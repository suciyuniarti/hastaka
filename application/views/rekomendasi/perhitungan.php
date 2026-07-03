<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">

    <!-- Tombol Kembali -->
    <a href="<?= base_url('rekomendasi/hasil'); ?>" class="inline-flex items-center gap-1 text-sky-600 hover:text-sky-700 text-sm font-medium mb-6 transition group">
        <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
        Kembali ke hasil rekomendasi
    </a>

    <!-- Header -->
    <div class="mb-10 animate-fade-in-up">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">
            Detail Perhitungan SAW
        </h1>
        <p class="text-gray-600 text-base sm:text-lg">
            <?= $paket->nama_paket; ?> — transparansi proses algoritma
        </p>
    </div>

    <!-- LANGKAH 1: NORMALISASI BOBOT (Wj) -->
    <div class="bg-white rounded-2xl shadow-md shadow-slate-200/50 p-5 sm:p-6 mb-6 border border-gray-200 animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-bold border border-sky-200">
                Langkah 1
            </span>
            <h2 class="font-bold text-lg text-gray-900">Normalisasi bobot (Wj)</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">
            Nilai yang kamu masukkan dibagi total semua nilai agar bobotnya proporsional.
        </p>
        
        <div class="bg-sky-50 rounded-lg p-4 mb-4 border border-sky-200">
            <p class="text-sm font-mono text-gray-800 text-center">
                Wj = nilai inputmu ÷ total semua input
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm border-collapse">
                <thead>
                    <tr class="bg-sky-500 text-white">
                        <th class="border border-sky-600 px-3 py-2 text-left font-semibold">Kriteria</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">Nilai input kamu</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">Bobot (Wj)</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kriteria as $kr): ?>
                        <?php
                            $nilai_input = isset($bobot_input[$kr->kode_kriteria]) ? $bobot_input[$kr->kode_kriteria] : 0;
                            $wj = isset($bobot_normalisasi[$kr->kode_kriteria]) ? $bobot_normalisasi[$kr->kode_kriteria] : 0;
                            $is_tertinggi = ($wj == max($bobot_normalisasi));
                        ?>
                        <tr class="<?= $is_tertinggi ? 'bg-sky-50' : 'bg-white'; ?> hover:bg-sky-50 transition-colors">
                            <td class="border border-gray-200 px-3 py-2 font-medium">
                                <?= $kr->kode_kriteria; ?> <?= $kr->nama_kriteria; ?>
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-center"><?= $nilai_input; ?></td>
                            <td class="border border-gray-200 px-3 py-2 text-center font-bold <?= $is_tertinggi ? 'text-sky-600' : ''; ?>">
                                <?= number_format($wj, 4); ?>
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-center">
                                <?php if ($kr->kode_kriteria == 'C1'): ?>
                                    <span class="inline-flex items-center gap-1 text-red-600 font-medium">
                                        Cost <span class="material-symbols-rounded text-[14px]">arrow_downward</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 text-green-600 font-medium">
                                        Benefit <span class="material-symbols-rounded text-[14px]">arrow_upward</span>
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="bg-gray-50 font-bold">
                        <td class="border border-gray-200 px-3 py-2">Total</td>
                        <td class="border border-gray-200 px-3 py-2 text-center"><?= array_sum($bobot_input); ?></td>
                        <td class="border border-gray-200 px-3 py-2 text-center">1,0000</td>
                        <td class="border border-gray-200 px-3 py-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
            <p class="text-xs text-blue-800">
                <strong>Contoh:</strong> Jika kamu input 5 untuk harga dan totalnya 12, maka Wj harga = 5 ÷ 12 = 0,4167
            </p>
        </div>
    </div>

    <!-- LANGKAH 2: MATRIKS KEPUTUSAN (Xij) -->
    <div class="bg-white rounded-2xl shadow-md shadow-slate-200/50 p-5 sm:p-6 mb-6 border border-gray-200 animate-fade-in-up" style="animation-delay: 0.2s;">
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-bold border border-sky-200">
                Langkah 2
            </span>
            <h2 class="font-bold text-lg text-gray-900">Matriks keputusan (Xij)</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">
            Data asli setiap paket wisata dari database sebelum dinormalisasi.
        </p>

        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm border-collapse">
                <thead>
                    <tr class="bg-sky-500 text-white">
                        <th class="border border-sky-600 px-3 py-2 text-left font-semibold">Paket</th>
                        <th class="border border-sky-600 px-3 py-2 text-right font-semibold">C1 Harga (Rp)</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">C2 Durasi (hari)</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">C3 Destinasi</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">C4 Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Kelompokkan matriks keputusan per paket
                        $matriks_per_paket = [];
                        foreach ($matriks_keputusan as $nilai) {
                            if (!isset($matriks_per_paket[$nilai->id_paket])) {
                                $matriks_per_paket[$nilai->id_paket] = [
                                    'nama_paket' => $nilai->nama_paket,
                                    'nilai' => []
                                ];
                            }
                            $matriks_per_paket[$nilai->id_paket]['nilai'][$nilai->kode_kriteria] = $nilai->nilai;
                        }
                    ?>
                    <?php foreach ($matriks_per_paket as $id_p => $data_paket): ?>
                        <?php
                            $is_paket_terpilih = ($id_p == $paket->id_paket);
                        ?>
                        <tr class="<?= $is_paket_terpilih ? 'bg-sky-50 font-semibold' : 'bg-white'; ?> hover:bg-sky-50 transition-colors">
                            <td class="border border-gray-200 px-3 py-2">
                                <?= $data_paket['nama_paket']; ?>
                                <?php if ($is_paket_terpilih): ?>
                                    <span class="ml-1 text-sky-600">←</span>
                                <?php endif; ?>
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-right">
                                Rp <?= number_format(isset($data_paket['nilai']['C1']) ? $data_paket['nilai']['C1'] : 0, 0, ',', '.'); ?>
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-center">
                                <?= isset($data_paket['nilai']['C2']) ? $data_paket['nilai']['C2'] : 0; ?>
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-center">
                                <?= isset($data_paket['nilai']['C3']) ? $data_paket['nilai']['C3'] : 0; ?>
                            </td>
                            <td class="border border-gray-200 px-3 py-2 text-center">
                                <?= isset($data_paket['nilai']['C4']) ? $data_paket['nilai']['C4'] : 0; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="bg-gray-50 font-bold">
                        <td class="border border-gray-200 px-3 py-2">Nilai Min</td>
                        <td class="border border-gray-200 px-3 py-2 text-right">
                            Rp <?= number_format(isset($max_min['C1']['min']) ? $max_min['C1']['min'] : 0, 0, ',', '.'); ?>
                        </td>
                        <td class="border border-gray-200 px-3 py-2 text-center">
                            <?= isset($max_min['C2']['max']) ? $max_min['C2']['max'] : 0; ?>
                        </td>
                        <td class="border border-gray-200 px-3 py-2 text-center">
                            <?= isset($max_min['C3']['max']) ? $max_min['C3']['max'] : 0; ?>
                        </td>
                        <td class="border border-gray-200 px-3 py-2 text-center">
                            <?= isset($max_min['C4']['max']) ? $max_min['C4']['max'] : 0; ?>
                        </td>
                    </tr>
                    <tr class="bg-gray-50 font-bold">
                        <td class="border border-gray-200 px-3 py-2">Nilai Max</td>
                        <td class="border border-gray-200 px-3 py-2 text-right">
                            Rp <?= number_format(isset($max_min['C1']['max']) ? $max_min['C1']['max'] : 0, 0, ',', '.'); ?>
                        </td>
                        <td class="border border-gray-200 px-3 py-2 text-center">
                            <?= isset($max_min['C2']['max']) ? $max_min['C2']['max'] : 0; ?>
                        </td>
                        <td class="border border-gray-200 px-3 py-2 text-center">
                            <?= isset($max_min['C3']['max']) ? $max_min['C3']['max'] : 0; ?>
                        </td>
                        <td class="border border-gray-200 px-3 py-2 text-center">
                            <?= isset($max_min['C4']['max']) ? $max_min['C4']['max'] : 0; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- LANGKAH 3: NORMALISASI MATRIKS (rij) -->
    <div class="bg-white rounded-2xl shadow-md shadow-slate-200/50 p-5 sm:p-6 mb-6 border border-gray-200 animate-fade-in-up" style="animation-delay: 0.3s;">
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-bold border border-sky-200">
                Langkah 3
            </span>
            <h2 class="font-bold text-lg text-gray-900">Normalisasi matriks (rij)</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">
            Setiap nilai diubah ke skala 0–1 agar semua kriteria bisa dibandingkan secara adil.
        </p>

        <div class="grid sm:grid-cols-2 gap-3 mb-4">
            <div class="bg-sky-50 rounded-lg p-3 border border-sky-200">
                <p class="text-xs font-mono text-gray-800 text-center">
                    <strong>Cost (C1):</strong> rij = Min ÷ Xij
                </p>
            </div>
            <div class="bg-sky-50 rounded-lg p-3 border border-sky-200">
                <p class="text-xs font-mono text-gray-800 text-center">
                    <strong>Benefit (C2–C4):</strong> rij = Xij ÷ Max
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm border-collapse">
                <thead>
                    <tr class="bg-sky-500 text-white">
                        <th class="border border-sky-600 px-3 py-2 text-left font-semibold">Paket</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">rij C1</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">rij C2</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">rij C3</th>
                        <th class="border border-sky-600 px-3 py-2 text-center font-semibold">rij C4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matriks_normalisasi as $id_p => $data_paket): ?>
                        <?php
                            $is_paket_terpilih = ($id_p == $paket->id_paket);
                        ?>
                        <tr class="<?= $is_paket_terpilih ? 'bg-sky-50 font-semibold' : 'bg-white'; ?> hover:bg-sky-50 transition-colors">
                            <td class="border border-gray-200 px-3 py-2">
                                <?= $data_paket['nama_paket']; ?>
                                <?php if ($is_paket_terpilih): ?>
                                    <span class="ml-1 text-sky-600">←</span>
                                <?php endif; ?>
                            </td>
                            <?php foreach (['C1', 'C2', 'C3', 'C4'] as $kode): ?>
                                <?php
                                    $nilai_data = isset($data_paket['nilai'][$kode]) ? $data_paket['nilai'][$kode] : null;
                                    if ($nilai_data):
                                        $rij = $nilai_data['normalisasi'];
                                        $xij = $nilai_data['nilai_asli'];
                                        $sifat = $nilai_data['sifat'];
                                        $max = $nilai_data['max'];
                                        $min = $nilai_data['min'];
                                        
                                        // Format perhitungan
                                        if ($sifat == 'cost') {
                                            $perhitungan = number_format($min, 0, ',', '.') . ' ÷ ' . number_format($xij, 0, ',', '.') . ' = ' . number_format($rij, 3);
                                        } else {
                                            $perhitungan = number_format($xij, 0, ',', '.') . ' ÷ ' . number_format($max, 0, ',', '.') . ' = ' . number_format($rij, 3);
                                        }
                                        
                                        $is_terbaik = ($rij == 1.0);
                                    else:
                                        $perhitungan = '-';
                                        $is_terbaik = false;
                                    endif;
                                ?>
                                <td class="border border-gray-200 px-3 py-2 text-center <?= $is_terbaik ? 'bg-sky-50 text-sky-700 font-bold' : ''; ?>">
                                    <div class="flex flex-col items-center">
                                        <span class="text-[10px] text-gray-600"><?= $perhitungan; ?></span>
                                        <span class="font-bold"><?= isset($nilai_data) ? number_format($rij, 3) : '-'; ?></span>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
            <p class="text-xs text-blue-800">
                <strong>Catatan:</strong> Nilai 1,000 artinya paket ini terbaik di kriteria tersebut.
            </p>
        </div>
    </div>

    <!-- LANGKAH 4: NILAI PREFERENSI AKHIR (Vi) -->
    <div class="bg-white rounded-2xl shadow-md shadow-slate-200/50 p-5 sm:p-6 mb-6 border border-gray-200 animate-fade-in-up" style="animation-delay: 0.4s;">
        <div class="flex items-center gap-2 mb-4">
            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-bold border border-sky-200">
                Langkah 4
            </span>
            <h2 class="font-bold text-lg text-gray-900">Nilai preferensi akhir (Vi)</h2>
        </div>
        <p class="text-sm text-gray-600 mb-4">
            Vi dihitung dari penjumlahan semua (rij × Wj). Semakin tinggi Vi, semakin cocok paket itu dengan preferensimu.
        </p>

        <?php
            // Ambil detail perhitungan untuk paket yang sedang dilihat
            $detail_vi_paket = [];
            foreach ($nilai_v_semua as $item) {
                if ($item['nama_paket'] == $paket->nama_paket) {
                    $detail_vi_paket = $item['detail'];
                    $vi_paket = $item['nilai_v'];
                    break;
                }
            }
        ?>

        <?php if (!empty($detail_vi_paket)): ?>
            <div class="bg-sky-50 rounded-lg p-4 mb-4 border border-sky-200">
                <p class="text-xs font-mono text-gray-800 leading-relaxed whitespace-pre-line">
                    <strong>V = </strong><?php
                        $parts = [];
                        foreach ($detail_vi_paket as $d) {
                            $parts[] = "({$d['rij']} × {$d['wj']})";
                        }
                        echo implode(' + ', $parts);
                    ?><br><br>
                    <strong>    = </strong><?php
                        $parts = [];
                        foreach ($detail_vi_paket as $d) {
                            $parts[] = number_format($d['kontribusi'], 4);
                        }
                        echo implode(' + ', $parts);
                    ?><br><br>
                    <strong>    = <?= number_format($vi_paket, 4); ?></strong>
                </p>
            </div>
        <?php endif; ?>

        <!-- Grid Ranking Semua Paket -->
        <h3 class="font-bold text-sm text-gray-700 mb-3">Ranking Semua Paket</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-4">
            <?php foreach ($nilai_v_semua as $index => $item): ?>
                <?php
                    $is_paket_terpilih = ($item['nama_paket'] == $paket->nama_paket);
                    $rank = $index + 1;
                ?>
                <div class="bg-white rounded-lg p-4 border-2 <?= $is_paket_terpilih ? 'border-sky-500' : 'border-gray-200'; ?> hover:shadow-md transition-all">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <p class="font-semibold text-sm text-gray-900"><?= $item['nama_paket']; ?></p>
                            <p class="text-xs text-gray-600 mt-1">Ranking #<?= $rank; ?></p>
                        </div>
                        <?php if ($rank == 1): ?>
                            <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 px-2 py-1 rounded-full text-[10px] font-bold">
                                Terbaik
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-2xl font-extrabold text-sky-600"><?= number_format($item['nilai_v'], 4); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Penjelasan Dinamis -->
        <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <span class="material-symbols-rounded text-sky-600 text-[20px] mt-0.5">info</span>
                <p class="text-sm text-blue-900 leading-relaxed">
                    <?= $penjelasan; ?>
                </p>
            </div>
        </div>
    </div>

</main>