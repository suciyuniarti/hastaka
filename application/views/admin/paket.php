<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">luggage</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Paket Wisata</h1>
        <p><?= $total_paket ?? count($paket ?? []); ?> paket terdaftar</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div class="search-bar flex-1 w-full sm:w-auto">
        <form method="GET" action="<?= base_url('admin/paket'); ?>" class="flex gap-3 w-full">
            <div class="relative flex-1">
                <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                <input type="text" name="keyword" placeholder="Cari nama paket..." value="<?= htmlspecialchars($keyword ?? ''); ?>" class="w-full pl-11">
            </div>
            <button type="submit" class="btn btn-primary whitespace-nowrap"><span class="material-symbols-rounded">search</span> Cari</button>
            <?php if (!empty($keyword)): ?>
            <a href="<?= base_url('admin/paket'); ?>" class="btn btn-secondary whitespace-nowrap"><span class="material-symbols-rounded">close</span> Reset</a>
            <?php endif; ?>
        </form>
    </div>
    <a href="<?= base_url('admin/paket/tambah'); ?>" class="btn btn-primary whitespace-nowrap" onclick="openModal('modal-tambah'); return false;"><span class="material-symbols-rounded text-lg">add</span> Tambah Paket</a>
</div>

<?php if (!empty($keyword)): ?>
<p style="font-size:13px;color:#6b7280;margin-bottom:12px">
    Menampilkan hasil pencarian untuk "<strong><?= htmlspecialchars($keyword); ?></strong>" — <?= count($paket); ?> paket ditemukan
</p>
<?php endif; ?>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table text-sm min-w-[900px]">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider w-12">#</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider w-28">Foto</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-left">Nama Paket</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-right w-36">Harga</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-24">Durasi</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-28">Status</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-52">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($paket)): ?>
                <?php foreach ($paket as $i => $p): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap">
                    <td class="py-4 px-4 text-slate-400 text-sm font-mono"><?= $i + 1; ?></td>
                    <td class="py-4 px-4">
                        <div class="relative group">
                            <img src="<?= base_url('application/assets/images/paket/' . $p->foto . '?v=' . time()); ?>"
                                class="w-20 h-16 object-cover rounded-xl shadow-sm border border-slate-200 group-hover:border-sky-300 transition"
                                onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                        </div>
                    </td>
                    <td class="py-4 px-4 whitespace-normal">
                        <div class="font-semibold text-slate-800"><?= $p->nama_paket; ?></div>
                        <div class="text-xs text-slate-500 mt-0.5"><?= $p->jumlah_destinasi ?? 0; ?> Destinasi &bull; <?= $p->jumlah_aktivitas ?? 0; ?> Aktivitas</div>
                    </td>
                    <td class="py-4 px-4 text-right whitespace-nowrap">
                        <div class="font-bold text-slate-800">Rp <?= number_format($p->harga, 0, ',', '.'); ?></div>
                        <div class="text-xs text-slate-500 mt-0.5">/orang</div>
                    </td>
                    <td class="py-4 px-4 text-center whitespace-nowrap">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-50 rounded-lg border border-sky-100">
                            <span class="material-symbols-rounded text-sky-600 text-[16px]">schedule</span>
                            <span class="font-semibold text-sm"><?= $p->durasi_hari; ?></span>
                        </span>
                        <div class="text-xs text-slate-500 mt-1">Hari</div>
                    </td>
                    <td class="py-4 px-4 text-center whitespace-nowrap">
<span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold <?= $p->status == 'tersedia' ? 'badge-tersedia' : 'badge-habis'; ?>">
                            <span class="w-2 h-2 rounded-full <?= $p->status == 'tersedia' ? 'bg-emerald-500' : 'bg-red-500'; ?>"></span>
                            <?= $p->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia'; ?>
                        </span>
                    </td>
                    <td class="py-4 px-4 whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" class="btn btn-warning btn-icon-sm" title="Nilai" onclick="lihatNilai(<?= $p->id_paket; ?>)"><span class="material-symbols-rounded text-sm">star</span> Nilai</button>
                            <button type="button" class="btn btn-primary btn-icon-sm" title="Edit" onclick="openEditModal(<?= $p->id_paket; ?>)"><span class="material-symbols-rounded text-sm">edit</span> Edit</button>
                            <button type="button" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="openDeleteModal(<?= $p->id_paket; ?>, '<?= htmlspecialchars($p->nama_paket, ENT_QUOTES); ?>')"><span class="material-symbols-rounded text-sm">delete</span> Hapus</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="7" class="py-16 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <span class="material-symbols-rounded">luggage</span>
                        </div>
                        <h3>Belum ada paket wisata.</h3>
                        <p class="text-slate-400 text-sm mt-1">Mulai dengan menambahkan paket wisata pertama Anda</p>
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
            <a href="<?= base_url('admin/paket/' . ($current_page - 1)); ?>" class="pagination-btn prev">Sebelumnya</a>
            <?php endif; ?>
            <?php if ($current_page < $total_pages - 1): ?>
            <a href="<?= base_url('admin/paket/' . ($current_page + 1)); ?>" class="pagination-btn next">Selanjutnya</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah Paket -->
