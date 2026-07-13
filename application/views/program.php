<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="text-center mb-14 animate-fade-in-up">
        <div class="inline-flex items-center gap-2 bg-brand-50 border border-brand-200 rounded-full px-4 py-1.5 text-brand-700 text-sm font-semibold mb-4">
            <span class="material-symbols-rounded text-[16px]">category</span>
            Program Perjalanan Kami
        </div>
        <h1 class="text-4xl font-extrabold text-gray-900 mb-3">Program <span class="gradient-text">Hastaka</span></h1>
        <p class="text-gray-500 max-w-xl mx-auto">Kami menyediakan berbagai jenis program perjalanan yang dirancang untuk memenuhi kebutuhan berbeda, mulai dari edukasi hingga rekreasi.</p>
    </div>

    <!-- Program Grid -->
    <?php if (!empty($kategori)): ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-14">
    <?php
    $colors = [
        ['from' => 'from-brand-400', 'to' => 'to-brand-600', 'bg' => 'bg-brand-50', 'text' => 'text-brand-700', 'border' => 'border-brand-200', 'shadow' => 'shadow-brand-500/20'],
        ['from' => 'from-sky-400', 'to' => 'to-sky-600', 'bg' => 'bg-sky-50', 'text' => 'text-sky-700', 'border' => 'border-sky-200', 'shadow' => 'shadow-sky-500/20'],
        ['from' => 'from-cyan-400', 'to' => 'to-cyan-600', 'bg' => 'bg-cyan-50', 'text' => 'text-cyan-700', 'border' => 'border-cyan-200', 'shadow' => 'shadow-cyan-500/20'],
        ['from' => 'from-blue-400', 'to' => 'to-blue-600', 'bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'shadow' => 'shadow-blue-500/20'],
        ['from' => 'from-indigo-400', 'to' => 'to-indigo-600', 'bg' => 'bg-indigo-50', 'text' => 'text-indigo-700', 'border' => 'border-indigo-200', 'shadow' => 'shadow-indigo-500/20'],
        ['from' => 'from-teal-400', 'to' => 'to-teal-600', 'bg' => 'bg-teal-50', 'text' => 'text-teal-700', 'border' => 'border-teal-200', 'shadow' => 'shadow-teal-500/20'],
    ];
        ?>
        <?php foreach ($kategori as $i => $kat): ?>
        <?php $c = $colors[$i % count($colors)]; ?>
        <div class="group bg-white rounded-2xl overflow-hidden shadow-md shadow-slate-200/50 border-2 border-slate-200/80 hover:shadow-2xl hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300 animate-fade-in-up" style="animation-delay: <?= $i * 0.1; ?>s;">
            <div class="bg-gradient-to-r <?= $c['from']; ?> <?= $c['to']; ?> p-6 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 200 100"><defs><pattern id="prog-dots-<?= $i; ?>" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#prog-dots-<?= $i; ?>)"/></svg>
                </div>
                <div class="relative z-10">
                <div class="w-14 h-14 bg-white/25 backdrop-blur rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <span class="material-symbols-rounded text-white text-3xl"><?= $kat->icon ?? 'school'; ?></span>
                </div>
                    <h3 class="text-xl font-extrabold text-white"><?= $kat->nama_kategori; ?></h3>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-brand-600 transition-colors"><?= $kat->nama_kategori; ?></h3>
                <?php if (!empty($kat->sasaran)): ?>
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-rounded text-brand-500 text-[16px]">target</span>
                    <p class="text-sm font-semibold text-gray-700"><?= $kat->sasaran; ?></p>
                </div>
                <?php endif; ?>
                <?php if (!empty($kat->deskripsi)): ?>
                <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2"><?= $kat->deskripsi; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="text-center py-20">
        <span class="material-symbols-rounded text-gray-300 text-6xl">category</span>
        <p class="text-gray-400 mt-4 text-lg">Belum ada program tersedia.</p>
    </div>
    <?php endif; ?>

    <!-- CTA -->
    <div class="gradient-bg rounded-3xl p-10 text-center relative overflow-hidden animate-fade-in-up">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200"><defs><pattern id="prog-cta-dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#prog-cta-dots)"/></svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3">Tertarik dengan Program Kami?</h2>
            <p class="text-white/80 max-w-lg mx-auto mb-6">Lihat paket wisata yang tersedia dan mulai rencanakan perjalanan Anda bersama Hastaka Holiday.</p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-2 bg-white text-brand-700 px-8 py-3.5 rounded-2xl font-bold hover:bg-white/90 transition shadow-xl">
                    <span class="material-symbols-rounded text-[20px]">luggage</span> Lihat Paket
                </a>
                <a href="<?= base_url('rekomendasi'); ?>" class="inline-flex items-center gap-2 bg-white/15 backdrop-blur text-white px-8 py-3.5 rounded-2xl font-bold hover:bg-white/25 transition border border-white/20">
                    <span class="material-symbols-rounded text-[20px]">auto_awesome</span> Rekomendasi
                </a>
            </div>
        </div>
    </div>
</main>
