<?php
// admin/admin_header.php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/../config/database.php';

$current_page = basename($_SERVER['PHP_SELF']);

$page_titles = [
    'dashboard.php'      => 'Dashboard',
    'event.php'          => 'Manajemen Agenda',
    'daftar_peserta.php' => 'Daftar Peserta',
];
$page_title_text = $page_titles[$current_page] ?? 'Admin Panel';
?>
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title_text ?> — Dishub Jateng Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <?= vite_assets() ?>
</head>
<body class="bg-slate-100 font-sans min-h-screen flex">

<!-- ══════════════════════════════════════
     SIDEBAR (Desktop: fixed left column)
     ══════════════════════════════════════ -->
<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-40 w-64 bg-dishub-navy flex flex-col
              transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <!-- Brand -->
    <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center flex-shrink-0 shadow">
            <img src="<?= BASE_URL ?>assets/img/jateng.png"
                 alt="Logo Jateng" class="w-8 h-8 object-contain">
        </div>
        <div class="leading-tight">
            <p class="text-white font-bold text-sm leading-none">Dishub Jateng</p>
            <p class="text-slate-400 text-xs mt-0.5">Admin Panel</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider px-3 mb-3">
            Menu Utama
        </p>

        <a href="<?= BASE_URL ?>admin/dashboard.php"
           class="side-link <?= $current_page === 'dashboard.php' ? 'active' : '' ?>">
            <span class="side-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
            </span>
            <span>Dashboard</span>
        </a>

        <a href="<?= BASE_URL ?>admin/event.php"
           class="side-link <?= $current_page === 'event.php' ? 'active' : '' ?>">
            <span class="side-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </span>
            <span>Manajemen Agenda</span>
        </a>

        <a href="<?= BASE_URL ?>admin/daftar_peserta.php"
           class="side-link <?= $current_page === 'daftar_peserta.php' ? 'active' : '' ?>">
            <span class="side-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </span>
            <span>Daftar Peserta</span>
        </a>

        <div class="pt-4 mt-4 border-t border-white/10">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider px-3 mb-3">
                Lainnya
            </p>
            <a href="<?= BASE_URL ?>index.php" target="_blank" class="side-link">
                <span class="side-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </span>
                <span>Lihat Website</span>
            </a>
        </div>
    </nav>

    <!-- User + Logout -->
    <div class="px-4 py-4 border-t border-white/10">
        <div class="flex items-center gap-3 px-3 py-2 mb-2 rounded-xl bg-white/5">
            <div class="w-8 h-8 rounded-lg bg-dishub-blue flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold uppercase">
                    <?= strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)) ?>
                </span>
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-semibold truncate">
                    <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
                </p>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                    <span class="text-green-400 text-xs">Online</span>
                </div>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin/logout.php"
           class="side-link text-red-400 hover:text-red-300 hover:bg-red-500/10 w-full">
            <span class="side-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </span>
            <span>Keluar</span>
        </a>
    </div>
</aside>

<!-- Mobile sidebar overlay -->
<div id="sidebar-overlay"
     class="fixed inset-0 z-30 bg-black/50 hidden lg:hidden"
     onclick="toggleSidebar()">
</div>

<!-- ══════════════════════════════════════
     MAIN CONTENT AREA
     ══════════════════════════════════════ -->
<div class="flex-1 flex flex-col min-w-0 lg:ml-64">

    <!-- Top Header -->
    <header class="sticky top-0 z-20 bg-white border-b border-slate-200 shadow-sm">
        <div class="flex items-center justify-between h-16 px-4 md:px-6">

            <!-- Left: Hamburger (mobile) + Page Title -->
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-sm">
                    <span class="text-slate-400 hidden sm:inline">Admin</span>
                    <span class="text-slate-300 hidden sm:inline">/</span>
                    <span class="font-semibold text-slate-800"><?= $page_title_text ?></span>
                </nav>
            </div>

            <!-- Right: User info -->
            <div class="flex items-center gap-3">

                <div class="hidden sm:block text-right">
                    <p class="text-sm font-semibold text-slate-800">
                        <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
                    </p>
                    <p class="text-xs text-slate-400">Administrator</p>
                </div>

                <div class="w-9 h-9 rounded-xl bg-dishub-blue flex items-center justify-center
                            text-white text-sm font-bold shadow">
                    <?= strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)) ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content Wrapper -->
    <main class="flex-1 p-4 md:p-6 space-y-6 animate-fade-in">
<?php
// NOTE: Each page that includes this file must close:
//   </main></div></body></html>
?>
