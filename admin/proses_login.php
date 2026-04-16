<?php
session_start();
require_once '../config/database.php';

// Ambil data dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header('Location: login.php?error=Username dan password harus diisi');
    exit;
}

// Cari admin berdasarkan username
$stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($result);

if ($admin && password_verify($password, $admin['password'])) {
    // Login sukses, simpan session
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['username'] = $admin['username'];
    $_SESSION['is_logged_in'] = true;

    header('Location: dashboard.php');
    exit;
} else {
    // Login gagal
    header('Location: login.php?error=Username atau Password salah');
    exit;
}
