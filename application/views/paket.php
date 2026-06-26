<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10 animate-fade-in-up">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">Paket <span class="gradient-text">Wisata</span></h1>
            <p class="text-gray-500 mt-1">Temukan paket wisata terbaik untuk perjalanan Anda</p>
        </div>
        <!-- Search -->
        <div class="relative w-full sm:w-72">
            <span class="material-symbols-rounded absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
            <input type="text" id="search-paket" placeholder="Cari paket..."
                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition">
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl mb-6 animate-slide-down">
        <span class="material-symbols-rounded text-emerald-400">check_circle</span>
        <span class="text-sm"><?= $this->session->flashdata('success'); ?></span>
    </div>
    <?php endif; ?>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-2 mb-8 overflow-x-auto pb-2" id="filter-tabs">
        <button onclick="filterPaket('semua')" class="filter-btn px-4 py-2 rounded-xl text-sm font-medium bg-brand-600 text-white transition" data-filter="semua">Semua</button>
        <button onclick="filterPaket('tersedia')" class="filter-btn px-4 py-2 rounded-xl text-sm font-medium bg-blue-50 text-brand-600 hover:bg-brand-100 transition" data-filter="tersedia">Tersedia</button>
        <button onclick="filterPaket('penuh')" class="filter-btn px-4 py-2 rounded-xl text-sm font-medium bg-blue-50 text-brand-600 hover:bg-brand-100 transition" data-filter="penuh">Penuh</button>
    </div>

    <!-- Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="paket-grid">
        <?php if (!empty($paket)): ?>
            <?php foreach ($paket as $i => $p): ?>
            <div class="paket-card group hover-lift rounded-3xl overflow-hidden bg-white shadow-lg shadow-gray-200/50 animate-fade-in-up" data-status="<?= $p->status; ?>" data-nama="<?= strtolower($p->nama_paket); ?>">
                <div class="relative overflow-hidden">
                    <img src="<?= base_url('application/assets/images/paket/' . $p->foto . '?v=' . time()); ?>"
                        class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500"
                        onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                    <div class="absolute top-4 left-4">
                        <span class="status-badge <?= $p->status == 'tersedia' ? 'status-tersedia' : 'status-penuh'; ?>">
                            <?= ucfirst($p->status); ?>
                        </span>
                    </div>

                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-brand-600 transition line-clamp-1"><?= $p->nama_paket; ?></h3>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2"><?= character_limiter($p->deskripsi, 100); ?></p>
                    <div class="flex items-center gap-3 mt-3 text-gray-500 text-sm flex-wrap">
                        <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">schedule</span> <?= $p->durasi_hari; ?> Hari</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">place</span> <?= $p->jumlah_destinasi; ?> Destinasi</span>
                        <?php if (!empty($p->fasilitas_count)): ?>
                        <span class="flex items-center gap-1 text-brand-600"><span class="material-symbols-rounded text-[14px]">verified</span> <?= $p->fasilitas_count; ?> Fasilitas</span>
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-between items-center mt-5 pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-[10px] text-gray-400 font-semibold uppercase">Mulai dari</p>
                            <p class="text-xl font-extrabold gradient-text">Rp <?= number_format($p->harga, 0, ',', '.'); ?></p>
                        </div>
                        <a href="<?= base_url('paket/detail/' . $p->id_paket); ?>"
                            class="inline-flex items-center gap-1.5 bg-brand-50 text-brand-700 px-4 py-2 rounded-full text-sm font-semibold hover:bg-brand-100 transition">
                            <span class="material-symbols-rounded text-[16px]">visibility</span> Detail
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-16">
                <span class="material-symbols-rounded text-gray-300 text-6xl">luggage</span>
                <p class="text-gray-400 mt-4 text-lg">Belum ada paket wisata tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
function filterPaket(status) {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('bg-brand-600','text-white');
        btn.classList.add('bg-gray-100','text-gray-600');
    });
    const active = document.querySelector(`[data-filter="${status}"]`);
    active.classList.remove('bg-gray-100','text-gray-600');
    active.classList.add('bg-brand-600','text-white');

    document.querySelectorAll('.paket-card').forEach(card => {
        if (status === 'semua' || card.dataset.status === status) {
            card.style.display = '';
            card.classList.add('animate-fade-in');
        } else {
            card.style.display = 'none';
        }
    });
}

document.getElementById('search-paket').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.paket-card').forEach(card => {
        card.style.display = card.dataset.nama.includes(q) ? '' : 'none';
    });
});
</script>