<div id="modal-tambah" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-tambah')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Tambah Paket Wisata</span>
            <button class="modal-close" onclick="closeModal('modal-tambah')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <form id="form-tambah-paket" action="<?= base_url('admin/paket/tambah'); ?>" method="post" enctype="multipart/form-data" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="form-label">Nama Paket <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_paket" class="form-input" required placeholder="Contoh: Paket Wisata Bali 3 Hari 2 Malam">
                    </div>
                    <div>
                        <label class="form-label">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="harga" class="form-input" required placeholder="2500000">
                    </div>
                    <div>
                        <label class="form-label">Durasi (Hari) <span class="text-red-500">*</span></label>
                        <input type="number" name="durasi_hari" class="form-input" min="1" required placeholder="3">
                    </div>
                    <div>
                        <label class="form-label">Min. Peserta</label>
                        <input type="number" name="min_peserta" class="form-input" value="10" min="1">
                        <p class="form-help">Jumlah minimal peserta</p>
                    </div>
                    <div>
                        <label class="form-label">Status</label>
<select name="status" class="form-input">
                            <option value="tersedia">Tersedia</option>
                            <option value="penuh">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label">Foto Paket</label>
                        <div class="file-upload">
                            <input type="file" name="foto" id="input_foto_tambah" accept="image/*">
                            <span class="material-symbols-rounded file-upload-icon">image</span>
                            <p class="file-upload-text">Klik untuk upload foto paket</p>
                            <p class="file-upload-hint">Format: JPG, JPEG. Maks 2MB.</p>
                        </div>
                        <div id="preview-tambah" style="display:none; margin-top:8px">
                            <img id="img-preview-tambah" style="width:100%; max-height:200px; object-fit:cover; border-radius:8px; border:0.5px solid #e5e7eb">
                            <p style="font-size:11px; color:#6b7280; margin-top:4px">Preview foto yang akan diupload</p>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" rows="4" class="form-input" required placeholder="Deskripsi lengkap paket wisata..."></textarea>
                    </div>
                    <?php if (!empty($destinasi_list)): ?>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="material-symbols-rounded text-[16px]">place</span> Destinasi
                            <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-[160px] overflow-y-auto pr-1">
                            <?php foreach ($destinasi_list as $d): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="destinasi[]" value="<?= $d->id_destinasi; ?>">
                                <span class="text-xs"><?= $d->nama_destinasi; ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($fasilitas_list)): ?>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="material-symbols-rounded text-[16px]">inventory_2</span> Fasilitas Include
                            <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-[160px] overflow-y-auto pr-1">
                            <?php foreach ($fasilitas_list as $f): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="fasilitas[]" value="<?= $f->id_fasilitas; ?>">
                                <span class="material-symbols-rounded text-[16px]"><?= $f->icon; ?></span>
                                <span class="text-xs"><?= $f->nama_fasilitas; ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($aktivitas_list)): ?>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="material-symbols-rounded text-[16px]">hiking</span> Aktivitas Include
                            <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-[160px] overflow-y-auto pr-1">
                            <?php foreach ($aktivitas_list as $a): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="aktivitas[]" value="<?= $a->id_aktivitas; ?>">
                                <span class="material-symbols-rounded text-[16px]"><?= $a->icon; ?></span>
                                <span class="text-xs"><?= $a->nama_aktivitas; ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-tambah-paket" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span> Simpan Paket
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Paket -->
<div id="modal-edit" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-edit')">
    <div class="modal-box modal-md">
        <div class="modal-header">
            <span class="modal-title">Edit Paket Wisata</span>
            <button class="modal-close" onclick="closeModal('modal-edit')"><span class="material-symbols-rounded">close</span></button>
        </div>
        <div class="modal-body">
            <div id="edit-loading" class="text-center py-8">
                <span class="material-symbols-rounded text-4xl text-slate-300 animate-spin">refresh</span>
                <p class="text-sm text-slate-500 mt-2">Memuat data...</p>
            </div>
            <form id="form-edit-paket" action="" method="post" enctype="multipart/form-data" class="space-y-5 hidden">
                <input type="hidden" name="id_paket" id="edit-id-paket">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="form-label">Nama Paket <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_paket" id="edit-nama" class="form-input" required placeholder="Contoh: Paket Wisata Bali 3 Hari 2 Malam">
                    </div>
                    <div>
                        <label class="form-label">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="harga" id="edit-harga" class="form-input" required placeholder="2500000">
                    </div>
                    <div>
                        <label class="form-label">Durasi (Hari) <span class="text-red-500">*</span></label>
                        <input type="number" name="durasi_hari" id="edit-durasi" class="form-input" min="1" required placeholder="3">
                    </div>
                    <div>
                        <label class="form-label">Min. Peserta</label>
                        <input type="number" name="min_peserta" id="edit-min-peserta" class="form-input" value="10" min="1">
                        <p class="form-help">Jumlah minimal peserta</p>
                    </div>
                    <div>
                        <label class="form-label">Status</label>
