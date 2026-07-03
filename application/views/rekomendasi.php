<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">

    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10 animate-fade-in-up">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">
                Temukan paket wisata terbaik untukmu
            </h1>
            <p class="text-gray-600 text-base sm:text-lg">
                Pilih seberapa penting setiap hal bagimu.<br class="sm:hidden">
                Tidak ada jawaban salah.
            </p>
        </div>

        <!-- Penjelasan Cara Kerja -->
        <div class="bg-[#EFF8FF] border border-[#bae6fd] rounded-xl p-5 sm:p-6 mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
            <h3 class="font-semibold text-base text-gray-900 mb-4 text-center">Bagaimana cara kerjanya?</h3>
            <div class="flex flex-col lg:flex-row items-center justify-center gap-4 lg:gap-6">
                <!-- Langkah 1 -->
                <div class="flex-1 w-full">
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[11px] font-bold text-sky-500 mb-1">1</span>
                        <span class="material-symbols-rounded text-sky-500 text-[24px] mb-2">checklist</span>
                        <h4 class="text-[13px] font-medium text-sky-700 mb-1">Pilih yang penting buatmu</h4>
                        <p class="text-[12px] text-sky-700 leading-relaxed">Tentukan seberapa penting harga, durasi, destinasi, dan aktivitas buat perjalananmu.</p>
                    </div>
                </div>
                
                <!-- Panah 1→2 (hanya desktop) -->
                <div class="hidden lg:block flex-shrink-0">
                    <span class="material-symbols-rounded text-sky-300 text-[24px]">arrow_forward</span>
                </div>
                
                <!-- Langkah 2 -->
                <div class="flex-1 w-full">
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[11px] font-bold text-sky-500 mb-1">2</span>
                        <span class="material-symbols-rounded text-sky-500 text-[24px] mb-2">auto_awesome</span>
                        <h4 class="text-[13px] font-medium text-sky-700 mb-1">Sistem menghitung otomatis</h4>
                        <p class="text-[12px] text-sky-700 leading-relaxed">Setiap paket wisata dinilai dan diurutkan berdasarkan preferensi yang kamu pilih.</p>
                    </div>
                </div>
                
                <!-- Panah 2→3 (hanya desktop) -->
                <div class="hidden lg:block flex-shrink-0">
                    <span class="material-symbols-rounded text-sky-300 text-[24px]">arrow_forward</span>
                </div>
                
                <!-- Langkah 3 -->
                <div class="flex-1 w-full">
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[11px] font-bold text-sky-500 mb-1">3</span>
                        <span class="material-symbols-rounded text-sky-500 text-[24px] mb-2">emoji_events</span>
                        <h4 class="text-[13px] font-medium text-sky-700 mb-1">Dapat rekomendasi terbaik</h4>
                        <p class="text-[12px] text-sky-700 leading-relaxed">Paket yang paling cocok dengan keinginanmu muncul di urutan pertama.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Preferensi -->
        <form action="<?= base_url('rekomendasi/hasil'); ?>" method="post" id="form-preferensi" class="animate-fade-in-up stagger-1">
        
        <!-- Kriteria Cards -->
        <div class="space-y-4 mb-8">
            <?php foreach ($kriteria as $kr): ?>
                <?php
                    $pertanyaan = '';
                    $keterangan = '';
                    $ikon = '';
                    
                    if ($kr->kode_kriteria == 'C1') {
                        $pertanyaan = 'Seberapa penting harga buat kamu?';
                        $keterangan = 'Semakin murah semakin baik';
                        $ikon = 'arrow_downward';
                    } elseif ($kr->kode_kriteria == 'C2') {
                        $pertanyaan = 'Seberapa penting durasi perjalanan buat kamu?';
                        $keterangan = 'Semakin banyak semakin baik';
                        $ikon = 'arrow_upward';
                    } elseif ($kr->kode_kriteria == 'C3') {
                        $pertanyaan = 'Seberapa penting jumlah destinasi buat kamu?';
                        $keterangan = 'Semakin banyak semakin baik';
                        $ikon = 'arrow_upward';
                    } elseif ($kr->kode_kriteria == 'C4') {
                        $pertanyaan = 'Seberapa penting jumlah aktivitas buat kamu?';
                        $keterangan = 'Semakin banyak semakin baik';
                        $ikon = 'arrow_upward';
                    }
                ?>
                
                <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-5 hover:shadow-lg hover:border-sky-200 transition-all duration-300">
                    <!-- Nama Kriteria -->
                    <div class="mb-3">
                        <h3 class="font-semibold text-gray-900 text-base sm:text-lg mb-1"><?= $kr->nama_kriteria; ?></h3>
                        <p class="text-gray-600 text-sm"><?= $pertanyaan; ?></p>
                    </div>
                    
                    <!-- Keterangan Jenis Kriteria -->
                    <div class="flex items-center gap-1.5 mb-4">
                        <span class="material-symbols-rounded text-gray-600 text-[18px]"><?= $ikon; ?></span>
                        <span class="text-xs text-gray-600"><?= $keterangan; ?></span>
                    </div>
                    
                    <!-- 5 Tombol Pilihan -->
                    <div class="grid grid-cols-5 gap-2 sm:gap-3">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <button type="button" 
                                    class="btn-nilai bg-slate-50 rounded-lg p-2 sm:p-3 text-center border-2 border-slate-200 transition-all duration-200 hover:border-sky-300 hover:shadow-sm hover:scale-105"
                                    onclick="pilihNilai('<?= strtolower($kr->kode_kriteria); ?>', <?= $i; ?>, this)">
                                <span class="angka font-extrabold text-lg sm:text-xl text-gray-800 mb-1 block"><?= $i; ?></span>
                                <span class="label text-[10px] sm:text-xs text-gray-600 font-medium leading-tight block">
                                    <?php if($i == 1): ?>Tidak penting<?php elseif($i == 2): ?>Kurang penting<?php elseif($i == 3): ?>Cukup penting<?php elseif($i == 4): ?>Penting<?php else: ?>Sangat penting<?php endif; ?>
                                </span>
                            </button>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Input Hidden untuk setiap kriteria -->
        <input type="hidden" name="bobot_C1" id="val-c1" value="">
        <input type="hidden" name="bobot_C2" id="val-c2" value="">
        <input type="hidden" name="bobot_C3" id="val-c3" value="">
        <input type="hidden" name="bobot_C4" id="val-c4" value="">

        <!-- Pesan Error -->
        <div id="pesan-error" style="display:none; color:#dc2626; font-size:13px; margin-bottom:8px; padding:8px 12px; background:#FEF2F2; border-radius:8px; border:0.5px solid #fca5a5"></div>

        <!-- Tombol Submit -->
        <button type="submit" id="btn-submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white py-4 rounded-full font-bold text-base sm:text-lg transition-all duration-300 hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2">
            <span class="material-symbols-rounded text-[22px]">search</span>
            Cari rekomendasi terbaik
        </button>

        </form>

        <!-- Info SAW -->
        <div class="mt-12 bg-white rounded-2xl shadow-lg shadow-slate-200/50 p-6 sm:p-8 border border-gray-200">
            <h2 class="font-bold text-lg mb-4 flex items-center gap-2 text-gray-900">
                <span class="material-symbols-rounded text-sky-600">info</span> 
                Cara Kerja Metode SAW
            </h2>
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="bg-sky-50 rounded-xl p-5 border border-sky-100 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white font-bold text-sm mb-3 shadow-md">1</div>
                    <h3 class="font-bold text-sm text-gray-900">Normalisasi</h3>
                    <p class="text-gray-600 text-xs mt-1">Nilai kriteria dinormalisasi berdasarkan sifat Benefit/Cost</p>
                </div>
                <div class="bg-sky-50 rounded-xl p-5 border border-sky-100 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white font-bold text-sm mb-3 shadow-md">2</div>
                    <h3 class="font-bold text-sm text-gray-900">Perangkingan</h3>
                    <p class="text-gray-600 text-xs mt-1">Nilai normalisasi dikalikan dengan bobot preferensi Anda</p>
                </div>
                <div class="bg-sky-50 rounded-xl p-5 border border-sky-100 hover:shadow-md transition-all duration-300">
                    <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white font-bold text-sm mb-3 shadow-md">3</div>
                    <h3 class="font-bold text-sm text-gray-900">Hasil</h3>
                    <p class="text-gray-600 text-xs mt-1">Paket diurutkan dari nilai tertinggi ke terendah</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Update value hidden saat tombol 1-5 diklik
