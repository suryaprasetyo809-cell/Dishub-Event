<?php
require_once __DIR__ . '/../config/database.php';

// ── TAMBAH EVENT ───────────────────────────
if (isset($_POST['tambah'])) {
    $nama      = mysqli_real_escape_string($conn, trim($_POST['nama_event']));
    $tanggal   = mysqli_real_escape_string($conn, $_POST['tanggal_event']);
    $deskripsi = mysqli_real_escape_string($conn, trim($_POST['deskripsi'] ?? ''));

    if ($nama && $tanggal) {
        mysqli_query($conn, "INSERT INTO events (nama_event, tanggal_event, deskripsi)
                             VALUES ('$nama', '$tanggal', '$deskripsi')");
    }

    header("Location: event.php");
    exit;
}

// ── HAPUS EVENT ───────────────────────────
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM events WHERE id = $id LIMIT 1");

    header("Location: event.php");
    exit;
}

// ── AMBIL DATA ────────────────────────────
$events = mysqli_query($conn, "SELECT * FROM events ORDER BY tanggal_event DESC");

// ── LOAD HEADER (HARUS DI BAWAH) ─────────
require_once __DIR__ . '/admin_header.php';
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    <!-- ── FORM TAMBAH ──────────────────────── -->
    <div class="glass-card p-6 lg:col-span-1">
        <h3 class="font-bold text-slate-800 mb-5 flex items-center gap-2">
            <span class="w-8 h-8 rounded-lg bg-dishub-blue flex items-center justify-center text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </span>
            Tambah Agenda
        </h3>

        <form method="post" class="space-y-4">
            <div>
                <label class="form-label">Nama Kegiatan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_event" required
                       class="form-input"
                       placeholder="Contoh: Rapat Koordinasi Lalu Lintas">
            </div>

            <div>
                <label class="form-label">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_event" required class="form-input">
            </div>

            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                          class="form-input resize-none"
                          placeholder="Masukkan deskripsi singkat kegiatan..."></textarea>
            </div>

            <button type="submit" name="tambah" class="btn-action w-full justify-center py-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Agenda
            </button>
        </form>
    </div>

    <!-- ── TABLE DAFTAR EVENT ────────────────── -->
    <div class="glass-card overflow-hidden lg:col-span-2">
        <div class="flex items-center justify-between p-5 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-dishub-blue">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Daftar Agenda
            </h3>
            <span class="badge-info"><?= mysqli_num_rows($events) ?> agenda</span>
        </div>

        <?php if (mysqli_num_rows($events) === 0): ?>
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="font-semibold text-slate-600 text-sm">Belum ada agenda</p>
                <p class="text-xs text-slate-400 mt-1">Tambahkan agenda pertama di form sebelah kiri</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="tbl-head">Nama Kegiatan</th>
                            <th class="tbl-head">Tanggal</th>
                            <th class="tbl-head w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($events)): ?>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="tbl-cell">
                                <p class="font-semibold text-slate-800 text-sm">
                                    <?= htmlspecialchars($row['nama_event']) ?>
                                </p>
                                <?php if (!empty($row['deskripsi'])): ?>
                                    <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">
                                        <?= htmlspecialchars($row['deskripsi']) ?>
                                    </p>
                                <?php endif; ?>
                            </td>
                            <td class="tbl-cell">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-slate-700">
                                        <?= date('d M Y', strtotime($row['tanggal_event'])) ?>
                                    </span>
                                    <span class="text-xs text-slate-400">
                                        <?= date('l', strtotime($row['tanggal_event'])) ?>
                                    </span>
                                </div>
                            </td>
                            <td class="tbl-cell text-center">
                                <a href="event.php?hapus=<?= $row['id'] ?>"
                                   class="btn-danger inline-flex items-center gap-1"
                                   onclick="return confirm('Hapus agenda ini? Peserta terkait tidak akan terhapus.')">
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
