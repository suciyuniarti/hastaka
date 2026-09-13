<?php if ($this->session->flashdata('success')): ?>
<?php endif; ?>

<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">hotel</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Akomodasi</h1>
        <p><?= $total_akomodasi ?? count($akomodasi ?? []); ?> akomodasi terdaftar</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div></div>
    <button type="button" class="btn btn-primary whitespace-nowrap" onclick="openModal('modal-tambah-akomodasi')">
        <span class="material-symbols-rounded text-lg">add</span> Tambah Akomodasi
    </button>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-12">#</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-20">Icon</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Nama Akomodasi</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Wilayah</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Deskripsi</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Harga/Orang</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-24 text-center">Paket</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-28 text-center">Status</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($akomodasi)): ?>
<?php foreach ($akomodasi as $i => $a): 
                    $wilayah = !empty($a->wilayah) ? $a->wilayah : '-';
                    if (strlen($wilayah) > 40) {
                        $wilayah = substr($wilayah, 0, 40) . '...';
                    }
                    $jumlah_paket = count($a->paket_list ?? []);
                ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?> <?= ($a->is_active != 'y' && $a->is_active != 1) ? 'opacity-60' : ''; ?>">
                    <td class="py-4 px-5 text-slate-400 text-sm font-mono td-no"><?= $i + 1; ?></td>
                    <td class="py-4 px-5">
                        <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600">
                            <span class="material-symbols-rounded text-xl"><?= $a->icon; ?></span>
                        </div>
                    </td>
                    <td class="py-4 px-5 font-semibold text-slate-800 text-sm">
                        <?= $a->nama_akomodasi; ?>
                        <?php if ($a->is_active != 'y' && $a->is_active != 1): ?>
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                Nonaktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-5 text-slate-600 text-sm">
                        <div class="truncate max-w-xs" title="<?= htmlspecialchars($a->wilayah ?? '', ENT_QUOTES); ?>"><?= $wilayah; ?></div>
                    </td>
                    <td class="py-4 px-5 text-slate-600 text-sm">
                        <?php if (!empty($a->deskripsi)): ?>
                        <span class="truncate max-w-xs inline-block align-middle" style="max-width:160px;" title="<?= htmlspecialchars($a->deskripsi, ENT_QUOTES); ?>"><?= character_limiter($a->deskripsi, 50); ?></span>
                        <?php else: ?>
                        <span class="text-slate-400">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-5 text-slate-600 text-sm whitespace-nowrap">
                        <?php if ($a->harga_tambahan > 0): ?>
                            Rp <?= number_format($a->harga_tambahan, 0, ',', '.'); ?> <span class="text-xs text-slate-400">/orang</span>
                        <?php else: ?>
                            <span class="text-slate-400">Gratis</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-5 text-center text-sm">
                        <?php if ($jumlah_paket > 0): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-brand-50 border border-brand-200 rounded-lg text-xs font-bold text-brand-700">
                                <span class="material-symbols-rounded text-[14px]">luggage</span>
                                <?= $jumlah_paket; ?> paket
                            </span>
                        <?php else: ?>
                            <span class="text-slate-400">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-5 text-center">
                        <?php if ($a->is_active == 'y' || $a->is_active == 1): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 border border-emerald-200 rounded-lg text-xs font-bold text-emerald-700 cursor-pointer hover:bg-emerald-100 transition" onclick="toggleStatus(<?= $a->id_akomodasi; ?>, 'nonaktif', '<?= htmlspecialchars($a->nama_akomodasi, ENT_QUOTES); ?>')" title="Klik untuk menonaktifkan">
                                <span class="material-symbols-rounded text-[14px]">check_circle</span> Aktif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-red-50 border border-red-200 rounded-lg text-xs font-bold text-red-700 cursor-pointer hover:bg-red-100 transition" onclick="toggleStatus(<?= $a->id_akomodasi; ?>, 'aktif', '<?= htmlspecialchars($a->nama_akomodasi, ENT_QUOTES); ?>')" title="Klik untuk mengaktifkan">
                                <span class="material-symbols-rounded text-[14px]">cancel</span> Nonaktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" class="btn btn-primary btn-icon-sm" title="Edit" onclick="openEditModal(<?= $a->id_akomodasi; ?>)">
                                <span class="material-symbols-rounded text-sm">edit</span> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="openDeleteModal(<?= $a->id_akomodasi; ?>, '<?= htmlspecialchars($a->nama_akomodasi, ENT_QUOTES); ?>')">
                                <span class="material-symbols-rounded text-sm">delete</span> Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
