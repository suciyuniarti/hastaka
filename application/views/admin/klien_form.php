<?php $is_edit = isset($klien); ?>

<div class="space-y-6">
    <div class="admin-form-wrap max-w-3xl">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                <span class="material-symbols-rounded text-sky-600 text-xl"><?= $is_edit ? 'edit' : 'add'; ?></span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900"><?= $is_edit ? 'Edit' : 'Tambah'; ?> Klien</h1>
                <p class="text-sm text-slate-500"><?= $is_edit ? 'Perbarui data klien' : 'Tambah klien baru'; ?></p>
            </div>
        </div>

        <?= form_open_multipart($is_edit ? 'admin/klien/edit/' . $klien->id_klien : 'admin/klien/tambah', ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">Nama Klien <span class="required">*</span></label>
            <input type="text" name="nama_klien" value="<?= set_value('nama_klien', $is_edit ? $klien->nama_klien : ''); ?>"
                class="form-input" required>
            <?= form_error('nama_klien', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">Jenis <span class="required">*</span></label>
            <select name="jenis" class="form-input" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="sekolah" <?= set_select('jenis', 'sekolah', $is_edit && $klien->jenis == 'sekolah'); ?>>Sekolah</option>
                <option value="perusahaan" <?= set_select('jenis', 'perusahaan', $is_edit && $klien->jenis == 'perusahaan'); ?>>Perusahaan</option>
                <option value="instansi" <?= set_select('jenis', 'instansi', $is_edit && $klien->jenis == 'instansi'); ?>>Instansi Pemerintah</option>
                <option value="komunitas" <?= set_select('jenis', 'komunitas', $is_edit && $klien->jenis == 'komunitas'); ?>>Komunitas</option>
            </select>
            <?= form_error('jenis', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">Logo / Gambar</label>
            <?php if ($is_edit && !empty($klien->logo)): ?>
            <div class="file-preview mb-4">
                <img src="<?= base_url('application/assets/images/klien/' . $klien->logo); ?>" onerror="this.style.display='none'">
                <div class="file-preview-info">
                    <p>Logo saat ini</p>
                    <span>Upload gambar baru untuk mengganti</span>
                </div>
            </div>
            <?php endif; ?>
            <div class="file-upload">
                <input type="file" name="logo" accept="image/*">
                <span class="material-symbols-rounded file-upload-icon">upload_file</span>
                <p class="file-upload-text">Klik untuk upload logo</p>
                <p class="file-upload-hint">Format: JPG, PNG. Maks 1MB.</p>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Website</label>
                <input type="url" name="website" value="<?= set_value('website', $is_edit ? $klien->website : ''); ?>"
                    class="form-input" placeholder="https://example.com">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span>
                <?= $is_edit ? 'Update' : 'Simpan'; ?> Klien
            </button>
            <a href="<?= base_url('admin/klien'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded">close</span> Batal
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>