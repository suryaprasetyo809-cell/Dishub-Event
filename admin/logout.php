<?php
session_start();

// Hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

// Kembali ke halaman awal (menu user)
header("Location: ../index.php");
exit;
