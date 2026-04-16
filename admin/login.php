<?php
session_start();
require_once __DIR__ . '/../config/app.php';

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Dishub Jateng</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    <?= vite_assets() ?>
</head>
<body class="bg-dishub-navy min-h-screen flex items-center justify-center p-6 relative overflow-hidden selection:bg-dishub-accent selection:text-dishub-navy">
    
    <!-- Cinematic Industrial Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-dishub-blue/10 rounded-full blur-[150px] animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-dishub-accent/5 rounded-full blur-[120px] animate-pulse-slow"></div>
    </div>

    <!-- Login Card (Normalized Professional) -->
    <div class="relative z-10 w-full max-w-md">
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl border border-white/20 animate-fade-in-up">
            
            <div class="text-center mb-10 group">
                <div class="inline-block p-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-inner mb-6 group-hover:rotate-12 transition-transform duration-700">
                    <img src="<?= BASE_URL ?>assets/img/jateng.png" alt="Logo Jateng" class="h-16 w-auto">
                </div>
                <h1 class="text-3xl font-black text-dishub-navy tracking-tight italic uppercase">Portal <span class="text-dishub-blue">Admin.</span></h1>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2 opacity-80 italic">Otoritas Keamanan Sistem Event</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl text-center text-xs font-bold uppercase tracking-wider mb-8 animate-shake">
                    ⚠️ AUTHENTICATION ERROR: <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <form action="proses_login.php" method="post" class="space-y-6">
                <div class="space-y-2 group">
                    <label class="form-label px-1">Kredensial Username</label>
                    <div class="relative">
                        <input type="text" name="username" class="form-input" placeholder="Masukkan username" required autofocus>
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 opacity-30 group-focus-within:opacity-100 transition-opacity">👤</span>
                    </div>
                </div>

                <div class="space-y-2 group">
                    <label class="form-label px-1">Kunci Akses Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" class="form-input" placeholder="Masukkan password" required>
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 opacity-30 group-focus-within:opacity-100 transition-opacity">🔒</span>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn-primary w-full justify-center py-3 text-base shadow-xl">
                        EKSEKUSI AKSES &rarr;
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                 <a href="<?= BASE_URL ?>index.php" class="text-[10px] font-bold text-slate-400 hover:text-dishub-blue transition-all group uppercase tracking-widest italic">
                     <span class="group-hover:-translate-x-1 transition-transform inline-block mr-1">←</span> Kembali Ke Beranda Publik
                 </a>
            </div>
        </div>
        
        <p class="text-center text-[10px] text-white/30 font-bold uppercase tracking-widest mt-8 italic opacity-80 decoration-white/5">
            &copy; <?= date('Y') ?> Dinas Perhubungan Jawa Tengah
        </p>
    </div>

    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }
        .animate-shake { animation: shake 0.4s ease-in-out; }
    </style>
</body>
</html>
