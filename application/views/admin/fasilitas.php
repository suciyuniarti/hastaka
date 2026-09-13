<?php if ($this->session->flashdata('success')): ?>
<?php endif; ?>

<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">inventory_2</span>
    </div>
    <div class="page-header-content">
        <h1>Fasilitas</h1>
        <p>Kelola daftar fasilitas paket wisata</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div></div>
    <button type="button" class="btn btn-primary whitespace-nowrap" onclick="openModal('modal-tambah-fasilitas')">
        <span class="material-symbols-rounded text-lg">add</span> Tambah Fasilitas
    </button>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-12">#</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-20">Icon</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Nama Fasilitas</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Deskripsi</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-40 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($fasilitas)): ?>
                <?php foreach ($fasilitas as $i => $f): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
                    <td class="py-4 px-5 text-slate-400 text-sm font-mono td-no"><?= $i + 1; ?></td>
                    <td class="py-4 px-5">
                        <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600">
                            <span class="material-symbols-rounded text-xl"><?= $f->icon; ?></span>
                        </div>
                    </td>
                    <td class="py-4 px-5 font-semibold text-slate-800 text-sm"><?= $f->nama_fasilitas; ?></td>
                    <td class="py-4 px-5 text-slate-500 text-sm max-w-xs truncate"><?= character_limiter($f->deskripsi, 80); ?></td>
                    <td class="py-4 px-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" class="btn btn-primary btn-icon-sm" title="Edit" onclick="openEditModal(<?= $f->id_fasilitas; ?>)">
                                <span class="material-symbols-rounded text-sm">edit</span> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="openDeleteModal(<?= $f->id_fasilitas; ?>, '<?= htmlspecialchars($f->nama_fasilitas, ENT_QUOTES); ?>')">
                                <span class="material-symbols-rounded text-sm">delete</span> Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="5" class="py-16 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <span class="material-symbols-rounded">checklist</span>
                        </div>
                        <h3>Belum ada fasilitas.</h3>
                    </div>
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($total_pages) && $total_pages > 1): ?>
    <div class="pagination">
        <p class="pagination-info">Halaman <?= $current_page + 1; ?> dari <?= $total_pages; ?></p>
        <div class="pagination-buttons">
            <?php if ($current_page > 0): ?>
            <a href="<?= base_url('admin/fasilitas/' . ($current_page - 1)); ?>" class="pagination-btn prev">Sebelumnya</a>
            <?php endif; ?>
            <?php for ($i = 0; $i < $total_pages; $i++): ?>
            <a href="<?= base_url('admin/fasilitas/' . $i); ?>" class="pagination-num <?= $i == $current_page ? 'active' : ''; ?>"><?= $i + 1; ?></a>
            <?php endfor; ?>
            <?php if ($current_page < $total_pages - 1): ?>
            <a href="<?= base_url('admin/fasilitas/' . ($current_page + 1)); ?>" class="pagination-btn next">Selanjutnya</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah Fasilitas -->
<div id="modal-tambah-fasilitas" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-tambah-fasilitas')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Tambah Fasilitas</span>
            <button class="modal-close" onclick="closeModal('modal-tambah-fasilitas')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <form id="form-tambah-fasilitas" action="<?= base_url('admin/fasilitas/tambah'); ?>" method="post" class="space-y-5">
                <div class="form-group">
                    <label class="form-label">Nama Fasilitas <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_fasilitas" class="form-input" required placeholder="Contoh: Transportasi, Hotel, Makan">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Material Symbols)</label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="icon" id="tambah-icon-input" class="form-input flex-1" value="check_circle" placeholder="directions_bus, hotel, restaurant, etc." onchange="updateIconPreview('tambah')">
                        <div id="tambah-icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                            <span class="material-symbols-rounded text-2xl">check_circle</span>
                        </div>
                    </div>
                    <p class="form-help">Gunakan nama icon dari Material Symbols</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-input" placeholder="Deskripsi fasilitas paket..."></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-tambah-fasilitas" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span> Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Fasilitas -->