<tr><td colspan="9" class="py-16 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <span class="material-symbols-rounded">hotel</span>
                        </div>
                        <h3>Belum ada akomodasi.</h3>
                        <p class="text-slate-400 text-sm mt-1">Mulai dengan menambahkan akomodasi pertama</p>
                    </div>
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Akomodasi -->
<div id="modal-tambah-akomodasi" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-tambah-akomodasi')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Tambah Akomodasi</span>
            <button class="modal-close" onclick="closeModal('modal-tambah-akomodasi')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <form id="form-tambah-akomodasi" action="<?= base_url('admin/akomodasi/tambah'); ?>" method="post" enctype="multipart/form-data" class="space-y-5">
                <div class="form-group">
                    <label class="form-label">Nama Akomodasi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_akomodasi" class="form-input" required placeholder="Contoh: Hotel Bintang 3">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Material Symbols) <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="icon" id="tambah-icon-input" class="form-input flex-1" value="hotel" placeholder="hotel, directions_bus, flight, etc." onchange="updateIconPreview('tambah')">
                        <div id="tambah-icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                            <span class="material-symbols-rounded text-2xl">hotel</span>
                        </div>
                    </div>
                    <p class="form-help">Gunakan nama icon dari Material Symbols</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga Tambahan per Orang (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="harga_tambahan" id="tambah-harga" class="form-input" min="0" placeholder="0" required oninput="formatRupiah('tambah')">
                    <p class="form-help">Harga ini akan dikali jumlah peserta saat pelanggan booking</p>
                    <p class="text-xs text-slate-500 mt-1">Preview: <strong id="tambah-harga-preview">Rp 0</strong></p>
                </div>
                <div class="form-group">
                    <label class="form-label">Wilayah</label>
                    <input type="text" name="wilayah" class="form-input" placeholder="contoh: Jabodetabek, Bandung, Surabaya">
                    <p class="form-help">Informasi wilayah yang dilayani. Akan ditampilkan ke pelanggan saat booking.</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-input" placeholder="Deskripsi akomodasi..." maxlength="200" oninput="updateCharCount(this)"></textarea>
                    <div class="flex justify-between mt-1">
                        <p class="form-help">Maksimal 200 karakter</p>
                        <p class="text-xs text-slate-500"><span id="tambah-char-count">0</span>/200</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status <span class="text-red-500">*</span></label>
                    <select name="is_active" class="form-input" required>
                        <option value="y" selected>Aktif</option>
                        <option value="n">Non-Aktif</option>
                    </select>
                    <p class="form-help">Akomodasi non-aktif tidak akan muncul di form booking</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Tersedia Di Paket <span class="text-red-500">*</span></label>
                    <p class="form-help" style="margin-bottom: 8px;">Pilih minimal 1 paket wisata yang menggunakan akomodasi ini</p>
                    <div class="checkbox-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                        <?php foreach ($paket_list as $p): ?>
                        <label class="checkbox-item" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px; cursor: pointer; transition: all 0.2s; font-size: 13px; font-weight: 500; color: #475569;">
                            <input type="checkbox" name="paket[]" value="<?= $p->id_paket; ?>" style="accent-color: #0ea5e9; width: 16px; height: 16px;" onchange="updatePaketCheckbox(this)">
                            <span style="flex: 1;"><?= $p->nama_paket; ?></span>
                            <span style="font-size: 11px; color: #64748b; font-weight: 600;"><?= $p->durasi_hari; ?>H</span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="form-help" id="tambah-paket-count" style="margin-top: 8px;">0 paket dipilih</p>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-tambah-akomodasi" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span> Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Akomodasi -->
<div id="modal-edit-akomodasi" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-edit-akomodasi')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Edit Akomodasi</span>
            <button class="modal-close" onclick="closeModal('modal-edit-akomodasi')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <div id="edit-loading" class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 animate-spin">refresh</span>
                <p class="text-sm text-slate-500 mt-2">Memuat data...</p>
            </div>
            <form id="form-edit-akomodasi" action="" method="post" enctype="multipart/form-data" class="space-y-5 hidden">
                <input type="hidden" name="id_akomodasi" id="edit-id-akomodasi">
                <div class="form-group">
                    <label class="form-label">Nama Akomodasi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_akomodasi" id="edit-nama-akomodasi" class="form-input" required placeholder="Contoh: Hotel Bintang 3">
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Material Symbols) <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="text" name="icon" id="edit-icon-input" class="form-input flex-1" placeholder="hotel, directions_bus, flight, etc." onchange="updateIconPreview('edit')">
                        <div id="edit-icon-preview" class="w-12 h-12 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600 shadow-sm">
                            <span class="material-symbols-rounded text-2xl">hotel</span>
                        </div>
                    </div>
                    <p class="form-help">Gunakan nama icon dari Material Symbols</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga Tambahan per Orang (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="harga_tambahan" id="edit-harga" class="form-input" min="0" placeholder="0" required oninput="formatRupiah('edit')">
                    <p class="form-help">Harga ini akan dikali jumlah peserta saat pelanggan booking</p>
                    <p class="text-xs text-slate-500 mt-1">Preview: <strong id="edit-harga-preview">Rp 0</strong></p>
                </div>
                <div class="form-group">
                    <label class="form-label">Wilayah</label>
                    <input type="text" name="wilayah" id="edit-wilayah" class="form-input" placeholder="contoh: Jabodetabek, Bandung, Surabaya">
                    <p class="form-help">Informasi wilayah yang dilayani. Akan ditampilkan ke pelanggan saat booking.</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="edit-deskripsi-akomodasi" rows="3" class="form-input" placeholder="Deskripsi akomodasi..." maxlength="200" oninput="updateCharCount(this)"></textarea>
                    <div class="flex justify-between mt-1">
                        <p class="form-help">Maksimal 200 karakter</p>
                        <p class="text-xs text-slate-500"><span id="edit-char-count">0</span>/200</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status <span class="text-red-500">*</span></label>
                    <select name="is_active" id="edit-is-active" class="form-input" required>
                        <option value="y">Aktif</option>
                        <option value="n">Non-Aktif</option>
                    </select>
                    <p class="form-help">Akomodasi non-aktif tidak akan muncul di form booking</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Tersedia Di Paket <span class="text-red-500">*</span></label>
                    <p class="form-help" style="margin-bottom: 8px;">Pilih minimal 1 paket wisata yang menggunakan akomodasi ini</p>
                    <div class="checkbox-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;" id="edit-paket-grid">
                        <?php foreach ($paket_list as $p): ?>
                        <label class="checkbox-item" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px; cursor: pointer; transition: all 0.2s; font-size: 13px; font-weight: 500; color: #475569;">
                            <input type="checkbox" name="paket[]" value="<?= $p->id_paket; ?>" class="edit-paket-check" style="accent-color: #0ea5e9; width: 16px; height: 16px;" onchange="updatePaketCheckbox(this)">
                            <span style="flex: 1;"><?= $p->nama_paket; ?></span>
                            <span style="font-size: 11px; color: #64748b; font-weight: 600;"><?= $p->durasi_hari; ?>H</span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="form-help" id="edit-paket-count" style="margin-top: 8px;">0 paket dipilih</p>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-edit-akomodasi" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">update</span> Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modal-hapus-akomodasi" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-hapus-akomodasi')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-red-500">delete</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Akomodasi?</h3>
            <p class="text-sm text-gray-500">Akomodasi <strong id="hapus-nama-akomodasi"></strong> akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <form id="form-hapus-akomodasi" method="post" style="display:inline;">
                <button type="submit" class="btn btn-danger">
                    <span class="material-symbols-rounded text-sm">delete</span> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Toggle Status -->
<div id="modal-toggle-status" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-toggle-status')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-blue-500">toggle_on</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Ubah Status Akomodasi?</h3>
            <p class="text-sm text-gray-500">Yakin ingin mengubah status <strong id="toggle-status-nama"></strong> menjadi <strong id="toggle-status-action" class="font-bold"></strong>?</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="button" class="btn btn-primary" onclick="confirmToggleStatus()">
                <span class="material-symbols-rounded text-sm">check</span> Ya, Ubah
            </button>
        </div>
    </div>
</div>

<script>
const baseUrl = '<?= base_url(); ?>';

function updatePaketCount(prefix) {
    if (prefix === 'tambah') {
        var count = document.querySelectorAll('#modal-tambah-akomodasi input[name="paket[]"]:checked').length;
        var el = document.getElementById('tambah-paket-count');
    } else {
        var count = document.querySelectorAll('#modal-edit-akomodasi input[name="paket[]"]:checked').length;
        var el = document.getElementById('edit-paket-count');
    }
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
    var modalId = checkbox.closest('.modal-overlay').id;
    var prefix = modalId.includes('tambah') ? 'tambah' : 'edit';
    updatePaketCount(prefix);
}

function formatRupiah(prefix) {
    var input, preview;
    if (prefix === 'tambah') {
        input = document.getElementById('tambah-harga');
        preview = document.getElementById('tambah-harga-preview');
    } else {
        input = document.getElementById('edit-harga');
        preview = document.getElementById('edit-harga-preview');
    }
    if (preview) {
        preview.textContent = 'Rp ' + parseInt(input ? input.value || 0 : 0).toLocaleString('id-ID');
    }
}

function updateCharCount(textarea) {
    var modalId = textarea.closest('.modal-overlay').id;
    var prefix = modalId.includes('tambah') ? 'tambah' : 'edit';
    var counter = document.getElementById(prefix + '-char-count');
    if (counter) counter.textContent = textarea.value.length;
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
    if (preview) preview.textContent = input ? input.value || 'hotel' : 'hotel';
}

function openEditModal(id) {
    const modal = document.getElementById('modal-edit-akomodasi');
    const loading = document.getElementById('edit-loading');
    const form = document.getElementById('form-edit-akomodasi');
    if (!modal || !loading || !form) return;

    loading.classList.remove('hidden');
    form.classList.add('hidden');
    openModal('modal-edit-akomodasi');

    fetch(baseUrl + 'admin/get_akomodasi/' + id)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            loading.classList.add('hidden');
            form.classList.remove('hidden');

            var el = document.getElementById('edit-id-akomodasi');
            if (el) el.value = data.id_akomodasi || '';

            el = document.getElementById('edit-nama-akomodasi');
            if (el) el.value = data.nama_akomodasi || '';

            el = document.getElementById('edit-icon-input');
            if (el) el.value = data.icon || 'hotel';
            var iconPreview = document.querySelector('#edit-icon-preview .material-symbols-rounded');
            if (iconPreview) iconPreview.textContent = data.icon || 'hotel';

            el = document.getElementById('edit-harga');
            if (el) el.value = data.harga_tambahan || 0;
            formatRupiah('edit');

            el = document.getElementById('edit-wilayah');
            if (el) el.value = data.wilayah || '';

            el = document.getElementById('edit-deskripsi-akomodasi');
            if (el) el.value = data.deskripsi || '';
            var counter = document.getElementById('edit-char-count');
            if (counter) counter.textContent = data.deskripsi ? data.deskripsi.length : 0;

            el = document.getElementById('edit-is-active');
            if (el && data.is_active) el.value = data.is_active;

            document.querySelectorAll('#modal-edit-akomodasi input[name="paket[]"]').forEach(function(chk) {
                chk.checked = (data.selected_paket || []).includes(parseInt(chk.value));
                updatePaketCheckbox(chk);
            });

            form.action = baseUrl + 'admin/akomodasi/edit/' + (data.id_akomodasi || id);
        })
        .catch(function() {
            loading.classList.add('hidden');
            form.classList.remove('hidden');
            showToast && showToast('error', 'Gagal memuat data akomodasi');
        });
}

