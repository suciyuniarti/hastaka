<?php $is_edit = isset($paket) && $paket; ?>

<?php if ($this->session->flashdata('error')): ?>
<div class="flash-error flex items-center gap-3 mb-6 animate-slide-down">
    <span class="material-symbols-rounded text-red-500">error</span>
    <?= $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>

<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded"><?= $is_edit ? 'edit' : 'add'; ?></span>
    </div>
    <div class="page-header-content">
        <h1><?= $is_edit ? 'Edit' : 'Tambah'; ?> Paket Wisata</h1>
        <p><?= $is_edit ? 'Perbarui informasi paket' : 'Tambahkan paket wisata baru'; ?></p>
    </div>
</div>

<div class="admin-form-wrap">
    <?= form_open_multipart($is_edit ? 'admin/paket/edit/' . $paket->id_paket : 'admin/paket/tambah', ['class' => 'space-y-6']); ?>

        <div class="form-grid">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">badge</span> Nama Paket
                </label>
                <input type="text" name="nama_paket" value="<?= set_value('nama_paket', $is_edit ? $paket->nama_paket : ''); ?>"
                    class="form-input" required>
                <?= form_error('nama_paket', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">description</span> Deskripsi
                </label>
                <textarea name="deskripsi" rows="4" class="form-input" required><?= set_value('deskripsi', $is_edit ? $paket->deskripsi : ''); ?></textarea>
                <?= form_error('deskripsi', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">payments</span> Harga (Rp)
                </label>
                <input type="number" name="harga" value="<?= set_value('harga', $is_edit ? $paket->harga : ''); ?>"
                    class="form-input" required>
                <?= form_error('harga', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">schedule</span> Durasi (Hari)
                </label>
                <input type="number" name="durasi_hari" value="<?= set_value('durasi_hari', $is_edit ? $paket->durasi_hari : ''); ?>" min="1"
                    class="form-input" required>
                <?= form_error('durasi_hari', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">group</span> Min. Peserta
                </label>
                <input type="number" name="min_peserta" value="<?= set_value('min_peserta', $is_edit ? ($paket->min_peserta ?? 1) : '10'); ?>" min="1"
                    class="form-input">
                <p class="form-help">Jumlah minimal peserta</p>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">toggle_on</span> Status
                </label>
                <select name="status" class="form-input">
                    <option value="tersedia" <?= set_select('status', 'tersedia', $is_edit && $paket->status == 'tersedia'); ?>>Tersedia</option>
                    <option value="penuh" <?= set_select('status', 'penuh', $is_edit && $paket->status == 'penuh'); ?>>Penuh</option>
                </select>
            </div>
        </div>

        <div class="form-section-title">
            <span class="material-symbols-rounded">place</span> Destinasi
            <span style="font-weight: 400; color: #94a3b8; text-transform: none; letter-spacing: 0;">(Centang yang termasuk)</span>
        </div>
        <div class="checkbox-group">
            <?php
            $grouped = [];
            if (!empty($destinasi_list)):
                foreach ($destinasi_list as $d):
                    $grouped[$d->kota][] = $d;
                endforeach;
            endif;
            ?>
            <?php foreach ($grouped as $kota => $items): ?>
            <div class="checkbox-section">
                <p class="checkbox-section-title"><?= $kota; ?></p>
                <div class="checkbox-grid">
                    <?php foreach ($items as $d): ?>
                    <label class="checkbox-item">
                        <input type="checkbox" name="destinasi[]" value="<?= $d->id_destinasi; ?>"
                            <?= in_array($d->id_destinasi, $selected_destinasi ?? []) ? 'checked' : ''; ?>>
                        <span class="material-symbols-rounded"><?= $d->jenis == 'kampus' ? 'account_balance' : 'landscape'; ?></span>
                        <span><?= $d->nama_destinasi; ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <p class="form-help" id="destinasi-count" style="margin-top: 12px;">0 destinasi dipilih</p>
        </div>

        <div class="form-section-title">
            <span class="material-symbols-rounded">inventory_2</span> Fasilitas Include
            <span style="font-weight: 400; color: #94a3b8; text-transform: none; letter-spacing: 0;">(Centang yang termasuk)</span>
        </div>
        <div class="checkbox-group">
            <div class="checkbox-grid">
                <?php if (!empty($fasilitas_list)): ?>
                <?php foreach ($fasilitas_list as $f): ?>
                <label class="checkbox-item">
                    <input type="checkbox" name="fasilitas[]" value="<?= $f->id_fasilitas; ?>"
                        <?= in_array($f->id_fasilitas, $selected_fasilitas ?? []) ? 'checked' : ''; ?>>
                    <span class="material-symbols-rounded"><?= $f->icon; ?></span>
                    <span><?= $f->nama_fasilitas; ?></span>
                </label>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <p class="form-help" id="fasilitas-count" style="margin-top: 12px;">0 fasilitas dipilih</p>
        </div>

        <div class="form-section-title">
            <span class="material-symbols-rounded">hiking</span> Aktivitas Include
            <span style="font-weight: 400; color: #94a3b8; text-transform: none; letter-spacing: 0;">(Centang yang termasuk)</span>
        </div>
        <div class="checkbox-group">
            <div class="checkbox-grid">
                <?php if (!empty($aktivitas_list)): ?>
                <?php foreach ($aktivitas_list as $a): ?>
                <label class="checkbox-item">
                    <input type="checkbox" name="aktivitas[]" value="<?= $a->id_aktivitas; ?>"
                        <?= in_array($a->id_aktivitas, $selected_aktivitas ?? []) ? 'checked' : ''; ?>>
                    <span class="material-symbols-rounded"><?= $a->icon; ?></span>
                    <span><?= $a->nama_aktivitas; ?></span>
                </label>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <p class="form-help" id="aktivitas-count" style="margin-top: 12px;">0 aktivitas dipilih</p>
        </div>

        <div class="form-section-title">
            <span class="material-symbols-rounded">image</span> Foto Paket
        </div>
        <div class="form-group">
            <?php if ($is_edit && $paket->foto): ?>
            <div class="file-preview mb-4">
                <img src="<?= base_url('application/assets/images/paket/' . $paket->foto . '?v=' . time()); ?>" onerror="this.style.display='none'">
                <div class="file-preview-info">
                    <p>Foto paket saat ini</p>
                    <span>Upload foto baru untuk mengganti</span>
                </div>
            </div>
            <?php endif; ?>
            <div class="file-upload">
                <input type="file" name="foto" accept="image/*">
                <span class="material-symbols-rounded file-upload-icon">image</span>
                <p class="file-upload-text">Klik untuk upload foto paket</p>
                <p class="file-upload-hint">Format: JPG, JPEG. Maks 2MB.</p>
            </div>
        </div>

        <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-xl">save</span>
            <?= $is_edit ? 'Update' : 'Simpan'; ?>
        </button>
        <a href="<?= base_url('admin/paket'); ?>" class="btn btn-secondary">
            <span class="material-symbols-rounded text-xl">close</span> Batal
        </a>
        </div>

    <?= form_close(); ?>

</div>

<script>
function updateCounts() {
    var dc = document.querySelectorAll('input[name="destinasi[]"]:checked').length;
    var fc = document.querySelectorAll('input[name="fasilitas[]"]:checked').length;
    var ac = document.querySelectorAll('input[name="aktivitas[]"]:checked').length;
    var el1 = document.getElementById('destinasi-count');
    var el2 = document.getElementById('fasilitas-count');
    var el3 = document.getElementById('aktivitas-count');
    if (el1) el1.textContent = dc + ' destinasi dipilih';
    if (el2) el2.textContent = fc + ' fasilitas dipilih';
    if (el3) el3.textContent = ac + ' aktivitas dipilih';
}
document.addEventListener('change', function(e) {
    if (e.target.name === 'destinasi[]' || e.target.name === 'fasilitas[]' || e.target.name === 'aktivitas[]') updateCounts();
});
document.addEventListener('DOMContentLoaded', updateCounts);
</script>