<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10 overflow-x-hidden">

<a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-2 text-brand-600 hover:text-brand-700 text-sm font-bold mb-8 transition-all duration-300 group hover:gap-3">
        <span class="material-symbols-rounded text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Kembali ke Daftar Paket
    </a>

    <div class="grid lg:grid-cols-5 gap-8">

        <!-- Foto -->
        <div class="lg:col-span-3 animate-fade-in-up">
            <div class="group relative rounded-3xl overflow-hidden shadow-2xl shadow-brand-500/20 hover:shadow-3xl hover:shadow-brand-500/30 transition-all duration-300">
                <img src="<?= base_url('application/assets/images/paket/' . $paket->foto . '?v=' . time()); ?>"
                    class="w-full h-[420px] object-cover group-hover:scale-105 transition-transform duration-500"
                    onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>

            <!-- Destinasi Section (below photo on lg) -->
            <?php if (!empty($destinasi_paket)): ?>
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6 mt-8">
<h3 class="font-bold text-lg text-gray-900 mb-4 flex flex-wrap items-center gap-2 min-w-0">
                    <span class="material-symbols-rounded text-brand-500 flex-shrink-0">place</span> Destinasi
                    <span class="text-xs bg-brand-50 text-brand-600 px-2 py-0.5 rounded-full font-bold ml-auto whitespace-nowrap"><?= count($destinasi_paket); ?> tempat</span>
                </h3>
                <div class="grid sm:grid-cols-2 gap-1.5">
                    <?php foreach ($destinasi_paket as $d): ?>
                    <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-surface-50 border border-gray-100 hover:border-brand-200 transition">
                        <span class="material-symbols-rounded text-[16px] text-emerald-500">landscape</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-700 font-medium truncate"><?= $d->nama_destinasi; ?></p>
                            <p class="text-[11px] text-gray-400"><?= $d->kota; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Aktivitas Section -->
            <?php if (!empty($aktivitas_paket)): ?>
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6 mt-8">
<h3 class="font-bold text-lg text-gray-900 mb-4 flex flex-wrap items-center gap-2 min-w-0">
                    <span class="material-symbols-rounded text-brand-600 flex-shrink-0">hiking</span> Aktivitas
                    <span class="text-xs bg-brand-50 text-brand-700 px-2 py-0.5 rounded-full font-bold ml-auto whitespace-nowrap"><?= count($aktivitas_paket); ?> aktivitas</span>
                </h3>
                <div class="grid sm:grid-cols-2 gap-2">
                    <?php foreach ($aktivitas_paket as $a): ?>
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 border border-blue-100 hover:border-brand-200 transition group">
                        <div class="w-9 h-9 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-brand-100 transition">
                            <span class="material-symbols-rounded text-brand-600 text-[18px]"><?= $a->icon; ?></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-700 font-semibold truncate"><?= $a->nama_aktivitas; ?></p>
                            <?php if (!empty($a->deskripsi)): ?>
                            <p class="text-xs text-gray-400 mt-0.5 truncate"><?= character_limiter($a->deskripsi, 60); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Status -->
            <div>
<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold <?= $paket->status == 'tersedia' ? 'status-tersedia' : 'status-penuh'; ?>">
                    <span class="w-1.5 h-1.5 rounded-full <?= $paket->status == 'tersedia' ? 'bg-emerald-500' : 'bg-red-500'; ?>"></span>
                    <?= $paket->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia'; ?>
                </span>
            </div>

<h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-tight break-words"><?= $paket->nama_paket; ?></h1>

<!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-2 sm:gap-3 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="group bg-white rounded-xl p-2 sm:p-4 text-center border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300 cursor-default min-w-0">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                        <span class="material-symbols-rounded text-white text-[18px] sm:text-[20px]">schedule</span>
                    </div>
                    <p class="text-lg sm:text-xl font-extrabold text-gray-800"><?= $paket->durasi_hari; ?></p>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider truncate">Hari</p>
                </div>
                <div class="group bg-white rounded-xl p-2 sm:p-4 text-center border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300 cursor-default min-w-0">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                        <span class="material-symbols-rounded text-white text-[18px] sm:text-[20px]">place</span>
                    </div>
                    <p class="text-lg sm:text-xl font-extrabold text-gray-800"><?= $paket->jumlah_destinasi; ?></p>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider truncate">Destinasi</p>
                </div>
                <div class="group bg-white rounded-xl p-2 sm:p-4 text-center border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300 cursor-default min-w-0">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                        <span class="material-symbols-rounded text-white text-[18px] sm:text-[20px]">hiking</span>
                    </div>
                    <p class="text-lg sm:text-xl font-extrabold text-gray-800"><?= $paket->jumlah_aktivitas; ?></p>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider truncate">Aktivitas</p>
                </div>
            </div>

<!-- Harga -->
            <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="bg-gradient-to-br from-brand-600 to-brand-500 rounded-2xl p-6 text-white shadow-xl shadow-brand-500/30 hover:shadow-2xl hover:shadow-brand-500/40 hover:-translate-y-1 transition-all duration-300">
                    <p class="text-xs font-bold uppercase tracking-wider mb-1 opacity-90">Harga per Orang</p>
                    <p class="text-3xl font-extrabold break-words">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></p>
                    <p class="text-[11px] mt-2 flex items-center gap-1 opacity-80 min-w-0">
                        <span class="material-symbols-rounded text-[14px] flex-shrink-0">info</span>
                        <span class="break-words">Harga dapat berubah jika ada penambahan destinasi</span>
                    </p>
                </div>
            </div>

            <!-- Minimum Peserta -->
            <div class="animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="bg-white rounded-2xl p-5 border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 transition-all duration-300">
