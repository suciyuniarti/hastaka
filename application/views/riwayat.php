<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8 animate-fade-in-up">
        <h1 class="text-3xl font-extrabold text-slate-900">Riwayat <span class="gradient-text">Pemesanan</span></h1>
        <p class="text-slate-500 mt-1">Daftar semua pemesanan yang pernah Anda lakukan</p>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-2 border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-start gap-3 animate-slide-down shadow-lg shadow-emerald-500/10">
        <div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center flex-shrink-0">
            <span class="material-symbols-rounded text-white text-lg">check_circle</span>
        </div>
        <div class="flex-1">
            <p class="font-bold text-sm mb-0.5">Berhasil</p>
            <p class="text-sm text-emerald-700"><?= $this->session->flashdata('success'); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($pemesanan)): ?>
    <div class="space-y-4">
        <?php foreach ($pemesanan as $p): ?>
        <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 p-6 flex flex-col md:flex-row gap-6 hover-lift animate-fade-in-up">
            <img src="<?= base_url('application/assets/images/paket/' . $p->foto . '?v=' . time()); ?>"
                class="w-full md:w-44 h-32 object-cover rounded-2xl"
                onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">

            <div class="flex-1">
                <div class="flex justify-between items-start gap-4">
                    <div>
                        <h3 class="font-bold text-lg text-slate-900"><?= $p->nama_paket; ?></h3>
                        <?php if (!empty($p->nama_kategori)): ?>
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-sky-600 bg-sky-50 px-2 py-0.5 rounded-full border border-sky-200 mt-1">
                            <span class="material-symbols-rounded text-[12px]"><?= $p->kategori_icon; ?></span>
                            <?= $p->nama_kategori; ?>
                        </span>
                        <?php endif; ?>
                        <p class="text-slate-500 text-sm font-mono mt-1"><?= $p->kode_booking; ?></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold flex-shrink-0 <?= $p->status_pemesanan == 'pending' ? 'bg-amber-100 text-amber-700 border-2 border-amber-200' : ($p->status_pemesanan == 'dikonfirmasi' ? 'bg-emerald-100 text-emerald-700 border-2 border-emerald-200' : ($p->status_pemesanan == 'selesai' ? 'bg-brand-100 text-brand-700 border-2 border-brand-200' : 'bg-red-100 text-red-700 border-2 border-red-200')); ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?= $p->status_pemesanan == 'pending' ? 'bg-amber-500' : ($p->status_pemesanan == 'dikonfirmasi' ? 'bg-emerald-500' : ($p->status_pemesanan == 'selesai' ? 'bg-brand-500' : 'bg-red-500')); ?>"></span>
                        <?= ucfirst($p->status_pemesanan); ?>
                    </span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 text-sm">
                    <div>
                        <p class="text-slate-400 text-xs">Keberangkatan</p>
                        <p class="font-semibold text-slate-800"><?= date('d M Y', strtotime($p->tgl_keberangkatan)); ?></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs">Peserta</p>
                        <p class="font-semibold text-slate-800"><?= $p->jumlah_peserta; ?> orang</p>
                    </div>
                    <?php if (!empty($p->nama_akomodasi)): ?>
                    <div>
                        <p class="text-slate-400 text-xs">Akomodasi</p>
                        <p class="font-semibold text-brand-700 flex items-center gap-1">
                            <span class="material-symbols-rounded text-[12px]"><?= $p->akomodasi_icon ?? 'directions_bus'; ?></span>
                            <?= $p->nama_akomodasi; ?>
                        </p>
                    </div>
                    <?php endif; ?>
                    <div>
                        <p class="text-slate-400 text-xs">Total</p>
                        <p class="font-bold gradient-text">Rp <?= number_format($p->total_bayar, 0, ',', '.'); ?></p>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-3">
                    <a href="<?= base_url('pemesanan/invoice/' . $p->id_pemesanan); ?>"
                        class="inline-flex items-center gap-2 gradient-bg text-white px-5 py-2.5 rounded-full font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25">
                        <span class="material-symbols-rounded text-[18px]">receipt_long</span> Lihat Invoice
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 p-16 text-center animate-fade-in-up">
        <div class="w-20 h-20 gradient-bg rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-sky-500/20">
            <span class="material-symbols-rounded text-white text-4xl">receipt_long</span>
        </div>
        <p class="text-slate-500 text-lg mb-6">Belum ada riwayat pemesanan.</p>
        <a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-2 gradient-bg text-white px-8 py-3 rounded-full font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25">
            <span class="material-symbols-rounded text-[20px]">luggage</span> Jelajahi Paket Wisata
        </a>
    </div>
    <?php endif; ?>
</main>