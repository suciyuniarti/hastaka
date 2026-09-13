<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">tune</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Kriteria SAW</h1>
        <p>Atur sifat kriteria untuk perhitungan SAW</p>
    </div>
</div>

<div class="admin-card mb-6 flex items-start gap-3">
    <span class="material-symbols-rounded text-sky-500 mt-0.5">info</span>
    <div class="text-sm text-sky-800">
        <p class="font-bold mb-2">Panduan Kelola Kriteria SAW</p>
        <p style="margin-bottom: 12px;">Di halaman ini admin dapat mengatur sifat setiap kriteria yang digunakan dalam perhitungan rekomendasi paket wisata.</p>
        <p style="margin-bottom: 8px;"><strong>Cost</strong> → digunakan untuk kriteria yang semakin kecil nilainya semakin baik (contoh: harga — paket lebih murah lebih direkomendasikan)</p>
        <p style="margin-bottom: 8px;"><strong>Benefit</strong> → digunakan untuk kriteria yang semakin besar nilainya semakin baik (contoh: durasi, destinasi, aktivitas — semakin banyak semakin direkomendasikan)</p>
    </div>
</div>

<?= form_open('admin/kriteria', ['class' => 'admin-table-wrap', 'id' => 'form-kriteria']); ?>
<div class="overflow-x-auto">
    <table class="admin-table text-sm">
        <thead>
            <tr class="table-header">
                <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-20">Kode</th>
                <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Nama Kriteria</th>
                <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Sumber Data</th>
                <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-32 text-center">Sifat</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kriteria)): ?>
            <?php foreach ($kriteria as $kr): ?>
            <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap">
                <td class="py-4 px-5">
                    <span class="w-10 h-10 bg-sky-50 border border-sky-100 text-sky-700 rounded-xl flex items-center justify-center text-sm font-bold"><?= $kr->kode_kriteria; ?></span>
                </td>
                <td class="py-4 px-5 font-bold text-slate-800"><?= $kr->nama_kriteria; ?></td>
                <td class="py-4 px-5">
                    <?php
                    $sumber = [
                        'C1' => ['Harga Paket', 'payments'],
                        'C2' => ['Durasi (Hari)', 'schedule'],
                        'C3' => ['Jml Destinasi', 'place'],
                        'C4' => ['Jml Aktivitas', 'hiking'],
                    ];
                    $src = $sumber[$kr->kode_kriteria] ?? ['-', 'help'];
                    ?>
                    <span class="flex items-center gap-1.5 text-xs text-slate-500">
                        <span class="material-symbols-rounded text-[14px] text-slate-400"><?= $src[1]; ?></span>
                        <?= $src[0]; ?>
                    </span>
                </td>
                <td class="py-4 px-5 text-center">
                    <input type="hidden" name="bobot[<?= $kr->id_kriteria; ?>]" value="<?= $kr->bobot; ?>">
                    <select name="sifat[<?= $kr->id_kriteria; ?>]" class="form-input w-28 text-xs py-1 sifat-select" data-kode="<?= $kr->kode_kriteria; ?>" data-nama="<?= $kr->nama_kriteria; ?>" required>
                        <option value="benefit" <?= $kr->sifat == 'benefit' ? 'selected' : ''; ?>>Benefit</option>
                        <option value="cost" <?= $kr->sifat == 'cost' ? 'selected' : ''; ?>>Cost</option>
                    </select>
                    <div class="sifat-info text-xs mt-1" style="font-size: 11px;"></div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr><td colspan="5" class="py-12 text-center">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <span class="material-symbols-rounded">tune</span>
                    </div>
                    <h3>Belum ada kriteria.</h3>
                </div>
            </td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="admin-card mt-4" style="background: #EFF8FF; border: 1px solid #bae6fd; border-radius: 8px; padding: 10px 14px;">
    <p style="font-size: 13px; color: #0369a1; margin: 0;">
        <span class="material-symbols-rounded text-sm align-middle mr-1">info</span>
        Bobot setiap kriteria ditentukan otomatis berdasarkan preferensi yang diinput pelanggan saat mencari rekomendasi. Admin cukup mengatur sifat kriteria (cost/benefit).
    </p>
</div>

<div class="form-actions px-5 py-4 border-t border-slate-100 flex justify-end items-center">
    <button type="button" class="btn btn-primary" onclick="konfirmasiSimpanKriteria()">
        <span class="material-symbols-rounded text-lg">save</span> Simpan Perubahan Sifat
    </button>
</div>
<?= form_close(); ?>

