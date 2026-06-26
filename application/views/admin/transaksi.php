<?php if ($this->session->flashdata('success')): ?>
<div class="flash-success flex items-center gap-3 mb-6">
    <span class="material-symbols-rounded text-emerald-500">check_circle</span>
    <?= $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">receipt_long</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Transaksi</h1>
        <p><?= $total_transaksi ?? count($transaksi ?? []); ?> transaksi tercatat</p>
    </div>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table text-sm min-w-[900px]">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Kode Booking</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Pelanggan</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Paket</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Keberangkatan</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-20">Peserta</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-right w-28">Total</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-24">Bukti</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transaksi)): ?>
                <?php foreach ($transaksi as $t): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap">
                    <td class="py-4 px-4 font-mono text-xs font-bold text-sky-600"><?= $t->kode_booking; ?></td>
                    <td class="py-4 px-4 font-semibold text-slate-800"><?= $t->nama_lengkap; ?></td>
                    <td class="py-4 px-4 text-slate-600"><?= $t->nama_paket; ?></td>
                    <td class="py-4 px-4 text-slate-600 text-sm"><?= date('d M Y', strtotime($t->tgl_keberangkatan)); ?></td>
                    <td class="py-4 px-4 text-center">
                        <span class="inline-flex items-center gap-1 bg-slate-100 px-2 py-1 rounded-lg text-xs font-bold">
                            <span class="material-symbols-rounded text-sm">person</span> <?= $t->jumlah_peserta; ?>
                        </span>
                    </td>
                    <td class="py-4 px-4 font-bold text-right">Rp <?= number_format($t->total_bayar, 0, ',', '.'); ?></td>
                    <td class="py-4 px-4 text-center">
                        <?php if (!empty($t->bukti_transfer) && file_exists(FCPATH . 'application/assets/images/bukti/' . $t->bukti_transfer)): ?>
                        <button onclick="showBukti('<?= base_url('application/assets/images/bukti/' . $t->bukti_transfer); ?>')" class="btn btn-secondary btn-icon-sm"><span class="material-symbols-rounded text-sm">visibility</span> Lihat</button>
                        <?php else: ?>
                        <span class="text-slate-400 text-xs font-medium">Belum ada</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <span class="badge <?= 'badge-' . $t->status_pemesanan; ?>"><?= ucfirst($t->status_pemesanan); ?></span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center justify-center gap-1.5">
                            <?php if ($t->status_pemesanan == 'pending'): ?>
                            <a href="<?= base_url('admin/transaksi/konfirmasi/' . $t->id_pemesanan); ?>" class="btn btn-success btn-icon-sm" title="Konfirmasi" onclick="return confirm('Konfirmasi transaksi ini?')"><span class="material-symbols-rounded text-sm">check_circle</span> Konfirmasi</a>
                            <a href="<?= base_url('admin/transaksi/batalkan/' . $t->id_pemesanan); ?>" class="btn btn-danger btn-icon-sm" title="Batalkan" onclick="return confirm('Batalkan transaksi ini?')"><span class="material-symbols-rounded text-sm">close</span> Batal</a>
                            <?php elseif ($t->status_pemesanan == 'dikonfirmasi'): ?>
                            <span class="btn btn-secondary btn-icon-sm" style="cursor: default;"><span class="material-symbols-rounded text-sm">check_circle</span> Dikonfirmasi</span>
                            <?php else: ?>
                            <span class="btn btn-secondary btn-icon-sm" style="cursor: default;"><span class="material-symbols-rounded text-sm"><?= ucfirst($t->status_pemesanan == 'selesai' ? 'check_circle' : 'close'); ?></span> <?= ucfirst($t->status_pemesanan == 'selesai' ? 'Selesai' : 'Dibatalkan'); ?></span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="9" class="py-16 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <span class="material-symbols-rounded">receipt_long</span>
                        </div>
                        <h3>Belum ada transaksi.</h3>
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
            <a href="<?= base_url('admin/transaksi/' . ($current_page - 1)); ?>" class="pagination-btn prev">Sebelumnya</a>
            <?php endif; ?>
            <?php for ($i = 0; $i < $total_pages; $i++): ?>
            <a href="<?= base_url('admin/transaksi/' . $i); ?>" class="pagination-num <?= $i == $current_page ? 'active' : ''; ?>"><?= $i + 1; ?></a>
            <?php endfor; ?>
            <?php if ($current_page < $total_pages - 1): ?>
            <a href="<?= base_url('admin/transaksi/' . ($current_page + 1)); ?>" class="pagination-btn next">Selanjutnya</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
function showBukti(url) {
    document.getElementById('bukti-modal-img').src = url;
    document.getElementById('bukti-modal').classList.remove('hidden');
}
function closeBukti() {
    document.getElementById('bukti-modal').classList.add('hidden');
}
</script>

<div id="bukti-modal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden animate-fade-in-up">
        <div class="flex items-center justify-between p-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-900">Bukti Transfer</h3>
            <button onclick="closeBukti()" class="p-2 rounded-lg hover:bg-slate-100 transition">
                <span class="material-symbols-rounded text-slate-500">close</span>
            </button>
        </div>
        <div class="p-4 flex justify-center bg-slate-50">
            <img id="bukti-modal-img" src="" alt="Bukti Transfer" class="max-h-[75vh] rounded-xl shadow-md object-contain">
</div>
</div>
</div>