<?php
declare(strict_types=1);
function getConnection(): mysqli
{
    $hostname = 'localhost';
    $dbName = 'fast_camp';
    $username = 'root';
    $password = '';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}