function pilihNilai(kriteria, nilai, elBtn) {
  // Hapus aktif dari semua tombol dalam grup yang sama
  var grup = elBtn.closest('.bg-white');
  grup.querySelectorAll('.btn-nilai').forEach(function(btn) {
    btn.classList.remove('aktif');
    btn.classList.remove('border-sky-500', 'bg-sky-50', 'shadow-md');
    btn.classList.add('border-slate-200', 'bg-slate-50');
    btn.querySelector('.angka').classList.remove('text-sky-600');
    btn.querySelector('.angka').classList.add('text-gray-800');
    btn.querySelector('.label').classList.remove('text-sky-700');
    btn.querySelector('.label').classList.add('text-gray-600');
  });
  
  // Set tombol yang diklik jadi aktif
  elBtn.classList.add('aktif');
  elBtn.classList.remove('border-slate-200', 'bg-slate-50');
  elBtn.classList.add('border-sky-500', 'bg-sky-50', 'shadow-md');
  elBtn.querySelector('.angka').classList.remove('text-gray-800');
  elBtn.querySelector('.angka').classList.add('text-sky-600');
  elBtn.querySelector('.label').classList.remove('text-gray-600');
  elBtn.querySelector('.label').classList.add('text-sky-700');
  
  // Update input hidden
  document.getElementById('val-' + kriteria).value = nilai;
}

// Validasi sebelum submit
document.getElementById('form-preferensi').addEventListener('submit', function(e) {
  var c1 = document.getElementById('val-c1').value;
  var c2 = document.getElementById('val-c2').value;
  var c3 = document.getElementById('val-c3').value;
  var c4 = document.getElementById('val-c4').value;
  
  if (!c1 || !c2 || !c3 || !c4) {
    e.preventDefault();
    // Tampilkan pesan error
    var pesan = document.getElementById('pesan-error');
    if (pesan) {
      pesan.style.display = 'block';
      pesan.textContent = 'Pilih nilai untuk semua kriteria dulu ya';
      // Scroll ke pesan error
      pesan.scrollIntoView({ behavior: 'smooth' });
    }
    return false;
  }
});
</script>