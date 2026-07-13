<?php if ($this->session->flashdata('success')): ?>
<?php endif; ?>

<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">place</span>
    </div>
    <div class="page-header-content">
        <h1>Destinasi</h1>
        <p>Kelola daftar destinasi wisata</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div class="search-bar flex-1 w-full sm:w-auto">
        <form method="GET" action="<?= base_url('admin/destinasi'); ?>" class="flex items-center gap-3 w-full">
            <label class="text-slate-400 text-sm font-semibold whitespace-nowrap" style="font-family: 'Inter', sans-serif;">Filter:</label>
            <select name="kota" onchange="this.form.submit()" class="form-input" style="flex:1;">
                <option value="">Semua Kota</option>
                <?php foreach ($kota_list as $kota): ?>
                <option value="<?= urlencode($kota); ?>" <?= $filter_kota == $kota ? 'selected' : ''; ?>><?= $kota; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if ($filter_kota): ?>
            <a href="<?= base_url('admin/destinasi'); ?>" class="btn btn-secondary whitespace-nowrap"><span class="material-symbols-rounded">close</span>Reset</a>
            <?php endif; ?>
        </form>
    </div>
    <button type="button" class="btn btn-primary whitespace-nowrap" onclick="openModal('modal-tambah-destinasi')">
        <span class="material-symbols-rounded text-lg">add</span> Tambah Destinasi
    </button>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-12">#</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Nama</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Kota</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-40 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($destinasi)): ?>
                <?php $start_number = $current_page * 15; ?>
                <?php foreach ($destinasi as $i => $d): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
                    <td class="py-4 px-5 text-slate-400 text-sm font-mono td-no"><?= $start_number + $i + 1; ?></td>
                    <td class="py-4 px-5 font-semibold text-slate-800 text-sm"><?= $d->nama_destinasi; ?></td>
                    <td class="py-4 px-5 text-slate-500 text-sm"><?= $d->kota; ?></td>
                    <td class="py-4 px-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" class="btn btn-primary btn-icon-sm" title="Edit" onclick="openEditModal(<?= $d->id_destinasi; ?>)">
                                <span class="material-symbols-rounded text-sm">edit</span> Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="openDeleteModal(<?= $d->id_destinasi; ?>, '<?= htmlspecialchars($d->nama_destinasi, ENT_QUOTES); ?>')">
                                <span class="material-symbols-rounded text-sm">delete</span> Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="4" class="py-16 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <span class="material-symbols-rounded">place</span>
                        </div>
                        <h3>Belum ada destinasi.</h3>
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
            <a href="<?= base_url('admin/destinasi/' . ($current_page - 1)); ?>" class="pagination-btn prev">Sebelumnya</a>
            <?php endif; ?>
            <?php for ($i = 0; $i < $total_pages; $i++): ?>
            <a href="<?= base_url('admin/destinasi/' . $i); ?>" class="pagination-num <?= $i == $current_page ? 'active' : ''; ?>"><?= $i + 1; ?></a>
            <?php endfor; ?>
            <?php if ($current_page < $total_pages - 1): ?>
            <a href="<?= base_url('admin/destinasi/' . ($current_page + 1)); ?>" class="pagination-btn next">Selanjutnya</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php
$kota_indonesia = [
    'Aceh' => ['Banda Aceh','Sabang','Lhokseumawe','Meulaboh'],
    'Sumatera Utara' => ['Medan','Pematangsiantar','Binjai','Tebing Tinggi'],
    'Sumatera Barat' => ['Padang','Bukittinggi','Payakumbuh','Pariaman'],
    'Riau' => ['Pekanbaru','Dumai','Bangkinang'],
    'Kepulauan Riau' => ['Batam','Tanjung Pinang'],
    'Jambi' => ['Jambi','Muara Bungo'],
    'Sumatera Selatan' => ['Palembang','Prabumulih','Lubuklinggau'],
    'Bengkulu' => ['Bengkulu'],
    'Lampung' => ['Bandar Lampung','Metro'],
    'Bangka Belitung' => ['Pangkal Pinang'],
    'Banten' => ['Tangerang','Cilegon','Serang'],
    'DKI Jakarta' => ['Jakarta Pusat','Jakarta Utara','Jakarta Barat','Jakarta Timur','Jakarta Selatan'],
    'Jawa Barat' => ['Bandung','Bogor','Bekasi','Depok','Cirebon','Sukabumi','Garut','Tasikmalaya'],
    'Jawa Tengah' => ['Semarang','Solo','Magelang','Pekalongan','Salatiga','Kudus','Kendal','Wonosobo'],
    'DI Yogyakarta' => ['Yogyakarta','Sleman','Bantul','Kulon Progo','Gunung Kidul'],
    'Jawa Timur' => ['Surabaya','Malang','Kediri','Blitar','Mojokerto','Jember','Probolinggo','Pasuruan','Gresik','Sidoarjo','Batu','Tulungagung'],
    'Bali' => ['Denpasar','Singaraja','Gianyar','Tabanan','Badung','Klungkung','Karangasem'],
    'Nusa Tenggara Barat' => ['Mataram','Bima','Sumbawa'],
    'Nusa Tenggara Timur' => ['Kupang','Ende','Maumere','Labuan Bajo','Ruteng'],
    'Kalimantan Barat' => ['Pontianak','Singkawang'],
    'Kalimantan Tengah' => ['Palangka Raya'],
    'Kalimantan Selatan' => ['Banjarmasin','Banjarbaru'],
    'Kalimantan Timur' => ['Samarinda','Balikpapan','Bontang','Tenggarong'],
    'Kalimantan Utara' => ['Tanjung Selor','Tarakan'],
    'Sulawesi Utara' => ['Manado','Bitung','Tomohon'],
    'Gorontalo' => ['Gorontalo'],
    'Sulawesi Tengah' => ['Palu','Poso','Toli-Toli'],
    'Sulawesi Barat' => ['Mamuju','Majene'],
    'Sulawesi Selatan' => ['Makassar','Parepare','Palopo','Maros','Gowa'],
    'Sulawesi Tenggara' => ['Kendari','Baubau'],
    'Maluku' => ['Ambon','Tual'],
    'Maluku Utara' => ['Ternate','Tidore'],
    'Papua' => ['Jayapura','Sentani','Wamena'],
    'Papua Barat' => ['Manokwari','Sorong','Fakfak'],
    'Papua Selatan' => ['Merauke'],
    'Papua Tengah' => ['Nabire','Timika'],
    'Papua Pegunungan' => ['Wamena'],
];
?>

