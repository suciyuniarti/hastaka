<?php $is_edit = isset($aktivitas) && $aktivitas; ?>

<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded"><?= $is_edit ? 'edit' : 'add'; ?></span>
    </div>
    <div class="page-header-content">
        <h1><?= $is_edit ? 'Edit' : 'Tambah'; ?> Aktivitas</h1>
        <p><?= $is_edit ? 'Perbarui informasi aktivitas' : 'Tambahkan aktivitas baru'; ?></p>
    </div>
</div>

<div class="admin-form-wrap">
    <?= form_open($is_edit ? 'admin/aktivitas/edit/' . $aktivitas->id_aktivitas : 'admin/aktivitas/tambah', ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500 text-xl">badge</span> Nama Aktivitas
            </label>
            <input type="text" name="nama_aktivitas" value="<?= set_value('nama_aktivitas', $is_edit ? $aktivitas->nama_aktivitas : ''); ?>"
                class="form-input" required>
            <?= form_error('nama_aktivitas', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500 text-xl">icon</span> Icon (Material Symbol)
            </label>
            <input type="text" name="icon" value="<?= set_value('icon', $is_edit ? $aktivitas->icon : 'hiking'); ?>"
                placeholder="hiking, snorkeling, swimming, camping, etc."
                class="form-input">
            <p class="form-help">Gunakan nama icon dari Material Symbols</p>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500 text-xl">description</span> Deskripsi
            </label>
            <textarea name="deskripsi" rows="3" class="form-input"><?= set_value('deskripsi', $is_edit ? $aktivitas->deskripsi : ''); ?></textarea>
        </div>

<div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-xl">save</span>
                <?= $is_edit ? 'Update' : 'Simpan'; ?>
            </button>
            <a href="<?= base_url('admin/aktivitas'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded text-xl">close</span> Batal
            </a>
        </div>
    <?= form_close(); ?>

</div>