<?php
/**
 * RESTClient Components
 *
 * Make REST requests to RESTful services with simple syntax.
 * Ported from CodeIgniter REST Class.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Philip Sturgeon
 * @author          Edited by Neilsen Chan
 * @created			04/06/2009
 * @license         http://philsturgeon.co.uk/code/dbad-license
 * @link			http://getsparks.org/packages/restclient/show
 */
require_once 'CURL.php';
class RESTClient
{
	private $rest_server;
	private $format;
	private $mime_type;
	
	private $http_auth = null;
	private $http_user = null;
	private $http_pass = null;

    private $response_string;
	private $_curl;
	private $_headers = array();

	function __construct($config = array())
    {
		$this->_curl = new CURL();
		empty($config) OR $this->initialize($config);
    }

	function __destruct()
	{
		$this->_curl->set_default();
	}

    public function initialize($config)
    {
		$this->rest_server = $config['server'];
		
		if (substr($this->rest_server, -1, 1) != '/')
		{
			$this->rest_server .= '/';
		}

		isset($config['http_auth']) && $this->http_auth = $config['http_auth'];
		isset($config['http_user']) && $this->http_user = $config['http_user'];
		isset($config['http_pass']) && $this->http_pass = $config['http_pass'];
    }


    public function get($uri, $params = array(), $format = NULL)
    {
    	return $this->_call('get', $uri, $params, $format);
    }


    public function post($uri, $params = array(), $format = NULL)
    {
        return $this->_call('post', $uri, $params, $format);
    }


    public function put($uri, $params = array(), $format = NULL)
    {
        return $this->_call('put', $uri, $params, $format);
    }


    public function delete($uri, $params = array(), $format = NULL)
    {
        return $this->_call('delete', $uri, $params, $format);
    }

    public function api_key($key, $name = 'X-API-KEY')
	{
		$this->_curl->http_header($name, $key);
	}
	
	public function set_header($name, $value)
	{
		$this->_headers[$name] = $value;
	}

    public function language($lang)
	{
		if (is_array($lang))
		{
			$lang = implode(', ', $lang);
		}

		$this->_curl->http_header('Accept-Language', $lang);
	}

    private function _call($method, $uri, $params = array(), $format = NULL)
    {
    	$this->format($format);
    	$this->_set_headers();
        $encode_func = $this->format."_encode";
    	$params = Encrypt::$encode_func($params);
    	
        if ($method=='get')
        {
        	$uri .= '?'.$params;
            $params= null;
        }
        
        // Initialize cURL session
        $this->_curl->create($this->rest_server.$uri);

        // If authentication is enabled use it
        if ($this->http_auth != '' && $this->http_user != '')
        {
        	$this->_curl->http_login($this->http_user, $this->http_pass, $this->http_auth);
        }

        // We still want the response even if there is an error code over 400
        $this->_curl->option('failonerror', FALSE);

        // Call the correct method with parameters
        $this->_curl->{$method}($params);

        // Execute and return the response from the REST
        $response = $this->_curl->execute();
        $this->response_string =& $response;
        // Format and return
        $decode_func = $this->format."_decode";
		return Encrypt::$decode_func($response);
    }


    // If a type is passed in that is not supported, use it as a mime type
    public function format($format)
	{
		$format = $format ? $format : 'encrypt';
		if (array_key_exists($format, Encrypt::$supported_formats))
		{
			$this->format = $format;
			$this->mime_type = Encrypt::$supported_formats[$format];
		}
		else
		{
			$this->mime_type = $format;
		}

		return $this;
	}

	public function debug()
	{
		$request = $this->_curl->debug();

		echo "=============================================<br/>\n";
		echo "<h2>REST Test</h2>\n";
		echo "=============================================<br/>\n";
		echo "<h3>Request</h3>\n";
		echo $request['url']."<br/>\n";
		echo "=============================================<br/>\n";
		echo "<h3>Response</h3>\n";

		if ($this->response_string)
		{
			echo "<code>".nl2br(htmlentities($this->response_string))."</code><br/>\n\n";
		}

		else
		{
			echo "No response<br/>\n\n";
		}

		echo "=============================================<br/>\n";

		if ($this->_curl->error_string)
		{
			echo "<h3>Errors</h3>";
			echo "<strong>Code:</strong> ".$this->_curl->error_code."<br/>\n";
			echo "<strong>Message:</strong> ".$this->_curl->error_string."<br/>\n";
			echo "=============================================<br/>\n";
		}

		echo "<h3>Call details</h3>";
		echo "<pre>";
		print_r($this->_curl->info);
		echo "</pre>";

	}

