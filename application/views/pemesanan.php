<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10 animate-fade-in-up">
            <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 px-4 py-1.5 rounded-full text-sm font-semibold mb-4 border border-brand-200">
                <span class="material-symbols-rounded text-[16px]">confirmation_number</span> Cek Pesanan
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900">Cek <span class="gradient-text">Pesanan</span></h1>
            <p class="text-gray-500 mt-2">Masukkan kode booking untuk melihat status dan detail pesanan</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-6 border-2 border-slate-200/80 mb-8 animate-fade-in-up stagger-1">
            <?= form_open('pemesanan', ['method' => 'GET', 'class' => 'flex gap-3']); ?>
                <div class="relative flex-1">
                    <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                    <input type="text" name="kode" value="<?= $kode; ?>"
                        class="w-full pl-12 pr-4 py-3.5 bg-white border-2 border-slate-200 rounded-2xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all hover:border-slate-300"
                        placeholder="Contoh: HST20240101ABCD" required>
                </div>
                <button type="submit" class="gradient-bg text-white px-8 py-3.5 rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-brand-500/40 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">search</span> Cek
                </button>
            <?= form_close(); ?>
        </div>

        <?php if ($kode && $pemesanan): ?>
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border-2 border-slate-200/80 overflow-hidden animate-fade-in-up stagger-2">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-8 pb-6 border-b border-slate-100">
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-900">Detail Pesanan</h2>
                        <p class="text-gray-500 text-sm font-mono mt-1"><?= $pemesanan->kode_booking; ?></p>
                    </div>
                    <?php
                    $sc = ['pending'=>'bg-amber-100 text-amber-700 border-amber-200','dikonfirmasi'=>'bg-emerald-100 text-emerald-700 border-emerald-200','selesai'=>'bg-brand-100 text-brand-700 border-brand-200','dibatalkan'=>'bg-red-100 text-red-700 border-red-200'];
                    $sl = ['pending'=>'Menunggu Konfirmasi','dikonfirmasi'=>'Dikonfirmasi','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'];
                    $sc_dot = ['pending'=>'bg-amber-500','dikonfirmasi'=>'bg-emerald-500','selesai'=>'bg-brand-500','dibatalkan'=>'bg-red-500'];
                    ?>
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold border-2 <?= $sc[$pemesanan->status_pemesanan]; ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?= $sc_dot[$pemesanan->status_pemesanan]; ?>"></span>
                        <?= $sl[$pemesanan->status_pemesanan]; ?>
                    </span>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Paket Wisata</p>
                        <p class="font-bold text-slate-900"><?= $pemesanan->nama_paket; ?></p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Pemesan</p>
                        <p class="font-bold text-slate-900"><?= $pemesanan->nama_lengkap; ?></p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Keberangkatan</p>
                        <p class="font-bold text-slate-900"><?= date('d F Y', strtotime($pemesanan->tgl_keberangkatan)); ?></p>
                    </div>
                    <?php if (!empty($pemesanan->jam_keberangkatan)): ?>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Jam Keberangkatan</p>
                        <p class="font-bold text-slate-900"><?= date('H:i', strtotime($pemesanan->jam_keberangkatan)); ?> WIB</p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($pemesanan->titik_kumpul)): ?>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Titik Kumpul</p>
                        <p class="font-bold text-slate-900 text-sm"><?= $pemesanan->titik_kumpul; ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($pemesanan->nama_akomodasi)): ?>
                    <div class="bg-brand-50 rounded-2xl p-4 border border-brand-100">
                        <p class="text-brand-500 text-[10px] font-bold uppercase tracking-wider mb-1">Akomodasi</p>
                        <p class="font-bold text-brand-900 flex items-center gap-1">
                            <span class="material-symbols-rounded text-[14px]"><?= $pemesanan->akomodasi_icon ?? 'directions_bus'; ?></span>
                            <?= $pemesanan->nama_akomodasi; ?>
                        </p>
                        <p class="text-brand-700 text-xs mt-1">+ Rp <?= number_format($pemesanan->harga_akomodasi, 0, ',', '.'); ?>/org</p>
                    </div>
                    <?php endif; ?>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Peserta</p>
                        <p class="font-bold text-slate-900"><?= $pemesanan->jumlah_peserta; ?> orang</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Tipe Pembayaran</p>
                        <p class="font-bold text-slate-900"><?= ($pemesanan->tipe_pembayaran ?? 'full') == 'dp' ? 'DP (Uang Muka)' : 'Lunas (Full)'; ?></p>
                    </div>
                    <div class="bg-brand-50 rounded-2xl p-4 border-2 border-brand-100">
                        <p class="text-brand-500 text-[10px] font-bold uppercase tracking-wider mb-1">Total Bayar</p>
                        <p class="font-extrabold gradient-text text-xl">Rp <?= number_format($pemesanan->total_bayar, 0, ',', '.'); ?></p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Tanggal Transaksi</p>
                        <p class="font-bold text-slate-900"><?= date('d F Y H:i', strtotime($pemesanan->tgl_transaksi)); ?> WIB</p>
                    </div>
                </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Pemesan</p>
                        <p class="font-bold text-slate-900"><?= $pemesanan->nama_lengkap; ?></p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Keberangkatan</p>
                        <p class="font-bold text-slate-900"><?= date('d F Y', strtotime($pemesanan->tgl_keberangkatan)); ?></p>
                    </div>
                    <?php if (!empty($pemesanan->jam_keberangkatan)): ?>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Jam Keberangkatan</p>
                        <p class="font-bold text-slate-900"><?= date('H:i', strtotime($pemesanan->jam_keberangkatan)); ?> WIB</p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($pemesanan->titik_kumpul)): ?>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Titik Kumpul</p>
                        <p class="font-bold text-slate-900 text-sm"><?= $pemesanan->titik_kumpul; ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Peserta</p>
                        <p class="font-bold text-slate-900"><?= $pemesanan->jumlah_peserta; ?> orang</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Harga/orang</p>
                        <p class="font-bold text-slate-900">Rp <?= number_format($pemesanan->harga, 0, ',', '.'); ?></p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Tipe Pembayaran</p>
                        <p class="font-bold text-slate-900"><?= ($pemesanan->tipe_pembayaran ?? 'full') == 'dp' ? 'DP (Uang Muka)' : 'Lunas (Full)'; ?></p>
                    </div>
                    <div class="bg-brand-50 rounded-2xl p-4 border-2 border-brand-100">
                        <p class="text-brand-500 text-[10px] font-bold uppercase tracking-wider mb-1">Total Bayar</p>
                        <p class="font-extrabold gradient-text text-xl">Rp <?= number_format($pemesanan->total_bayar, 0, ',', '.'); ?></p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Tanggal Transaksi</p>
                        <p class="font-bold text-slate-900"><?= date('d F Y H:i', strtotime($pemesanan->tgl_transaksi)); ?> WIB</p>
                    </div>
                </div>

                <?php if (!empty($pemesanan->catatan)): ?>
                <div class="bg-sky-50 rounded-2xl p-4 border border-sky-100 mb-6">
                    <p class="text-sky-600 text-[10px] font-bold uppercase tracking-wider mb-1">Catatan</p>
                    <p class="text-sky-900 text-sm"><?= $pemesanan->catatan; ?></p>
                </div>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="<?= base_url('pemesanan/invoice/' . $pemesanan->id_pemesanan); ?>" class="flex-1 text-center gradient-bg text-white py-3.5 rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-brand-500/40 hover:scale-105 active:scale-95 transition-all duration-300 inline-flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded text-[18px]">receipt_long</span> Lihat Invoice
                    </a>
                    <a href="<?= base_url('pemesanan'); ?>" class="flex-1 text-center bg-slate-100 text-slate-700 py-3.5 rounded-2xl font-semibold text-sm hover:bg-slate-200 transition inline-flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded text-[18px]">search</span> Cek Lainnya
                    </a>
                </div>
            </div>
        </div>
        <?php elseif ($kode): ?>
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border-2 border-red-200 p-8 text-center animate-fade-in-up">
            <span class="material-symbols-rounded text-red-400 text-5xl">error</span>
            <p class="text-red-700 font-bold text-lg mt-4">Kode booking tidak ditemukan</p>
            <p class="text-red-500 text-sm mt-1">Pastikan kode yang Anda masukkan benar</p>
        </div>
        <?php endif; ?>
    </div>
</main>