<select name="status" id="edit-status" class="form-input">
                            <option value="tersedia">Tersedia</option>
                            <option value="penuh">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label">Foto Paket</label>
                        <div id="preview-edit" style="margin-bottom:8px">
                            <p style="font-size:11px; color:#6b7280; margin-bottom:4px">Foto saat ini:</p>
                            <img id="img-current" style="width:100%; max-height:150px; object-fit:cover; border-radius:8px; border:0.5px solid #e5e7eb">
                        </div>
                        <div class="file-upload">
                            <input type="file" name="foto" id="input_foto_edit" accept="image/*">
                            <span class="material-symbols-rounded file-upload-icon">image</span>
                            <p class="file-upload-text">Klik untuk mengganti foto paket</p>
                            <p class="file-upload-hint">Format: JPG, JPEG. Maks 2MB.</p>
                        </div>
                        <div id="preview-edit-baru" style="display:none; margin-top:8px">
                            <p style="font-size:11px; color:#6b7280; margin-bottom:4px">Preview foto baru:</p>
                            <img id="img-preview-edit" style="width:100%; max-height:150px; object-fit:cover; border-radius:8px; border:0.5px solid #0ea5e9">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" id="edit-deskripsi" rows="4" class="form-input" required placeholder="Deskripsi lengkap paket wisata..."></textarea>
                    </div>
                    <?php if (!empty($destinasi_list)): ?>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="material-symbols-rounded text-[16px]">place</span> Destinasi
                            <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-[160px] overflow-y-auto pr-1">
                            <?php foreach ($destinasi_list as $d): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="destinasi[]" value="<?= $d->id_destinasi; ?>" class="edit-destinasi">
                                <span class="text-xs"><?= $d->nama_destinasi; ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($fasilitas_list)): ?>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="material-symbols-rounded text-[16px]">inventory_2</span> Fasilitas Include
                            <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-[160px] overflow-y-auto pr-1">
                            <?php foreach ($fasilitas_list as $f): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="fasilitas[]" value="<?= $f->id_fasilitas; ?>" class="edit-fasilitas">
                                <span class="material-symbols-rounded text-[16px]"><?= $f->icon; ?></span>
                                <span class="text-xs"><?= $f->nama_fasilitas; ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($aktivitas_list)): ?>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2 mb-3">
                            <span class="material-symbols-rounded text-[16px]">hiking</span> Aktivitas Include
                            <span class="text-slate-400 font-normal">(Centang yang termasuk)</span>
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-[160px] overflow-y-auto pr-1">
                            <?php foreach ($aktivitas_list as $a): ?>
                            <label class="checkbox-item">
                                <input type="checkbox" name="aktivitas[]" value="<?= $a->id_aktivitas; ?>" class="edit-aktivitas">
                                <span class="material-symbols-rounded text-[16px]"><?= $a->icon; ?></span>
                                <span class="text-xs"><?= $a->nama_aktivitas; ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="submit" form="form-edit-paket" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">update</span> Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modal-hapus" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-hapus')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-red-500">delete</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Paket Wisata?</h3>
            <p class="text-sm text-gray-500">Paket <strong id="hapus-nama-paket"></strong> akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <form id="form-hapus-paket" method="post" style="display:inline;">
                <button type="submit" class="btn btn-danger">
                    <span class="material-symbols-rounded text-sm">delete</span> Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Nilai Alternatif -->
