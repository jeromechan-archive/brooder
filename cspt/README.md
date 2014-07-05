lbs-cspt
========
Project depends on CodeIgniter 2.1.3 and Spark 0.0.9

========
Installation
1. Apache virtual host configuration
<VirtualHost *:80>

    ServerName lbs-cspt.github.com
    DocumentRoot "/opt/app/lbs-cspt"
    ErrorLog "logs/lbs-cspt.github.com-error.log"
    CustomLog "logs/lbs-cspt.github.com-access.log" common
    <Directory "/opt/app/lbs-cspt">
		AllowOverride None
		Options Includes FollowSymLinks Indexes
		Order allow,deny
		Allow from all
		
		RewriteEngine On
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteRule . index.php   [L,QSA]
    </Directory>
    
</VirtualHost>
