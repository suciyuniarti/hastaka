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

        <!-- Penjelasan Skala -->
        <div class="bg-gradient-to-br from-sky-50 to-blue-50 rounded-3xl p-6 mb-8 border border-sky-200">
            <h2 class="font-bold text-lg text-gray-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-rounded text-sky-600">help</span> Cara Menentukan Bobot (Skala 1-5)
            </h2>
            <p class="text-gray-600 text-sm mb-4">Berikan nilai <strong>1-5</strong> untuk setiap kriteria berdasarkan seberapa penting kriteria tersebut bagi Anda. Semakin tinggi nilai, semakin penting kriteria tersebut dalam menentukan rekomendasi.</p>
            <div class="grid sm:grid-cols-5 gap-3">
                <div class="bg-white rounded-xl p-3 text-center border-2 border-gray-100">
                    <div class="text-2xl font-extrabold text-gray-400 mb-1">1</div>
                    <div class="text-xs text-gray-600 font-semibold">Tidak Penting</div>
                </div>
                <div class="bg-white rounded-xl p-3 text-center border-2 border-gray-100">
                    <div class="text-2xl font-extrabold text-gray-500 mb-1">2</div>
                    <div class="text-xs text-gray-600 font-semibold">Kurang Penting</div>
                </div>
                <div class="bg-white rounded-xl p-3 text-center border-2 border-brand-200">
                    <div class="text-2xl font-extrabold text-brand-600 mb-1">3</div>
                    <div class="text-xs text-gray-600 font-semibold">Cukup Penting</div>
                </div>
                <div class="bg-white rounded-xl p-3 text-center border-2 border-gray-100">
                    <div class="text-2xl font-extrabold text-sky-600 mb-1">4</div>
                    <div class="text-xs text-gray-600 font-semibold">Penting</div>
                </div>
                <div class="bg-white rounded-xl p-3 text-center border-2 border-gray-100">
                    <div class="text-2xl font-extrabold text-sky-700 mb-1">5</div>
                    <div class="text-xs text-gray-600 font-semibold">Sangat Penting</div>
                </div>
            </div>
            <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-3 flex items-start gap-2">
                <span class="material-symbols-rounded text-amber-500 text-[18px] mt-0.5">lightbulb</span>
                <p class="text-xs text-amber-800"><strong>Contoh:</strong> Jika Anda sangat memprioritaskan harga murah, berikan nilai <strong>5</strong> pada kriteria Harga. Jika lokasi tidak terlalu penting, berikan nilai <strong>1</strong> atau <strong>2</strong>.</p>
            </div>
        </div>

        <!-- Bobot Section -->
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 mb-8">
            <h2 class="font-bold text-lg text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-rounded text-brand-500">tune</span> Atur Bobot Preferensi Anda
            </h2>

            <div class="space-y-6">
                <?php foreach ($kriteria as $kr): ?>
                <div class="group">
                    <div class="flex justify-between mb-2">
                        <label class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                            <span class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center text-white text-xs font-bold"><?= $kr->kode_kriteria; ?></span>
                            <?= $kr->nama_kriteria; ?>
                            <span class="text-xs text-gray-400 font-normal">(<?= $kr->sifat == 'benefit' ? 'Semakin tinggi semakin baik' : 'Semakin rendah semakin baik'; ?>)</span>
                        </label>
                    </div>
                    <div class="flex items-center gap-4">
                        <input type="range" name="bobot_<?= $kr->kode_kriteria; ?>" min="1" max="5" value="3"
                            class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-brand-600"
                            oninput="updateSlider('<?= $kr->kode_kriteria; ?>', this.value)">
                        <div id="badge_<?= $kr->kode_kriteria; ?>" class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-brand-500/25 transition-transform group-hover:scale-110">3</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                <span class="material-symbols-rounded text-blue-600 text-[20px] mt-0.5">tips_and_updates</span>
                <div class="text-xs text-blue-800">
                    <strong>Tips:</strong> Geser slider ke kanan untuk bobot yang lebih penting, ke kiri untuk bobot yang kurang penting. Sistem akan memprioritaskan paket yang sesuai dengan preferensi Anda.
                </div>
            </div>
            <button type="submit" class="mt-6 w-full gradient-bg text-white py-4 rounded-2xl font-bold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 flex items-center justify-center gap-2">
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
