<?php
$page_title = 'Beranda — Event Dishub Jawa Tengah';
require_once __DIR__ . '/includes/header.php';
?>

<!-- ── HERO ──────────────────────────────── -->
<section class="relative bg-dishub-navy overflow-hidden min-h-[520px] flex items-center">
    <!-- Background pamflet image with overlay -->
    <div class="absolute inset-0">
        <img src="<?= BASE_URL ?>assets/img/pamflet.jpg"
             alt="" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-r from-dishub-navy via-dishub-navy/90 to-dishub-navy/60"></div>
    </div>

    <!-- Decorative glows -->
    <div class="absolute right-0 top-0 w-[600px] h-[600px] bg-dishub-blue/20 rounded-full
                blur-[120px] pointer-events-none animate-pulse-slow"></div>
    <div class="absolute right-1/3 bottom-0 w-80 h-80 bg-dishub-accent/10 rounded-full
                blur-[80px] pointer-events-none"></div>

    <div class="container mx-auto px-4 md:px-6 relative z-10 py-20">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20
                        px-4 py-1.5 rounded-full text-white text-xs font-semibold mb-6">
                <span class="w-2 h-2 bg-dishub-accent rounded-full animate-ping"></span>
                Portal Resmi 2026
            </div>

            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6">
                Digitalisasi <br>
                Pelayanan <span class="text-dishub-accent underline decoration-blue-500 decoration-4 underline-offset-4">Dishub Jateng.</span>
            </h1>

            <p class="text-slate-300 text-base md:text-lg leading-relaxed mb-8 max-w-xl">
                Pusat pendaftaran dan informasi berbagai kegiatan strategis Dinas Perhubungan Provinsi Jawa Tengah yang modern dan terintegrasi.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="<?= BASE_URL ?>daftar_event.php" class="btn-accent">
                    Lihat Agenda &rarr;
                </a>
                <a href="<?= BASE_URL ?>profil.php"
                   class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20
                          text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-white/20 transition-colors">
                    Tentang Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ── FEATURE HIGHLIGHTS ────────────────── -->
<section class="bg-white py-16">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <p class="text-xs font-semibold text-dishub-blue uppercase tracking-widest mb-2">Keunggulan Platform</p>
            <h2 class="text-2xl md:text-4xl font-black text-dishub-navy">Satu Pintu Menuju<br>Event Perhubungan</h2>
            <div class="w-16 h-1 bg-dishub-accent mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $features = [
                ['icon' => '📄', 'color' => 'bg-blue-50 text-dishub-blue', 'title' => 'Paperless Registration',
                 'desc' => 'Daftar kapan saja dan di mana saja tanpa kerumulan berkas fisik. Semua proses sepenuhnya digital.'],
                ['icon' => '⚡', 'color' => 'bg-yellow-50 text-yellow-600', 'title' => 'Real-time Approval',
                 'desc' => 'Validasi data secara instan. Status kepesertaan Anda diproses saat itu juga.'],
                ['icon' => '📜', 'color' => 'bg-green-50 text-green-600', 'title' => 'E-Sertifikat Resmi',
                 'desc' => 'Sertifikat digital yang sah dan dapat diunduh langsung setelah kegiatan selesai dilaksanakan.'],
            ];
            foreach ($features as $f):
            ?>
            <div class="group bg-slate-50 hover:bg-white rounded-2xl p-6 border border-transparent
                        hover:border-slate-200 hover:shadow-lg transition-all duration-300">
                <div class="w-12 h-12 rounded-2xl <?= $f['color'] ?> flex items-center justify-center text-2xl mb-4
                            group-hover:scale-110 transition-transform">
                    <?= $f['icon'] ?>
                </div>
                <h3 class="font-bold text-dishub-navy text-base mb-2"><?= $f['title'] ?></h3>
                <p class="text-slate-500 text-sm leading-relaxed"><?= $f['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── CALL TO ACTION ────────────────────── -->
<section class="bg-dishub-bg py-16">
    <div class="container mx-auto px-4 md:px-6">
        <div class="bg-dishub-navy rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center
                    justify-between gap-8 relative overflow-hidden">
            <div class="relative z-10 max-w-xl">
                <h3 class="text-2xl md:text-4xl font-black text-white leading-tight mb-4">
                    Wujudkan <span class="text-dishub-accent">Jateng Gayeng</span><br>
                    Melalui Transportasi Modern.
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Bergabunglah dalam kegiatan strategis kami dan berkontribusi nyata bagi kemajuan perhubungan Jawa Tengah.
                </p>
            </div>
            <a href="<?= BASE_URL ?>daftar_event.php"
               class="btn-accent flex-shrink-0 text-base px-8 py-4 rounded-2xl shadow-xl">
                Daftar Sekarang &rarr;
            </a>
            <!-- Decorative -->
            <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-dishub-blue/20 rounded-full blur-3xl pointer-events-none"></div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
