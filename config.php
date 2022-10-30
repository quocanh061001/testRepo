<?php 
$host = 'localhost';
$db   = 'crud';
$user = 'root';
$pass = '';
$port = "3307";
$charset = 'utf8mb4';


     $mysqli = new mysqli($host,$user,$pass, $db, $port);
     echo 'connect successfully';
     if ($mysqli -> connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
    }
?>