<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10 animate-fade-in-up relative">
            <div class="absolute inset-0 dot-pattern pointer-events-none" style="opacity: 0.3;" aria-hidden="true"></div>
            <div class="relative">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-3"
                    style="background: linear-gradient(135deg, #0ea5e9, #0369a1); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
                    Temukan paket wisata terbaik untukmu
                </h1>
                <p class="text-gray-600 text-base sm:text-lg">
                    Pilih seberapa penting setiap hal bagimu.<br class="sm:hidden">
                    Tidak ada jawaban salah.
                </p>
            </div>
        </div>

        <!-- Form Preferensi -->
        <form action="<?= base_url('rekomendasi/hasil'); ?>" method="post" id="form-preferensi" class="animate-fade-in-up stagger-1">

        <!-- Kriteria Cards -->
        <div class="space-y-4 mb-6">
            <?php foreach ($kriteria as $kr): ?>
                <?php
                    $pertanyaan = '';
                    $keterangan = '';
                    $ikon = '';
                    $ikon_header = '';
                    
                    if ($kr->kode_kriteria == 'C1') {
                        $pertanyaan = 'Seberapa penting harga buat kamu?';
                        $keterangan = 'Semakin murah semakin baik';
                        $ikon = 'arrow_downward';
                        $ikon_header = 'payments';
                    } elseif ($kr->kode_kriteria == 'C2') {
                        $pertanyaan = 'Seberapa penting durasi perjalanan buat kamu?';
                        $keterangan = 'Semakin banyak semakin baik';
                        $ikon = 'arrow_upward';
                        $ikon_header = 'calendar_month';
                    } elseif ($kr->kode_kriteria == 'C3') {
                        $pertanyaan = 'Seberapa penting jumlah destinasi buat kamu?';
                        $keterangan = 'Semakin banyak semakin baik';
                        $ikon = 'arrow_upward';
                        $ikon_header = 'location_on';
                    } elseif ($kr->kode_kriteria == 'C4') {
                        $pertanyaan = 'Seberapa penting jumlah aktivitas buat kamu?';
                        $keterangan = 'Semakin banyak semakin baik';
                        $ikon = 'arrow_upward';
                        $ikon_header = 'hiking';
                    }
                ?>
                
                <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-5 hover:shadow-lg hover:border-sky-200 transition-all duration-300">
                    <!-- Nama Kriteria dengan Ikon -->
                    <div class="flex items-start gap-3 mb-3">
                        <div class="kriteria-icon-circle mt-0.5">
                            <span class="material-symbols-rounded text-[#0ea5e9] text-[28px]"><?= $ikon_header; ?></span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 text-base sm:text-lg mb-1"><?= $kr->nama_kriteria; ?></h3>
                            <p class="text-gray-600 text-sm"><?= $pertanyaan; ?></p>
                        </div>
                    </div>
                    
                    <!-- 5 Tombol Pilihan -->
                    <div class="grid grid-cols-5 gap-2 sm:gap-3">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <button type="button" 
                                    class="btn-nilai rounded-lg p-2 sm:p-3 text-center transition-all duration-200"
                                    data-nilai="<?= $i; ?>"
                                    onclick="pilihNilai('<?= strtolower($kr->kode_kriteria); ?>', <?= $i; ?>, this)">
                                <span class="angka font-extrabold text-lg sm:text-xl text-gray-800 mb-1 block"><?= $i; ?></span>
                                <span class="label text-[10px] sm:text-xs text-gray-600 font-medium leading-tight block">
                                    <?php if($i == 1): ?>Tidak penting<?php elseif($i == 2): ?>Kurang penting<?php elseif($i == 3): ?>Cukup penting<?php elseif($i == 4): ?>Penting<?php else: ?>Sangat penting<?php endif; ?>
                                </span>
                            </button>
                        <?php endfor; ?>
                    </div>

                    <!-- Progress bar per card -->
                    <div class="progress-preferensi" id="progress-<?= strtolower($kr->kode_kriteria); ?>">
                        <div class="progress-preferensi-fill" style="width: 0%"></div>
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

        <!-- Counter progress -->
        <div id="progress-counter" class="text-center text-[13px] mb-3" style="color: #0369a1;">
            0 dari 4 kriteria sudah dipilih
        </div>

        <!-- Tombol Submit -->
