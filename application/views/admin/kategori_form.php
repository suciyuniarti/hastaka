<?php $is_edit = isset($kategori) && $kategori; ?>

<div class="space-y-6">
    <div class="admin-form-wrap max-w-2xl">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                <span class="material-symbols-rounded text-sky-600 text-xl"><?= $is_edit ? 'edit' : 'add'; ?></span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900"><?= $is_edit ? 'Edit' : 'Tambah'; ?> Kategori Program</h1>
                <p class="text-sm text-slate-500"><?= $is_edit ? 'Perbarui kategori program wisata' : 'Tambahkan kategori program baru'; ?></p>
            </div>
        </div>

        <?= form_open($is_edit ? 'admin/kategori/edit/' . $kategori->id_kategori : 'admin/kategori/tambah', ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">badge</span> Nama Kategori <span class="required">*</span>
            </label>
            <input type="text" name="nama_kategori" value="<?= set_value('nama_kategori', $is_edit ? $kategori->nama_kategori : ''); ?>"
                class="form-input" required>
            <?= form_error('nama_kategori', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">icons</span> Icon (Material Symbols)
            </label>
            <div class="flex items-center gap-3">
                <input type="text" name="icon" id="icon-input" value="<?= set_value('icon', $is_edit ? $kategori->icon : 'school'); ?>"
                    placeholder="school, work, groups, etc."
                    class="form-input flex-1" onchange="updateIconPreview(this.value)">
                <div id="icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                    <span class="material-symbols-rounded text-2xl"><?= set_value('icon', $is_edit ? $kategori->icon : 'school'); ?></span>
                </div>
            </div>
            <p class="form-help">Preview icon otomatis - gunakan nama icon dari Material Symbols</p>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">target</span> Sasaran
            </label>
            <input type="text" name="sasaran" value="<?= set_value('sasaran', $is_edit ? $kategori->sasaran : ''); ?>"
                placeholder="Siswa SMA/SMK, Karyawan, Umum, dll"
                class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">description</span> Deskripsi
            </label>
            <textarea name="deskripsi" rows="3" class="form-input" placeholder="Deskripsi kategori program..."><?= set_value('deskripsi', $is_edit ? $kategori->deskripsi : ''); ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg"><?= $is_edit ? 'update' : 'save'; ?></span>
                <?= $is_edit ? 'Update' : 'Simpan'; ?>
            </button>
            <a href="<?= base_url('admin/kategori'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded">close</span> Batal
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
function updateIconPreview(value) {
    document.querySelector('#icon-preview .material-symbols-rounded').textContent = value || 'school';
}
</script>