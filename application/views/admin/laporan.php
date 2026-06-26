<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">analytics</span>
    </div>
    <div class="page-header-content">
        <h1>Laporan Transaksi</h1>
        <p>Laporan keuangan berdasarkan periode</p>
    </div>
</div>

<div class="admin-card mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
    <div class="flex items-center gap-2 mb-5">
        <span class="material-symbols-rounded text-sky-500">date_range</span>
        <h3 class="font-bold text-slate-700">Filter Periode</h3>
    </div>
    <?= form_open('admin/laporan', ['method' => 'GET']); ?>
    <div class="flex flex-wrap gap-4 items-end">
        <div class="form-group mb-0">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="tgl_mulai" value="<?= $tgl_mulai; ?>" class="form-input">
        </div>
        <div class="form-group mb-0">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date" name="tgl_selesai" value="<?= $tgl_selesai; ?>" class="form-input">
        </div>
        <button type="submit" class="btn btn-primary"><span class="material-symbols-rounded">filter_list</span> Filter</button>
        <button type="button" onclick="window.print()" class="btn btn-secondary"><span class="material-symbols-rounded">print</span> Cetak Laporan</button>
    </div>
    <?= form_close(); ?>
</div>

<div class="admin-card animate-fade-in-up" style="animation-delay: 0.2s;">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4 pb-4 border-b border-slate-100">
        <div>
            <?php
            $tgl_mulai_safe = !empty($tgl_mulai) ? $tgl_mulai : date('Y-m-d');
            $tgl_selesai_safe = !empty($tgl_selesai) ? $tgl_selesai : date('Y-m-d');
            $laporan_count_safe = isset($laporan) && is_array($laporan) ? count($laporan) : 0;
            ?>
            <h2 class="font-bold text-lg text-slate-800">Periode: <?= date('d M Y', strtotime($tgl_mulai_safe)); ?> - <?= date('d M Y', strtotime($tgl_selesai_safe)); ?></h2>
            <p class="text-slate-500 text-sm"><?= $laporan_count_safe; ?> transaksi</p>
        </div>
<?php
        $total_pendapatan = 0;
        $laporan_safe = isset($laporan) && is_array($laporan) ? $laporan : [];
        foreach ($laporan_safe as $l) {
            if ($l->status_pemesanan == 'dikonfirmasi' || $l->status_pemesanan == 'selesai') {
                $total_pendapatan += $l->total_bayar;
            }
        }
        ?>
        <div class="bg-sky-50 border border-sky-200 rounded-2xl px-5 py-3 text-right w-full sm:w-auto">
            <p class="text-xs text-sky-600 font-semibold">Total Pendapatan</p>
            <p class="text-xl font-bold text-sky-700">Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></p>
        </div>
    </div>

    <?php if (!empty($laporan)): ?>
    <div class="overflow-x-auto">
        <table class="admin-table text-sm">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider w-12">No</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Kode Booking</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Pelanggan</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Paket</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Keberangkatan</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-right">Total</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laporan as $i => $l): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
                    <td class="py-4 px-4 text-slate-400 text-sm font-mono"><?= $i + 1; ?></td>
                    <td class="py-4 px-4 font-mono text-xs font-bold text-sky-600"><?= $l->kode_booking; ?></td>
                    <td class="py-4 px-4 font-semibold text-slate-800"><?= $l->nama_lengkap; ?></td>
                    <td class="py-4 px-4 text-slate-600"><?= $l->nama_paket; ?></td>
                    <td class="py-4 px-4 text-slate-600 text-sm"><?= date('d M Y', strtotime($l->tgl_keberangkatan)); ?></td>
                    <td class="py-4 px-4 font-bold text-right">Rp <?= number_format($l->total_bayar, 0, ',', '.'); ?></td>
                    <td class="py-4 px-4 text-center">
                        <span class="badge <?= 'badge-' . $l->status_pemesanan; ?>"><?= ucfirst($l->status_pemesanan); ?></span>
                    </td>
                    <td class="py-4 px-4 text-slate-500 text-xs"><?= date('d M Y H:i', strtotime($l->tgl_transaksi)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="text-center py-12">
        <div class="empty-state">
            <div class="empty-state-icon">
                <span class="material-symbols-rounded">analytics</span>
            </div>
            <h3>Tidak ada data transaksi pada periode ini.</h3>
        </div>
    </div>
    <?php endif; ?>
</div>