<div id="modalNilai" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center">
  <div style="background:white;border-radius:16px;width:600px;max-width:95vw;max-height:90vh;overflow-y:auto">
    <div style="padding:20px 24px;border-bottom:0.5px solid #e5e7eb;display:flex;justify-content:space-between;align-items:flex-start">
      <div>
        <h3 style="font-size:16px;font-weight:600;color:#0f172a;margin:0">Detail Nilai Alternatif</h3>
        <p id="nilai-nama-paket" style="font-size:13px;color:#6b7280;margin:4px 0 0 0"></p>
      </div>
      <button onclick="tutupModalNilai()" style="background:none;border:none;font-size:20px;color:#9ca3af;cursor:pointer;padding:0;line-height:1">✕</button>
    </div>
    <div style="margin:16px 24px 0;background:#FEF3C7;border:0.5px solid #FCD34D;border-radius:8px;padding:10px 14px">
      <p style="font-size:12px;color:#92400E;margin:0">⚠ Nilai ini diambil otomatis dari data paket wisata dan tidak dapat diedit untuk menjaga akurasi perhitungan SAW.</p>
    </div>
    <div id="nilai-loading" style="padding:40px;text-align:center;color:#6b7280;font-size:13px">Memuat data...</div>
    <div id="nilai-content" style="display:none;padding:16px 24px">
      <table style="width:100%;border-collapse:collapse;font-size:13px">
        <thead>
          <tr style="background:#0ea5e9">
            <th style="padding:8px 12px;color:white;text-align:center;font-weight:500;font-size:12px">Kode</th>
            <th style="padding:8px 12px;color:white;text-align:left;font-weight:500;font-size:12px">Kriteria</th>
            <th style="padding:8px 12px;color:white;text-align:center;font-weight:500;font-size:12px">Sifat</th>
            <th style="padding:8px 12px;color:white;text-align:center;font-weight:500;font-size:12px">Nilai</th>
            <th style="padding:8px 12px;color:white;text-align:left;font-weight:500;font-size:12px">Sumber Data</th>
          </tr>
        </thead>
        <tbody id="nilai-tabel-body"></tbody>
      </table>
    </div>
    <div style="padding:16px 24px;border-top:0.5px solid #e5e7eb;display:flex;justify-content:flex-end">
      <button onclick="tutupModalNilai()" style="padding:8px 20px;border:0.5px solid #e5e7eb;border-radius:8px;background:white;font-size:13px;cursor:pointer;color:#374151">Tutup</button>
    </div>
  </div>
</div>

<script>
  const baseUrl = '<?= base_url(); ?>';

  function openEditModal(id) {
      const modal = document.getElementById('modal-edit');
      const loading = document.getElementById('edit-loading');
      const form = document.getElementById('form-edit-paket');
      if (!modal || !loading || !form) return;

      loading.classList.remove('hidden');
      form.classList.add('hidden');
      openModal('modal-edit');

      fetch('<?= base_url('admin/get_data/'); ?>' + id)
          .then(function(r) { return r.json(); })
          .then(function(data) {
              loading.classList.add('hidden');
              form.classList.remove('hidden');

              var el = document.getElementById('edit-id-paket');
              if (el) el.value = data.id_paket || '';

              el = document.getElementById('edit-nama');
              if (el) el.value = data.nama_paket || '';

              el = document.getElementById('edit-deskripsi');
              if (el) el.value = data.deskripsi || '';

              el = document.getElementById('edit-harga');
              if (el) el.value = data.harga != null ? data.harga : '';

              el = document.getElementById('edit-durasi');
              if (el) el.value = data.durasi_hari != null ? data.durasi_hari : '';

              el = document.getElementById('edit-min-peserta');
              if (el) el.value = data.min_peserta || 1;

              el = document.getElementById('edit-status');
              if (el && data.status) el.value = data.status;

              document.querySelectorAll('.edit-destinasi').forEach(function(chk) {
                  chk.checked = (data.selected_destinasi || []).includes(parseInt(chk.value));
              });
              document.querySelectorAll('.edit-fasilitas').forEach(function(chk) {
                  chk.checked = (data.selected_fasilitas || []).includes(parseInt(chk.value));
              });
              document.querySelectorAll('.edit-aktivitas').forEach(function(chk) {
                  chk.checked = (data.selected_aktivitas || []).includes(parseInt(chk.value));
              });

              var previewEdit = document.getElementById('preview-edit');
              var imgCurrent = document.getElementById('img-current');
              if (previewEdit && imgCurrent) {
                  if (data.foto) {
                      previewEdit.style.display = 'block';
                      imgCurrent.src = baseUrl + 'application/assets/images/paket/' + encodeURIComponent(data.foto) + '?v=' + Date.now();
                  } else {
                      previewEdit.style.display = 'none';
                      imgCurrent.src = '';
                  }
              }

              var previewEditBaru = document.getElementById('preview-edit-baru');
              var inputFotoEdit = document.getElementById('input_foto_edit');
              if (previewEditBaru) previewEditBaru.style.display = 'none';
              if (inputFotoEdit) inputFotoEdit.value = '';

              form.action = '<?= base_url('admin/paket/edit/'); ?>' + (data.id_paket || id);
          })
          .catch(function(err) {
              loading.classList.add('hidden');
              form.classList.remove('hidden');
              showToast && showToast('error', 'Gagal memuat data paket');
          });
  }

  function openDeleteModal(id, nama) {
      document.getElementById('hapus-nama-paket').textContent = nama;
      document.getElementById('form-hapus-paket').action = '<?= base_url('admin/paket/hapus/'); ?>' + id;
      openModal('modal-hapus');
  }

  document.getElementById('input_foto_tambah').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
          const reader = new FileReader();
          reader.onload = function(ev) {
              const img = document.getElementById('img-preview-tambah');
              const preview = document.getElementById('preview-tambah');
              if (img) img.src = ev.target.result;
              if (preview) preview.style.display = 'block';
          };
          reader.readAsDataURL(file);
      }
  });

  document.getElementById('input_foto_edit').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
          const reader = new FileReader();
          reader.onload = function(ev) {
              const img = document.getElementById('img-preview-edit');
              const preview = document.getElementById('preview-edit-baru');
              if (img) img.src = ev.target.result;
              if (preview) preview.style.display = 'block';
          };
          reader.readAsDataURL(file);
      }
  });
