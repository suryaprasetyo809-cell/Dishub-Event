<?php
$page_title = 'Visi & Misi — Dishub Jawa Tengah';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Header -->
<div class="bg-dishub-navy py-14 relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-96 h-96 bg-dishub-blue/20 rounded-full blur-[120px] animate-pulse-slow pointer-events-none"></div>
    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <p class="text-dishub-accent text-xs font-semibold uppercase tracking-widest mb-2">Strategi 2045</p>
        <h1 class="text-3xl md:text-5xl font-black text-white mb-4">
            Visi &amp; <span class="text-dishub-accent">Misi.</span>
        </h1>
        <p class="text-slate-400 text-sm md:text-base max-w-2xl">
            Jawa Tengah sebagai Provinsi Maju yang Berkelanjutan untuk Menuju Indonesia Emas 2045.
        </p>
    </div>
</div>

<div class="container mx-auto px-4 md:px-6 py-12 space-y-10">

    <!-- Vision Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-dishub-navy to-[#003580] p-6 md:p-10 relative">
            <div class="absolute right-0 top-0 w-72 h-72 bg-dishub-blue/20 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 bg-dishub-accent/20 border border-dishub-accent/30
                            px-4 py-1.5 rounded-full text-dishub-accent text-xs font-bold uppercase mb-5">
                    ⭐ Visi
                </div>
                <p class="text-white text-xl md:text-3xl font-black leading-tight max-w-3xl">
                    "Jawa Tengah sebagai Provinsi Maju yang Berkelanjutan untuk Menuju
                    <span class="text-dishub-accent">Indonesia Emas 2045</span>."
                </p>
            </div>
        </div>
    </div>

    <!-- Mission Grid -->
    <div>
        <div class="flex items-center gap-3 mb-6">
            <span class="w-1 h-6 bg-dishub-blue rounded-full"></span>
            <h2 class="text-xl font-bold text-dishub-navy">Agenda Misi Kami</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $misi = [
                "Meningkatkan layanan dasar yang inklusif untuk mewujudkan sumber daya manusia mandiri dan kompetitif.",
                "Meningkatkan pertumbuhan perekonomian perkotaan dan pedesaan berbasis sektor unggulan berkelanjutan.",
                "Mewujudkan tata kelola pemerintahan yang responsif dan kolaboratif dengan nilai integritas tinggi.",
                "Mewujudkan pembangunan infrastruktur yang merata dan berkeadilan bagi seluruh lapisan masyarakat.",
                "Menjaga stabilitas daerah dengan pendekatan budaya lokal dan perlindungan kesejahteraan sosial.",
                "Menciptakan iklim investasi kondusif untuk membuka kesempatan kerja seluas-luasnya.",
            ];

            $colors = [
                'bg-blue-50 text-dishub-blue',
                'bg-yellow-50 text-yellow-600',
                'bg-green-50 text-green-600',
                'bg-purple-50 text-purple-600',
                'bg-orange-50 text-orange-600',
                'bg-cyan-50 text-cyan-600',
            ];

            foreach ($misi as $i => $item):
            ?>
            <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm p-5
                        hover:shadow-md hover:-translate-y-1 hover:border-dishub-blue/30 transition-all duration-300">
                <div class="w-11 h-11 rounded-2xl <?= $colors[$i] ?> flex items-center justify-center
                            text-base font-black mb-4 group-hover:scale-110 transition-transform">
                    <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                </div>
                <p class="text-slate-700 text-sm leading-relaxed font-medium"><?= $item ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
