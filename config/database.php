<?php
// Load Composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env locally if it exists
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// Database Connection using Environment Variables
$conn = mysqli_connect(
    getenv('MYSQLHOST') ?: 'localhost',
    getenv('MYSQLUSER') ?: 'root',
    getenv('MYSQLPASSWORD') ?: '',
    getenv('MYSQLDATABASE') ?: 'dishub_event',
    getenv('MYSQLPORT') ?: '3306'
);

if (!$conn) {
    die("Gagal koneksi database: " . mysqli_connect_error());
}
