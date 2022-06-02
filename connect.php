<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'trybae_site';

$conn = new MySQLi($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
