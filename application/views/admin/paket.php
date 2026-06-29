<?php if ($this->session->flashdata('success')): ?>
<div class="flash-success" onclick="this.classList.add('flash-hide'); setTimeout(() => this.remove(), 300);">
    <span class="material-symbols-rounded">check_circle</span>
    <div class="flash-content">
        <span class="flash-title">Berhasil</span>
        <span class="flash-message"><?= $this->session->flashdata('success'); ?></span>
    </div>
</div>
<div class="flash-overlay" onclick="this.remove()"></div>
<?php endif; ?>

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
                <input type="text" name="search" placeholder="Cari nama paket..." value="<?= $this->input->get('search'); ?>" class="w-full">
            </div>
            <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded">search</span> Cari</button>
            <?php if ($this->input->get('search')): ?>
            <a href="<?= base_url('admin/paket'); ?>" class="btn btn-secondary"><span class="material-symbols-rounded">close</span> Reset</a>
            <?php endif; ?>
        </form>
    </div>
    <a href="<?= base_url('admin/paket/tambah'); ?>" class="btn btn-primary whitespace-nowrap"><span class="material-symbols-rounded text-lg">add</span> Tambah Paket</a>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
            <tr class="table-header">
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider w-12">#</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider w-24">Foto</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-left">Nama Paket</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-right w-32">Harga</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-20">Durasi</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-28">Status</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($paket)): ?>
                <?php foreach ($paket as $i => $p): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
                            <td class="py-4 px-4 text-slate-400 text-sm font-mono td-no"><?= $i + 1; ?></td>
                            <td class="py-4 px-4">
                                <div class="relative group">
                                    <img src="<?= base_url('application/assets/images/paket/' . $p->foto . '?v=' . time()); ?>"
                                        class="w-20 h-16 object-cover rounded-xl shadow-md border-2 border-slate-200 group-hover:border-sky-300 transition"
                                        onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition"></div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-slate-800 text-sm"><?= $p->nama_paket; ?></div>
                                <div class="text-xs text-slate-500 mt-0.5"><?= $p->jumlah_destinasi ?? 0; ?> Destinasi &bull; <?= $p->jumlah_aktivitas ?? 0; ?> Aktivitas</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-bold text-slate-800 text-sm text-right">Rp <?= number_format($p->harga, 0, ',', '.'); ?></div>
                                <div class="text-xs text-slate-500 text-right mt-0.5">/orang</div>
                            </td>
                            <td class="py-4 px-4 text-slate-700 text-sm text-center">
                                <div class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-50 rounded-lg border border-sky-100">
                                    <span class="material-symbols-rounded text-sky-600 text-[16px]">schedule</span>
                                    <span class="font-semibold"><?= $p->durasi_hari; ?></span>
                                </div>
                                <div class="text-xs text-slate-500 mt-1">Hari</div>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold <?= $p->status == 'tersedia' ? 'badge-tersedia' : 'badge-habis'; ?>">
                                    <span class="w-2 h-2 rounded-full <?= $p->status == 'tersedia' ? 'bg-emerald-500' : 'bg-red-500'; ?>"></span>
                                    <?= ucfirst($p->status); ?>
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center gap-2">
                                <a href="<?= base_url('admin/nilai/' . $p->id_paket); ?>" class="btn btn-warning btn-icon-sm" title="Nilai"><span class="material-symbols-rounded text-sm">star</span> Nilai</a>
                                <a href="<?= base_url('admin/paket/edit/' . $p->id_paket); ?>" class="btn btn-primary btn-icon-sm" title="Edit"><span class="material-symbols-rounded text-sm">edit</span> Edit</a>
                                <a href="<?= base_url('admin/paket/hapus/' . $p->id_paket); ?>" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="return confirm('Yakin hapus paket ini?')"><span class="material-symbols-rounded text-sm">delete</span> Hapus</a>
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
</div>