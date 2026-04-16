<?php
require_once __DIR__ . '/admin_header.php';

try {
    // Statistics
    $total_event   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM events"))['c'] ?? 0;
    $total_peserta = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM peserta"))['c'] ?? 0;
    $event_aktif   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM events WHERE tanggal_event >= CURDATE()"))['c'] ?? 0;
    
    // Recent events
    $recent_events = mysqli_query($conn, "SELECT * FROM events ORDER BY tanggal_event DESC LIMIT 5");
    
    // Recent registrants
    $recent_peserta = mysqli_query($conn,
        "SELECT p.nama, p.jabatan, e.nama_event, p.id
         FROM peserta p LEFT JOIN events e ON p.event_id = e.id
         ORDER BY p.id DESC LIMIT 5");
} catch (mysqli_sql_exception $e) {
    die("Error Database: " . $e->getMessage() . ". <br>Silakan jalankan update_db.php!");
}
?>

<!-- ── STAT CARDS ─────────────────────────── -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

    <!-- Card: Total Event -->
    <div class="stat-card group hover:border-dishub-blue/30 border border-transparent">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-dishub-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Event</span>
        </div>
        <p class="text-4xl font-black text-dishub-navy"><?= $total_event ?></p>
        <p class="text-sm text-slate-500 mt-1">Agenda tersimpan</p>
    </div>

    <!-- Card: Total Peserta -->
    <div class="stat-card group hover:border-green-300/50 border border-transparent">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Peserta</span>
        </div>
        <p class="text-4xl font-black text-dishub-navy"><?= $total_peserta ?></p>
        <p class="text-sm text-slate-500 mt-1">Registrasi digital</p>
    </div>

    <!-- Card: Event Aktif -->
    <div class="stat-card group hover:border-orange-300/50 border border-transparent sm:col-span-2 xl:col-span-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Aktif</span>
        </div>
        <p class="text-4xl font-black text-dishub-navy"><?= $event_aktif ?></p>
        <p class="text-sm text-slate-500 mt-1">Agenda berjalan</p>
    </div>
</div>

<!-- ── WELCOME BANNER + QUICK ACTIONS ──── -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    <!-- Welcome Banner -->
    <div class="glass-card lg:col-span-2 bg-gradient-to-br from-dishub-navy to-[#003580] p-6 text-white min-h-[180px] flex flex-col justify-between">
        <div>
            <p class="text-blue-300 text-xs font-semibold uppercase tracking-wider mb-2">
                Selamat Datang 👋
            </p>
            <h2 class="text-2xl font-black text-white leading-tight">
                Halo, <span class="text-dishub-accent"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>!
            </h2>
            <p class="text-slate-300 text-sm mt-2 max-w-md">
                Kelola agenda dan pantau pendaftaran peserta kegiatan Dinas Perhubungan Provinsi Jawa Tengah dari sini.
            </p>
        </div>
        <div class="flex items-center gap-3 mt-4">
            <a href="<?= BASE_URL ?>admin/event.php"
               class="btn-accent text-xs px-4 py-2 rounded-lg inline-flex items-center gap-2 font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Agenda
            </a>
            <a href="<?= BASE_URL ?>admin/daftar_peserta.php"
               class="text-sm text-blue-300 hover:text-white transition-colors font-medium">
                Lihat Peserta →
            </a>
        </div>

        <!-- Decorative blob -->
        <div class="absolute right-0 top-0 w-48 h-48 bg-dishub-blue/20 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- Quick Actions -->
    <div class="glass-card p-5 flex flex-col gap-3">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Akses Cepat</p>

        <a href="<?= BASE_URL ?>admin/event.php"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group border border-transparent hover:border-slate-200">
            <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0 group-hover:bg-dishub-blue transition-colors">
                <svg class="w-4 h-4 text-dishub-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800">Buat Agenda</p>
                <p class="text-xs text-slate-400">Tambah sesi baru</p>
            </div>
            <svg class="w-4 h-4 text-slate-300 ml-auto group-hover:text-dishub-blue transition-colors"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="<?= BASE_URL ?>admin/daftar_peserta.php"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group border border-transparent hover:border-slate-200">
            <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0 group-hover:bg-green-600 transition-colors">
                <svg class="w-4 h-4 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800">Data Peserta</p>
                <p class="text-xs text-slate-400">Lihat semua registrasi</p>
            </div>
            <svg class="w-4 h-4 text-slate-300 ml-auto group-hover:text-green-600 transition-colors"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="<?= BASE_URL ?>admin/cetak_peserta.php" target="_blank"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group border border-transparent hover:border-slate-200">
            <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0 group-hover:bg-purple-600 transition-colors">
                <svg class="w-4 h-4 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800">Cetak PDF</p>
                <p class="text-xs text-slate-400">Ekspor daftar peserta</p>
            </div>
            <svg class="w-4 h-4 text-slate-300 ml-auto group-hover:text-purple-600 transition-colors"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</div>

<!-- ── RECENT DATA TABLES ──────────────── -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

    <!-- Recent Events -->
    <div class="glass-card overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-sm">Agenda Terbaru</h3>
            <a href="<?= BASE_URL ?>admin/event.php"
               class="text-xs text-dishub-blue font-semibold hover:underline">
                Lihat semua →
            </a>
        </div>
        <div class="divide-y divide-slate-50">
            <?php if (mysqli_num_rows($recent_events) === 0): ?>
                <p class="text-sm text-slate-400 text-center py-8">Belum ada agenda.</p>
            <?php else: ?>
                <?php while ($ev = mysqli_fetch_assoc($recent_events)): ?>
                <div class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50 transition-colors">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex flex-col items-center justify-center flex-shrink-0">
                        <span class="text-dishub-blue font-bold text-xs leading-none">
                            <?= date('d', strtotime($ev['tanggal_event'])) ?>
                        </span>
                        <span class="text-blue-400 text-[9px] uppercase leading-none">
                            <?= date('M', strtotime($ev['tanggal_event'])) ?>
                        </span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-800 truncate">
                            <?= htmlspecialchars($ev['nama_event']) ?>
                        </p>
                        <p class="text-xs text-slate-400">
                            <?= date('d F Y', strtotime($ev['tanggal_event'])) ?>
                        </p>
                    </div>
                    <span class="badge-active flex-shrink-0">Aktif</span>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Registrants -->
    <div class="glass-card overflow-hidden">
        <div class="flex items-center justify-between p-5 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-sm">Peserta Terbaru</h3>
            <a href="<?= BASE_URL ?>admin/daftar_peserta.php"
               class="text-xs text-dishub-blue font-semibold hover:underline">
                Lihat semua →
            </a>
        </div>
        <div class="divide-y divide-slate-50">
            <?php if (mysqli_num_rows($recent_peserta) === 0): ?>
                <p class="text-sm text-slate-400 text-center py-8">Belum ada peserta.</p>
            <?php else: ?>
                <?php while ($ps = mysqli_fetch_assoc($recent_peserta)): ?>
                <div class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50 transition-colors">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0 text-slate-500 font-bold text-sm">
                        <?= strtoupper(substr($ps['nama'], 0, 1)) ?>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-800 truncate">
                            <?= htmlspecialchars($ps['nama']) ?>
                        </p>
                        <p class="text-xs text-slate-400 truncate">
                            <?= htmlspecialchars($ps['jabatan'] ?? '-') ?>
                            <?php if ($ps['nama_event']): ?>
                                · <span class="text-dishub-blue"><?= htmlspecialchars($ps['nama_event']) ?></span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

    </main>
</div><!-- /.flex-1 -->

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>
</body>
</html>
