<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10 animate-fade-in-up">
            <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                <span class="material-symbols-rounded text-[16px]">search</span> Cek Pesanan
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900">Cek <span class="gradient-text">Pesanan</span></h1>
            <p class="text-gray-500 mt-2">Masukkan kode booking Anda untuk melihat status pesanan</p>
        </div>

        <!-- Form Pencarian -->
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 mb-8 animate-fade-in-up stagger-1">
            <?= form_open('pemesanan', ['method' => 'GET']); ?>
            <div class="flex gap-3">
                <div class="relative flex-1">
                    <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">confirmation_number</span>
                    <input type="text" name="kode" value="<?= $kode; ?>"
                        class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-2xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                        placeholder="Contoh: HST20240101ABCD" required>
                </div>
                <button type="submit" class="gradient-bg text-white px-8 py-3.5 rounded-2xl font-bold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 flex items-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">search</span> Cek
                </button>
            </div>
            <?= form_close(); ?>
        </div>

        <!-- Hasil Pencarian -->
        <?php if ($kode && $pemesanan): ?>
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 animate-fade-in-up stagger-2">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900">Detail Pesanan</h2>
                    <p class="text-gray-500 text-sm font-mono mt-1"><?= $pemesanan->kode_booking; ?></p>
                </div>
                <?php
                $sc = ['pending'=>'bg-amber-100 text-amber-700','dikonfirmasi'=>'bg-emerald-100 text-emerald-700','selesai'=>'bg-brand-100 text-brand-700','dibatalkan'=>'bg-red-100 text-red-700'];
                $sl = ['pending'=>'Menunggu Konfirmasi','dikonfirmasi'=>'Dikonfirmasi','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'];
                ?>
                <span class="<?= $sc[$pemesanan->status_pemesanan]; ?> px-4 py-1.5 rounded-full font-bold text-xs">
                    <?= $sl[$pemesanan->status_pemesanan]; ?>
                </span>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-surface-50 rounded-2xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs mb-1">Paket Wisata</p>
                    <p class="font-bold text-gray-900"><?= $pemesanan->nama_paket; ?></p>
                </div>
                <div class="bg-surface-50 rounded-2xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs mb-1">Kategori Program</p>
                    <?php if (!empty($pemesanan->nama_kategori)): ?>
                    <p class="font-bold text-gray-900 flex items-center gap-1.5">
                        <span class="material-symbols-rounded text-brand-500 text-[16px]"><?= $pemesanan->kategori_icon; ?></span>
                        <?= $pemesanan->nama_kategori; ?>
                        <span class="text-[10px] text-gray-400 font-normal">(<?= $pemesanan->sasaran; ?>)</span>
                    </p>
                    <?php else: ?>
                    <p class="text-gray-300 text-xs italic">Belum dipilih</p>
                    <?php endif; ?>
                </div>
                <div class="bg-surface-50 rounded-2xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs mb-1">Nama Pemesan</p>
                    <p class="font-bold text-gray-900"><?= $pemesanan->nama_lengkap; ?></p>
                </div>
                <div class="bg-surface-50 rounded-2xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs mb-1">Tanggal Keberangkatan</p>
                    <p class="font-bold text-gray-900"><?= date('d F Y', strtotime($pemesanan->tgl_keberangkatan)); ?></p>
                </div>
                <div class="bg-surface-50 rounded-2xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs mb-1">Jumlah Peserta</p>
                    <p class="font-bold text-gray-900"><?= $pemesanan->jumlah_peserta; ?> orang</p>
                </div>
                <div class="bg-surface-50 rounded-2xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs mb-1">Total Bayar</p>
                    <p class="font-extrabold gradient-text text-lg">Rp <?= number_format($pemesanan->total_bayar, 0, ',', '.'); ?></p>
                </div>
                <div class="bg-surface-50 rounded-2xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs mb-1">Tanggal Transaksi</p>
                    <p class="font-bold text-gray-900"><?= date('d F Y H:i', strtotime($pemesanan->tgl_transaksi)); ?> WIB</p>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <a href="<?= base_url('pemesanan/invoice/' . $pemesanan->id_pemesanan); ?>" class="inline-flex items-center gap-2 gradient-bg text-white px-6 py-2.5 rounded-full font-bold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/20">
                    <span class="material-symbols-rounded text-[18px]">receipt_long</span> Lihat Invoice
                </a>
                <a href="<?= base_url('pemesanan'); ?>" class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 px-6 py-2.5 rounded-full font-semibold text-sm hover:bg-slate-200 transition">
                    <span class="material-symbols-rounded text-[18px]">search</span> Cek Lainnya
                </a>
            </div>
        </div>
        <?php elseif ($kode): ?>
        <div class="bg-red-50 border border-red-200 rounded-3xl p-8 text-center animate-fade-in-up">
            <span class="material-symbols-rounded text-red-400 text-5xl">error</span>
            <p class="text-red-700 font-semibold mt-3">Kode booking tidak ditemukan.</p>
            <p class="text-red-500 text-sm mt-1">Pastikan kode yang Anda masukkan benar.</p>
        </div>
        <?php endif; ?>
    </div>
</main>