<!-- Modal Konfirmasi Simpan Kriteria -->
<div id="modalKonfirmasiKriteria" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div class="modal-box" style="background: white; border-radius: 12px; max-width: 500px; width: 90%; max-height: 90vh; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <!-- Header -->
        <div style="padding: 24px 24px 0; text-align: center; flex-shrink: 0;">
            <div style="width: 40px; height: 40px; background: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                <span class="material-symbols-rounded" style="color: #f59e0b; font-size: 24px;">warning</span>
            </div>
            <h3 style="font-weight: 600; font-size: 18px; color: #1f2937; margin: 0;">Simpan Perubahan Sifat Kriteria?</h3>
        </div>
        
        <!-- Body -->
        <div style="padding: 16px 24px; flex-grow: 1; overflow-y: auto;">
            <p style="font-size: 13px; color: #6b7280; margin: 0 0 16px; text-align: center;">Perubahan yang akan disimpan:</p>
            
            <!-- Ringkasan Kriteria -->
            <div id="ringkasan-kriteria" style="background: #f9fafb; border-radius: 8px; padding: 12px 16px; ">
                <!-- Ringkasan akan diisi oleh JavaScript -->
            </div>
            
            <!-- Peringatan -->
            <div style="background: #FEF3C7; border: 0.5px solid #FCD34D; border-radius: 8px; padding: 10px 14px; margin-top: 12px; display: flex; gap: 8px; align-items: start;">
                <span class="material-symbols-rounded" style="color: #f59e0b; font-size: 18px; flex-shrink: 0;">warning</span>
                <p style="font-size: 12px; color: #92400E; margin: 0; line-height: 1.5;">
                    Perubahan ini akan langsung mempengaruhi urutan hasil rekomendasi paket wisata untuk semua pelanggan. Pastikan sifat kriteria sudah sesuai sebelum menyimpan.
                </p>
            </div>
        </div>
        
        <!-- Footer -->
        <div style="padding: 12px 24px 24px; display: flex; gap: 10px; justify-content: flex-end; flex-shrink: 0; background: #fff; border-top: 0.5px solid #e5e7eb;">   
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="button" class="btn btn-primary" onclick="simpanKriteria()" style="padding: 8px 16px; background: #0ea5e9; color: white; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;">
                Ya, Simpan
            </button>
        </div>
    </div>
</div>

<script>
(function() {
  'use strict';
  
  window.konfirmasiSimpanKriteria = function() {
    const dropdowns = document.querySelectorAll('select[name^="sifat"]');
    
    if (dropdowns.length === 0) {
      console.error('Dropdown sifat tidak ditemukan');
      return;
    }
    
    let ringkasan = '';
    
    dropdowns.forEach(function(select) {
      const kode = select.dataset.kode || '?';
      const nama = select.dataset.nama || '?';
      const sifat = select.value;
      
      const sifatLabel = sifat === 'cost'
        ? '<span style="background:#FEF2F2;color:#dc2626;padding:2px 8px;border-radius:99px;font-size:11px;font-weight:500">COST</span> <span style="font-size:11px;color:#dc2626">↓ semakin kecil semakin baik</span>'
        : '<span style="background:#f0fdf4;color:#16a34a;padding:2px 8px;border-radius:99px;font-size:11px;font-weight:500">BENEFIT</span> <span style="font-size:11px;color:#16a34a">↑ semakin besar semakin baik</span>';
      
      ringkasan += `
        <div style="padding:8px 0;border-bottom:0.5px solid #e5e7eb">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px">
            <span style="background:#EFF8FF;color:#0369a1;padding:2px 8px;border-radius:6px;font-size:11px;font-weight:500">${kode}</span>
            <span style="font-size:13px;font-weight:500">${nama}</span>
          </div>
          <div style="padding-left:4px">
            ${sifatLabel}
          </div>
        </div>
      `;
    });
    
    const elRingkasan = document.getElementById('ringkasan-kriteria');
    if (elRingkasan) {
      elRingkasan.innerHTML = ringkasan;
    }
    
    const modal = document.getElementById('modalKonfirmasiKriteria');
    if (modal) {
      modal.style.display = 'flex';
      modal.classList.add('active');
    } else {
      console.error('Modal tidak ditemukan — submit langsung');
      document.getElementById('form-kriteria').submit();
    }
  };

  window.batalSimpanKriteria = function() {
    const modal = document.getElementById('modalKonfirmasiKriteria');
    if (modal) {
      modal.style.display = 'none';
      modal.classList.remove('active');
    }
  };

  window.simpanKriteria = function() {
    const form = document.getElementById('form-kriteria');
    if (form) {
      form.submit();
    } else {
      console.error('Form tidak ditemukan');
    }
  };

  document.addEventListener('DOMContentLoaded', function() {
    const sifatSelects = document.querySelectorAll('.sifat-select');

    function updateSifatInfo(select) {
      const infoDiv = select.closest('td').querySelector('.sifat-info');
      const sifat = select.value;
      
      if (sifat === 'cost') {
        infoDiv.innerHTML = '<span style="color: #dc2626;">↓ Semakin kecil semakin baik</span>';
      } else {
        infoDiv.innerHTML = '<span style="color: #16a34a;">↑ Semakin besar semakin baik</span>';
      }
    }

    sifatSelects.forEach(select => {
      updateSifatInfo(select);
      
      select.addEventListener('change', function() {
        updateSifatInfo(this);
      });
    });
  });
})();
</script>
