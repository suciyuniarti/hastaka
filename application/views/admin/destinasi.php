<?php if ($this->session->flashdata('success')): ?>
<div class="flash-success flex items-center gap-3 mb-6">
    <span class="material-symbols-rounded text-emerald-500">check_circle</span>
    <?= $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">place</span>
    </div>
    <div class="page-header-content">
        <h1>Destinasi</h1>
        <p>Kelola daftar destinasi wisata</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
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
    <a href="<?= base_url('admin/destinasi/tambah'); ?>" class="btn btn-primary whitespace-nowrap"><span class="material-symbols-rounded text-lg">add</span> Tambah Destinasi</a>
</div>

<div class="admin-table-wrap animate-fade-in-up">
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
                            <a href="<?= base_url('admin/destinasi/edit/' . $d->id_destinasi); ?>" class="btn btn-primary btn-icon-sm" title="Edit"><span class="material-symbols-rounded text-sm">edit</span> Edit</a>
                            <a href="<?= base_url('admin/destinasi/hapus/' . $d->id_destinasi); ?>" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="return confirm('Hapus destinasi ini?')"><span class="material-symbols-rounded text-sm">delete</span> Hapus</a>
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