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

    // 2. Update Foreign Key to ON DELETE CASCADE
    echo "<p>Memperbarui relasi tabel (ON DELETE CASCADE)...</p>";
    
    // Cari nama constraint yang ada pada kolom event_id
    $query_find_fk = "SELECT CONSTRAINT_NAME 
                      FROM information_schema.KEY_COLUMN_USAGE 
                      WHERE TABLE_SCHEMA = DATABASE() 
                      AND TABLE_NAME = 'peserta' 
                      AND COLUMN_NAME = 'event_id' 
                      AND REFERENCED_TABLE_NAME = 'events'";
    
    $fk_result = mysqli_query($conn, $query_find_fk);
    while ($row = mysqli_fetch_assoc($fk_result)) {
        $old_fk = $row['CONSTRAINT_NAME'];
        echo "<p>Menghapus constraint lama: <code>$old_fk</code>...</p>";
        mysqli_query($conn, "ALTER TABLE peserta DROP FOREIGN KEY $old_fk");
    }

    echo "<p>Menambahkan constraint baru dengan ON DELETE CASCADE...</p>";
    mysqli_query($conn, "ALTER TABLE peserta ADD CONSTRAINT fk_event_cascade 
                        FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE");
    
    echo "<p>✅ Relasi tabel BERHASIL diperbarui.</p>";

    echo "<h3>Selesai! Database Anda sekarang sudah sinkron dengan kode PHP.</h3>";
    echo "<p><a href='index.php'>Kembali ke Beranda</a></p>";

} catch (mysqli_sql_exception $e) {
    die("❌ GAGAL melakukan patch: " . $e->getMessage());
}
