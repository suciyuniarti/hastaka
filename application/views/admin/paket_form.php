<div class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3 mb-8">
            <a href="<?= base_url('admin/paket'); ?>" class="inline-flex items-center gap-1 text-brand-600 hover:text-brand-700 text-sm font-medium transition group">
                <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Kembali
            </a>
        </div>

        <?php $is_edit = isset($is_edit) ? $is_edit : (isset($paket) && $paket); ?>

        <div class="flex items-center gap-3 mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900"><?= $is_edit ? 'Edit' : 'Tambah'; ?> <span class="gradient-text">Paket Wisata</span></h1>
            <span class="px-3 py-1 rounded-full bg-brand-100 text-brand-700 text-xs font-bold border border-brand-200"><?= $is_edit ? 'Perbarui Data' : 'Data Baru'; ?></span>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border-2 border-slate-200/80 overflow-hidden">
                    <div class="p-6 sm:p-8 border-b border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                            <span class="material-symbols-rounded text-[16px]">info</span>
                            Informasi Dasar
                        </p>
                    </div>
                    <div class="p-6 sm:p-8">
                        <?= form_open_multipart($is_edit ? 'admin/paket/edit/' . $paket->id_paket : 'admin/paket/tambah', ['class' => 'space-y-6']); ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="sm:col-span-2">
                                    <label class="form-label">Nama Paket <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_paket" value="<?= set_value('nama_paket', $is_edit ? $paket->nama_paket : ''); ?>" class="form-input" required placeholder="Contoh: Paket Wisata Bali 3 Hari 2 Malam">
                                    <?= form_error('nama_paket', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="form-label">Deskripsi <span class="text-red-500">*</span></label>
                                    <textarea name="deskripsi" rows="4" class="form-input" required placeholder="Deskripsi lengkap paket wisata..."><?= htmlspecialchars(set_value('deskripsi', $is_edit ? $paket->deskripsi : ''), ENT_QUOTES); ?></textarea>
                                    <?= form_error('deskripsi', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                                </div>
                            </div>

                            <div class="border-t border-slate-100 pt-6">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-5">
                                    <span class="material-symbols-rounded text-[16px]">payments</span>
                                    Harga & Durasi
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label class="form-label">Harga (Rp) <span class="text-red-500">*</span></label>
                                        <input type="number" name="harga" value="<?= set_value('harga', $is_edit ? $paket->harga : ''); ?>" class="form-input" required placeholder="2500000">
                                        <?= form_error('harga', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                                    </div>
                                    <div>
                                        <label class="form-label">Durasi (Hari) <span class="text-red-500">*</span></label>
                                        <input type="number" name="durasi_hari" value="<?= set_value('durasi_hari', $is_edit ? $paket->durasi_hari : ''); ?>" min="1" class="form-input" required placeholder="3">
                                        <?= form_error('durasi_hari', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                                    </div>
                                    <div>
                                        <label class="form-label">Min. Peserta</label>
                                        <input type="number" name="min_peserta" value="<?= set_value('min_peserta', $is_edit ? ($paket->min_peserta ?? 1) : '10'); ?>" min="1" class="form-input" placeholder="10">
                                        <p class="form-help">Jumlah minimal peserta</p>
                                    </div>
                                    <div>
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-input">
                                            <option value="tersedia" <?= set_select('status', 'tersedia', $is_edit && $paket->status == 'tersedia'); ?>>Tersedia</option>
<option value="penuh" <?= set_select('status', 'penuh', $is_edit && $paket->status == 'penuh'); ?>>Tidak Tersedia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($destinasi_list) || !empty($fasilitas_list) || !empty($aktivitas_list)): ?>
                            <div class="border-t border-slate-100 pt-6 space-y-6">
                                <?php if (!empty($destinasi_list)): ?>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-4">
                                        <span class="material-symbols-rounded text-[16px]">place</span>
                                        Destinasi
                                        <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                                    </p>
                                    <div class="checkbox-group">
                                        <?php
                                        $grouped = [];
                                        foreach ($destinasi_list as $d) {
                                            $grouped[$d->kota][] = $d;
                                        }
                                        ?>
                                        <?php foreach ($grouped as $kota => $items): ?>
                                        <div class="checkbox-section">
                                            <p class="checkbox-section-title"><?= $kota; ?></p>
                                            <div class="checkbox-grid">
                                                <?php foreach ($items as $d): ?>
                                                <label class="checkbox-item">
                                                    <input type="checkbox" name="destinasi[]" value="<?= $d->id_destinasi; ?>" <?= in_array($d->id_destinasi, $selected_destinasi ?? []) ? 'checked' : ''; ?>>
                                                    <span class="material-symbols-rounded"><?= $d->jenis == 'kampus' ? 'account_balance' : 'landscape'; ?></span>
                                                    <span><?= $d->nama_destinasi; ?></span>
                                                </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <p class="form-help" id="destinasi-count" style="margin-top: 12px;">0 destinasi dipilih</p>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($fasilitas_list)): ?>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-4">
                                        <span class="material-symbols-rounded text-[16px]">inventory_2</span>
                                        Fasilitas Include
                                        <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                                    </p>
                                    <div class="checkbox-group">
                                        <div class="checkbox-grid">
                                            <?php foreach ($fasilitas_list as $f): ?>
                                            <label class="checkbox-item">
                                                <input type="checkbox" name="fasilitas[]" value="<?= $f->id_fasilitas; ?>" <?= in_array($f->id_fasilitas, $selected_fasilitas ?? []) ? 'checked' : ''; ?>>
                                                <span class="material-symbols-rounded"><?= $f->icon; ?></span>
                                                <span><?= $f->nama_fasilitas; ?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                        <p class="form-help" id="fasilitas-count" style="margin-top: 12px;">0 fasilitas dipilih</p>
                                    </div>
                                </div>
                                <?php endif; ?>

                            <?php if (!empty($aktivitas_list)): ?>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-4">
                                    <span class="material-symbols-rounded text-[16px]">hiking</span>
                                    Aktivitas Include
                                    <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                                </p>
                                <div class="checkbox-group">
                                    <div class="checkbox-grid">
                                        <?php foreach ($aktivitas_list as $a): ?>
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="aktivitas[]" value="<?= $a->id_aktivitas; ?>" <?= in_array($a->id_aktivitas, $selected_aktivitas ?? []) ? 'checked' : ''; ?>>
                                            <span class="material-symbols-rounded"><?= $a->icon; ?></span>
                                            <span><?= $a->nama_aktivitas; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                    <p class="form-help" id="aktivitas-count" style="margin-top: 12px;">0 aktivitas dipilih</p>
                                </div>
                            </div>
                            <?php endif; ?>

                            </div>
                            <?php endif; ?>

                            <div class="border-t border-slate-100 pt-6">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-4">
                                    <span class="material-symbols-rounded text-[16px]">image</span>
                                    Foto Paket
                                </p>
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
                            </div>

                            <div class="flex items-center gap-3 pt-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="material-symbols-rounded text-lg"><?= $is_edit ? 'update' : 'save'; ?></span>
                                    <?= $is_edit ? 'Update Paket' : 'Simpan Paket'; ?>
                                </button>
                                <a href="<?= base_url('admin/paket'); ?>" class="btn btn-secondary">
                                    <span class="material-symbols-rounded">close</span> Batal
                                </a>
                            </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>

<style>
.form-section {
    background: #f8fafc;
    border-radius: 16px;
    padding: 20px;
    border: 1px solid #e2e8f0;
}
.section-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #64748b;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.form-group {
    margin-bottom: 4px;
}
.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}
.form-input {
    width: 100%;
    padding: 10px 12px;
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    color: #1e293b;
    transition: all 0.2s;
}
.form-input:focus {
    outline: none;
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}
.form-input::placeholder {
    color: #94a3b8;
}
.form-error {
    color: #ef4444;
    font-size: 12px;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.form-help {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 4px;
}
.checkbox-group {
    margin-top: 0;
}
.checkbox-section {
    margin-bottom: 16px;
}
.checkbox-section:last-child {
    margin-bottom: 0;
}
.checkbox-section-title {
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    margin-bottom: 8px;
}
.checkbox-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 8px;
}
.checkbox-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 13px;
    font-weight: 500;
    color: #475569;
}
.checkbox-item:hover {
    border-color: #0ea5e9;
    background: #f0f9ff;
}
.checkbox-item input[type="checkbox"] {
    accent-color: #0ea5e9;
    width: 16px;
    height: 16px;
}
.file-upload {
    position: relative;
    border: 2px dashed #e2e8f0;
    border-radius: 16px;
    padding: 32px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
}
.file-upload:hover {
    border-color: #0ea5e9;
    background: #f0f9ff;
}
.file-upload input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}
.file-upload-icon {
    font-size: 40px;
    color: #94a3b8;
    margin-bottom: 8px;
}
.file-upload-text {
    font-size: 14px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 2px;
}
.file-upload-hint {
    font-size: 12px;
    color: #94a3b8;
}
.file-preview {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 12px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}
.file-preview img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e2e8f0;
}
.file-preview-info p {
    font-weight: 600;
    font-size: 13px;
    color: #374151;
}
.file-preview-info span {
    font-size: 12px;
    color: #94a3b8;
}
</style>

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