<!-- Modal Tambah Destinasi -->
<div id="modal-tambah-destinasi" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-tambah-destinasi')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Tambah Destinasi</span>
            <button class="modal-close" onclick="closeModal('modal-tambah-destinasi')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="form-tambah-destinasi" action="<?= base_url('admin/destinasi/tambah'); ?>" method="post" class="space-y-5">
                <div class="form-group">
                    <label class="form-label">Nama Destinasi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_destinasi" class="form-input" required placeholder="Contoh: Pantai Kuta">
                </div>
                <div class="form-group">
                    <label class="form-label">Kota <span class="text-red-500">*</span></label>
                    <select name="kota" class="form-input" required>
                        <option value="" disabled selected>Pilih Kota</option>
                        <?php foreach ($kota_indonesia as $provinsi => $kotas): ?>
                        <optgroup label="<?= $provinsi; ?>">
                            <?php foreach ($kotas as $k): ?>
                            <option value="<?= $k; ?>"><?= $k; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modal-tambah-destinasi')">Batal</button>
            <button type="submit" form="form-tambah-destinasi" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span> Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Destinasi -->
<div id="modal-edit-destinasi" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-edit-destinasi')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Edit Destinasi</span>
            <button class="modal-close" onclick="closeModal('modal-edit-destinasi')">&times;</button>
        </div>
        <div class="modal-body">
            <div id="edit-loading" class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 animate-spin">refresh</span>
                <p class="text-sm text-slate-500 mt-2">Memuat data...</p>
            </div>
            <form id="form-edit-destinasi" action="" method="post" class="space-y-5 hidden">
                <input type="hidden" name="id_destinasi" id="edit-id-destinasi">
                <div class="form-group">
                    <label class="form-label">Nama Destinasi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_destinasi" id="edit-nama-destinasi" class="form-input" required placeholder="Contoh: Pantai Kuta">
                </div>
                <div class="form-group">
                    <label class="form-label">Kota <span class="text-red-500">*</span></label>
                    <select name="kota" id="edit-kota" class="form-input" required>
                        <option value="" disabled>Pilih Kota</option>
                        <?php foreach ($kota_indonesia as $provinsi => $kotas): ?>
                        <optgroup label="<?= $provinsi; ?>">
                            <?php foreach ($kotas as $k): ?>
                            <option value="<?= $k; ?>"><?= $k; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modal-edit-destinasi')">Batal</button>
            <button type="submit" form="form-edit-destinasi" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">update</span> Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modal-hapus-destinasi" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-hapus-destinasi')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-red-500">delete</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Destinasi?</h3>
            <p class="text-sm text-gray-500">Destinasi <strong id="hapus-nama-destinasi"></strong> akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button class="btn btn-secondary" onclick="closeModal('modal-hapus-destinasi')">Batal</button>
            <form id="form-hapus-destinasi" method="post" style="display:inline;">
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
    const modal = document.getElementById('modal-edit-destinasi');
    const loading = document.getElementById('edit-loading');
    const form = document.getElementById('form-edit-destinasi');
    if (!modal || !loading || !form) return;

    loading.classList.remove('hidden');
    form.classList.add('hidden');
    openModal('modal-edit-destinasi');

    fetch(baseUrl + 'admin/get_destinasi/' + id)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            loading.classList.add('hidden');
            form.classList.remove('hidden');

            var el = document.getElementById('edit-id-destinasi');
            if (el) el.value = data.id_destinasi || '';

            el = document.getElementById('edit-nama-destinasi');
            if (el) el.value = data.nama_destinasi || '';

            el = document.getElementById('edit-kota');
            if (el && data.kota) el.value = data.kota;

            form.action = baseUrl + 'admin/destinasi/edit/' + (data.id_destinasi || id);
        })
        .catch(function() {
            loading.classList.add('hidden');
            form.classList.remove('hidden');
            showToast && showToast('error', 'Gagal memuat data destinasi');
        });
}

function openDeleteModal(id, nama) {
    document.getElementById('hapus-nama-destinasi').textContent = nama;
    document.getElementById('form-hapus-destinasi').action = baseUrl + 'admin/destinasi/hapus/' + id;
    openModal('modal-hapus-destinasi');
}
</script>
