<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">

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
        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 p-6 mb-8 border-2 border-slate-200/80">
            <h2 class="font-bold text-lg text-gray-900 mb-4 flex items-center gap-2">
                <span class="material-symbols-rounded text-sky-600">help</span> Cara Menentukan Bobot (Skala 1-5)
            </h2>
            <p class="text-gray-600 text-sm mb-4">Berikan nilai <strong>1-5</strong> untuk setiap kriteria berdasarkan seberapa penting kriteria tersebut bagi Anda. Semakin tinggi nilai, semakin penting kriteria tersebut dalam menentukan rekomendasi.</p>
            <div class="grid grid-cols-5 gap-3">
                <div class="group bg-slate-50 rounded-xl p-3 text-center border-2 border-slate-200 hover:border-brand-300 hover:shadow-md transition-all duration-300">
                    <div class="text-2xl font-extrabold text-gray-400 mb-1 group-hover:scale-110 transition-transform">1</div>
                    <div class="text-[10px] text-gray-600 font-bold">Tidak Penting</div>
                </div>
                <div class="group bg-slate-50 rounded-xl p-3 text-center border-2 border-slate-200 hover:border-brand-300 hover:shadow-md transition-all duration-300">
                    <div class="text-2xl font-extrabold text-gray-500 mb-1 group-hover:scale-110 transition-transform">2</div>
                    <div class="text-[10px] text-gray-600 font-bold">Kurang Penting</div>
                </div>
                <div class="group bg-brand-50 rounded-xl p-3 text-center border-2 border-brand-200 hover:border-brand-400 hover:shadow-md hover:shadow-brand-500/20 transition-all duration-300">
                    <div class="text-2xl font-extrabold text-brand-600 mb-1 group-hover:scale-110 transition-transform">3</div>
                    <div class="text-[10px] text-gray-600 font-bold">Cukup Penting</div>
                </div>
                <div class="group bg-slate-50 rounded-xl p-3 text-center border-2 border-slate-200 hover:border-brand-300 hover:shadow-md transition-all duration-300">
                    <div class="text-2xl font-extrabold text-sky-600 mb-1 group-hover:scale-110 transition-transform">4</div>
                    <div class="text-[10px] text-gray-600 font-bold">Penting</div>
                </div>
                <div class="group bg-slate-50 rounded-xl p-3 text-center border-2 border-slate-200 hover:border-brand-300 hover:shadow-md transition-all duration-300">
                    <div class="text-2xl font-extrabold text-sky-700 mb-1 group-hover:scale-110 transition-transform">5</div>
                    <div class="text-[10px] text-gray-600 font-bold">Sangat Penting</div>
                </div>
            </div>
            <div class="mt-4 bg-gradient-to-br from-amber-50 to-orange-50 border-2 border-amber-200 rounded-xl p-4 flex items-start gap-3">
                <span class="material-symbols-rounded text-amber-500 text-[18px] mt-0.5">lightbulb</span>
                <p class="text-xs text-amber-800"><strong>Contoh:</strong> Jika Anda sangat memprioritaskan harga murah, berikan nilai <strong>5</strong> pada kriteria Harga. Jika lokasi tidak terlalu penting, berikan nilai <strong>1</strong> atau <strong>2</strong>.</p>
            </div>
        </div>

        <!-- Bobot Section -->
        <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-8 mb-8 border-2 border-slate-200/80">
            <h2 class="font-bold text-lg text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-rounded text-brand-500">tune</span> Atur Bobot Preferensi Anda
            </h2>

            <div class="space-y-6">
                <?php foreach ($kriteria as $kr): ?>
                <div class="group bg-slate-50 rounded-2xl p-5 border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 transition-all duration-300">
                    <div class="flex justify-between mb-3">
                        <label class="font-bold text-gray-800 text-sm flex items-center gap-2">
                            <span class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-lg shadow-brand-500/25"><?= $kr->kode_kriteria; ?></span>
                            <span><?= $kr->nama_kriteria; ?></span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mb-3"><?= $kr->sifat == 'benefit' ? '✓ Semakin tinggi semakin baik' : '✓ Semakin rendah semakin baik'; ?></p>
                    <div class="flex items-center gap-4">
                        <input type="range" name="bobot_<?= $kr->kode_kriteria; ?>" min="1" max="5" value="3"
                            class="flex-1 h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-brand-600 hover:accent-brand-500"
                            oninput="updateSlider('<?= $kr->kode_kriteria; ?>', this.value)">
                        <div id="badge_<?= $kr->kode_kriteria; ?>" class="w-14 h-14 gradient-bg rounded-xl flex items-center justify-center text-white font-extrabold text-xl shadow-xl shadow-brand-500/30 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">3</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-6 bg-gradient-to-br from-blue-50 to-sky-50 border-2 border-blue-200 rounded-xl p-4 flex items-start gap-3">
                <span class="material-symbols-rounded text-blue-600 text-[20px] mt-0.5">tips_and_updates</span>
                <div class="text-xs text-blue-800">
                    <strong>Tips:</strong> Geser slider ke kanan untuk bobot yang lebih penting, ke kiri untuk bobot yang kurang penting. Sistem akan memprioritaskan paket yang sesuai dengan preferensi Anda.
                </div>
            </div>
            <button type="submit" class="group mt-6 w-full gradient-bg text-white py-4 rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-brand-500/40 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                <span class="material-symbols-rounded text-[20px]">calculate</span> Hitung Rekomendasi
            </button>
        </div>

        <?= form_close(); ?>

        <!-- Info SAW -->
        <div class="animate-fade-in-up stagger-2">
        <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 p-8 border-2 border-slate-200/80">
            <h2 class="font-bold text-lg mb-4 flex items-center gap-2 text-brand-800">
                <span class="material-symbols-rounded text-brand-500">info</span> Cara Kerja Metode SAW
            </h2>
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="group bg-slate-50 rounded-2xl p-5 border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-xl flex items-center justify-center text-white font-bold text-sm mb-3 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-brand-500/25">1</div>
                    <h3 class="font-bold text-sm text-gray-800">Normalisasi</h3>
                    <p class="text-gray-500 text-xs mt-1">Nilai kriteria dinormalisasi berdasarkan sifat Benefit/Cost</p>
                </div>
                <div class="group bg-slate-50 rounded-2xl p-5 border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-xl flex items-center justify-center text-white font-bold text-sm mb-3 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-brand-500/25">2</div>
                    <h3 class="font-bold text-sm text-gray-800">Perangkingan</h3>
                    <p class="text-gray-500 text-xs mt-1">Nilai normalisasi dikalikan dengan bobot preferensi Anda</p>
                </div>
                <div class="group bg-slate-50 rounded-2xl p-5 border-2 border-slate-200/80 hover:border-brand-300 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-gradient-to-br from-brand-500 to-brand-600 rounded-xl flex items-center justify-center text-white font-bold text-sm mb-3 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-brand-500/25">3</div>
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
