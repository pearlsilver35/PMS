<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dbconn = "localhost";
$database_dbconn = "db_pms";
$username_dbconn = "root";
$password_dbconn = "";
$dbconn = mysql_pconnect($hostname_dbconn, $username_dbconn, $password_dbconn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>