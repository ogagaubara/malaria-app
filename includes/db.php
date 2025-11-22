<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // leave blank for WAMP default
$dbname = 'health_app';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>