</script>

<script>
function lihatNilai(id_paket) {
  var modal = document.getElementById('modalNilai');
  modal.style.display = 'flex';
  
  document.getElementById('nilai-loading').style.display = 'block';
  document.getElementById('nilai-content').style.display = 'none';
  document.getElementById('nilai-nama-paket').textContent = '';

  fetch(baseUrl + 'admin/get_nilai/' + id_paket)
    .then(function(r) { return r.json(); })
    .then(function(data) {
      if (data.error) {
        alert(data.error);
        tutupModalNilai();
        return;
      }

      document.getElementById('nilai-nama-paket').textContent = data.nama_paket;

      var rows = '';
      data.kriteria.forEach(function(kr) {
        var sifatBadge = kr.sifat === 'COST'
          ? '<span style="background:#FEF2F2;color:#dc2626;padding:2px 8px;border-radius:99px;font-size:11px;font-weight:500">COST</span>'
          : '<span style="background:#f0fdf4;color:#16a34a;padding:2px 8px;border-radius:99px;font-size:11px;font-weight:500">BENEFIT</span>';

        var bgRow = data.kriteria.indexOf(kr) % 2 === 0 ? '#ffffff' : '#f8fafc';

        rows += '<tr style="background:' + bgRow + '">'
          + '<td style="padding:8px 12px;text-align:center"><span style="background:#EFF8FF;color:#0369a1;padding:2px 8px;border-radius:6px;font-size:12px;font-weight:500">' + kr.kode + '</span></td>'
          + '<td style="padding:8px 12px;font-size:13px">' + kr.nama + '</td>'
          + '<td style="padding:8px 12px;text-align:center">' + sifatBadge + '</td>'
          + '<td style="padding:8px 12px;text-align:center;font-weight:600;color:#0ea5e9;font-size:14px">' + parseInt(kr.nilai).toLocaleString('id-ID') + '</td>'
          + '<td style="padding:8px 12px;font-size:11px;color:#6b7280;font-style:italic">' + kr.sumber + '</td>'
          + '</tr>';
      });

      document.getElementById('nilai-tabel-body').innerHTML = rows;

      document.getElementById('nilai-loading').style.display = 'none';
      document.getElementById('nilai-content').style.display = 'block';
    })
    .catch(function() {
      alert('Gagal memuat data nilai');
      tutupModalNilai();
    });
}

function tutupModalNilai() {
  document.getElementById('modalNilai').style.display = 'none';
}

document.getElementById('modalNilai').addEventListener('click', function(e) {
  if (e.target === this) tutupModalNilai();
});
</script>
