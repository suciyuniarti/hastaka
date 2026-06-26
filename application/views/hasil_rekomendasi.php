<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <a href="<?= base_url('rekomendasi'); ?>" class="inline-flex items-center gap-1 text-brand-600 hover:text-brand-700 text-sm font-medium mb-6 transition group">
        <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Ubah Preferensi
    </a>

    <div class="mb-10 animate-fade-in-up">
        <h1 class="text-3xl font-extrabold text-gray-900">Hasil <span class="gradient-text">Rekomendasi</span></h1>
        <p class="text-gray-500 mt-1">Perangkingan paket berdasarkan preferensi Anda dengan metode SAW</p>
    </div>

    <!-- Bobot Summary -->
    <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 p-6 mb-10 animate-fade-in-up stagger-1">
        <h3 class="font-bold text-sm text-gray-700 mb-4 flex items-center gap-2">
            <span class="material-symbols-rounded text-brand-500 text-[20px]">tune</span> Bobot Preferensi Anda
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <?php foreach ($kriteria as $kr): ?>
            <div class="bg-brand-50 rounded-2xl p-4 text-center border border-brand-100">
                <p class="text-xs text-brand-500 font-bold"><?= $kr->kode_kriteria; ?></p>
                <p class="font-semibold text-sm text-gray-800"><?= $kr->nama_kriteria; ?></p>
                <p class="text-2xl font-extrabold gradient-text mt-1"><?= isset($bobot[$kr->kode_kriteria]) ? $bobot[$kr->kode_kriteria] : '-'; ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Active Filters -->
    </div>

    <!-- Ranking Results -->
    <?php if (!empty($hasil)): ?>
    <div class="space-y-4">
        <?php foreach ($hasil as $i => $h): ?>
        <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 p-6 flex flex-col md:flex-row gap-6 animate-fade-in-up hover-lift <?= $i == 0 ? 'ring-2 ring-brand-500 ring-offset-2' : ''; ?>" style="animation-delay: <?= ($i+2)*0.1; ?>s; opacity:0;">

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
                <img src="<?= base_url('application/assets/images/paket/' . $h['foto'] . '?v=' . time()); ?>"
                    class="w-full h-28 object-cover rounded-2xl"
                    onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
            </div>

            <!-- Info -->
            <div class="flex-1">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <?php if (!empty($h['jumlah_aktivitas'])): ?>
                            <span class="bg-purple-50 text-purple-700 px-2 py-0.5 rounded-full text-[11px] font-semibold border border-purple-200 flex items-center gap-1">
                                <span class="material-symbols-rounded text-[13px]">hiking</span>
                                <?= $h['jumlah_aktivitas']; ?> Aktivitas
                            </span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-bold text-lg text-gray-900"><?= $h['nama_paket']; ?></h3>
                        <p class="gradient-text font-extrabold text-lg mt-0.5">Rp <?= number_format($h['harga'], 0, ',', '.'); ?></p>
                    </div>
                    <?php if ($i == 0): ?>
                    <span class="status-badge bg-amber-100 text-amber-700 border border-amber-200 flex-shrink-0 inline-flex items-center gap-1">
                        <span class="material-symbols-rounded text-[14px]">emoji_events</span> Terbaik
                    </span>
                    <?php endif; ?>
                </div>

                <!-- Normalisasi Detail -->
                <div class="mt-3">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        <?php foreach ($h['detail'] as $d): ?>
                        <div class="bg-surface-50 rounded-xl p-2.5 border border-gray-100">
                            <p class="text-[10px] text-gray-400 font-semibold uppercase"><?= $d['kode']; ?> <?= $d['nama']; ?></p>
                            <p class="font-bold text-sm text-gray-800">R: <?= $d['normalisasi']; ?></p>
                            <p class="text-[10px] text-gray-400">W: <?= $d['bobot']; ?> (<?= $d['sifat']; ?>)</p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-3">
                    <span class="bg-brand-50 text-brand-700 px-4 py-2 rounded-full font-bold text-sm border border-brand-100 inline-flex items-center gap-1.5">
                        <span class="material-symbols-rounded text-brand-600 text-[16px]">calculate</span> V = <?= $h['nilai_v']; ?>
                    </span>
                    <a href="<?= base_url('paket/detail/' . $h['id_paket']); ?>" class="inline-flex items-center gap-1.5 text-brand-600 hover:text-brand-700 text-sm font-semibold transition">
                        <span class="material-symbols-rounded text-[16px]">info</span> Lihat Detail
                    </a>
                    <?php if ($this->session->userdata('role') != 'admin'): ?>
                    <a href="<?= base_url('pemesanan/booking/' . $h['id_paket']); ?>" class="gradient-bg text-white px-5 py-2 rounded-full text-sm font-bold hover:opacity-90 transition shadow-lg shadow-brand-500/20 inline-flex items-center gap-1.5">
                        <span class="material-symbols-rounded text-[16px]">shopping_cart</span> Pesan
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