<div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                            <span class="material-symbols-rounded text-white text-[20px]">group</span>
                        </div>
                        <div class="min-w-0">
                            <p class="font-bold text-gray-800 text-sm break-words">Minimum <?= $paket->min_peserta ?? 1; ?> Peserta</p>
                            <p class="text-gray-600 text-xs mt-1 break-words">Paket ini memerlukan minimal <?= $paket->min_peserta ?? 1; ?> peserta untuk dapat dilaksanakan. Harga sudah termasuk transportasi, akomodasi, dan guide.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="bg-white rounded-2xl p-6 border-2 border-slate-200/80">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <div class="w-8 h-8 bg-brand-50 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-rounded text-brand-600 text-[18px]">description</span>
                        </div>
                        Deskripsi
                    </h3>
                    <p class="text-gray-600 leading-relaxed text-sm"><?= nl2br($paket->deskripsi); ?></p>
                </div>
            </div>

<!-- Action -->
            <div class="animate-fade-in-up flex flex-col gap-3"  style="animation-delay: 0.5s;">
                <?php if ($paket->status != 'tersedia'): ?>
                    <div class="w-full bg-gray-200 text-gray-500 py-4 rounded-2xl font-semibold text-center text-sm border border-gray-300 cursor-not-allowed">
                        <span class="material-symbols-rounded text-[18px] align-middle">cancel</span> Paket Tidak Tersedia
                    </div>
                <?php elseif ($this->session->userdata('role') == 'admin'): ?>
                    <div class="w-full bg-gray-100 text-gray-500 py-3.5 rounded-2xl font-semibold text-center text-sm border border-gray-200">
                        <span class="material-symbols-rounded text-[18px] align-middle">info</span> Admin tidak dapat memesan
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('pemesanan/booking/' . $paket->id_paket); ?>" class="group w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-brand-600 to-brand-500 text-white py-4 rounded-2xl font-bold text-sm hover:from-brand-700 hover:to-brand-600 hover:shadow-xl hover:shadow-brand-500/50 hover:scale-105 active:scale-95 transition-all duration-300">
                        <span class="material-symbols-rounded text-[20px] group-hover:scale-110 transition-transform">shopping_cart</span> Pesan Sekarang
                    </a>
                    <a href="https://wa.me/6287719646932?text=<?= urlencode('Halo Hastaka Holiday, saya tertarik dengan paket ' . $paket->nama_paket . ' (Rp ' . number_format($paket->harga, 0, ',', '.') . '). Bisa info lebih lanjut?'); ?>" target="_blank"
                        class="group w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white py-4 rounded-2xl font-bold text-sm hover:from-emerald-600 hover:to-emerald-700 hover:shadow-xl hover:shadow-emerald-500/50 hover:scale-105 active:scale-95 transition-all duration-300">
                        <span class="material-symbols-rounded text-[20px] group-hover:scale-110 transition-transform">chat</span> Tanya via WhatsApp
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Fasilitas & Harga Tidak Termasuk (side by side) -->
    <div class="mt-10 grid lg:grid-cols-2 gap-6 animate-fade-in-up stagger-1">
        <?php if (!empty($fasilitas_paket)): ?>
        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6">
<h3 class="font-bold text-lg text-gray-900 mb-5 flex flex-wrap items-center gap-2 min-w-0">
                <span class="material-symbols-rounded text-brand-500 flex-shrink-0">inventory_2</span> Fasilitas Include
                <span class="text-xs bg-emerald-50 text-emerald-700 px-2.5 py-0.5 rounded-full font-bold border border-emerald-200 ml-auto whitespace-nowrap"><?= count($fasilitas_paket); ?> item</span>
            </h3>
            <div class="space-y-2">
                <?php foreach ($fasilitas_paket as $f): ?>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-surface-50 border border-gray-100 hover:border-brand-200 transition group">
                    <div class="w-9 h-9 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-brand-100 transition">
                        <span class="material-symbols-rounded text-brand-600 text-[18px]"><?= $f->icon; ?></span>
                    </div>
<div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-700 font-semibold break-words"><?= $f->nama_fasilitas; ?></p>
                        <?php if (!empty($f->deskripsi)): ?>
                        <p class="text-xs text-gray-400 mt-0.5 break-words"><?= $f->deskripsi; ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="material-symbols-rounded text-emerald-500 text-[16px] flex-shrink-0">check_circle</span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6">
<h3 class="font-bold text-lg text-gray-900 mb-5 flex flex-wrap items-center gap-2 min-w-0">
                <span class="material-symbols-rounded text-red-500 flex-shrink-0">remove_circle</span> Harga Tidak Termasuk
            </h3>
            <div class="space-y-2">
<div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px] flex-shrink-0">close</span>
                    <p class="text-sm text-gray-700 font-medium min-w-0">Pengeluaran pribadi</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px] flex-shrink-0">close</span>
                    <p class="text-sm text-gray-700 font-medium min-w-0">Makan di luar jadwal paket</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px] flex-shrink-0">close</span>
                    <p class="text-sm text-gray-700 font-medium min-w-0">Tip / tips sukarela</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px] flex-shrink-0">close</span>
                    <p class="text-sm text-gray-700 font-medium min-w-0">Asuransi perjalanan</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px] flex-shrink-0">close</span>
                    <p class="text-sm text-gray-700 font-medium min-w-0">Biaya tambahan di luar itinerary</p>
                </div>
            </div>
            <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-3 flex items-start gap-2">
                <span class="material-symbols-rounded text-amber-500 text-[16px] mt-0.5">info</span>
                <p class="text-xs text-amber-700"><strong>Catatan:</strong> Harga dapat berubah apabila terdapat penambahan destinasi atau permintaan khusus di luar paket standar.</p>
            </div>
        </div>
    </div>
</main>
