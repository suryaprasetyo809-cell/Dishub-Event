<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug Info</h1>";

$vendor = __DIR__ . '/vendor/autoload.php';
if (file_exists($vendor)) {
    echo "<p>✅ vendor/autoload.php exists</p>";
} else {
    echo "<p>❌ vendor/autoload.php MISSING</p>";
}

require_once __DIR__ . '/config/database.php';

if (isset($conn)) {
    echo "<p>✅ Database connection variable exists</p>";
    $query = mysqli_query($conn, "SELECT * FROM events");
    if ($query) {
        echo "<p>✅ Table 'events' is readable. Total rows: " . mysqli_num_rows($query) . "</p>";
    } else {
        echo "<p>❌ Query failed: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p>❌ Connection failed</p>";
}
