<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">

    <a href="<?= base_url('rekomendasi'); ?>" class="inline-flex items-center gap-1 text-brand-600 hover:text-brand-700 text-sm font-medium mb-6 transition group">
        <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Ubah Preferensi
    </a>

    <div class="mb-10 animate-fade-in-up">
        <h1 class="text-3xl font-extrabold text-gray-900">Hasil <span class="gradient-text">Rekomendasi</span></h1>
        <p class="text-gray-500 mt-1">Perangkingan paket berdasarkan preferensi Anda dengan metode SAW</p>
    </div>

    <!-- Bobot Summary -->
    <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 p-6 mb-10 border-2 border-slate-200/80">
            <h3 class="font-bold text-sm text-gray-700 mb-4 flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-50 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-rounded text-brand-600 text-[18px]">tune</span>
                </div>
                Bobot Preferensi Anda
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <?php foreach ($kriteria as $kr): ?>
                <div class="group bg-slate-50 rounded-2xl p-4 text-center border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                    <p class="text-xs text-brand-500 font-bold mb-1"><?= $kr->kode_kriteria; ?></p>
                    <p class="font-semibold text-sm text-gray-800"><?= $kr->nama_kriteria; ?></p>
                    <p class="text-2xl font-extrabold gradient-text mt-2"><?= isset($bobot[$kr->kode_kriteria]) ? $bobot[$kr->kode_kriteria] : '-'; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Ranking Results -->
    <?php if (!empty($hasil)): ?>
    <div class="space-y-4">
        <?php foreach ($hasil as $i => $h): ?>
        <div class="group bg-white rounded-2xl shadow-md shadow-slate-200/50 p-6 flex flex-col md:flex-row gap-6 border-2 border-slate-200/80 hover:shadow-2xl hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300 animate-fade-in-up <?= $i == 0 ? 'ring-2 ring-brand-500 ring-offset-2' : ''; ?>" style="animation-delay: <?= ($i+2)*0.1; ?>s; opacity:0;">

            <!-- Rank Badge -->
            <div class="flex items-center justify-center">
                <?php
                $rank_colors = ['bg-gradient-to-br from-yellow-400 to-amber-500 text-white shadow-amber-200', 'bg-gradient-to-br from-gray-300 to-gray-400 text-white shadow-gray-200', 'bg-gradient-to-br from-orange-400 to-orange-500 text-white shadow-orange-200'];
                $rank_bg = $i < 3 ? $rank_colors[$i] : 'bg-gray-100 text-gray-600';
                ?>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-extrabold <?= $rank_bg; ?> shadow-lg">
                    #<?= $i + 1; ?>
                </div>
            </div>

            <!-- Foto -->
            <div class="w-full md:w-44 flex-shrink-0">
                <div class="relative overflow-hidden rounded-2xl aspect-video md:aspect-auto md:h-32">
                    <img src="<?= base_url('application/assets/images/paket/' . $h['foto'] . '?v=' . time()); ?>"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </div>

            <!-- Info -->
            <div class="flex-1">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap mb-2">
                            <?php if (!empty($h['jumlah_aktivitas'])): ?>
                            <span class="inline-flex items-center gap-1 bg-brand-50 text-brand-700 px-2.5 py-1 rounded-lg text-[11px] font-bold border border-brand-200">
                                <span class="material-symbols-rounded text-[13px]">hiking</span>
                                <?= $h['jumlah_aktivitas']; ?> Aktivitas
                            </span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-bold text-lg text-gray-900 group-hover:text-brand-600 transition-colors"><?= $h['nama_paket']; ?></h3>
                        <p class="gradient-text font-extrabold text-xl mt-1">Rp <?= number_format($h['harga'], 0, ',', '.'); ?></p>
                    </div>
                    <?php if ($i == 0): ?>
                    <span class="status-badge bg-amber-100 text-amber-700 border border-amber-200 flex-shrink-0 inline-flex items-center gap-1">
                        <span class="material-symbols-rounded text-[14px]">emoji_events</span> Terbaik
                    </span>
                    <?php endif; ?>
                </div>

                <!-- Normalisasi Detail -->
                <div class="mt-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        <?php foreach ($h['detail'] as $d): ?>
                        <div class="bg-slate-50 rounded-xl p-3 border-2 border-slate-200/80 hover:border-brand-300 transition-all duration-300">
                            <p class="text-[10px] text-gray-500 font-bold uppercase mb-1"><?= $d['kode']; ?> <?= $d['nama']; ?></p>
                            <p class="font-bold text-sm text-gray-800">R: <?= $d['normalisasi']; ?></p>
                            <p class="text-[10px] text-gray-500">W: <?= $d['bobot']; ?> (<?= $d['sifat']; ?>)</p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-3 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-brand-600 to-brand-500 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg shadow-brand-500/30">
                        <span class="material-symbols-rounded text-[16px]">calculate</span> V = <?= $h['nilai_v']; ?>
                    </span>
                    <a href="<?= base_url('paket/detail/' . $h['id_paket']); ?>" class="group/btn inline-flex items-center gap-1.5 text-brand-600 hover:text-brand-700 text-sm font-bold transition">
                        <span class="material-symbols-rounded text-[16px] group-hover/btn:scale-110 transition-transform">info</span> Lihat Detail
                    </a>
                    <?php if ($this->session->userdata('role') != 'admin'): ?>
                    <a href="<?= base_url('pemesanan/booking/' . $h['id_paket']); ?>" class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-brand-600 to-brand-500 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:from-brand-700 hover:to-brand-600 hover:shadow-xl hover:shadow-brand-500/40 hover:scale-105 active:scale-95 transition-all duration-300">
                        <span class="material-symbols-rounded text-[16px] group-hover/btn:scale-110 transition-transform">shopping_cart</span> Pesan
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-3xl shadow p-16 text-center">
        <span class="material-symbols-rounded text-gray-300 text-6xl">search_off</span>
        <p class="text-gray-400 mt-4 text-lg">Tidak ada paket tersedia untuk direkomendasikan.</p>
    </div>
    <?php endif; ?>

</main>

