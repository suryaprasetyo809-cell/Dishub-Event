<?php
$page_title = 'Profil — Dishub Jawa Tengah';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<div class="bg-dishub-navy py-14 relative overflow-hidden">
    <div class="absolute right-0 top-0 w-96 h-96 bg-dishub-blue/20 rounded-full blur-[120px] animate-pulse-slow pointer-events-none"></div>
    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <p class="text-dishub-accent text-xs font-semibold uppercase tracking-widest mb-2">Tentang Kami</p>
        <h1 class="text-3xl md:text-5xl font-black text-white mb-4">
            Dinas <span class="text-dishub-accent">Perhubungan.</span>
        </h1>
        <p class="text-slate-400 text-sm md:text-base max-w-2xl">
            Melayani seluruh lapisan masyarakat Jawa Tengah dengan keandalan, integritas, dan semangat transformasi digital.
        </p>
    </div>
</div>

<!-- Content -->
<div class="container mx-auto px-4 md:px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Main content -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
                <h2 class="text-xl font-bold text-dishub-navy mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-dishub-blue rounded-full"></span>
                    Sejarah Singkat
                </h2>
                <div class="prose prose-sm text-slate-600 max-w-none space-y-4 leading-relaxed">
                    <p>
                        Sejak jaman Pemerintah Hindia Belanda, masalah lalu lintas ditangani oleh
                        <strong class="text-dishub-blue">"Departemen Weg Verkeer en Water Staat"</strong>
                        dengan aturan pelaksanaan dalam <em>Weg Verkeer Ordonantie</em> (WVO),
                        Staatsblad Nomor 86 Tahun 1933.
                    </p>
                    <blockquote class="border-l-4 border-dishub-accent pl-4 bg-slate-50 rounded-r-xl py-3 pr-4 italic text-slate-700 font-medium">
                        "Mendorong mobilitas Jawa Tengah yang berkelanjutan, aman, dan merata untuk semua."
                    </blockquote>
                    <p>
                        Dalam perkembangannya, organisasi ini bermetamorfosis mulai dari Djawatan Lalu Lintas
                        Djalan (LLD) pada 1957, hingga pembentukan <strong class="text-dishub-navy">Dinas
                        Perhubungan Provinsi Jawa Tengah</strong> melalui UU Nomor 23 Tahun 2014.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
                <h2 class="text-xl font-bold text-dishub-navy mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 bg-dishub-accent rounded-full"></span>
                    Fungsi Utama
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php
                    $fungsi = [
                        'Perumusan kebijakan strategis di bidang perhubungan lintas kabupaten/kota.',
                        'Pengawasan & pengendalian lalu lintas angkutan jalan dan penyeberangan.',
                        'Pengembangan infrastruktur transportasi darat, sungai, danau.',
                        'Pembinaan keselamatan berlalu lintas bagi warga Jawa Tengah.',
                    ];
                    foreach ($fungsi as $i => $item):
                    ?>
                    <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl hover:bg-blue-50 transition-colors group">
                        <span class="w-7 h-7 rounded-lg bg-dishub-blue text-white text-xs font-bold
                                     flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                        </span>
                        <p class="text-sm text-slate-600 leading-relaxed"><?= $item ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Timeline card -->
            <div class="bg-dishub-navy text-white rounded-2xl p-6 relative overflow-hidden">
                <h3 class="font-bold text-sm uppercase tracking-wider text-dishub-accent mb-5">
                    Timeline Transformasi
                </h3>
                <div class="space-y-4 border-l-2 border-white/10 pl-4 ml-2">
                    <?php
                    $timeline = [
                        ['year' => '1933', 'text' => 'WVO Staatsblad No. 86 — era Hindia Belanda.', 'active' => false],
                        ['year' => '1957', 'text' => 'Djawatan LLD, 10 provinsi nasional.', 'active' => false],
                        ['year' => '2014', 'text' => 'UU No. 23 — otonomi daerah perhubungan.', 'active' => true],
                    ];
                    foreach ($timeline as $t):
                    ?>
                    <div class="relative">
                        <div class="absolute -left-[21px] top-0.5 w-3 h-3 rounded-full
                                    <?= $t['active'] ? 'bg-dishub-accent ring-4 ring-yellow-500/20' : 'bg-white/30' ?>">
                        </div>
                        <p class="text-xs font-bold <?= $t['active'] ? 'text-dishub-accent' : 'text-blue-400' ?> mb-1">
                            <?= $t['year'] ?>
                        </p>
                        <p class="text-slate-300 text-xs leading-relaxed"><?= $t['text'] ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Glow -->
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-dishub-blue/30 rounded-full blur-3xl"></div>
            </div>

            <!-- Contact card -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-sm text-slate-800 mb-4">Info Kontak</h3>
                <div class="space-y-3">
                    <div class="flex gap-3 items-start">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-dishub-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500">Jl. Siliwangi No. 355-357, Semarang 50146</p>
                    </div>
                    <div class="flex gap-3 items-center">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-dishub-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500">(024) 7605803</p>
                    </div>
                </div>
                <a href="<?= BASE_URL ?>daftar_event.php"
                   class="btn-primary w-full justify-center mt-5 text-sm">
                    Lihat Agenda &rarr;
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
