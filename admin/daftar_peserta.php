<?php
// ── KONEKSI ────────────────────────────────
require_once __DIR__ . '/../config/database.php';

// ── ACTIONS (HARUS DI ATAS) ───────────────
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM peserta WHERE id = $id LIMIT 1");

    header("Location: daftar_peserta.php");
    exit;
}

// ── FILTER by event ───────────────────────
$filter_event = isset($_GET['event_id']) ? (int) $_GET['event_id'] : 0;
$where = $filter_event ? "WHERE p.event_id = $filter_event" : '';

// ── QUERY DATA ────────────────────────────
$sql = "SELECT p.*, e.nama_event
        FROM peserta p
        LEFT JOIN events e ON p.event_id = e.id
        $where
        ORDER BY p.id DESC";
$result = mysqli_query($conn, $sql);

// ── LIST EVENT ────────────────────────────
$events_list = mysqli_query($conn, "SELECT id, nama_event FROM events ORDER BY nama_event ASC");

// ── BARU LOAD HEADER (SETELAH LOGIC) ─────
require_once __DIR__ . '/admin_header.php';
?>

<!-- ── TOOLBAR ───────────────────────────── -->
<div class="glass-card p-4 flex flex-col sm:flex-row gap-3 items-start sm:items-center justify-between">
    <div>
        <h3 class="font-bold text-slate-800">Daftar Peserta</h3>
        <p class="text-xs text-slate-400 mt-0.5"><?= mysqli_num_rows($result) ?> peserta ditemukan</p>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <!-- Filter by event -->
        <form method="get" class="flex items-center gap-2">
            <select name="event_id" onchange="this.form.submit()"
                    class="form-input py-2 text-xs max-w-[200px]">
                <option value="0">Semua Event</option>
                <?php mysqli_data_seek($events_list, 0); ?>
                <?php while ($ev = mysqli_fetch_assoc($events_list)): ?>
                    <option value="<?= $ev['id'] ?>"
                        <?= $filter_event === (int)$ev['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ev['nama_event']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
        <a href="<?= BASE_URL ?>admin/cetak_peserta.php<?= $filter_event ? '?event_id='.$filter_event : '' ?>"
           target="_blank"
           class="btn-action text-xs inline-flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak PDF
        </a>
    </div>
</div>

<!-- ── TABLE ─────────────────────────────── -->
<div class="glass-card overflow-hidden">
    <?php if (mysqli_num_rows($result) === 0): ?>
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="font-semibold text-slate-600">Belum ada peserta</p>
            <p class="text-xs text-slate-400 mt-1">Data peserta akan muncul setelah ada yang mendaftar</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px]">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="tbl-head">#</th>
                        <th class="tbl-head">Peserta</th>
                        <th class="tbl-head">Jabatan & Bidang</th>
                        <th class="tbl-head">Event</th>
                        <th class="tbl-head text-center">Tanda Tangan</th>
                        <th class="tbl-head text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="tbl-cell text-slate-400 text-xs w-10"><?= $no++ ?></td>
                        <td class="tbl-cell">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center
                                            text-slate-500 font-bold text-sm flex-shrink-0">
                                    <?= strtoupper(substr($row['nama'], 0, 1)) ?>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 text-sm">
                                        <?= htmlspecialchars($row['nama']) ?>
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        <?= htmlspecialchars($row['no_hp'] ?? '-') ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="tbl-cell">
                            <p class="text-sm font-medium text-slate-700">
                                <?= htmlspecialchars($row['jabatan'] ?? '-') ?>
                            </p>
                            <p class="text-xs text-slate-400">
                                <?= htmlspecialchars($row['bidang'] ?? '-') ?>
                            </p>
                        </td>
                        <td class="tbl-cell">
                            <?php if ($row['nama_event']): ?>
                                <span class="badge-info text-xs">
                                    <?= htmlspecialchars($row['nama_event']) ?>
                                </span>
                            <?php else: ?>
                                <span class="text-xs text-slate-400">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="tbl-cell text-center">
                            <?php if (!empty($row['tanda_tangan'])): ?>
                                <div class="inline-block">
                                    <img src="<?= $row['tanda_tangan'] ?>"
                                         alt="TTD <?= htmlspecialchars($row['nama']) ?>"
                                         class="h-10 max-w-[120px] object-contain border border-slate-200
                                                rounded-lg bg-white p-1 hover:scale-150 hover:shadow-xl
                                                transition-transform duration-200 cursor-zoom-in">
                                </div>
                            <?php else: ?>
                                <span class="text-xs text-slate-300">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td class="tbl-cell text-center">
                            <a href="daftar_peserta.php?hapus=<?= $row['id'] ?>"
                               class="btn-danger inline-flex items-center gap-1 text-xs"
                               onclick="return confirm('Hapus data peserta ini secara permanen?')">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

    </main>
</div>

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