function openDeleteModal(id, nama) {
    document.getElementById('hapus-nama-akomodasi').textContent = nama;
    document.getElementById('form-hapus-akomodasi').action = baseUrl + 'admin/akomodasi/hapus/' + id;
    openModal('modal-hapus-akomodasi');
}

var pendingToggleId = null;
var pendingToggleStatus = null;
var pendingToggleNama = null;

function toggleStatus(id, newStatus, nama) {
    pendingToggleId = id;
    pendingToggleStatus = newStatus;
    pendingToggleNama = nama || '';
    
    var namaEl = document.getElementById('toggle-status-nama');
    var actionEl = document.getElementById('toggle-status-action');
    if (namaEl && actionEl) {
        namaEl.textContent = pendingToggleNama;
        actionEl.textContent = newStatus === 'aktif' ? 'Aktif' : 'Nonaktif';
    }
    
    openModal('modal-toggle-status');
}

function confirmToggleStatus() {
    if (!pendingToggleId || !pendingToggleStatus) {
        tutupModal();
        return;
    }
    
    fetch(baseUrl + 'admin/akomodasi/toggle_status/' + pendingToggleId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({})
    })
    .then(function(response) { 
        return response.json().then(function(data) {
            if (!response.ok) {
                throw new Error(data.message || 'HTTP error ' + response.status);
            }
            return data;
        });
    })
    .then(function(data) {
        tutupModal();
        if (data.success) {
            showToast && showToast('success', 'Status berhasil diubah menjadi ' + (pendingToggleStatus === 'aktif' ? 'Aktif' : 'Nonaktif'));
            setTimeout(function() {
                location.reload();
            }, 1000);
        } else {
            showToast && showToast('error', 'Gagal mengubah status: ' + data.message);
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
        tutupModal();
        showToast && showToast('error', 'Terjadi kesalahan: ' + error.message);
    });
    
    pendingToggleId = null;
    pendingToggleStatus = null;
    pendingToggleNama = null;
}

document.addEventListener('DOMContentLoaded', function() {
    updatePaketCount('tambah');
    document.querySelectorAll('#modal-tambah-akomodasi input[name="paket[]"]').forEach(function(cb) {
        updatePaketCheckbox(cb);
    });
    formatRupiah('tambah');
});
</script>
