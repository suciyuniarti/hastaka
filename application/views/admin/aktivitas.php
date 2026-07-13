<?php if ($this->session->flashdata('success')): ?>
<?php endif; ?>

<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">hiking</span>
    </div>
    <div class="page-header-content">
        <h1>Aktivitas Wisata</h1>
        <p>Kelola daftar aktivitas wisata</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div></div>
    <button type="button" class="btn btn-primary whitespace-nowrap" onclick="openModal('modal-tambah-aktivitas')">
        <span class="material-symbols-rounded text-lg">add</span> Tambah Aktivitas
    </button>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-12">#</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-20">Icon</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Nama Aktivitas</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Deskripsi</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($aktivitas)): ?>
                <?php foreach ($aktivitas as $i => $a): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
                    <td class="py-4 px-5 text-slate-400 text-sm font-mono td-no"><?= $i + 1; ?></td>
                    <td class="py-4 px-5">
                        <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600">
                            <span class="material-symbols-rounded text-xl"><?= $a->icon; ?></span>
                        </div>
                    </td>
                    <td class="py-4 px-5 font-semibold text-slate-800 text-sm"><?= $a->nama_aktivitas; ?></td>
                    <td class="py-4 px-5 text-slate-500 text-sm max-w-xs truncate"><?= character_limiter($a->deskripsi, 80); ?></td>
                    <td class="py-4 px-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" class="btn btn-primary btn-icon-sm" title="Edit" onclick="openEditModal(<?= $a->id_aktivitas; ?>)">
                                <span class="material-symbols-rounded text-sm">edit</span> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="openDeleteModal(<?= $a->id_aktivitas; ?>, '<?= htmlspecialchars($a->nama_aktivitas, ENT_QUOTES); ?>')">
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
                            <span class="material-symbols-rounded">hiking</span>
                        </div>
                        <h3>Belum ada aktivitas.</h3>
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
            <a href="<?= base_url('admin/aktivitas/' . ($current_page - 1)); ?>" class="pagination-btn prev">Sebelumnya</a>
            <?php endif; ?>
            <?php for ($i = 0; $i < $total_pages; $i++): ?>
            <a href="<?= base_url('admin/aktivitas/' . $i); ?>" class="pagination-num <?= $i == $current_page ? 'active' : ''; ?>"><?= $i + 1; ?></a>
            <?php endfor; ?>
            <?php if ($current_page < $total_pages - 1): ?>
            <a href="<?= base_url('admin/aktivitas/' . ($current_page + 1)); ?>" class="pagination-btn next">Selanjutnya</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah Aktivitas -->
<div id="modal-tambah-aktivitas" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-tambah-aktivitas')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Tambah Aktivitas</span>
            <button class="modal-close" onclick="closeModal('modal-tambah-aktivitas')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="form-tambah-aktivitas" action="<?= base_url('admin/aktivitas/tambah'); ?>" method="post" class="space-y-5">
                <div class="form-group">
                    <label class="form-label">Nama Aktivitas <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_aktivitas" class="form-input" required placeholder="Contoh: Snorkeling, Hiking, Cycling">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Material Symbols)</label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="icon" id="tambah-icon-input" class="form-input flex-1" value="hiking" placeholder="hiking, snorkeling, swimming, camping" onchange="updateIconPreview('tambah')">
                        <div id="tambah-icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                            <span class="material-symbols-rounded text-2xl">hiking</span>
                        </div>
                    </div>
                    <p class="form-help">Gunakan nama icon dari Material Symbols</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-input" placeholder="Deskripsi aktivitas wisata..."></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modal-tambah-aktivitas')">Batal</button>
            <button type="submit" form="form-tambah-aktivitas" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span> Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Aktivitas -->
<div id="modal-edit-aktivitas" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-edit-aktivitas')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Edit Aktivitas</span>
            <button class="modal-close" onclick="closeModal('modal-edit-aktivitas')">&times;</button>
        </div>
        <div class="modal-body">
            <div id="edit-loading" class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 animate-spin">refresh</span>
                <p class="text-sm text-slate-500 mt-2">Memuat data...</p>
            </div>
            <form id="form-edit-aktivitas" action="" method="post" class="space-y-5 hidden">
                <input type="hidden" name="id_aktivitas" id="edit-id-aktivitas">
                <div class="form-group">
                    <label class="form-label">Nama Aktivitas <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_aktivitas" id="edit-nama-aktivitas" class="form-input" required placeholder="Contoh: Snorkeling, Hiking, Cycling">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Material Symbols)</label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="icon" id="edit-icon-input" class="form-input flex-1" placeholder="hiking, snorkeling, swimming, camping" onchange="updateIconPreview('edit')">
                        <div id="edit-icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                            <span class="material-symbols-rounded text-2xl">hiking</span>
                        </div>
                    </div>
                    <p class="form-help">Gunakan nama icon dari Material Symbols</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="edit-deskripsi-aktivitas" rows="3" class="form-input" placeholder="Deskripsi aktivitas wisata..."></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modal-edit-aktivitas')">Batal</button>
            <button type="submit" form="form-edit-aktivitas" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">update</span> Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modal-hapus-aktivitas" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-hapus-aktivitas')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-red-500">delete</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Aktivitas?</h3>
            <p class="text-sm text-gray-500">Aktivitas <strong id="hapus-nama-aktivitas"></strong> akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button class="btn btn-secondary" onclick="closeModal('modal-hapus-aktivitas')">Batal</button>
            <form id="form-hapus-aktivitas" method="post" style="display:inline;">
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
    const modal = document.getElementById('modal-edit-aktivitas');
    const loading = document.getElementById('edit-loading');
    const form = document.getElementById('form-edit-aktivitas');
    if (!modal || !loading || !form) return;

    loading.classList.remove('hidden');
    form.classList.add('hidden');
    openModal('modal-edit-aktivitas');

    fetch(baseUrl + 'admin/get_aktivitas/' + id)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            loading.classList.add('hidden');
            form.classList.remove('hidden');

            var el = document.getElementById('edit-id-aktivitas');
            if (el) el.value = data.id_aktivitas || '';

            el = document.getElementById('edit-nama-aktivitas');
            if (el) el.value = data.nama_aktivitas || '';

            el = document.getElementById('edit-deskripsi-aktivitas');
            if (el) el.value = data.deskripsi || '';

            var iconInput = document.getElementById('edit-icon-input');
            var iconPreview = document.querySelector('#edit-icon-preview .material-symbols-rounded');
            if (iconInput) iconInput.value = data.icon || 'hiking';
            if (iconPreview) iconPreview.textContent = data.icon || 'hiking';

            form.action = baseUrl + 'admin/aktivitas/edit/' + (data.id_aktivitas || id);
        })
        .catch(function() {
            loading.classList.add('hidden');
            form.classList.remove('hidden');
            showToast && showToast('error', 'Gagal memuat data aktivitas');
        });
}

function openDeleteModal(id, nama) {
    document.getElementById('hapus-nama-aktivitas').textContent = nama;
    document.getElementById('form-hapus-aktivitas').action = baseUrl + 'admin/aktivitas/hapus/' + id;
    openModal('modal-hapus-aktivitas');
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
    if (preview) preview.textContent = input ? input.value || 'hiking' : 'hiking';
}
</script>
