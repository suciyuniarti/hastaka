<?php 
$is_edit = isset($akomodasi) && $akomodasi;
$akomodasi = $akomodasi ?? null;
?>

<div class="space-y-6">
    <div class="admin-form-wrap max-w-2xl">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                <span class="material-symbols-rounded text-sky-600 text-xl"><?= $is_edit ? 'edit' : 'add'; ?></span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900"><?= $is_edit ? 'Edit' : 'Tambah'; ?> Akomodasi</h1>
                <p class="text-sm text-slate-500"><?= $is_edit ? 'Perbarui informasi akomodasi' : 'Tambahkan akomodasi paket wisata baru'; ?></p>
            </div>
        </div>

        <?= form_open($is_edit ? 'admin/akomodasi/edit/' . $akomodasi->id_akomodasi : 'admin/akomodasi/tambah', ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">hotel</span> Nama Akomodasi <span class="required">*</span>
            </label>
            <input type="text" name="nama_akomodasi" value="<?= set_value('nama_akomodasi', $is_edit ? $akomodasi->nama_akomodasi : ''); ?>"
                class="form-input" required>
            <?= form_error('nama_akomodasi', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">icons</span> Icon (Material Symbols)
            </label>
            <div class="flex items-center gap-3">
                <input type="text" name="icon" id="icon-input" value="<?= set_value('icon', $is_edit ? $akomodasi->icon : 'hotel'); ?>"
                    placeholder="hotel, directions_bus, flight, etc."
                    class="form-input flex-1" onchange="updateIconPreview(this.value)">
                <div id="icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                    <span class="material-symbols-rounded text-2xl"><?= set_value('icon', $is_edit ? $akomodasi->icon : 'hotel'); ?></span>
                </div>
            </div>
            <p class="form-help">Preview icon otomatis - gunakan nama icon dari Material Symbols</p>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">payments</span> Harga Tambahan per Orang (Rp)
            </label>
            <input type="number" name="harga_tambahan" id="harga-input" value="<?= set_value('harga_tambahan', $is_edit ? $akomodasi->harga_tambahan : '0'); ?>"
                class="form-input" min="0" placeholder="0" oninput="formatRupiah(this)" required>
            <p class="form-help">Harga ini akan dikali jumlah peserta saat pelanggan booking</p>
            <p class="text-xs text-slate-500 mt-1">Preview: <strong id="harga-preview">Rp <?= number_format(set_value('harga_tambahan', $is_edit ? $akomodasi->harga_tambahan : 0), 0, ',', '.'); ?></strong></p>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">map</span> Wilayah
            </label>
            <input type="text" name="wilayah" value="<?= set_value('wilayah', $is_edit ? ($akomodasi->wilayah ?? '') : ''); ?>"
                class="form-input" placeholder="contoh: Jabodetabek, Bandung, Surabaya">
            <p class="form-help">Informasi wilayah yang dilayani. Akan ditampilkan ke pelanggan saat booking.</p>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">description</span> Deskripsi
            </label>
            <textarea name="deskripsi" rows="3" class="form-input" placeholder="Deskripsi akomodasi..." maxlength="200" oninput="updateCharCount()"><?= set_value('deskripsi', $is_edit ? $akomodasi->deskripsi : ''); ?></textarea>
            <div class="flex justify-between mt-1">
                <p class="form-help">Maksimal 200 karakter</p>
                <p class="text-xs text-slate-500"><span id="char-count"><?= strlen(set_value('deskripsi', $is_edit ? $akomodasi->deskripsi : '')); ?></span>/200</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">toggle_on</span> Status
            </label>
            <select name="is_active" class="form-input">
                <option value="y" <?= set_select('is_active', 'y', $is_edit && $akomodasi->is_active == 'y'); ?>>Aktif</option>
                <option value="n" <?= set_select('is_active', 'n', $is_edit && $akomodasi->is_active == 'n'); ?>>Non-Aktif</option>
            </select>
            <p class="form-help">Akomodasi non-aktif tidak akan muncul di form booking</p>
        </div>

        <?php if (!empty($paket_list)): ?>
        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">luggage</span> Tersedia Di Paket <span class="required">*</span>
            </label>
            <p class="form-help" style="margin-bottom: 8px;">Pilih minimal 1 paket wisata yang menggunakan akomodasi ini</p>
            <div class="checkbox-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                <?php foreach ($paket_list as $p): ?>
                <label class="checkbox-item" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px; cursor: pointer; transition: all 0.2s; font-size: 13px; font-weight: 500; color: #475569;">
                    <input type="checkbox" name="paket[]" value="<?= $p->id_paket; ?>" <?= in_array($p->id_paket, $selected_paket ?? []) ? 'checked' : ''; ?> style="accent-color: #0ea5e9; width: 16px; height: 16px;" onchange="updatePaketCheckbox(this)">
                    <span style="flex: 1;"><?= $p->nama_paket; ?></span>
                    <span style="font-size: 11px; color: #64748b; font-weight: 600;"><?= $p->durasi_hari; ?>H</span>
                </label>
                <?php endforeach; ?>
            </div>
            <p class="form-help" id="paket-count" style="margin-top: 8px;"><?= count($selected_paket ?? []); ?> paket dipilih</p>
        </div>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg"><?= $is_edit ? 'update' : 'save'; ?></span>
                <?= $is_edit ? 'Update' : 'Simpan'; ?>
            </button>
            <a href="<?= base_url('admin/akomodasi'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded">close</span> Batal
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
function updateIconPreview(value) {
    document.querySelector('#icon-preview .material-symbols-rounded').textContent = value || 'hotel';
}

function formatRupiah(input) {
    const value = input.value;
    const preview = document.getElementById('harga-preview');
    if (preview) {
        preview.textContent = 'Rp ' + parseInt(value || 0).toLocaleString('id-ID');
    }
}

function updateCharCount() {
    const textarea = document.querySelector('textarea[name="deskripsi"]');
    const counter = document.getElementById('char-count');
    if (textarea && counter) {
        counter.textContent = textarea.value.length;
    }
}

function updatePaketCount() {
    var count = document.querySelectorAll('input[name="paket[]"]:checked').length;
    var el = document.getElementById('paket-count');
    if (el) el.textContent = count + ' paket dipilih';
}

function updatePaketCheckbox(checkbox) {
    var label = checkbox.closest('.checkbox-item');
    if (checkbox.checked) {
        label.style.borderColor = '#0ea5e9';
        label.style.backgroundColor = '#EFF8FF';
    } else {
        label.style.borderColor = '#e2e8f0';
        label.style.backgroundColor = '#fff';
    }
    updatePaketCount();
}

document.addEventListener('change', function(e) {
    if (e.target.name === 'paket[]') {
        updatePaketCheckbox(e.target);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    updatePaketCount();
    updateCharCount();
    
    // Initialize checkbox states
    document.querySelectorAll('input[name="paket[]"]').forEach(function(checkbox) {
        updatePaketCheckbox(checkbox);
    });
});
</script>
