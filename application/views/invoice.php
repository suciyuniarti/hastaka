<main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 animate-fade-in-up">
        <div class="text-center border-b border-gray-100 pb-6 mb-6">
            <div class="w-14 h-14 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg shadow-brand-500/20">
                <span class="material-symbols-rounded text-white text-2xl">receipt_long</span>
            </div>
            <h1 class="text-2xl font-extrabold gradient-text">Invoice Pemesanan</h1>
        </div>
        <?php $sc=['pending'=>'bg-amber-100 text-amber-700','dikonfirmasi'=>'bg-emerald-100 text-emerald-700','selesai'=>'bg-brand-100 text-brand-700','dibatalkan'=>'bg-red-100 text-red-700']; $sl=['pending'=>'Menunggu Konfirmasi','dikonfirmasi'=>'Dikonfirmasi','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan']; ?>
<div class="flex justify-between items-start mb-6">
        <div><p class="text-gray-500 text-xs">Kode Booking</p><p class="font-extrabold text-lg font-mono"><?= $pemesanan->kode_booking; ?></p></div>
        <span class="status-badge <?= 'status-' . $pemesanan->status_pemesanan; ?>"><?= ['pending'=>'Menunggu Konfirmasi','dikonfirmasi'=>'Dikonfirmasi','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'][$pemesanan->status_pemesanan]; ?></span>
    </div>
        <div class="grid grid-cols-2 gap-4 text-sm border-t border-gray-100 pt-4">
            <div><p class="text-gray-400 text-xs">Pemesan</p><p class="font-semibold"><?= $pemesanan->nama_lengkap; ?></p></div>
            <div><p class="text-gray-400 text-xs">Email</p><p class="font-semibold"><?= $pemesanan->email; ?></p></div>
            <div><p class="text-gray-400 text-xs">Paket</p><p class="font-semibold"><?= $pemesanan->nama_paket; ?></p></div>
            <div><p class="text-gray-400 text-xs">Kategori Program</p><p class="font-semibold">
                <?php if (!empty($pemesanan->nama_kategori)): ?>
                <span class="inline-flex items-center gap-1 text-brand-700"><span class="material-symbols-rounded text-[14px]"><?= $pemesanan->kategori_icon; ?></span><?= $pemesanan->nama_kategori; ?></span>
                <?php else: ?>
                <span class="text-gray-300 text-xs">Belum dipilih</span>
                <?php endif; ?>
            </p></div>
            <div><p class="text-gray-400 text-xs">Keberangkatan</p><p class="font-semibold"><?= date('d M Y', strtotime($pemesanan->tgl_keberangkatan)); ?></p></div>
            <div><p class="text-gray-400 text-xs">Peserta</p><p class="font-semibold"><?= $pemesanan->jumlah_peserta; ?> orang</p></div>
            <div><p class="text-gray-400 text-xs">Harga/orang</p><p class="font-semibold">Rp <?= number_format($pemesanan->harga, 0, ',', '.'); ?></p></div>
            <div><p class="text-gray-400 text-xs">Tipe Pembayaran</p><p class="font-semibold"><?= ($pemesanan->tipe_pembayaran ?? 'full') == 'dp' ? 'DP (Uang Muka)' : 'Lunas (Full)'; ?></p></div>
        </div>
        <div class="border-t border-gray-100 mt-4 pt-4 space-y-2">
            <div class="flex justify-between items-center">
                <span class="font-bold text-lg">Total</span>
                <span class="text-2xl font-extrabold gradient-text">Rp <?= number_format($pemesanan->total_bayar, 0, ',', '.'); ?></span>
            </div>
            <?php if (($pemesanan->tipe_pembayaran ?? 'full') == 'dp'): ?>
            <?php $total_asli = $pemesanan->harga * $pemesanan->jumlah_peserta; $sisa = $total_asli - $pemesanan->jumlah_dp; ?>
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
        </div>

        <?php if (!empty($pemesanan->bukti_transfer)): ?>
        <div class="border-t border-gray-100 mt-4 pt-4">
            <h3 class="font-bold text-sm mb-3 flex items-center gap-2"><span class="material-symbols-rounded text-brand-500 text-[18px]">receipt</span> Bukti Transfer</h3>
            <img src="<?= base_url('application/assets/images/bukti/' . $pemesanan->bukti_transfer); ?>" class="max-w-xs w-full rounded-xl border border-gray-200 shadow-md" onerror="this.style.display='none'">
        </div>
        <?php endif; ?>
        <?php if ($pemesanan->status_pemesanan == 'pending'): ?>
        <div class="bg-brand-50 rounded-2xl p-5 mt-6 border border-brand-100">
            <h3 class="font-bold text-sm mb-2 flex items-center gap-2 text-brand-800"><span class="material-symbols-rounded text-brand-500 text-[18px]">info</span> Instruksi Pembayaran</h3>
            <ol class="list-decimal list-inside space-y-1.5 text-gray-700 text-sm">
                <li>Transfer <strong>Rp <?= number_format($pemesanan->total_bayar, 0, ',', '.'); ?></strong></li>
                <li>Ke rekening: <strong>BCA 1234567890</strong> a/n Hastaka Holiday</li>
                <li>Konfirmasi ke admin dengan kode <strong><?= $pemesanan->kode_booking; ?></strong></li>
            </ol>
        </div>
        <?php endif; ?>
<div class="flex gap-3 mt-8">
            <a href="<?= base_url('pemesanan/riwayat'); ?>" class="flex-1 text-center bg-slate-100 text-slate-700 py-3 rounded-full font-semibold text-sm hover:bg-slate-200 transition inline-flex items-center justify-center gap-2">
                <span class="material-symbols-rounded text-[18px]">history</span> Riwayat
            </a>
            <button onclick="window.print()" class="flex-1 gradient-bg text-white py-3 rounded-full font-bold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 inline-flex items-center justify-center gap-2">
                <span class="material-symbols-rounded text-[18px]">print</span> Cetak Invoice
            </button>
        </div>
        <?php if ($pemesanan->status_pemesanan == 'pending'): ?>
        <a href="https://wa.me/6287719646932?text=<?= urlencode('Halo Hastaka Holiday, saya ingin konfirmasi pembayaran.\nKode Booking: ' . $pemesanan->kode_booking . '\nTotal: Rp ' . number_format($pemesanan->total_bayar, 0, ',', '.') . '\n\nMohon dicek. Terima kasih.'); ?>" target="_blank" class="w-full flex items-center justify-center gap-2 bg-emerald-500 text-white py-3.5 rounded-2xl font-bold text-sm hover:bg-emerald-600 transition mt-3">
            <span class="material-symbols-rounded text-[20px]">chat</span> Konfirmasi via WhatsApp
        </a>
        <?php endif; ?>
    </div>
</main>
