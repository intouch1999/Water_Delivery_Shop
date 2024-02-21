<?php
$servername = "da85.hostneverdie.com";
$username = "Username";
$password = "Password";
try {
  $conn = new PDO("mysql:host=$servername;dbname=Username", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed please contact admin";
}
?>