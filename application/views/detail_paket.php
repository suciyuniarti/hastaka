<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-1 text-brand-600 hover:text-brand-700 text-sm font-medium mb-6 transition group">
        <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Kembali ke Daftar Paket
    </a>

    <div class="grid lg:grid-cols-5 gap-10 animate-fade-in-up">

        <!-- Foto -->
        <div class="lg:col-span-3">
            <div class="rounded-3xl overflow-hidden shadow-xl shadow-gray-200/50">
                <img src="<?= base_url('application/assets/images/paket/' . $paket->foto . '?v=' . time()); ?>"
                    class="w-full h-[420px] object-cover"
                    onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
            </div>

            <!-- Destinasi Section (below photo on lg) -->
            <?php if (!empty($destinasi_paket)): ?>
            <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6 mt-8">
                <h3 class="font-bold text-lg text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-rounded text-brand-500">place</span> Destinasi
                    <span class="text-xs bg-brand-50 text-brand-600 px-2 py-0.5 rounded-full font-bold ml-auto"><?= count($destinasi_paket); ?> tempat</span>
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
                <h3 class="font-bold text-lg text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-rounded text-brand-600">hiking</span> Aktivitas
                    <span class="text-xs bg-brand-50 text-brand-700 px-2 py-0.5 rounded-full font-bold ml-auto"><?= count($aktivitas_paket); ?> aktivitas</span>
                </h3>
                <div class="grid sm:grid-cols-2 gap-2">
                    <?php foreach ($aktivitas_paket as $a): ?>
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 border border-blue-100 hover:border-brand-200 transition group">
                        <div class="w-9 h-9 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-brand-100 transition">
                            <span class="material-symbols-rounded text-brand-600 text-[18px]"><?= $a->icon; ?></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-700 font-semibold truncate"><?= $a->nama_aktivitas; ?></p>
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
                    <?= ucfirst($paket->status); ?>
                </span>
            </div>

            <h1 class="text-2xl font-extrabold text-gray-900 leading-tight"><?= $paket->nama_paket; ?></h1>

            <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-2">
                <div class="bg-blue-50 rounded-xl p-3 text-center border border-blue-100">
                    <span class="material-symbols-rounded text-brand-600 text-[20px]">schedule</span>
                    <p class="text-lg font-extrabold text-gray-800 mt-0.5"><?= $paket->durasi_hari; ?></p>
                    <p class="text-[10px] text-gray-400 font-semibold">Hari</p>
                </div>
                <div class="bg-blue-50 rounded-xl p-3 text-center border border-blue-100">
                    <span class="material-symbols-rounded text-brand-600 text-[20px]">place</span>
                    <p class="text-lg font-extrabold text-gray-800 mt-0.5"><?= $paket->jumlah_destinasi; ?></p>
                    <p class="text-[10px] text-gray-400 font-semibold">Destinasi</p>
                </div>
                <div class="bg-blue-50 rounded-xl p-3 text-center border border-blue-100">
                    <span class="material-symbols-rounded text-brand-600 text-[20px]">hiking</span>
                    <p class="text-lg font-extrabold text-gray-800 mt-0.5"><?= $paket->jumlah_aktivitas; ?></p>
                    <p class="text-[10px] text-gray-400 font-semibold">Aktivitas</p>
                </div>
            </div>

            <!-- Harga -->
            <div class="bg-gradient-to-r from-brand-50 to-blue-50 rounded-2xl p-5 border border-brand-100">
                <p class="text-xs text-brand-500 font-bold uppercase tracking-wider mb-1">Harga per Orang</p>
                <p class="text-3xl font-extrabold gradient-text">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></p>
                <p class="text-[11px] text-amber-600 mt-2 flex items-center gap-1">
                    <span class="material-symbols-rounded text-[14px]">info</span>
                    Harga dapat berubah jika ada penambahan destinasi
                </p>
            </div>

            <!-- Minimum Peserta -->
            <div class="bg-brand-50 rounded-2xl p-4 border border-brand-200 flex items-start gap-3">
                <span class="material-symbols-rounded text-brand-600 text-[20px] mt-0.5">group</span>
                <div>
                    <p class="font-bold text-brand-800 text-sm">Minimum <?= $paket->min_peserta ?? 1; ?> Peserta</p>
                    <p class="text-brand-600 text-xs mt-0.5">Paket ini memerlukan minimal <?= $paket->min_peserta ?? 1; ?> peserta untuk dapat dilaksanakan. Harga sudah termasuk transportasi, akomodasi, dan guide.</p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                    <span class="material-symbols-rounded text-brand-500 text-[18px]">description</span> Deskripsi
                </h3>
                <p class="text-gray-600 leading-relaxed text-sm"><?= nl2br($paket->deskripsi); ?></p>
            </div>

            <!-- Action -->
            <div>
                <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <div class="w-full bg-gray-100 text-gray-500 py-3.5 rounded-2xl font-semibold text-center text-sm border border-gray-200">
                        <span class="material-symbols-rounded text-[18px] align-middle">info</span> Admin tidak dapat memesan
                    </div>
                <?php elseif ($paket->status == 'tersedia'): ?>
                    <div class="w-full inline-flex items-center justify-center gap-2 gradient-bg text-white py-4 rounded-2xl font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25">
                        <span class="material-symbols-rounded text-[20px]">shopping_cart</span> Pesan Sekarang
                    </a>
                    <a href="https://wa.me/6287719646932?text=<?= urlencode('Halo Hastaka Holiday, saya tertarik dengan paket ' . $paket->nama_paket . ' (Rp ' . number_format($paket->harga, 0, ',', '.') . '). Bisa info lebih lanjut?'); ?>" target="_blank"
                        class="w-full inline-flex items-center justify-center gap-2 bg-emerald-500 text-white py-3.5 rounded-2xl font-semibold text-sm hover:bg-emerald-600 transition mt-3">
                        <span class="material-symbols-rounded text-[20px]">chat</span> Tanya via WhatsApp
                    </a>
                <?php else: ?>
                    <button disabled class="w-full bg-gray-200 text-gray-500 py-4 rounded-2xl font-semibold text-sm cursor-not-allowed border border-gray-300">Paket Penuh</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Fasilitas & Harga Tidak Termasuk (side by side) -->
    <div class="mt-10 grid lg:grid-cols-2 gap-6 animate-fade-in-up stagger-1">
        <?php if (!empty($fasilitas_paket)): ?>
        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6">
            <h3 class="font-bold text-lg text-gray-900 mb-5 flex items-center gap-2">
                <span class="material-symbols-rounded text-brand-500">inventory_2</span> Fasilitas Include
                <span class="text-xs bg-emerald-50 text-emerald-700 px-2.5 py-0.5 rounded-full font-bold border border-emerald-200"><?= count($fasilitas_paket); ?> item</span>
            </h3>
            <div class="space-y-2">
                <?php foreach ($fasilitas_paket as $f): ?>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-surface-50 border border-gray-100 hover:border-brand-200 transition group">
                    <div class="w-9 h-9 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-brand-100 transition">
                        <span class="material-symbols-rounded text-brand-600 text-[18px]"><?= $f->icon; ?></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-700 font-semibold truncate"><?= $f->nama_fasilitas; ?></p>
                        <?php if (!empty($f->deskripsi)): ?>
                        <p class="text-xs text-gray-400 mt-0.5 truncate"><?= $f->deskripsi; ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="material-symbols-rounded text-emerald-500 text-[16px] flex-shrink-0">check_circle</span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 p-6">
            <h3 class="font-bold text-lg text-gray-900 mb-5 flex items-center gap-2">
                <span class="material-symbols-rounded text-red-500">remove_circle</span> Harga Tidak Termasuk
            </h3>
            <div class="space-y-2">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px]">close</span>
                    <p class="text-sm text-gray-700 font-medium">Pengeluaran pribadi</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px]">close</span>
                    <p class="text-sm text-gray-700 font-medium">Makan di luar jadwal paket</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px]">close</span>
                    <p class="text-sm text-gray-700 font-medium">Tip / tips sukarela</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px]">close</span>
                    <p class="text-sm text-gray-700 font-medium">Asuransi perjalanan</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50/50 border border-red-100">
                    <span class="material-symbols-rounded text-red-400 text-[18px]">close</span>
                    <p class="text-sm text-gray-700 font-medium">Biaya tambahan di luar itinerary</p>
                </div>
            </div>
            <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-3 flex items-start gap-2">
                <span class="material-symbols-rounded text-amber-500 text-[16px] mt-0.5">info</span>
                <p class="text-xs text-amber-700"><strong>Catatan:</strong> Harga dapat berubah apabila terdapat penambahan destinasi atau permintaan khusus di luar paket standar.</p>
            </div>
        </div>
    </div>
</main>
