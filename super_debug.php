<?php
// super_debug.php - No dependencies
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🚀 Super Debug System</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";

// 1. Check vendor
$vendor = __DIR__ . '/vendor/autoload.php';
echo "<p>Vendor Autoload: " . (file_exists($vendor) ? "✅ EXISTS" : "❌ MISSING") . "</p>";

// 2. Check Database Settings
echo "<h3>Checking ENV Variables:</h3>";
echo "HOST: " . (getenv('MYSQLHOST') ?: 'NOT SET') . "<br>";
echo "USER: " . (getenv('MYSQLUSER') ?: 'NOT SET') . "<br>";
echo "DB: " . (getenv('MYSQLDATABASE') ?: 'NOT SET') . "<br>";

// 3. Test Direct Connection
echo "<h3>Testing Direct Connection:</h3>";
try {
    $c = mysqli_connect(
        getenv('MYSQLHOST') ?: 'localhost',
        getenv('MYSQLUSER') ?: 'root',
        getenv('MYSQLPASSWORD') ?: '',
        getenv('MYSQLDATABASE') ?: 'dishub_event',
        getenv('MYSQLPORT') ?: '3306'
    );
    if ($c) {
        echo "✅ Connection Success!<br>";
        $q = mysqli_query($c, "SHOW TABLES");
        echo "Tables found: " . mysqli_num_rows($q);
    } else {
        echo "❌ Connection Failed: " . mysqli_connect_error();
    }
} catch (Exception $e) {
    echo "❌ Exception: " . $e->getMessage();
}
