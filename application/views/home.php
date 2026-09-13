<!-- PELANGGAN DASHBOARD -->
<?php if (!empty($user_logged_in) && $user_role == 'pelanggan'): ?>
<section class="bg-gradient-to-br from-brand-600 to-brand-500 relative overflow-hidden">
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
            <a href="<?= base_url('pemesanan/riwayat'); ?>" class="group bg-white/15 backdrop-blur rounded-2xl p-5 hover:bg-white/25 hover:-translate-y-1 transition-all duration-300">
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
            <div class="group bg-white/15 backdrop-blur rounded-2xl p-5 hover:bg-white/25 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                        <span class="material-symbols-rounded text-white">pending_actions</span>
                    </div>
                    <div>
                        <p class="text-white/70 text-xs">Booking Aktif</p>
                        <p class="text-white text-2xl font-bold"><?= isset($booking_aktif) ? $booking_aktif : 0; ?></p>
                    </div>
                </div>
            </div>
            <div class="group bg-white/15 backdrop-blur rounded-2xl p-5 hover:bg-white/25 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
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
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 animate-fade-in-up">
                Temukan Paket<br>Wisata <span class="text-sky-300">Impian</span> Anda
            </h1>
            <p class="text-lg text-white/90 leading-relaxed mb-10 max-w-xl animate-fade-in-up stagger-1">
                Sistem Informasi yang menyediakan berbagai pilihan paket wisata dan melakukan pemesanan dengan mudah.
            </p>
            <div class="flex flex-wrap gap-4 animate-fade-in-up stagger-2">
                <a href="<?= base_url('rekomendasi'); ?>" class="group inline-flex items-center gap-2 bg-white text-brand-700 px-8 py-4 rounded-2xl font-bold text-sm hover:shadow-2xl hover:shadow-white/30 hover:scale-105 active:scale-95 transition-all duration-300">
                    <span class="material-symbols-rounded text-[20px]">auto_awesome</span> Cari Rekomendasi
                </a>
                <a href="<?= base_url('paket'); ?>" class="group inline-flex items-center gap-2 bg-white/15 backdrop-blur-md text-white px-8 py-4 rounded-2xl font-bold text-sm hover:bg-white/25 hover:scale-105 active:scale-95 transition-all duration-300 border-2 border-white/30">
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

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($paket_terbaru)): ?>
            <?php foreach ($paket_terbaru as $i => $paket): ?>
            <a href="<?= base_url('paket/detail/' . $paket->id_paket); ?>" class="group block rounded-2xl overflow-hidden bg-white border-2 border-slate-200/80 shadow-md shadow-slate-200/50 hover:shadow-2xl hover:shadow-brand-500/30 hover:-translate-y-1 transition-all duration-300 animate-fade-in-up cursor-pointer" style="animation-delay: <?= $i * 0.1; ?>s;">
                <div class="relative overflow-hidden aspect-video">
                    <img src="<?= base_url('application/assets/images/paket/' . $paket->foto . '?v=' . time()); ?>"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Status Badge -->
                    <div class="absolute top-3 left-3">
<span class="badge <?= $paket->status == 'tersedia' ? 'badge-tersedia' : 'badge-penuh'; ?> shadow-lg">
                            <?= $paket->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia'; ?>
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-base text-gray-900 group-hover:text-brand-600 transition-colors line-clamp-1 mb-2"><?= $paket->nama_paket; ?></h3>
                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed mb-3"><?= character_limiter($paket->deskripsi ?? '', 80); ?></p>
                    
                    <div class="flex items-center gap-2 text-gray-500 text-sm flex-wrap mb-4">
                        <span class="flex items-center gap-1 bg-slate-50 px-2 py-1 rounded-lg border border-slate-100">
                            <span class="material-symbols-rounded text-[14px] text-brand-600">schedule</span> 
                            <span class="text-xs font-medium"><?= $paket->durasi_hari; ?> Hari</span>
                        </span>
                        <span class="flex items-center gap-1 bg-slate-50 px-2 py-1 rounded-lg border border-slate-100">
                            <span class="material-symbols-rounded text-[14px] text-brand-600">place</span> 
                            <span class="text-xs font-medium"><?= $paket->jumlah_destinasi; ?> Destinasi</span>
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Mulai dari</p>
                            <p class="text-xl font-extrabold gradient-text">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></p>
                        </div>
                        <span class="inline-flex items-center gap-1 text-brand-600 text-sm font-bold group-hover:gap-2 transition-all">
                            Detail <span class="material-symbols-rounded text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
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
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-extrabold text-gray-900">Mengapa Pilih <span class="gradient-text">Hastaka Holiday</span>?</h2>
            <p class="text-gray-500 mt-2 max-w-lg mx-auto">Agent travel terpercaya dengan pelayanan terbaik untuk setiap perjalanan Anda</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="group bg-white rounded-2xl p-6 text-center border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-brand-500 to-brand-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-brand-500/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <span class="material-symbols-rounded text-white text-2xl">verified</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Paket Terpercaya</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Setiap paket telah diverifikasi dan diuji untuk memastikan kualitas perjalanan Anda</p>
            </div>
            <div class="group bg-white rounded-2xl p-6 text-center border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-sky-500 to-sky-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-sky-500/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <span class="material-symbols-rounded text-white text-2xl">savings</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Harga Bersaing</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Dapatkan harga terbaik dengan nilai maksimal untuk setiap budget perjalanan</p>
            </div>
            <div class="group bg-white rounded-2xl p-6 text-center border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-cyan-500/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <span class="material-symbols-rounded text-white text-2xl">person_pin</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-2">Guide Berpengalaman</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Tour guide profesional dan berpengalaman siap menemani perjalanan Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- BUS REFERENCES -->
