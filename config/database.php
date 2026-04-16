<?php
// Load Composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env locally if it exists
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

// Enable error reporting for debugging (helpful on Railway)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database Connection using local or Railway Environment Variables
$conn = mysqli_connect(
    getenv('MYSQLHOST') ?: getenv('MYSQL_HOST') ?: 'localhost',
    getenv('MYSQLUSER') ?: getenv('MYSQL_USER') ?: 'root',
    getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD') ?: '',
    getenv('MYSQLDATABASE') ?: getenv('MYSQL_DATABASE') ?: 'railway', // Railway default is usually 'railway'
    getenv('MYSQLPORT') ?: getenv('MYSQL_PORT') ?: '3306'
);

if (!$conn) {
    die("Gagal koneksi database: " . mysqli_connect_error());
}