	// Return HTTP status code
	public function status()
	{
		return $this->info('http_code');
	}

	// Return curl info by specified key, or whole array
	public function info($key = null)
	{
		return $key === null ? $this->_curl->info : @$this->_curl->info[$key];
	}

	// Set custom options
	public function option($code, $value)
	{
		$this->_curl->option($code, $value);
	}

	private function _set_headers()
	{
		if (! array_key_exists("Accept", $this->_headers)) $this->set_header("Accept", $this->mime_type);
		foreach ($this->_headers as $k => $v){
			$this->_curl->http_header(sprintf("%s: %s", $k, $v));
		}
	}

	private function _format_response($response)
	{
		$this->response_string =& $response;

		// It is a supported format, so just run its formatting method
		if (array_key_exists($this->format, Encrypt::$supported_formats))
		{
			return $this->{$this->format}($response);
		}

		// Find out what format the data was returned in
		$returned_mime = @$this->_curl->info['content_type'];

		// If they sent through more than just mime, stip it off
		if (strpos($returned_mime, ';'))
		{
			list($returned_mime)=explode(';', $returned_mime);
		}

		$returned_mime = trim($returned_mime);

		if (array_key_exists($returned_mime, Encrypt::$auto_detect_formats))
		{
			return $this->{Encrypt::$auto_detect_formats[$returned_mime]}($response);
		}

		return $response;
	}

    // Format XML for output
    private function _xml($string)
    {
		return $string ? (array) simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA) : array();
    }

    // Format HTML for output
    // This function is DODGY! Not perfect CSV support but works with my REST_Controller
    private function _csv($string)
    {
		$data = array();

		// Splits
		$rows = explode("\n", trim($string));
		$headings = explode(',', array_shift($rows));
		foreach( $rows as $row )
		{
			// The substr removes " from start and end
			$data_fields = explode('","', trim(substr($row, 1, -1)));

			if (count($data_fields) == count($headings))
			{
				$data[] = array_combine($headings, $data_fields);
			}

		}

		return $data;
    }

}

class Encrypt
{
    public static $supported_formats = array(
        'xml' 				=> 'application/xml',
        'json' 				=> 'application/json',
        'serialize' 		=> 'application/vnd.php.serialized',
        'php' 				=> 'text/plain',
        'csv'				=> 'text/csv',
        'encrypt'			=> 'text/html'
    );

    public static $auto_detect_formats = array(
        'application/xml' 	=> 'xml',
        'text/xml' 			=> 'xml',
        'application/json' 	=> 'json',
        'text/json' 		=> 'json',
        'text/csv' 			=> 'csv',
        'text/html' 		=> 'encrypt',
        'application/csv' 	=> 'csv',
        'application/vnd.php.serialized' => 'serialize'
    );

    // Encode as JSON
    public static function json_encode($string)
    {
        return json_encode(trim($string));
    }

    // Decode as JSON
    public static function json_decode($string)
    {
        return json_decode(trim($string), true);
    }

    // Encode as Serialized array
    public static function serialize_encode($string)
    {
        return serialize(trim($string));
    }

    // Decode as Serialized array
    public static function serialize_decode($string)
    {
        return unserialize(trim($string));
    }

    // Encode raw PHP
    public static function php($string)
    {
        $string = trim($string);
        $populated = array();
        eval("\$populated = \"$string\";");
        return $populated;
    }

    // Encode raw Encrypt
    public static function encrypt_encode($string)
    {
        return base64_encode(json_encode($string));
    }

    // Decode raw Encrypt
    public static function encrypt_decode($string)
    {
        return json_decode(base64_decode(trim($string)), true);
    }
}
