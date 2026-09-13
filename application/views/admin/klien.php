<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">groups</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Klien</h1>
        <p><?= $total_klien ?? count($klien ?? []); ?> klien terdaftar</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div></div>
    <a href="<?= base_url('admin/klien/tambah'); ?>" class="btn btn-primary" onclick="openModal('modal-tambah-klien'); return false;"><span class="material-symbols-rounded text-lg">add</span> Tambah Klien</a>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table text-sm">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-16">Logo</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Nama Klien</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Jenis</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Website</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-40 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($klien)): ?>
                    <?php
                    $jenis_colors = [
                        'sekolah'    => 'bg-blue-100 border-blue-300 text-blue-700',
                        'perusahaan' => 'bg-emerald-100 border-emerald-300 text-emerald-700',
                        'instansi'   => 'bg-amber-100 border-amber-300 text-amber-700',
                        'komunitas'  => 'bg-purple-100 border-purple-300 text-purple-700',
                    ];
                    ?>
                    <?php foreach ($klien as $k): ?>
                        <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap">
                            <td class="py-4 px-5">
                                <?php if (!empty($k->logo) && file_exists(FCPATH . 'application/assets/images/klien/' . $k->logo)): ?>
                                    <img src="<?= base_url('application/assets/images/klien/' . $k->logo); ?>" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shadow-sm" onerror="this.style.display='none'">
                                <?php else: ?>
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center">
                                        <span class="material-symbols-rounded text-slate-300 text-xl">image</span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-5">
                                <p class="font-semibold text-slate-800"><?= $k->nama_klien; ?></p>
                            </td>
                            <td class="py-4 px-5">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border <?= $jenis_colors[$k->jenis] ?? 'bg-slate-600 text-white border-slate-700'; ?>">
                                    <?= ucfirst($k->jenis); ?>
                                </span>
                            </td>
                            <td class="py-4 px-5">
                                <?php if (!empty($k->website)): ?>
                                    <a href="<?= $k->website; ?>" target="_blank" class="text-sky-600 hover:text-sky-700 text-xs font-semibold inline-flex items-center gap-1 transition">
                                        <span class="material-symbols-rounded text-[12px]">open_in_new</span> Link
                                    </a>
                                <?php else: ?>
                                    <span class="text-slate-300 text-xs">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" class="btn btn-primary btn-icon-sm" onclick="openEditKlienModal(<?= $k->id_klien; ?>)"><span class="material-symbols-rounded text-sm">edit</span> Edit</button>
                                    <button type="button" class="btn btn-danger btn-icon-sm" onclick="openHapusKlienModal(<?= $k->id_klien; ?>, '<?= htmlspecialchars($k->nama_klien, ENT_QUOTES); ?>')"><span class="material-symbols-rounded text-sm">delete</span> Hapus</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <span class="material-symbols-rounded">groups</span>
                                </div>
                                <h3>Belum ada klien.</h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($total_pages) && $total_pages > 1): ?>
        <div class="pagination">
            <p class="pagination-info">Halaman <?= $current_page + 1; ?> dari <?= $total_pages; ?></p>
            <div class="pagination-buttons">
                <?php if ($current_page > 0): ?>
                    <a href="<?= base_url('admin/klien/' . ($current_page - 1)); ?>" class="pagination-btn prev">Sebelumnya</a>
                <?php endif; ?>
                <?php for ($i = 0; $i < $total_pages; $i++): ?>
                    <a href="<?= base_url('admin/klien/' . $i); ?>" class="pagination-num <?= $i == $current_page ? 'active' : ''; ?>"><?= $i + 1; ?></a>
                <?php endfor; ?>
                <?php if ($current_page < $total_pages - 1): ?>
                    <a href="<?= base_url('admin/klien/' . ($current_page + 1)); ?>" class="pagination-btn next">Selanjutnya</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah Klien -->
