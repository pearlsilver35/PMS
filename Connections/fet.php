<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_fet = "localhost";
$database_fet = "db_pms";
$username_fet = "root";
$password_fet = "";
$fet = mysql_pconnect($hostname_fet, $username_fet, $password_fet) or trigger_error(mysql_error(),E_USER_ERROR); 
?>