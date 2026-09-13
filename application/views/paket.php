<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">

    <!-- Page Header -->
    <div class="page-header animate-fade-in-up">
        <div class="page-header-icon">
            <span class="material-symbols-rounded">luggage</span>
        </div>
        <div class="page-header-content">
            <h1>Paket <span class="gradient-text">Wisata</span></h1>
            <p>Temukan paket wisata terbaik untuk perjalanan Anda</p>
        </div>
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

    <!-- Search Bar -->
    <div class="mt-4 mb-6 animate-fade-in-up" style="animation-delay: 0.05s;">
        <div class="relative w-full">
            <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
            <input type="text" id="search-paket" placeholder="Cari paket wisata..." 
                class="w-full pl-12 pr-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-300 hover:border-slate-300">
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-3 mb-8 overflow-x-auto pb-2" id="filter-tabs">
        <button onclick="filterPaket('semua')" class="filter-btn group relative px-6 py-3 rounded-xl text-sm font-bold bg-white text-slate-600 border-2 border-slate-200 transition-all duration-300 hover:border-slate-300 hover:bg-slate-50 hover:shadow-lg hover:shadow-slate-300/20 hover:scale-105 active:scale-95" data-filter="semua">
            <span class="relative z-10 flex items-center gap-2">
                <span class="material-symbols-rounded text-[18px]">grid_view</span>
                Semua
            </span>
        </button>
        <button onclick="filterPaket('tersedia')" class="filter-btn group relative px-6 py-3 rounded-xl text-sm font-bold bg-white text-slate-600 border-2 border-slate-200 transition-all duration-300 hover:border-slate-300 hover:bg-slate-50 hover:shadow-lg hover:shadow-slate-300/20 hover:scale-105 active:scale-95" data-filter="tersedia">
            <span class="relative z-10 flex items-center gap-2">
                <span class="material-symbols-rounded text-[18px]">check_circle</span>
                Tersedia
            </span>
        </button>
<button onclick="filterPaket('penuh')" class="filter-btn group relative px-6 py-3 rounded-xl text-sm font-bold bg-white text-slate-600 border-2 border-slate-200 transition-all duration-300 hover:border-slate-300 hover:bg-slate-50 hover:shadow-lg hover:shadow-slate-300/20 hover:scale-105 active:scale-95" data-filter="penuh">
            <span class="relative z-10 flex items-center gap-2">
                <span class="material-symbols-rounded text-[18px]">cancel</span>
                Tidak Tersedia
            </span>
        </button>
    </div>

    <!-- Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="paket-grid">
        <?php if (!empty($paket)): ?>
            <?php foreach ($paket as $i => $p): 
                $delay = ($i % 6) * 0.1; // Stagger animation for up to 6 items
            ?>
            <div class="paket-card group relative rounded-2xl overflow-hidden bg-white border border-slate-200/80 shadow-md shadow-slate-200/50 animate-fade-in-up hover:shadow-2xl hover:shadow-brand-500/30 hover:-translate-y-1 transition-all duration-300 cursor-pointer"
                 data-status="<?= $p->status; ?>" 
                 data-nama="<?= strtolower($p->nama_paket); ?>"
                 style="animation-delay: <?= $delay; ?>s;">
                
                <!-- Image Container -->
                <div class="relative overflow-hidden aspect-video">
                    <img src="<?= base_url('application/assets/images/paket/' . $p->foto . '?v=' . time()); ?>"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 left-4">
