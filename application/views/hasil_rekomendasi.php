<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">

    <!-- Tombol Ubah Preferensi -->
    <a href="<?= base_url('rekomendasi'); ?>" class="inline-flex items-center gap-1 text-sky-600 hover:text-sky-700 text-sm font-medium mb-6 transition group">
        <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
        Ubah preferensi
    </a>

    <!-- Header -->
    <div class="mb-10 animate-fade-in-up">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">
            Hasil Rekomendasi
        </h1>
        <p class="text-gray-600 text-base sm:text-lg">
            Berikut adalah paket wisata terbaik sesuai preferensimu
        </p>
    </div>

    <!-- Ringkasan Preferensi -->
    <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="bg-white rounded-2xl shadow-md shadow-slate-200/50 p-5 sm:p-6 mb-8 border border-gray-200">
            <h3 class="font-bold text-sm text-gray-700 mb-4 flex items-center gap-2">
                <div class="w-8 h-8 bg-sky-50 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-rounded text-sky-600 text-[18px]">tune</span>
                </div>
                Ringkasan Preferensi Kamu
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <?php foreach ($kriteria as $kr): ?>
                    <?php
                        $nilai = isset($bobot[$kr->kode_kriteria]) ? $bobot[$kr->kode_kriteria] : '-';
                        $label_nilai = '';
                        if ($nilai != '-') {
                            switch($nilai) {
                                case 1: $label_nilai = 'tidak penting'; break;
                                case 2: $label_nilai = 'kurang penting'; break;
                                case 3: $label_nilai = 'cukup penting'; break;
                                case 4: $label_nilai = 'penting'; break;
                                case 5: $label_nilai = 'sangat penting'; break;
                            }
                        }
                    ?>
                    <div class="bg-sky-50 rounded-xl p-4 text-center border-2 border-sky-100 hover:shadow-md transition-all duration-300">
                        <p class="text-xs text-sky-600 font-bold mb-1"><?= $kr->kode_kriteria; ?></p>
                        <p class="font-semibold text-xs text-gray-700 mb-2"><?= $kr->nama_kriteria; ?></p>
                        <p class="text-3xl font-extrabold text-sky-600"><?= $nilai; ?></p>
                        <?php if ($label_nilai): ?>
                            <p class="text-[10px] text-gray-600 mt-1 capitalize"><?= $label_nilai; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Ranking Results -->
    <?php if (!empty($hasil)): ?>
        <div class="space-y-6">
            <?php foreach ($hasil as $i => $h): ?>
                <?php
                    $is_rank_1 = ($i == 0);
                    $rank_badge_class = $is_rank_1 
                        ? 'bg-gradient-to-br from-yellow-400 to-amber-500 text-white shadow-amber-200' 
                        : 'bg-gradient-to-br from-gray-300 to-gray-400 text-white shadow-gray-200';
                    
                    // Hitung persentase kecocokan
                    $persentase = round($h['nilai_v'] * 100);
                    
                    // Tentukan bintang berdasarkan Vi
                    $bintang = '';
                    if ($h['nilai_v'] >= 0.8) {
                        $bintang = '★★★★★';
                    } elseif ($h['nilai_v'] >= 0.6) {
                        $bintang = '★★★★';
                    } elseif ($h['nilai_v'] >= 0.4) {
                        $bintang = '★★★';
                    } else {
                        $bintang = '★★';
                    }
                    
                    // Tentukan label keterangan kontekstual untuk setiap kriteria
                    $keterangan_map = [];
                    foreach ($h['detail'] as $d) {
                        $rij = $d['normalisasi'];
                        $nilai_asli = $d['nilai_asli'];
                        $kode = $d['kode'];
                        
                        if ($kode == 'C1') {
                            // Harga - Cost (semakin kecil semakin baik)
                            $harga_format = 'Rp ' . number_format($nilai_asli, 0, ',', '.');
                            if ($rij == 1.0) {
                                $keterangan_map[$kode] = $harga_format . ' — paling terjangkau';
                            } elseif ($rij >= 0.8) {
                                $keterangan_map[$kode] = $harga_format . ' — sangat terjangkau';
                            } elseif ($rij >= 0.6) {
                                $keterangan_map[$kode] = $harga_format . ' — cukup terjangkau';
                            } elseif ($rij >= 0.4) {
                                $keterangan_map[$kode] = $harga_format . ' — agak mahal';
                            } else {
                                $keterangan_map[$kode] = $harga_format . ' — paling mahal';
                            }
                        } elseif ($kode == 'C2') {
                            // Durasi - Benefit (semakin lama semakin baik)
                            if ($nilai_asli >= 5) {
                                $keterangan_map[$kode] = $nilai_asli . ' hari — perjalanan panjang';
                            } elseif ($nilai_asli >= 4) {
                                $keterangan_map[$kode] = $nilai_asli . ' hari — cukup lama';
                            } elseif ($nilai_asli >= 3) {
                                $keterangan_map[$kode] = $nilai_asli . ' hari — standar';
                            } elseif ($nilai_asli >= 2) {
                                $keterangan_map[$kode] = $nilai_asli . ' hari — cukup singkat';
                            } else {
                                $keterangan_map[$kode] = $nilai_asli . ' hari — sangat singkat';
                            }
                        } elseif ($kode == 'C3') {
                            // Destinasi - Benefit (semakin banyak semakin baik)
                            if ($nilai_asli >= 5) {
                                $keterangan_map[$kode] = $nilai_asli . ' destinasi — sangat banyak';
                            } elseif ($nilai_asli >= 4) {
                                $keterangan_map[$kode] = $nilai_asli . ' destinasi — cukup banyak';
                            } elseif ($nilai_asli >= 3) {
                                $keterangan_map[$kode] = $nilai_asli . ' destinasi — lumayan';
                            } elseif ($nilai_asli >= 2) {
                                $keterangan_map[$kode] = $nilai_asli . ' destinasi — sedikit';
                            } else {
                                $keterangan_map[$kode] = $nilai_asli . ' destinasi — sangat sedikit';
                            }
                        } elseif ($kode == 'C4') {
                            // Aktivitas - Benefit (semakin banyak semakin baik)
                            if ($nilai_asli >= 5) {
                                $keterangan_map[$kode] = $nilai_asli . ' aktivitas — sangat beragam';
                            } elseif ($nilai_asli >= 4) {
                                $keterangan_map[$kode] = $nilai_asli . ' aktivitas — cukup beragam';
                            } elseif ($nilai_asli >= 3) {
                                $keterangan_map[$kode] = $nilai_asli . ' aktivitas — lumayan';
                            } elseif ($nilai_asli >= 2) {
                                $keterangan_map[$kode] = $nilai_asli . ' aktivitas — sedikit';
                            } else {
                                $keterangan_map[$kode] = $nilai_asli . ' aktivitas — sangat sedikit';
                            }
                        }
                    }
                ?>
                
                <div class="bg-white rounded-2xl shadow-md shadow-slate-200/50 p-5 sm:p-6 border-2 <?= $is_rank_1 ? 'border-sky-500' : 'border-gray-200'; ?> hover:shadow-xl transition-all duration-300 animate-fade-in-up relative" style="animation-delay: <?= ($i+2)*0.1; ?>s;">
                    
                    <!-- Badge Paling Cocok untuk #1 -->
                    <?php if ($is_rank_1): ?>
                        <div class="absolute top-4 right-4 bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1">
                            <span class="material-symbols-rounded text-[14px]">emoji_events</span>
                            Paling cocok
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex flex-col lg:flex-row gap-5">
                        <!-- Ranking Badge dan Foto -->
                        <div class="flex flex-col sm:flex-row gap-4 flex-1">
                            <!-- Rank Badge -->
                            <div class="flex items-center justify-center sm:justify-start">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center text-2xl font-extrabold <?= $rank_badge_class; ?> shadow-lg">
                                    #<?= $i + 1; ?>
                                </div>
                            </div>
                            
                            <!-- Foto Paket -->
                            <div class="w-full sm:w-44 flex-shrink-0">
                                <div class="relative overflow-hidden rounded-xl aspect-video sm:aspect-auto sm:h-32 bg-gray-100">
                                    <?php if (!empty($h['foto'])): ?>
                                        <img src="<?= base_url('application/assets/images/paket/' . $h['foto'] . '?v=' . time()); ?>" 
                                             class="w-full h-full object-cover"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="hidden items-center justify-center w-full h-full bg-gray-100 text-6xl">🏖️</div>
                                    <?php else: ?>
                                        <div class="flex items-center justify-center w-full h-full bg-gray-100 text-6xl">🏖️</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Info Paket -->
                            <div class="flex-1">
                                <h3 class="font-semibold text-base sm:text-lg text-gray-900 mb-2"><?= $h['nama_paket']; ?></h3>
                                <p class="text-sky-600 font-extrabold text-lg sm:text-xl mb-2">
                                    Rp <?= number_format($h['harga'], 0, ',', '.'); ?>
                                </p>
                                <?php
                                    // Ambil nilai asli dari detail untuk durasi dan aktivitas
                                    $durasi = 0;
                                    $aktivitas = 0;
                                    foreach ($h['detail'] as $d) {
                                        if ($d['kode'] == 'C2') $durasi = $d['nilai_asli'];
                                        if ($d['kode'] == 'C4') $aktivitas = $d['nilai_asli'];
                                    }
                                ?>
                                <p class="text-xs text-gray-600">
                                    <?= $durasi; ?> hari · <?= $h['jumlah_destinasi_paket']; ?> destinasi · <?= $aktivitas; ?> aktivitas
                                </p>
                            </div>
                        </div>
                        
                        <!-- Detail Kriteria dan Progress Bar -->
                        <div class="flex-1">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                                <?php foreach ($h['detail'] as $d): ?>
                                    <?php
                                        $rij = $d['normalisasi'];
                                        $bar_color = $rij >= 0.5 ? 'bg-sky-500' : 'bg-gray-400';
                                        $bar_width = $rij * 100;
                                        
                                        // Label nilai untuk C1
                                        $label_c1 = '';
                                        if ($d['kode'] == 'C1' && isset($bobot[$d['kode']])) {
                                            $nilai_c1 = $bobot[$d['kode']];
                                            switch($nilai_c1) {
                                                case 1: $label_c1 = '(kamu: tidak penting)'; break;
                                                case 2: $label_c1 = '(kamu: kurang penting)'; break;
                                                case 3: $label_c1 = '(kamu: cukup penting)'; break;
                                                case 4: $label_c1 = '(kamu: penting)'; break;
                                                case 5: $label_c1 = '(kamu: sangat penting)'; break;
                                            }
                                        }
                                    ?>
                                    <div class="bg-sky-50 rounded-lg p-3 border border-sky-100">
                                        <p class="text-xs font-bold text-gray-700 mb-2">
                                            <?= $d['nama']; ?>
                                            <?php if ($label_c1): ?>
                                                <span class="text-[10px] text-gray-600 font-normal"><?= $label_c1; ?></span>
                                            <?php endif; ?>
                                        </p>
                                        <!-- Progress Bar -->
                                        <div class="w-full bg-gray-200 rounded-full h-2 mb-1.5 overflow-hidden">
                                            <div class="<?= $bar_color; ?> h-2 rounded-full transition-all duration-500" style="width: <?= $bar_width; ?>%"></div>
                                        </div>
                                        <p class="text-[10px] text-gray-600 font-medium"><?= $keterangan_map[$d['kode']]; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Skor Kecocokan -->
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-xs font-bold text-gray-700">Kecocokan dengan preferensimu:</span>
                                <span class="text-lg font-extrabold text-sky-600"><?= $persentase; ?>%</span>
                                <span class="text-sm"><?= $bintang; ?></span>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="flex flex-wrap items-center gap-2">
                                <a href="<?= base_url('pemesanan/form/' . $h['id_paket']); ?>" 
                                   class="inline-flex items-center gap-1.5 bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300 hover:shadow-md">
                                    <span class="material-symbols-rounded text-[16px]">shopping_cart</span>
                                    Pesan sekarang
                                </a>
                                <a href="<?= base_url('paket/detail/' . $h['id_paket']); ?>" 
                                   class="inline-flex items-center gap-1.5 border-2 border-sky-500 text-sky-600 hover:bg-sky-50 px-4 py-2 rounded-lg text-sm font-bold transition-all duration-300">
                                    <span class="material-symbols-rounded text-[16px]">info</span>
                                    Lihat detail paket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-md shadow-slate-200/50 p-12 sm:p-16 text-center border border-gray-200">
            <span class="material-symbols-rounded text-gray-300 text-6xl mb-4">search_off</span>
            <p class="text-gray-500 text-base sm:text-lg font-medium">
                Belum ada paket wisata yang tersedia saat ini.
            </p>
            <p class="text-gray-400 text-sm mt-2">
                Coba lagi nanti atau hubungi kami.
            </p>
        </div>
    <?php endif; ?>

    <!-- Catatan di Bawah Hasil -->
    <div class="mt-8 bg-sky-50 border-2 border-sky-200 rounded-xl p-5 sm:p-6 animate-fade-in-up" style="animation-delay: 0.3s;">
        <div class="flex items-start gap-3">
            <span class="material-symbols-rounded text-sky-600 text-[20px] mt-0.5">info</span>
            <div class="text-sm text-sky-900 leading-relaxed">
                <p class="font-semibold mb-1">Cara kerja perangkingan ini:</p>
                <p>
                    Urutan ini dihitung otomatis berdasarkan preferensimu menggunakan metode SAW (Simple Additive Weighting). 
                    Semakin penuh bar-nya, semakin baik paket itu di kriteria tersebut.
                </p>
            </div>
        </div>
    </div>

</main>