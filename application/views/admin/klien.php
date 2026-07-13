<?php if ($this->session->flashdata('success')): ?>
<?php endif; ?>

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
    <a href="<?= base_url('admin/klien/tambah'); ?>" class="btn btn-primary"><span class="material-symbols-rounded text-lg">add</span> Tambah Klien</a>
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
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Tgl Kerjasama</th>
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
                                <?php if (!empty($k->deskripsi)): ?>
                                    <p class="text-slate-400 text-xs mt-0.5 line-clamp-1"><?= $k->deskripsi; ?></p>
                                <?php endif; ?>
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
                            <td class="py-4 px-5 text-slate-500 text-xs">
                                <?= $k->tanggal_kerjasama ? date('d M Y', strtotime($k->tanggal_kerjasama)) : '-'; ?>
                            </td>
                            <td class="py-4 px-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?= base_url('admin/klien/edit/' . $k->id_klien); ?>" class="btn btn-primary btn-icon-sm" title="Edit"><span class="material-symbols-rounded text-sm">edit</span> Edit</a>
                                    <a href="<?= base_url('admin/klien/hapus/' . $k->id_klien); ?>" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="return confirm('Hapus klien ini?')"><span class="material-symbols-rounded text-sm">delete</span> Hapus</a>
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