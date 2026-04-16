</div><!-- /.flex-grow -->

<footer class="bg-dishub-navy text-white">
    <!-- Top section -->
    <div class="container mx-auto px-4 md:px-6 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- Brand -->
        <div class="sm:col-span-2 lg:col-span-1">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-white p-1.5 rounded-lg">
                    <img src="<?= BASE_URL ?>assets/img/jateng.png"
                         alt="Logo Jateng" class="h-8 w-auto object-contain">
                </div>
                <div>
                    <p class="font-black text-white text-sm">Dishub Jateng</p>
                    <p class="text-slate-400 text-xs">Event Portal</p>
                </div>
            </div>
            <p class="text-slate-400 text-sm leading-relaxed">
                Portal resmi pendaftaran dan informasi kegiatan Dinas Perhubungan Provinsi Jawa Tengah.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Navigasi</h4>
            <ul class="space-y-2">
                <li><a href="<?= BASE_URL ?>index.php"
                       class="text-slate-400 text-sm hover:text-white transition-colors">Beranda</a></li>
                <li><a href="<?= BASE_URL ?>profil.php"
                       class="text-slate-400 text-sm hover:text-white transition-colors">Profil</a></li>
                <li><a href="<?= BASE_URL ?>visi_misi.php"
                       class="text-slate-400 text-sm hover:text-white transition-colors">Visi &amp; Misi</a></li>
                <li><a href="<?= BASE_URL ?>daftar_event.php"
                       class="text-slate-400 text-sm hover:text-white transition-colors">Agenda Kegiatan</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Kontak</h4>
            <ul class="space-y-2">
                <li class="flex items-start gap-2 text-slate-400 text-sm">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Jl. Siliwangi No. 355-357 Semarang</span>
                </li>
                <li class="flex items-center gap-2 text-slate-400 text-sm">
                    <svg class="w-4 h-4 flex-shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>(024) 7605803</span>
                </li>
                <li class="flex items-center gap-2 text-slate-400 text-sm">
                    <svg class="w-4 h-4 flex-shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>dishub@jatengprov.go.id</span>
                </li>
            </ul>
        </div>

        <!-- Admin Access -->
        <div>
            <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Admin</h4>
            <a href="<?= BASE_URL ?>admin/login.php"
               class="inline-flex items-center gap-2 bg-dishub-blue text-white text-sm font-semibold
                      px-4 py-2.5 rounded-xl hover:bg-blue-600 transition-colors shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk Admin Panel
            </a>
            <p class="text-xs text-slate-500 mt-3">Khusus pengelola sistem.</p>
        </div>
    </div>

    <!-- Bottom bar -->
    <div class="border-t border-white/10">
        <div class="container mx-auto px-4 md:px-6 py-4 flex flex-col sm:flex-row items-center
                    justify-between gap-2 text-xs text-slate-500">
            <p>&copy; <?= date('Y') ?> Pemerintah Provinsi Jawa Tengah — Dinas Perhubungan</p>
            <div class="flex items-center gap-2">
                <img src="<?= BASE_URL ?>assets/img/logo.png" alt="" class="h-5 w-auto opacity-60">
            </div>
        </div>
    </div>
</footer>

<script>
// Mobile menu toggle
(function () {
    const toggle = document.getElementById('mobile-toggle');
    const menu   = document.getElementById('mobile-menu');
    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
})();
</script>

</body>
</html>
