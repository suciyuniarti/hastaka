<div class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl shadow-slate-200/50 border-2 border-slate-200/80 animate-fade-in-up overflow-hidden">
        <div class="bg-gradient-to-r from-brand-600 to-brand-700 px-8 py-6 text-white">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-rounded text-white text-2xl">receipt_long</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold">Invoice Pemesanan</h1>
                        <p class="text-brand-100 text-sm"><?= date('d F Y', strtotime($pemesanan->tgl_transaksi)); ?></p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-brand-200 text-xs uppercase tracking-wider mb-1">Kode Booking</p>
                    <p class="font-extrabold text-lg font-mono"><?= $pemesanan->kode_booking; ?></p>
                    <span class="inline-flex items-center gap-1.5 mt-2 px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white border border-white/30">
                        <span class="w-1.5 h-1.5 rounded-full <?= $pemesanan->status_pemesanan == 'pending' ? 'bg-amber-300' : ($pemesanan->status_pemesanan == 'dikonfirmasi' ? 'bg-emerald-300' : ($pemesanan->status_pemesanan == 'selesai' ? 'bg-white' : 'bg-red-300')); ?>"></span>
                        <?= ['pending'=>'Menunggu Konfirmasi','dikonfirmasi'=>'Dikonfirmasi','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'][$pemesanan->status_pemesanan]; ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-2">Pelanggan</p>
                    <p class="font-bold text-slate-900 text-lg"><?= $pemesanan->nama_lengkap; ?></p>
                    <p class="text-slate-500 text-sm mt-1"><?= $pemesanan->email; ?></p>
                    <p class="text-slate-600 text-sm"><?= $pemesanan->no_telepon ?? '-'; ?></p>
                </div>
                <div>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-2">Paket Wisata</p>
                    <p class="font-bold text-slate-900 text-lg"><?= $pemesanan->nama_paket; ?></p>
                    <?php if (!empty($pemesanan->nama_kategori)): ?>
                    <p class="text-brand-700 text-sm mt-1 flex items-center gap-1">
                        <span class="material-symbols-rounded text-[14px]"><?= $pemesanan->kategori_icon; ?></span>
                        <?= $pemesanan->nama_kategori; ?>
                        <span class="text-slate-400 text-xs">(<?= $pemesanan->sasaran; ?>)</span>
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="border-2 border-slate-100 rounded-2xl overflow-hidden mb-8">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="py-3 px-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Detail</th>
                            <th class="py-3 px-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">Qty</th>
                            <th class="py-3 px-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Harga</th>
                            <th class="py-3 px-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="py-4 px-4">
                                <p class="font-semibold text-slate-800"><?= $pemesanan->nama_paket; ?></p>
                                <p class="text-slate-500 text-xs mt-1"><?= date('d M Y', strtotime($pemesanan->tgl_keberangkatan)); ?><?= !empty($pemesanan->jam_keberangkatan) ? ' &bull; ' . date('H:i', strtotime($pemesanan->jam_keberangkatan)) . ' WIB' : ''; ?></p>
                                <?php if (!empty($pemesanan->titik_kumpul)): ?>
                                <p class="text-slate-500 text-xs mt-1 flex items-center gap-1">
                                    <span class="material-symbols-rounded text-[12px]">place</span> <?= $pemesanan->titik_kumpul; ?>
                                </p>
                                <?php endif; ?>
                                <?php if (!empty($pemesanan->nama_akomodasi)): ?>
                                <p class="text-brand-600 text-xs mt-1 flex items-center gap-1">
                                    <span class="material-symbols-rounded text-[12px]"><?= $pemesanan->akomodasi_icon ?? 'directions_bus'; ?></span> <?= $pemesanan->nama_akomodasi; ?>
                                </p>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-4 text-center font-semibold text-slate-800"><?= $pemesanan->jumlah_peserta; ?> org</td>
                            <td class="py-4 px-4 text-right font-semibold text-slate-800">Rp <?= number_format($pemesanan->harga, 0, ',', '.'); ?></td>
                            <td class="py-4 px-4 text-right font-bold text-slate-900">Rp <?= number_format($pemesanan->harga * $pemesanan->jumlah_peserta, 0, ',', '.'); ?></td>
                        </tr>
                        <?php if (!empty($pemesanan->nama_akomodasi) && !empty($pemesanan->harga_akomodasi)): ?>
                        <tr class="bg-brand-50/50">
                            <td class="py-4 px-4">
                                <p class="font-semibold text-brand-800">Akomodasi</p>
                                <p class="text-brand-600 text-xs mt-1"><?= $pemesanan->nama_akomodasi; ?></p>
                            </td>
                            <td class="py-4 px-4 text-center font-semibold text-brand-800"><?= $pemesanan->jumlah_peserta; ?> org</td>
                            <td class="py-4 px-4 text-right font-semibold text-brand-800">Rp <?= number_format($pemesanan->harga_akomodasi, 0, ',', '.'); ?></td>
                            <td class="py-4 px-4 text-right font-bold text-brand-700">Rp <?= number_format($pemesanan->harga_akomodasi * $pemesanan->jumlah_peserta, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endif; ?>
            <?php if (($pemesanan->tipe_pembayaran ?? 'full') == 'dp' && !empty($pemesanan->jumlah_dp)): ?>
            <?php $total_asli = ($pemesanan->harga + ($pemesanan->harga_akomodasi ?? 0)) * $pemesanan->jumlah_peserta; $sisa = $total_asli - $pemesanan->jumlah_dp; ?>
            <div class="flex justify-between text-sm text-gray-500">
                <span>Total harga sebenarnya</span>
                <span class="font-semibold">Rp <?= number_format($total_asli, 0, ',', '.'); ?></span>
            </div>
            <div class="flex justify-between text-sm text-purple-600">
                <span>DP yang sudah dibayar</span>
                <span class="font-semibold">Rp <?= number_format($pemesanan->jumlah_dp, 0, ',', '.'); ?></span>
            </div>
            <div class="flex justify-between text-sm text-amber-600 bg-amber-50 px-3 py-2 rounded-lg border border-amber-200">
                <span class="font-semibold">Sisa yang harus dilunasi</span>
                <span class="font-bold">Rp <?= number_format($sisa, 0, ',', '.'); ?></span>
            </div>
            <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="bg-gradient-to-br from-slate-50 to-brand-50 rounded-2xl p-6 border border-brand-100 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-600">Tipe Pembayaran</span>
                    <span class="font-bold text-slate-800"><?= ($pemesanan->tipe_pembayaran ?? 'full') == 'dp' ? 'DP (Uang Muka)' : 'Lunas (Full)'; ?></span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-slate-600">Total Tagihan</span>
                    <span class="font-bold text-slate-800">Rp <?= number_format($pemesanan->total_bayar, 0, ',', '.'); ?></span>
                </div>
                <?php if (($pemesanan->tipe_pembayaran ?? 'full') == 'dp' && !empty($pemesanan->jumlah_dp)): ?>
                <?php $total_asli = $pemesanan->harga * $pemesanan->jumlah_peserta; $sisa = $total_asli - $pemesanan->jumlah_dp; ?>
                <div class="border-t border-slate-200 pt-2 mt-2">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Total harga sebenarnya</span>
                        <span class="font-semibold text-slate-700">Rp <?= number_format($total_asli, 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between items-center text-sm mt-1">
                        <span class="text-brand-700">DP yang sudah dibayar</span>
                        <span class="font-bold text-brand-700">Rp <?= number_format($pemesanan->jumlah_dp, 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between items-center text-sm mt-1 bg-amber-50 px-3 py-2 rounded-lg border border-amber-200">
                        <span class="font-bold text-amber-800">Sisa yang harus dilunasi</span>
                        <span class="font-extrabold text-amber-700">Rp <?= number_format($sisa, 0, ',', '.'); ?></span>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($pemesanan->bukti_transfer)): ?>
            <div class="mb-6">
                <h3 class="font-bold text-sm mb-3 flex items-center gap-2 text-slate-700">
                    <span class="material-symbols-rounded text-brand-500 text-[18px]">receipt</span> Bukti Transfer
                </h3>
                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 flex justify-center">
                    <img src="<?= base_url('application/assets/images/bukti/' . $pemesanan->bukti_transfer); ?>" class="max-h-64 rounded-xl shadow-md object-contain" onerror="this.style.display='none'">
                </div>
            </div>
            <?php endif; ?>

            <?php if ($pemesanan->status_pemesanan == 'pending'): ?>
            <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-5 mb-6">
                <h3 class="font-bold text-sm mb-3 flex items-center gap-2 text-amber-800">
                    <span class="material-symbols-rounded text-amber-600 text-[18px]">info</span> Instruksi Pembayaran
                </h3>
                <ol class="list-decimal list-inside space-y-2 text-amber-900 text-sm">
                    <li>Transfer total <strong>Rp <?= number_format($pemesanan->total_bayar, 0, ',', '.'); ?></strong></li>
                    <li>Ke rekening: <strong>BCA 1234567890</strong> a/n Hastaka Holiday</li>
                    <li>Konfirmasi pembayaran dengan kode booking <strong><?= $pemesanan->kode_booking; ?></strong></li>
                </ol>
            </div>
            <?php endif; ?>

            <div class="flex flex-col sm:flex-row gap-3 mb-4">
                <a href="<?= base_url('pemesanan/riwayat'); ?>" class="flex-1 text-center bg-slate-100 text-slate-700 py-3 rounded-xl font-semibold text-sm hover:bg-slate-200 transition inline-flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[18px]">history</span> Riwayat Pesanan
                </a>
                <button onclick="window.print()" class="flex-1 gradient-bg text-white py-3 rounded-xl font-bold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 inline-flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[18px]">print</span> Cetak Invoice
                </button>
            </div>

            <?php if ($pemesanan->status_pemesanan == 'pending'): ?>
            <a href="https://wa.me/6287719646932?text=<?= urlencode('Halo Hastaka Holiday, saya ingin konfirmasi pembayaran.\nKode Booking: ' . $pemesanan->kode_booking . '\nTotal: Rp ' . number_format($pemesanan->total_bayar, 0, ',', '.') . '\n\nMohon dicek. Terima kasih.'); ?>" target="_blank" class="w-full flex items-center justify-center gap-2 bg-emerald-500 text-white py-3.5 rounded-xl font-bold text-sm hover:bg-emerald-600 transition">
                <span class="material-symbols-rounded text-[20px]">chat</span> Konfirmasi via WhatsApp
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style type="text/css" media="print">
    @page { margin: 0.5cm; size: A4; }
    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .animate-fade-in-up { animation: none !important; }
    button, a[href*="wa.me"] { display: none !important; }
    .bg-gradient-to-br { background: #fff !important; }
    .shadow-xl, .shadow-md, .shadow-lg { box-shadow: none !important; }
    .border-2 { border-width: 1px !important; }
    .rounded-3xl { border-radius: 8px !important; }
    .rounded-2xl { border-radius: 6px !important; }
    .rounded-xl { border-radius: 4px !important; }
</style>
