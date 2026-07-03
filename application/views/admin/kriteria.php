<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">tune</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Kriteria SAW</h1>
        <p>Atur bobot dan sifat kriteria untuk perhitungan SAW</p>
    </div>
</div>

<div class="admin-card mb-6 flex items-start gap-3">
    <span class="material-symbols-rounded text-sky-500 mt-0.5">info</span>
    <div class="text-sm text-sky-800">
        <p class="font-bold mb-1">Metode SAW (Simple Additive Weighting)</p>
        <p>Kriteria digunakan dalam perhitungan pembobotan untuk menentukan rekomendasi paket wisata terbaik. <strong class="font-bold">Total bobot</strong> harus tepat 1 (contoh: 0.3 + 0.3 + 0.2 + 0.2 = 1). <strong class="font-bold">Sifat</strong> menentukan apakah nilai semakin besar semakin baik (benefit) atau semakin kecil semakin baik (cost).</p>
    </div>
</div>

<?= form_open('admin/kriteria', ['class' => 'admin-table-wrap']); ?>
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
                    <select name="sifat[<?= $kr->id_kriteria; ?>]" class="form-input w-28 text-xs py-1 sifat-select" data-kode="<?= $kr->kode_kriteria; ?>" required>
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

<div class="form-actions px-5 py-4 border-t border-slate-100 flex justify-between items-center">
    <div class="text-sm text-slate-600">
        Total Bobot: <span id="total-bobot" class="font-bold text-amber-600">1.00</span>
        <span id="total-warning" class="text-red-500 text-xs ml-2 hidden">(harus = 1)</span>
    </div>
    <button type="submit" class="btn btn-primary">
        <span class="material-symbols-rounded text-lg">save</span> Simpan Semua
    </button>
</div>
<?= form_close(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const sifatSelects = document.querySelectorAll('.sifat-select');

    // Fungsi untuk update teks sifat
    function updateSifatInfo(select) {
        const infoDiv = select.closest('td').querySelector('.sifat-info');
        const sifat = select.value;
        
        if (sifat === 'cost') {
            infoDiv.innerHTML = '<span style="color: #dc2626;">↓ Semakin kecil semakin baik</span>';
        } else {
            infoDiv.innerHTML = '<span style="color: #16a34a;">↑ Semakin besar semakin baik</span>';
        }
    }

    // Inisialisasi teks untuk semua dropdown
    sifatSelects.forEach(select => {
        updateSifatInfo(select);
        
        // Update saat dropdown berubah
        select.addEventListener('change', function() {
            updateSifatInfo(this);
        });
    });
});
</script>
