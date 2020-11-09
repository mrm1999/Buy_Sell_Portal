<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "dbpro";
$db_port = 3306;

// Creating a Connection
$mysql = new mysqli($db_host,$db_user,$db_password,$db_name,$db_port);

if($mysql->connect_error)
{
    die("Connection failed");
}
/*else
{
    echo("Connection Sucessfull");
}*/
?>
