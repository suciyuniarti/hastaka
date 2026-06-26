<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10 animate-fade-in-up">
            <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                <span class="material-symbols-rounded text-[16px]">auto_awesome</span> Metode SAW
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900">Rekomendasi <span class="gradient-text">Paket Wisata</span></h1>
            <p class="text-gray-500 mt-2">Atur bobot preferensi Anda, sistem akan menghitung rekomendasi terbaik</p>
        </div>

        <?= form_open('rekomendasi/hasil', ['class' => 'animate-fade-in-up stagger-1']); ?>

        <!-- Bobot Section -->
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 mb-8">
            <h2 class="font-bold text-lg text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-rounded text-brand-500">tune</span> Bobot Preferensi (Skala 1-5)
            </h2>

            <div class="space-y-6">
                <?php foreach ($kriteria as $kr): ?>
                <div class="group">
                    <div class="flex justify-between mb-2">
                        <label class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                            <span class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center text-white text-xs font-bold"><?= $kr->kode_kriteria; ?></span>
                            <?= $kr->nama_kriteria; ?>
                        </label>
                        <span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-1 rounded-lg font-semibold uppercase"><?= $kr->sifat; ?></span>
                    </div>
                    <div class="flex items-center gap-4">
                        <input type="range" name="bobot_<?= $kr->kode_kriteria; ?>" min="1" max="5" value="3"
                            class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-brand-600"
                            oninput="updateSlider('<?= $kr->kode_kriteria; ?>', this.value)">
                        <div id="badge_<?= $kr->kode_kriteria; ?>" class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-brand-500/25 transition-transform group-hover:scale-110">3</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <button type="submit" class="mt-8 w-full gradient-bg text-white py-4 rounded-2xl font-bold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 flex items-center justify-center gap-2">
                <span class="material-symbols-rounded text-[20px]">calculate</span> Hitung Rekomendasi
            </button>
        </div>

        <?= form_close(); ?>

        <!-- Info SAW -->
        <div class="bg-brand-50 rounded-3xl p-8 border border-brand-100 animate-fade-in-up stagger-2">
            <h2 class="font-bold text-lg mb-4 flex items-center gap-2 text-brand-800">
                <span class="material-symbols-rounded text-brand-500">info</span> Cara Kerja Metode SAW
            </h2>
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl p-4 border border-brand-100">
                    <div class="w-8 h-8 bg-brand-100 rounded-lg flex items-center justify-center text-brand-700 font-bold text-sm mb-3">1</div>
                    <h3 class="font-bold text-sm text-gray-800">Normalisasi</h3>
                    <p class="text-gray-500 text-xs mt-1">Nilai kriteria dinormalisasi berdasarkan sifat Benefit/Cost</p>
                </div>
                <div class="bg-white rounded-2xl p-4 border border-brand-100">
                    <div class="w-8 h-8 bg-brand-100 rounded-lg flex items-center justify-center text-brand-700 font-bold text-sm mb-3">2</div>
                    <h3 class="font-bold text-sm text-gray-800">Perangkingan</h3>
                    <p class="text-gray-500 text-xs mt-1">Nilai normalisasi dikalikan dengan bobot preferensi Anda</p>
                </div>
                <div class="bg-white rounded-2xl p-4 border border-brand-100">
                    <div class="w-8 h-8 bg-brand-100 rounded-lg flex items-center justify-center text-brand-700 font-bold text-sm mb-3">3</div>
                    <h3 class="font-bold text-sm text-gray-800">Hasil</h3>
                    <p class="text-gray-500 text-xs mt-1">Paket diurutkan dari nilai tertinggi ke terendah</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function updateSlider(kode, val) {
    document.getElementById('badge_' + kode).textContent = val;
}
</script>