<div id="modal-edit-fasilitas" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-edit-fasilitas')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Edit Fasilitas</span>
            <button class="modal-close" onclick="closeModal('modal-edit-fasilitas')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <div id="edit-loading" class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 animate-spin">refresh</span>
                <p class="text-sm text-slate-500 mt-2">Memuat data...</p>
            </div>
            <form id="form-edit-fasilitas" action="" method="post" class="space-y-5 hidden">
                <input type="hidden" name="id_fasilitas" id="edit-id-fasilitas">
                <div class="form-group">
                    <label class="form-label">Nama Fasilitas <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_fasilitas" id="edit-nama-fasilitas" class="form-input" required placeholder="Contoh: Transportasi, Hotel, Makan">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Material Symbols)</label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="icon" id="edit-icon-input" class="form-input flex-1" placeholder="directions_bus, hotel, restaurant, etc." onchange="updateIconPreview('edit')">
                        <div id="edit-icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                            <span class="material-symbols-rounded text-2xl">check_circle</span>
                        </div>
                    </div>
                    <p class="form-help">Gunakan nama icon dari Material Symbols</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="edit-deskripsi-fasilitas" rows="3" class="form-input" placeholder="Deskripsi fasilitas paket..."></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-edit-fasilitas" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">update</span> Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modal-hapus-fasilitas" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-hapus-fasilitas')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-red-500">delete</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Fasilitas?</h3>
            <p class="text-sm text-gray-500">Fasilitas <strong id="hapus-nama-fasilitas"></strong> akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <form id="form-hapus-fasilitas" method="post" style="display:inline;">
                <button type="submit" class="btn btn-danger">
                    <span class="material-symbols-rounded text-sm">delete</span> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const baseUrl = '<?= base_url(); ?>';

function openEditModal(id) {
    const modal = document.getElementById('modal-edit-fasilitas');
    const loading = document.getElementById('edit-loading');
    const form = document.getElementById('form-edit-fasilitas');
    if (!modal || !loading || !form) return;

    loading.classList.remove('hidden');
    form.classList.add('hidden');
    openModal('modal-edit-fasilitas');

    fetch(baseUrl + 'admin/get_fasilitas/' + id)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            loading.classList.add('hidden');
            form.classList.remove('hidden');

            var el = document.getElementById('edit-id-fasilitas');
            if (el) el.value = data.id_fasilitas || '';

            el = document.getElementById('edit-nama-fasilitas');
            if (el) el.value = data.nama_fasilitas || '';

            el = document.getElementById('edit-deskripsi-fasilitas');
            if (el) el.value = data.deskripsi || '';

            var iconInput = document.getElementById('edit-icon-input');
            var iconPreview = document.querySelector('#edit-icon-preview .material-symbols-rounded');
            if (iconInput) iconInput.value = data.icon || 'check_circle';
            if (iconPreview) iconPreview.textContent = data.icon || 'check_circle';

            form.action = baseUrl + 'admin/fasilitas/edit/' + (data.id_fasilitas || id);
        })
        .catch(function() {
            loading.classList.add('hidden');
            form.classList.remove('hidden');
            showToast && showToast('error', 'Gagal memuat data fasilitas');
        });
}

function openDeleteModal(id, nama) {
    document.getElementById('hapus-nama-fasilitas').textContent = nama;
    document.getElementById('form-hapus-fasilitas').action = baseUrl + 'admin/fasilitas/hapus/' + id;
    openModal('modal-hapus-fasilitas');
}

function updateIconPreview(prefix) {
    var input, preview;
    if (prefix === 'tambah') {
        input = document.getElementById('tambah-icon-input');
        preview = document.querySelector('#tambah-icon-preview .material-symbols-rounded');
    } else {
        input = document.getElementById('edit-icon-input');
        preview = document.querySelector('#edit-icon-preview .material-symbols-rounded');
    }
    if (preview) preview.textContent = input ? input.value || 'check_circle' : 'check_circle';
}
</script>
