<?php
// includes/header.php — Public site header
require_once __DIR__ . '/../config/app.php';

if (!isset($page_title)) {
    $page_title = 'Event Dishub Jawa Tengah';
}

// Detect active nav link
$current = basename($_SERVER['PHP_SELF']);
function is_active(string $page): string {
    global $current;
    return $current === $page ? 'text-dishub-blue' : '';
}
?>
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal resmi pendaftaran kegiatan Dinas Perhubungan Provinsi Jawa Tengah.">
    <title><?= htmlspecialchars($page_title) ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Vite / Tailwind Assets -->
    <?= vite_assets() ?>
</head>
<body class="bg-dishub-bg font-sans text-slate-800 flex flex-col min-h-screen
             selection:bg-dishub-blue selection:text-white">

<!-- ── NAVBAR ─────────────────────────────── -->
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
    <div class="container mx-auto px-4 md:px-6 h-16 flex items-center justify-between gap-4">

        <!-- Brand (Logos + Name) -->
        <a href="<?= BASE_URL ?>index.php" class="flex items-center gap-3 flex-shrink-0 group">
            <img src="<?= BASE_URL ?>assets/img/jateng.png"
                 alt="Logo Jawa Tengah"
                 class="h-10 w-auto object-contain group-hover:scale-105 transition-transform drop-shadow-sm">
            <div class="hidden sm:block border-l border-slate-200 pl-3">
                <p class="font-black text-dishub-navy text-base leading-none">Dishub Jateng</p>
                <p class="text-xs text-slate-400 mt-0.5">Event Portal</p>
            </div>
        </a>

        <!-- Desktop nav -->
        <nav class="hidden md:flex items-center gap-1">
            <a href="<?= BASE_URL ?>index.php"
               class="nav-link px-3 py-2 rounded-lg hover:bg-slate-100 transition-colors text-xs font-semibold uppercase tracking-wide <?= is_active('index.php') ?>">
                Beranda
            </a>
            <a href="<?= BASE_URL ?>profil.php"
               class="nav-link px-3 py-2 rounded-lg hover:bg-slate-100 transition-colors text-xs font-semibold uppercase tracking-wide <?= is_active('profil.php') ?>">
                Profil
            </a>
            <a href="<?= BASE_URL ?>visi_misi.php"
               class="nav-link px-3 py-2 rounded-lg hover:bg-slate-100 transition-colors text-xs font-semibold uppercase tracking-wide <?= is_active('visi_misi.php') ?>">
                Visi &amp; Misi
            </a>
            <a href="<?= BASE_URL ?>daftar_event.php"
               class="nav-link px-3 py-2 rounded-lg hover:bg-slate-100 transition-colors text-xs font-semibold uppercase tracking-wide <?= is_active('daftar_event.php') ?>">
                Agenda
            </a>
            <a href="<?= BASE_URL ?>admin/login.php"
               class="ml-2 btn-primary text-xs px-4 py-2 rounded-lg">
                Admin Portal
            </a>
        </nav>

        <!-- Mobile hamburger -->
        <button id="mobile-toggle"
                class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Mobile dropdown menu -->
    <div id="mobile-menu"
         class="hidden md:hidden border-t border-slate-100 bg-white px-4 pb-4 pt-2 space-y-1">
        <a href="<?= BASE_URL ?>index.php"
           class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors <?= is_active('index.php') ?>">
            Beranda
        </a>
        <a href="<?= BASE_URL ?>profil.php"
           class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors <?= is_active('profil.php') ?>">
            Profil
        </a>
        <a href="<?= BASE_URL ?>visi_misi.php"
           class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors <?= is_active('visi_misi.php') ?>">
            Visi &amp; Misi
        </a>
        <a href="<?= BASE_URL ?>daftar_event.php"
           class="block px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors <?= is_active('daftar_event.php') ?>">
            Agenda Kegiatan
        </a>
        <div class="pt-2 border-t border-slate-100 mt-2">
            <a href="<?= BASE_URL ?>admin/login.php"
               class="block w-full text-center btn-primary text-sm py-2.5">
                Admin Portal
            </a>
        </div>
    </div>
</header>

<!-- Page content starts here -->
<div class="flex-grow flex flex-col">