<section class="bg-gradient-to-br from-slate-50 to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-extrabold text-gray-900">Referensi <span class="gradient-text">Bus</span></h2>
            <p class="text-gray-500 mt-2 max-w-lg mx-auto">Mitra transportasi bus pariwisata terpercaya untuk kenyamanan perjalanan Anda</p>
        </div>
        
        <?php if (!empty($bus_partner)): ?>
        <div class="relative">
            <div class="bus-gallery-scroll sm:grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 sm:gap-6">
                <?php foreach ($bus_partner as $i => $bus): ?>
                <div class="bus-card-item group bg-white rounded-2xl overflow-hidden border-2 border-slate-200/80 shadow-lg shadow-slate-200/50 hover:shadow-xl hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300 animate-fade-in-up" style="animation-delay: <?= $i * 0.05; ?>s;">
                    <div class="relative aspect-[4/3] bg-slate-100">
                        <img src="<?= base_url('application/assets/images/bus/' . $bus['gambar']); ?>" 
                            alt="<?= $bus['nama']; ?>" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            onerror="this.src='https://images.unsplash.com/photo-1549464188-d0526bfc0f2b'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white p-3 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <p class="font-bold text-sm text-center"><?= $bus['nama']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <span class="material-symbols-rounded text-gray-300 text-6xl">directions_bus</span>
            <p class="text-gray-400 mt-4 text-lg">Belum ada data mitra bus tersedia.</p>
        </div>
        <?php endif; ?>
        
        <div class="mt-10 text-center">
            <p class="text-sm text-gray-600 bg-white/50 backdrop-blur-sm rounded-xl p-4 inline-block max-w-3xl">
                Referensi bus dapat disesuaikan dengan kebutuhan pelanggan, budget, kapasitas, ketersediaan armada, dan kesepakatan. 
                Armada yang digunakan akan disesuaikan dengan penyedia transportasi yang bekerja sama.
            </p>
        </div>
    </div>
</section>

<!-- HOTEL REFERENCES -->
<section class="bg-gradient-to-br from-slate-50 to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-14">
            <h2 class="text-3xl font-extrabold text-gray-900">Referensi <span class="gradient-text">Hotel</span></h2>
            <p class="text-gray-500 mt-2 max-w-lg mx-auto">Mitra penginapan terpercaya untuk kenyamanan perjalanan Anda</p>
        </div>
        
        <?php if (!empty($hotel_partner)): ?>
        <div class="relative">
            <div class="hotel-gallery-scroll sm:grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 sm:gap-6">
                <?php foreach ($hotel_partner as $i => $hotel): ?>
                <div class="hotel-card-item group bg-white rounded-2xl overflow-hidden border-2 border-slate-200/80 shadow-lg shadow-slate-200/50 hover:shadow-xl hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300 animate-fade-in-up" style="animation-delay: <?= $i * 0.05; ?>s;">
                    <div class="relative aspect-[4/3] bg-slate-100">
                        <img src="<?= base_url('application/assets/images/hotel/' . $hotel['gambar']); ?>" 
                            alt="<?= $hotel['nama']; ?>" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            onerror="this.src='https://images.unsplash.com/photo-1549464188-d0526bfc0f2b'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white p-3 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <p class="font-bold text-sm text-center"><?= $hotel['nama']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <span class="material-symbols-rounded text-gray-300 text-6xl">hotel</span>
            <p class="text-gray-400 mt-4 text-lg">Belum ada data mitra hotel tersedia.</p>
        </div>
        <?php endif; ?>
        
        <div class="mt-10 text-center">
            <p class="text-sm text-gray-600 bg-white/50 backdrop-blur-sm rounded-xl p-4 inline-block max-w-3xl">
                Hotel disesuaikan dengan request, budget, kesepakatan, ketersediaan kamar & jumlah tamu.
            </p>
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
<a href="<?= base_url('rekomendasi'); ?>" class="inline-flex items-center gap-2 bg-white text-brand-700 px-8 py-4 rounded-2xl font-bold hover:bg-white/90 hover:scale-105 active:scale-95 transition-all duration-300 shadow-xl">
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

