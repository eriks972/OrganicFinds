<?php
require_once "Credentials.php";

// Create connection
$conn = new mysqli($DBhostname, $DBusername, $DBpassword, $DBname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>