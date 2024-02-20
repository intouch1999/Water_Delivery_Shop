<?php
$servername = "localhost";
$username = "insurely_admin";
$password = "Aa12346789";
try {
  $conn = new PDO("mysql:host=$servername;dbname=Username", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed please contact admin";
}
?>