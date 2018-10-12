<?php
$servername = "localhost";  
$username;  //commit 前刪除
$password;  //commit 前刪除
$dbname = "mentor_program_db";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

$conn->query("SET NAMES 'UTF8'");
$conn->query("SET time_zone = '+08:00'");

?>