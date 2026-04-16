<?php
require_once __DIR__ . '/config/database.php';

echo "<h1>Patching Database Railway...</h1>";

try {
    // 1. Check if 'deskripsi' column exists in 'events'
    $result = mysqli_query($conn, "SHOW COLUMNS FROM events LIKE 'deskripsi'");
    if (mysqli_num_rows($result) === 0) {
        echo "<p>Menambahkan kolom 'deskripsi' ke tabel 'events'...</p>";
        mysqli_query($conn, "ALTER TABLE events ADD COLUMN deskripsi TEXT AFTER tanggal_event");
        echo "<p>✅ Kolom 'deskripsi' BERHASIL ditambahkan.</p>";
    } else {
        echo "<p>ℹ️ Kolom 'deskripsi' sudah ada.</p>";
    }

    echo "<h3>Selesai! Database Anda sekarang sudah sinkron dengan kode PHP.</h3>";
    echo "<p><a href='index.php'>Kembali ke Beranda</a></p>";

} catch (mysqli_sql_exception $e) {
    die("❌ GAGAL melakukan patch: " . $e->getMessage());
}
