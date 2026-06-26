<!-- PELANGGAN DASHBOARD -->
<?php if (!empty($user_logged_in) && $user_role == 'pelanggan'): ?>
<section class="gradient-bg relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 400 200"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#dots)"/></svg>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur">
                <span class="material-symbols-rounded text-white text-2xl">waving_hand</span>
            </div>
            <div>
                <h2 class="text-white text-2xl font-bold">Halo, <?= $this->session->userdata('nama_lengkap'); ?>!</h2>
                <p class="text-white/70 text-sm">Selamat datang kembali di Hastaka Holiday</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="<?= base_url('pemesanan/riwayat'); ?>" class="bg-white/15 backdrop-blur rounded-2xl p-5 hover:bg-white/25 transition group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-rounded text-white">receipt_long</span>
                    </div>
                    <div>
                        <p class="text-white/70 text-xs">Total Booking</p>
                        <p class="text-white text-2xl font-bold"><?= isset($total_booking) ? $total_booking : 0; ?></p>
                    </div>
                </div>
            </a>
            <div class="bg-white/15 backdrop-blur rounded-2xl p-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-rounded text-white">pending_actions</span>
                    </div>
                    <div>
                        <p class="text-white/70 text-xs">Booking Aktif</p>
                        <p class="text-white text-2xl font-bold"><?= isset($booking_aktif) ? $booking_aktif : 0; ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white/15 backdrop-blur rounded-2xl p-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-rounded text-white">payments</span>
                    </div>
                    <div>
                        <p class="text-white/70 text-xs">Total Pengeluaran</p>
                        <p class="text-white text-lg font-bold">Rp <?= number_format(isset($total_spent) ? $total_spent : 0, 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- HERO -->
<section class="relative min-h-[600px] flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: linear-gradient(135deg, rgba(37,99,235,.9), rgba(59,130,246,.7), rgba(14,165,233,.5)), url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e');"></div>
    <div class="absolute inset-0 opacity-20">
        <svg class="w-full h-full" viewBox="0 0 800 600"><defs><pattern id="hero-grid" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.3"/></pattern></defs><rect width="100%" height="100%" fill="url(#hero-grid)"/></svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur rounded-full px-4 py-1.5 text-white/90 text-sm mb-6 animate-fade-in">
                <span class="material-symbols-rounded text-[16px]">auto_awesome</span>
                Rekomendasi Cerdas dengan Metode SAW
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 animate-fade-in-up">
                Temukan Paket<br>Wisata <span class="text-sky-300">Impian</span> Anda
            </h1>
            <p class="text-lg text-white/80 leading-relaxed mb-8 max-w-xl animate-fade-in-up stagger-1">
                Sistem rekomendasi cerdas yang membantu Anda memilih paket wisata terbaik berdasarkan harga, durasi, destinasi, dan aktivitas.
            </p>
            <div class="flex flex-wrap gap-4 animate-fade-in-up stagger-2">
                <a href="<?= base_url('rekomendasi'); ?>" class="inline-flex items-center gap-2 bg-white text-brand-700 px-7 py-3.5 rounded-2xl font-bold text-sm hover:bg-white/90 transition shadow-xl">
                    <span class="material-symbols-rounded text-[20px]">auto_awesome</span> Cari Rekomendasi
                </a>
                <a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-2 bg-white/15 backdrop-blur text-white px-7 py-3.5 rounded-2xl font-bold text-sm hover:bg-white/25 transition border border-white/20">
                    <span class="material-symbols-rounded text-[20px]">luggage</span> Lihat Paket
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <span class="material-symbols-rounded text-white/50 text-3xl">expand_more</span>
    </div>
</section>

<!-- STATS BAR -->
<section class="relative -mt-8 z-20 max-w-5xl mx-auto px-4">
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-6 grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="text-center">
            <p class="text-3xl font-extrabold gradient-text">50+</p>
            <p class="text-gray-500 text-sm mt-1">Destinasi</p>
        </div>
        <div class="text-center border-x border-gray-100">
            <p class="text-3xl font-extrabold gradient-text">4</p>
            <p class="text-gray-500 text-sm mt-1">Kriteria Penilaian</p>
        </div>
        <div class="text-center border-x border-gray-100">
            <p class="text-3xl font-extrabold gradient-text"><?= $total_paket ?? count($paket_populer); ?>+</p>
            <p class="text-gray-500 text-sm mt-1">Paket Wisata</p>
        </div>
        <div class="text-center">
            <p class="text-3xl font-extrabold gradient-text">100%</p>
            <p class="text-gray-500 text-sm mt-1">Objektif</p>
        </div>
    </div>
</section>

<!-- PAKET WISATA -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Jelajahi <span class="gradient-text">Destinasi Terbaik</span></h2>
            <p class="text-gray-500 mt-1">Paket wisata pilihan dengan rekomendasi cerdas berbasis SAW</p>
        </div>
        <a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-1.5 text-brand-600 font-semibold text-sm hover:text-brand-700 transition group">
            Lihat Semua <span class="material-symbols-rounded text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($paket_populer)): ?>
            <?php foreach ($paket_populer as $i => $paket): ?>
            <a href="<?= base_url('paket/detail/' . $paket->id_paket); ?>" class="group block hover-lift rounded-3xl overflow-hidden bg-white shadow-lg shadow-gray-200/50 animate-fade-in-up stagger-<?= $i+1; ?>">
                <div class="relative overflow-hidden">
                    <img src="<?= base_url('application/assets/images/paket/' . $paket->foto . '?v=' . time()); ?>"
                        class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500"
                        onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                    <div class="absolute bottom-0 inset-x-0 h-20 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-brand-600 transition"><?= $paket->nama_paket; ?></h3>
                    <div class="flex items-center gap-3 mt-2 text-gray-500 text-sm">
                        <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">schedule</span> <?= $paket->durasi_hari; ?> Hari</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">place</span> <?= $paket->jumlah_destinasi; ?> Destinasi</span>
                    </div>
                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-[10px] text-gray-400 font-semibold uppercase">Mulai dari</p>
                            <p class="text-xl font-extrabold gradient-text">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></p>
                        </div>
                        <span class="text-brand-600 text-sm font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">
                            Detail <span class="material-symbols-rounded text-[16px]">arrow_forward</span>
                        </span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-16">
                <span class="material-symbols-rounded text-gray-300 text-6xl">luggage</span>
                <p class="text-gray-400 mt-4 text-lg">Belum ada paket wisata tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- WHY CHOOSE HASTAKA -->
<section class="bg-white border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-extrabold text-gray-900">Mengapa Pilih <span class="gradient-text">Hastaka Holiday</span>?</h2>
            <p class="text-gray-500 mt-2 max-w-lg mx-auto">Agent travel terpercaya dengan pelayanan terbaik untuk setiap perjalanan Anda</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-blue-50 rounded-2xl p-6 text-center border border-blue-100 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-100/50 transition-all group">
                <div class="w-14 h-14 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-brand-500/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-rounded text-white text-2xl">verified</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Paket Terpercaya</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Setiap paket telah diverifikasi dan diuji untuk memastikan kualitas perjalanan Anda</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-6 text-center border border-blue-100 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-100/50 transition-all group">
                <div class="w-14 h-14 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-brand-500/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-rounded text-white text-2xl">savings</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Harga Bersaing</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Dapatkan harga terbaik dengan nilai maksimal untuk setiap budget perjalanan</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-6 text-center border border-blue-100 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-100/50 transition-all group">
                <div class="w-14 h-14 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-brand-500/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-rounded text-white text-2xl">person_pin</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Guide Berpengalaman</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Tour guide profesional dan berpengalaman siap menemani perjalanan Anda</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-6 text-center border border-blue-100 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-100/50 transition-all group">
                <div class="w-14 h-14 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-brand-500/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-rounded text-white text-2xl">support_agent</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Pelayanan 24/7</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Tim support kami siap membantu Anda kapan saja selama perjalanan</p>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-extrabold text-gray-900">Cara Kerja <span class="gradient-text">SAW</span></h2>
            <p class="text-gray-500 mt-2 max-w-lg mx-auto">Metode Simple Additive Weighting menghasilkan rekomendasi objektif berdasarkan preferensi Anda</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-brand-500/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-rounded text-white text-3xl">tune</span>
                </div>
                <h3 class="font-bold text-lg mb-2">1. Atur Bobot</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Tentukan preferensi Anda untuk setiap kriteria (harga, durasi, destinasi, aktivitas)</p>
            </div>
            <div class="text-center group">
                <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-brand-500/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-rounded text-white text-3xl">calculate</span>
                </div>
                <h3 class="font-bold text-lg mb-2">2. Normalisasi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Sistem menormalisasi nilai kriteria berdasarkan sifat benefit/cost</p>
            </div>
            <div class="text-center group">
                <div class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-brand-500/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-rounded text-white text-3xl">emoji_events</span>
                </div>
                <h3 class="font-bold text-lg mb-2">3. Dapatkan Hasil</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Paket diurutkan dari nilai tertinggi, paling sesuai preferensi Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="gradient-bg rounded-3xl p-10 md:p-16 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200"><defs><pattern id="cta-dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#cta-dots)"/></svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Siap Menemukan Paket Impian?</h2>
            <p class="text-white/80 max-w-lg mx-auto mb-8">Gunakan sistem rekomendasi kami dan dapatkan paket wisata terbaik sesuai kebutuhan Anda.</p>
            <a href="<?= base_url('rekomendasi'); ?>" class="inline-flex items-center gap-2 bg-white text-brand-700 px-8 py-4 rounded-2xl font-bold hover:bg-white/90 transition shadow-xl">
                <span class="material-symbols-rounded text-[20px]">rocket_launch</span> Mulai Rekomendasi
            </a>
        </div>
    </div>
</section>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/6287719646932" target="_blank"
    class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/30 transition-all hover:scale-110 animate-bounce"
    style="animation-duration: 2s; animation-iteration-count: 3;">
    <span class="material-symbols-rounded text-2xl">chat</span>
</a>