<button type="submit" id="btn-submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white py-4 rounded-full font-bold text-base sm:text-lg hover:shadow-xl hover:shadow-sky-500/40 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 opacity-85">
            <span class="material-symbols-rounded text-[22px]">search</span>
            Cari rekomendasi terbaik
        </button>

        </form>
    </div>
</main>

<script>
// Update value hidden saat tombol 1-5 diklik
function pilihNilai(kriteria, nilai, elBtn) {
  var key = kriteria.toUpperCase();

  // Hapus aktif dari semua tombol dalam grup yang sama
  var grup = elBtn.closest('.bg-white');
  grup.querySelectorAll('.btn-nilai').forEach(function(btn) {
    btn.classList.remove('aktif');
    var a = btn.querySelector('.angka');
    var l = btn.querySelector('.label');
    a.classList.remove('text-sky-600');
    a.classList.add('text-gray-800');
    l.classList.remove('text-sky-700');
    l.classList.add('text-gray-600');
  });
  
  // Set tombol yang diklik jadi aktif
  elBtn.classList.add('aktif');
  var angkaEl = elBtn.querySelector('.angka');
  var labelEl = elBtn.querySelector('.label');
  angkaEl.classList.remove('text-gray-800');
  angkaEl.classList.add('text-sky-600');
  labelEl.classList.remove('text-gray-600');
  labelEl.classList.add('text-sky-700');
  
  // Update input hidden
  document.getElementById('val-' + kriteria).value = nilai;

  // Update progress bar per card
  var barContainer = document.getElementById('progress-' + kriteria);
  var barFill = barContainer.querySelector('.progress-preferensi-fill');
  barContainer.classList.add('progress-preferensi-terisi');
  var pct = nilai * 20;
  barFill.style.width = pct + '%';

  // Update counter
  updateProgressCounter();
  updateSubmitButton();
}

function updateProgressCounter() {
  var vals = [
    document.getElementById('val-c1').value,
    document.getElementById('val-c2').value,
    document.getElementById('val-c3').value,
    document.getElementById('val-c4').value
  ];
  var count = vals.filter(function(v){ return v && v !== ''; }).length;
  var el = document.getElementById('progress-counter');
  if (count === 4) {
    el.innerHTML = '✓ Semua kriteria sudah dipilih!';
    el.style.color = '#16a34a';
  } else {
    el.innerHTML = count + ' dari 4 kriteria sudah dipilih';
    el.style.color = '#0369a1';
  }
  return count;
}

function updateSubmitButton() {
  var count = updateProgressCounter();
  var btn = document.getElementById('btn-submit');
  if (count === 4) {
    btn.classList.add('pulse-blue');
    btn.style.opacity = '1';
  } else {
    btn.classList.remove('pulse-blue');
    btn.style.opacity = '0.85';
  }
}

// Validasi sebelum submit
document.getElementById('form-preferensi').addEventListener('submit', function(e) {
  var c1 = document.getElementById('val-c1').value;
  var c2 = document.getElementById('val-c2').value;
  var c3 = document.getElementById('val-c3').value;
  var c4 = document.getElementById('val-c4').value;
  
  if (!c1 || !c2 || !c3 || !c4) {
    e.preventDefault();
    var pesan = document.getElementById('pesan-error');
    if (pesan) {
      pesan.style.display = 'block';
      pesan.textContent = 'Pilih nilai untuk semua kriteria dulu ya';
      pesan.scrollIntoView({ behavior: 'smooth' });
    }
    return false;
  }
});
</script>
