<?php if ($this->session->flashdata('success')): ?>
<div class="flash-success flex items-center gap-3 mb-6">
    <span class="material-symbols-rounded text-emerald-500">check_circle</span>
    <?= $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">hiking</span>
    </div>
    <div class="page-header-content">
        <h1>Aktivitas Wisata</h1>
        <p>Kelola daftar aktivitas wisata</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
    <div></div>
    <a href="<?= base_url('admin/aktivitas/tambah'); ?>" class="btn btn-primary"><span class="material-symbols-rounded text-lg">add</span> Tambah Aktivitas</a>
</div>

<div class="admin-table-wrap animate-fade-in-up" style="animation-delay: 0.15s;">
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
                            <a href="<?= base_url('admin/aktivitas/edit/' . $a->id_aktivitas); ?>" class="btn btn-primary btn-icon-sm" title="Edit"><span class="material-symbols-rounded text-sm">edit</span> Edit</a>
                            <a href="<?= base_url('admin/aktivitas/hapus/' . $a->id_aktivitas); ?>" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="return confirm('Hapus aktivitas ini?')"><span class="material-symbols-rounded text-sm">delete</span> Hapus</a>
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