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
        <span class="material-symbols-rounded">hotel</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Akomodasi</h1>
        <p><?= $total_akomodasi ?? count($akomodasi ?? []); ?> akomodasi terdaftar</p>
    </div>
</div>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div></div>
    <a href="<?= base_url('admin/akomodasi/tambah'); ?>" class="btn btn-primary whitespace-nowrap"><span class="material-symbols-rounded text-lg">add</span> Tambah Akomodasi</a>
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
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Harga/Orang</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-24 text-center">Paket</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-28 text-center">Status</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($akomodasi)): ?>
                <?php foreach ($akomodasi as $i => $a): 
                    $deskripsi = !empty($a->deskripsi) ? $a->deskripsi : '-';
                    if (strlen($deskripsi) > 50) {
                        $deskripsi = substr($deskripsi, 0, 50) . '...';
                    }
                    $wilayah = !empty($a->wilayah) ? $a->wilayah : '-';
                    if (strlen($wilayah) > 40) {
                        $wilayah = substr($wilayah, 0, 40) . '...';
                    }
                    $jumlah_paket = count($a->paket_list ?? []);
                ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
                    <td class="py-4 px-5 text-slate-400 text-sm font-mono td-no"><?= $i + 1; ?></td>
                    <td class="py-4 px-5">
                        <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center text-sky-600">
                            <span class="material-symbols-rounded text-xl"><?= $a->icon; ?></span>
                        </div>
                    </td>
                    <td class="py-4 px-5 font-semibold text-slate-800 text-sm"><?= $a->nama_akomodasi; ?></td>
                    <td class="py-4 px-5 text-slate-600 text-sm">
                        <div class="truncate max-w-xs" title="<?= htmlspecialchars($a->wilayah ?? '', ENT_QUOTES); ?>"><?= $wilayah; ?></div>
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
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 border border-emerald-200 rounded-lg text-xs font-bold text-emerald-700 cursor-pointer hover:bg-emerald-100 transition" onclick="toggleStatus(<?= $a->id_akomodasi; ?>, 'nonaktif')" title="Klik untuk menonaktifkan">
                                <span class="material-symbols-rounded text-[14px]">check_circle</span> Aktif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-red-50 border border-red-200 rounded-lg text-xs font-bold text-red-700 cursor-pointer hover:bg-red-100 transition" onclick="toggleStatus(<?= $a->id_akomodasi; ?>, 'aktif')" title="Klik untuk mengaktifkan">
                                <span class="material-symbols-rounded text-[14px]">cancel</span> Nonaktif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="<?= base_url('admin/akomodasi/edit/' . $a->id_akomodasi); ?>" class="btn btn-primary btn-icon-sm" title="Edit"><span class="material-symbols-rounded text-sm">edit</span> Edit</a>
                            <a href="<?= base_url('admin/akomodasi/hapus/' . $a->id_akomodasi); ?>" class="btn btn-danger btn-icon-sm" title="Hapus" onclick="return confirmDelete('<?= $a->nama_akomodasi; ?>')"><span class="material-symbols-rounded text-sm">delete</span> Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="8" class="py-16 text-center">
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

<script>
function confirmDelete(nama) {
    return confirm('Yakin ingin menghapus akomodasi "' + nama + '"?\nTindakan ini tidak bisa dibatalkan.');
}

function toggleStatus(id, newStatus) {
    if (!confirm('Ubah status akomodasi menjadi ' + newStatus + '?')) {
        return;
    }
    
    fetch('<?= base_url('admin/akomodasi/toggle_status'); ?>/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal mengubah status: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengubah status.');
    });
}
</script>
