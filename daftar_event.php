<?php
$page_title = 'Daftar Agenda — Event Dishub Jawa Tengah';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/header.php';

try {
    $events = mysqli_query($conn, "SELECT * FROM events ORDER BY tanggal_event ASC");
    $total  = mysqli_num_rows($events);
} catch (mysqli_sql_exception $e) {
    die("Error Database: " . $e->getMessage() . ". <br>Pastikan tabel 'events' sudah memiliki kolom 'deskripsi'!");
}
?>

<!-- Page Header -->
<div class="bg-dishub-navy py-14 relative overflow-hidden">
    <div class="absolute right-0 top-0 w-80 h-80 bg-dishub-blue/20 rounded-full blur-[100px] animate-pulse-slow pointer-events-none"></div>
    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <p class="text-dishub-accent text-xs font-semibold uppercase tracking-widest mb-2">Agenda Resmi</p>
        <h1 class="text-3xl md:text-5xl font-black text-white mb-4">
            Agenda &amp; <span class="text-dishub-accent">Kegiatan.</span>
        </h1>
        <p class="text-slate-400 text-sm md:text-base max-w-xl">
            Pilih kegiatan dan daftarkan diri Anda untuk berpartisipasi dalam agenda resmi Dishub Jawa Tengah.
        </p>
        <div class="flex items-center gap-4 mt-6">
            <div class="bg-white/10 backdrop-blur border border-white/20 rounded-xl px-5 py-3 text-center">
                <p class="text-dishub-accent font-black text-2xl"><?= $total ?></p>
                <p class="text-slate-400 text-xs">Agenda Aktif</p>
            </div>
        </div>
    </div>
</div>

<!-- Events Grid -->
<div class="container mx-auto px-4 md:px-6 py-12">

    <?php if ($total === 0): ?>
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Agenda</h2>
            <p class="text-slate-400 text-sm">Silakan pantau kembali secara berkala.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($row = mysqli_fetch_assoc($events)):
                $ts    = strtotime($row['tanggal_event']);
                $day   = date('d', $ts);
                $month = date('M', $ts);
                $year  = date('Y', $ts);
                $is_past = $ts < strtotime('today');
            ?>
            <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm
                        hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden">

                <!-- Card top (colored band) -->
                <div class="h-2 <?= $is_past ? 'bg-slate-200' : 'bg-dishub-blue' ?>"></div>

                <div class="p-6 flex-1 flex flex-col gap-4">
                    <!-- Date badge + status -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="bg-blue-50 rounded-2xl p-3 text-center min-w-[60px] flex-shrink-0
                                    group-hover:bg-dishub-blue transition-colors">
                            <span class="block text-2xl font-black text-dishub-blue group-hover:text-white transition-colors">
                                <?= $day ?>
                            </span>
                            <span class="block text-xs font-semibold text-blue-400 group-hover:text-blue-200 transition-colors uppercase">
                                <?= $month . ' ' . $year ?>
                            </span>
                        </div>
                        <?php if ($is_past): ?>
                            <span class="text-xs font-semibold text-slate-400 bg-slate-100 px-2 py-1 rounded-full">
                                Selesai
                            </span>
                        <?php else: ?>
                            <span class="badge-active">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-ping inline-block"></span>
                                Terbuka
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Title & description -->
                    <div class="flex-1">
                        <h2 class="font-bold text-dishub-navy text-base leading-tight mb-2 line-clamp-2">
                            <?= htmlspecialchars($row['nama_event']) ?>
                        </h2>
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">
                            <?= htmlspecialchars($row['deskripsi'] ?? 'Kegiatan resmi Dinas Perhubungan Provinsi Jawa Tengah.') ?>
                        </p>
                    </div>

                    <!-- CTA -->
                    <?php if (!$is_past): ?>
                    <a href="<?= BASE_URL ?>daftar.php?id_acara=<?= $row['id'] ?>"
                       class="btn-primary justify-center w-full text-sm">
                        Daftar Sekarang
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <?php else: ?>
                    <button disabled class="w-full text-center text-sm font-semibold text-slate-400
                                           bg-slate-50 py-2.5 rounded-xl cursor-not-allowed">
                        Pendaftaran Ditutup
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
