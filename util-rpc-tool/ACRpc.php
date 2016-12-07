<?php
/**
 * Copyright © 2015 AboutCoder.COM, All rights reserved.
 *
 * @author Jerome Chan
 * @date 12/13/15 5:13 PM
 * @description 
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////  Configurations of rpc request
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$url = "http://boss-stable.tuniu.com/restfulServer/agencyres";
//$url = "http://crm.tuniu.com/restfulServer/agencyres";
$method = "POST";
$params = array(
	"method" => "getAgencyContact",
	"param" => array(
		"agency_id" => 4333
	),
);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////  Execution codes body
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ch = curl_init();
$encodeParams = encoding($params);
if($method == "GET") {
	$url .= "?" . $encodeParams;
	curl_setopt($ch, CURLOPT_HTTPGET, true); //TRUE to reset the HTTP request method to GET. Since GET is the default, this is only necessary if the request method has been changed.
} elseif ($method == "POST") {
	curl_setopt($ch, CURLOPT_POST, true); //TRUE to do a regular HTTP POST. This POST is the normal application/x-www-form-urlencoded kind, most commonly used by HTML forms.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $encodeParams); //The full data to post in a HTTP "POST" operation. To post a file, prepend a filename with @ and use the full path. The filetype can be explicitly specified by following the filename with the type in the format ';type=mimetype'. This parameter can either be passed as a urlencoded string like 'para1=val1&para2=val2&...' or as an array with the field name as key and field data as value. If value is an array, the Content-Type header will be set to multipart/form-data. As of PHP 5.2.0, value must be an array if files are passed to this option with the @ prefix. As of PHP 5.5.0, the @ prefix is deprecated and files can be sent using CURLFile. The @ prefix can be disabled for safe passing of values beginning with @ by setting the CURLOPT_SAFE_UPLOAD option to TRUE.
} elseif ($method == "PUT") {
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //A custom request method to use instead of "GET" or "HEAD" when doing a HTTP request. This is useful for doing "DELETE" or other, more obscure HTTP requests. Valid values are things like "GET", "POST", "CONNECT" and so on; i.e. Do not enter a whole HTTP request line here. For instance, entering "GET /index.html HTTP/1.0\r\n\r\n" would be incorrect. (NOTE)Don't do this without making sure the server supports the custom request method first.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $encodeParams); //The full data to post in a HTTP "POST" operation. To post a file, prepend a filename with @ and use the full path. The filetype can be explicitly specified by following the filename with the type in the format ';type=mimetype'. This parameter can either be passed as a urlencoded string like 'para1=val1&para2=val2&...' or as an array with the field name as key and field data as value. If value is an array, the Content-Type header will be set to multipart/form-data. As of PHP 5.2.0, value must be an array if files are passed to this option with the @ prefix. As of PHP 5.5.0, the @ prefix is deprecated and files can be sent using CURLFile. The @ prefix can be disabled for safe passing of values beginning with @ by setting the CURLOPT_SAFE_UPLOAD option to TRUE.
} elseif ($method == "DELETE") {
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //A custom request method to use instead of "GET" or "HEAD" when doing a HTTP request. This is useful for doing "DELETE" or other, more obscure HTTP requests. Valid values are things like "GET", "POST", "CONNECT" and so on; i.e. Do not enter a whole HTTP request line here. For instance, entering "GET /index.html HTTP/1.0\r\n\r\n" would be incorrect. (NOTE)Don't do this without making sure the server supports the custom request method first.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $encodeParams); //The full data to post in a HTTP "POST" operation. To post a file, prepend a filename with @ and use the full path. The filetype can be explicitly specified by following the filename with the type in the format ';type=mimetype'. This parameter can either be passed as a urlencoded string like 'para1=val1&para2=val2&...' or as an array with the field name as key and field data as value. If value is an array, the Content-Type header will be set to multipart/form-data. As of PHP 5.2.0, value must be an array if files are passed to this option with the @ prefix. As of PHP 5.5.0, the @ prefix is deprecated and files can be sent using CURLFile. The @ prefix can be disabled for safe passing of values beginning with @ by setting the CURLOPT_SAFE_UPLOAD option to TRUE.
} else {
	print_r("请指定HTTP METHOD！");
	return;
}
$header = array(
	"X-HTTP-Method-Override: $method",
);
curl_setopt($ch, CURLOPT_URL, $url); //The URL to fetch. This can also be set when initializing a session with curl_init().
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
curl_setopt($ch, CURLOPT_HEADER, false); //TRUE to include the header in the output.
curl_setopt($ch, CURLOPT_TIMEOUT, 600); //The maximum number of seconds to allow cURL functions to execute.
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); //The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //An array of HTTP header fields to set, in the format array('Content-type: text/plain', 'Content-length: 100')
$output = curl_exec($ch); //Perform a cURL session. This function should be called after initializing a cURL session and all the options for the session are set.
curl_close($ch);
$decodeResult = decoding($output);

// Print out the parameters.
print_r("输入：");
var_dump($url, $params);
// Print out the output results.
echo "\n";
print_r("输出：");
var_dump($decodeResult, $output);

/**
 * Encoding object the rpc requests need.
 */
function encoding($object) {
	return base64_encode(json_encode($params));
}

/**
 * Decoding object the rpc requests need.
 */
function decoding($object) {
	return json_decode(base64_decode($object));
}