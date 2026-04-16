<?php
$page_title = "Pendaftaran Peserta - Event Dishub Jawa Tengah";
require_once 'config/database.php';
require_once 'includes/header.php';

$id_acara = intval($_GET['id_acara'] ?? 0);
?>

<!-- Page Header -->
<div class="bg-dishub-navy py-16 relative overflow-hidden">
    <div class="absolute right-0 top-0 w-80 h-80 bg-dishub-blue/20 rounded-full blur-[100px] animate-pulse-slow pointer-events-none"></div>
    <div class="container mx-auto px-4 md:px-6 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-1.5 rounded-full text-white text-[10px] font-bold uppercase mb-6 tracking-widest italic">
             REGISTRASI PESERTA 2026
        </div>
        <h1 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight tracking-tight italic">Formulir <span class="text-dishub-accent underline underline-offset-8 decoration-blue-500 decoration-4">Registrasi.</span></h1>
        <p class="text-slate-300 font-medium max-w-2xl mx-auto text-sm md:text-base leading-relaxed opacity-90 italic italic">"Koordinasi data terintegrasi untuk mewujudkan pelayanan perhubungan Jawa Tengah yang handal."</p>
    </div>
</div>

<div class="container mx-auto px-4 md:px-6 -mt-10 pb-24 relative z-[100]">
    <div class="max-w-3xl mx-auto bg-white rounded-3xl p-8 md:p-12 shadow-2xl border border-slate-100 animate-fade-in">
        <form action="<?= BASE_URL ?>proses_daftar.php" method="post" class="space-y-10">
            
            <!-- Section 1: Event Selection -->
            <div class="space-y-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-dishub-blue text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-lg shadow-blue-500/20 italic transform group-focus-within:rotate-12 transition-transform">01</div>
                    <h2 class="text-xl font-bold text-dishub-navy uppercase tracking-wider italic">Identifikasi Acara</h2>
                </div>
                
                <div class="space-y-2">
                    <label class="form-label">Target Agenda Kegiatan <span class="text-red-500">*</span></label>
                    <div class="relative">
                         <select name="id_acara" class="form-input appearance-none cursor-pointer pr-10" required>
                             <option value="">-- PILIH AGENDA SESI --</option>
                             <?php
                             $event = mysqli_query($conn, "SELECT * FROM events");
                             while ($e = mysqli_fetch_assoc($event)) {
                                 $selected = ($e['id'] == $id_acara) ? 'selected' : '';
                                 echo "<option value='{$e['id']}' $selected>{$e['nama_event']}</option>";
                             }
                             ?>
                         </select>
                         <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                         </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Personal Data -->
            <div class="space-y-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-dishub-blue text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-lg shadow-blue-500/20 italic transform group-focus-within:rotate-12 transition-transform">02</div>
                    <h2 class="text-xl font-bold text-dishub-navy uppercase tracking-wider italic">Otoritas Identitas</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="form-label">Nama Lengkap Partisipan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" class="form-input" placeholder="CONTOH: BUDI SANTOSO" required>
                    </div>

                    <div class="space-y-2">
                        <label class="form-label">Nomor HP / WhatsApp Aktif <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" class="form-input" placeholder="08XXXXXXXXXX" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="form-label">Jabatan Keanggotaan <span class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" class="form-input" placeholder="CONTOH: ANALIS KEBIJAKAN" required>
                    </div>

                    <div class="space-y-2">
                        <label class="form-label">Bidang / Unit Kerja <span class="text-red-500">*</span></label>
                        <input type="text" name="bidang" class="form-input" placeholder="CONTOH: BIDANG LALU LINTAS" required>
                    </div>
                </div>
            </div>

            <!-- Section 3: Signature Pad -->
            <div class="space-y-6">
                 <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 bg-dishub-blue text-white rounded-xl flex items-center justify-center font-bold text-lg shadow-lg shadow-blue-500/20 italic transform group-focus-within:rotate-12 transition-transform">03</div>
                    <h2 class="text-xl font-bold text-dishub-navy uppercase tracking-wider italic">Otoritas Validasi</h2>
                </div>

                <div class="p-6 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center">
                    <canvas id="signature-pad" class="w-full h-48 bg-white rounded-xl shadow-inner cursor-crosshair border border-slate-200 mb-6"></canvas>
                    <div class="flex w-full justify-between items-center px-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic flex items-center gap-2">
                             <span class="w-1.5 h-1.5 bg-dishub-accent rounded-full animate-ping"></span>
                             BUBUHKAN TANDA TANGAN DIGITAL ANDA
                        </p>
                        <button type="button" id="clear" class="text-red-500 text-[10px] font-bold uppercase hover:text-red-700 transition-colors">RESET KANVAS</button>
                    </div>
                    <input type="hidden" name="tanda_tangan" id="tanda_tangan_input">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100">
                <button type="submit" class="w-full btn-accent justify-center py-4 text-lg">
                    KIRIM DATA REGISTRASI &rarr;
                </button>
                <div class="mt-8 p-4 bg-blue-50/50 rounded-2xl border border-blue-100 flex items-start gap-4">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-xl shadow flex-shrink-0">🔒</div>
                    <p class="text-[10px] font-medium text-slate-500 uppercase tracking-wider leading-relaxed italic">Sistem Terenkripsi & Terlindungi Oleh Protokol Keamanan Dinas Perhubungan Prov. Jateng.</p>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas);

    document.getElementById('clear').addEventListener('click', () => {
        signaturePad.clear();
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        if (signaturePad.isEmpty()) {
            alert('Harap bubuhkan tanda tangan digital Anda terlebih dahulu sebelum mengirim registrasi.');
            e.preventDefault();
        } else {
            const dataUrl = signaturePad.toDataURL();
            document.getElementById('tanda_tangan_input').value = dataUrl;
        }
    });

    // Handle Window Resize properly for Canvas
    function resizeCanvas() {
        // Adjust canvas dimension based on client width of parent
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }
    window.addEventListener("resize", resizeCanvas);
    resizeCanvas();
</script>

<?php require_once 'includes/footer.php'; ?>