<div id="modal-tambah-klien" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-tambah-klien')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Tambah Klien</span>
            <button class="modal-close" onclick="closeModal('modal-tambah-klien')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <form id="form-tambah-klien" action="<?= base_url('admin/klien/tambah'); ?>" method="post" enctype="multipart/form-data" class="space-y-4">
                <div class="form-group">
                    <label class="form-label">Nama Klien <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_klien" class="form-input" required placeholder="Contoh: SMAN 1 Jakarta">
                    <?= form_error('nama_klien', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis <span class="text-red-500">*</span></label>
                    <select name="jenis" class="form-input" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="sekolah">Sekolah</option>
                        <option value="perusahaan">Perusahaan</option>
                        <option value="instansi">Instansi Pemerintah</option>
                        <option value="komunitas">Komunitas</option>
                    </select>
                    <?= form_error('jenis', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" class="form-input" placeholder="https://example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Logo / Gambar</label>
                    <div class="file-upload">
                        <input type="file" name="logo" id="input_logo_tambah" accept="image/*">
                        <span class="material-symbols-rounded file-upload-icon">upload_file</span>
                        <p class="file-upload-text">Klik untuk upload logo</p>
                        <p class="file-upload-hint">Format: JPG, PNG, GIF. Maks 1MB.</p>
                    </div>
                    <div id="preview-tambah-klien" style="display:none; margin-top:8px">
                        <img id="img-preview-tambah-klien" style="width:100%; max-height:200px; object-fit:cover; border-radius:8px; border:0.5px solid #e5e7eb">
                        <p style="font-size:11px; color:#6b7280; margin-top:4px">Preview logo yang akan diupload</p>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-tambah-klien" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span> Simpan Klien
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Klien -->
<div id="modal-edit-klien" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-edit-klien')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Edit Klien</span>
            <button class="modal-close" onclick="closeModal('modal-edit-klien')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <div id="edit-klien-loading" class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 animate-spin">refresh</span>
                <p class="text-sm text-slate-500 mt-2">Memuat data...</p>
            </div>
            <form id="form-edit-klien" action="" method="post" enctype="multipart/form-data" class="space-y-4 hidden">
                <input type="hidden" name="id_klien" id="edit-id-klien">
                <div class="form-group">
                    <label class="form-label">Nama Klien <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_klien" id="edit-nama-klien" class="form-input" required placeholder="Contoh: SMAN 1 Jakarta">
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis <span class="text-red-500">*</span></label>
                    <select name="jenis" id="edit-jenis" class="form-input" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="sekolah">Sekolah</option>
                        <option value="perusahaan">Perusahaan</option>
                        <option value="instansi">Instansi Pemerintah</option>
                        <option value="komunitas">Komunitas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Website</label>
                    <input type="url" name="website" id="edit-website" class="form-input" placeholder="https://example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Logo / Gambar</label>
                    <div id="preview-edit-klien" style="margin-bottom:8px">
                        <p style="font-size:11px; color:#6b7280; margin-bottom:4px">Logo saat ini:</p>
                        <img id="img-current-klien" style="width:100%; max-height:150px; object-fit:cover; border-radius:8px; border:0.5px solid #e5e7eb">
                    </div>
                    <div class="file-upload">
                        <input type="file" name="logo" id="input_logo_edit" accept="image/*">
                        <span class="material-symbols-rounded file-upload-icon">upload_file</span>
                        <p class="file-upload-text">Klik untuk mengganti logo</p>
                        <p class="file-upload-hint">Format: JPG, PNG, GIF. Maks 1MB.</p>
                    </div>
                    <div id="preview-edit-klien-baru" style="display:none; margin-top:8px">
                        <p style="font-size:11px; color:#6b7280; margin-bottom:4px">Preview logo baru:</p>
                        <img id="img-preview-edit-klien" style="width:100%; max-height:150px; object-fit:cover; border-radius:8px; border:0.5px solid #0ea5e9">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-edit-klien" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">update</span> Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Klien -->
<div id="modal-hapus-klien" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-hapus-klien')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-red-500">delete</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Klien?</h3>
            <p class="text-sm text-gray-500">Klien <strong id="hapus-nama-klien"></strong> akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <form id="form-hapus-klien" method="post" style="display:inline;">
                <button type="submit" class="btn btn-danger">
                    <span class="material-symbols-rounded text-sm">delete</span> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const baseUrl = '<?= base_url(); ?>';

    function openEditKlienModal(id) {
        const modal = document.getElementById('modal-edit-klien');
        const loading = document.getElementById('edit-klien-loading');
        const form = document.getElementById('form-edit-klien');
        if (!modal || !loading || !form) return;

        loading.classList.remove('hidden');
        form.classList.add('hidden');
        openModal('modal-edit-klien');

        fetch(baseUrl + 'admin/get_klien/' + id)
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.error) {
                    showToast && showToast('error', data.error);
                    closeModal('modal-edit-klien');
                    return;
                }

                loading.classList.add('hidden');
                form.classList.remove('hidden');

                const elId = document.getElementById('edit-id-klien');
                if (elId) elId.value = data.id_klien || '';

                const elNama = document.getElementById('edit-nama-klien');
                if (elNama) elNama.value = data.nama_klien || '';

                const elJenis = document.getElementById('edit-jenis');
                if (elJenis && data.jenis) elJenis.value = data.jenis;

                const elWeb = document.getElementById('edit-website');
                if (elWeb) elWeb.value = data.website || '';

                const previewEdit = document.getElementById('preview-edit-klien');
                const imgCurrent = document.getElementById('img-current-klien');
                if (previewEdit && imgCurrent) {
                    if (data.logo) {
                        previewEdit.style.display = 'block';
                        imgCurrent.src = baseUrl + 'application/assets/images/klien/' + encodeURIComponent(data.logo) + '?v=' + Date.now();
                    } else {
                        previewEdit.style.display = 'none';
                        imgCurrent.src = '';
                    }
                }

                const previewBaru = document.getElementById('preview-edit-klien-baru');
                const inputLogo = document.getElementById('input_logo_edit');
                if (previewBaru) previewBaru.style.display = 'none';
                if (inputLogo) inputLogo.value = '';

                form.action = baseUrl + 'admin/klien/edit/' + (data.id_klien || id);
            })
            .catch(function() {
                loading.classList.add('hidden');
                form.classList.remove('hidden');
                showToast && showToast('error', 'Gagal memuat data klien');
            });
    }

    function openHapusKlienModal(id, nama) {
        const namaEl = document.getElementById('hapus-nama-klien');
        if (namaEl) namaEl.textContent = nama;
        const form = document.getElementById('form-hapus-klien');
        if (form) form.action = baseUrl + 'admin/klien/hapus/' + id;
        openModal('modal-hapus-klien');
    }

    const inputLogoTambah = document.getElementById('input_logo_tambah');
    if (inputLogoTambah) {
        inputLogoTambah.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const img = document.getElementById('img-preview-tambah-klien');
                    const preview = document.getElementById('preview-tambah-klien');
                    if (img) img.src = ev.target.result;
                    if (preview) preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    const inputLogoEdit = document.getElementById('input_logo_edit');
    if (inputLogoEdit) {
        inputLogoEdit.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const img = document.getElementById('img-preview-edit-klien');
                    const preview = document.getElementById('preview-edit-klien-baru');
                    if (img) img.src = ev.target.result;
                    if (preview) preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