<span class="badge <?= $p->status == 'tersedia' ? 'badge-tersedia' : 'badge-penuh'; ?> shadow-lg">
                            <?= $p->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia'; ?>
                        </span>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-5">
                    <h3 class="font-bold text-base text-slate-900 group-hover:text-brand-600 transition-colors line-clamp-1 mb-2"><?= $p->nama_paket; ?></h3>
                    <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed mb-4"><?= character_limiter($p->deskripsi, 100); ?></p>
                    
                    <!-- Features -->
                    <div class="flex items-center gap-2 text-slate-600 text-sm flex-wrap mb-4">
                        <span class="flex items-center gap-1.5 bg-slate-50 px-2.5 py-1.5 rounded-lg border border-slate-100">
                            <span class="material-symbols-rounded text-[16px] text-brand-600">schedule</span> 
                            <span class="font-medium text-xs"><?= $p->durasi_hari; ?> Hari</span>
                        </span>
                        <span class="flex items-center gap-1.5 bg-slate-50 px-2.5 py-1.5 rounded-lg border border-slate-100">
                            <span class="material-symbols-rounded text-[16px] text-brand-600">place</span> 
                            <span class="font-medium text-xs"><?= $p->jumlah_destinasi; ?> Destinasi</span>
                        </span>
                        <?php if (!empty($p->fasilitas_count)): ?>
                        <span class="flex items-center gap-1.5 bg-brand-50 px-2.5 py-1.5 rounded-lg border border-brand-100">
                            <span class="material-symbols-rounded text-[16px] text-brand-600">verified</span> 
                            <span class="font-medium text-xs text-brand-700"><?= $p->fasilitas_count; ?> Fasilitas</span>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Price & Action -->
                    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Mulai dari</p>
                            <p class="text-xl font-extrabold gradient-text">Rp <?= number_format($p->harga, 0, ',', '.'); ?></p>
                        </div>
                        <a href="<?= base_url('paket/detail/' . $p->id_paket); ?>"
class="group/btn inline-flex items-center gap-2 bg-gradient-to-r from-brand-600 to-brand-500 text-white px-4 py-2.5 rounded-full text-sm font-bold hover:from-brand-700 hover:to-brand-600 hover:shadow-xl hover:shadow-brand-500/50 transition-all duration-300 hover:scale-105 active:scale-95">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                            Detail
                            <span class="material-symbols-rounded text-[16px] group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3">
                <div class="admin-card text-center py-16">
                    <span class="material-symbols-rounded text-slate-300 text-7xl block mb-4">luggage</span>
                    <p class="text-slate-400 text-lg font-medium">Belum ada paket wisata tersedia.</p>
                    <p class="text-slate-400 text-sm mt-2">Silakan cek kembali nanti untuk paket terbaru</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
function filterPaket(status) {
    // Update button styles
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('bg-gradient-to-r', 'from-brand-600', 'to-brand-500', 'text-white', 'shadow-lg', 'shadow-brand-500/30');
        btn.classList.add('bg-white', 'text-slate-600', 'border-2', 'border-slate-200');
    });

    const active = document.querySelector(`[data-filter="${status}"]`);
    active.classList.remove('bg-white', 'text-slate-600', 'border-2', 'border-slate-200');
    active.classList.add('bg-gradient-to-r', 'from-brand-600', 'to-brand-500', 'text-white', 'shadow-lg', 'shadow-brand-500/30');

    // Filter cards with animation
    const cards = document.querySelectorAll('.paket-card');
    cards.forEach((card, index) => {
        const shouldShow = status === 'semua' || card.dataset.status === status;
        
        if (shouldShow) {
            card.style.display = '';
            // Add staggered animation
            card.style.animation = 'none';
            card.offsetHeight; // Trigger reflow
            card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.05}s forwards`;
        } else {
            card.style.display = 'none';
        }
    });
}

// Search functionality with debounce
let searchTimeout;
document.getElementById('search-paket').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        const q = this.value.toLowerCase();
        const cards = document.querySelectorAll('.paket-card');
        
        cards.forEach((card, index) => {
            const matches = card.dataset.nama.includes(q);
            card.style.display = matches ? '' : 'none';
            
            if (matches && this.value) {
                card.style.animation = 'none';
                card.offsetHeight;
                card.style.animation = `fadeInUp 0.4s ease-out ${index * 0.03}s forwards`;
            }
        });
    }, 300);
});

// Add smooth scroll behavior
document.querySelectorAll('.paket-card').forEach(card => {
    card.addEventListener('click', function(e) {
        if (!e.target.closest('a')) {
            const link = this.querySelector('a[href*="detail"]');
            if (link) {
                window.location.href = link.href;
            }
        }
    });
});

// Set "Semua" sebagai filter aktif saat halaman dimuat
filterPaket('semua');
</script>


