<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="text-center mb-14 animate-fade-in-up">
        <div class="inline-flex items-center gap-2 bg-brand-50 border border-brand-200 rounded-full px-4 py-1.5 text-brand-700 text-sm font-semibold mb-4">
            <span class="material-symbols-rounded text-[16px]\">groups</span>
            Dipercaya oleh Berbagai Instansi
        </div>
        <h1 class="text-4xl font-extrabold text-gray-900 mb-3">Klien <span class="gradient-text">Kami</span></h1>
        <p class="text-gray-500 max-w-xl mx-auto">Hastaka Holiday telah dipercaya oleh berbagai sekolah, perusahaan, instansi pemerintah, dan komunitas untuk menyelenggarakan perjalanan terbaik.</p>
    </div>

    <!-- Client Grid -->
    <?php
    $jenis_icons = [
        'sekolah' => ['school', 'bg-brand-500', 'bg-brand-50', 'text-brand-700', 'border-brand-200'],
        'perusahaan' => ['apartment', 'bg-sky-500', 'bg-sky-50', 'text-sky-700', 'border-sky-200'],
        'instansi' => ['account_balance', 'bg-cyan-500', 'bg-cyan-50', 'text-cyan-700', 'border-cyan-200'],
        'komunitas' => ['diversity_3', 'bg-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-200'],
    ];
    $jenis_labels = ['sekolah' => 'Sekolah', 'perusahaan' => 'Perusahaan', 'instansi' => 'Instansi Pemerintah', 'komunitas' => 'Komunitas'];
    ?>

    <?php if (!empty($klien)): ?>
    <?php
    // Group by jenis
    $grouped = [];
    foreach ($klien as $k) $grouped[$k->jenis][] = $k;
    ?>
    <?php foreach ($grouped as $jenis => $items): ?>
    <?php $cfg = $jenis_icons[$jenis] ?? ['groups', 'bg-gray-500', 'bg-gray-50', 'text-gray-700', 'border-gray-200']; ?>
    <div class="mb-12 animate-fade-in-up">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 <?= $cfg[1]; ?> rounded-xl flex items-center justify-center shadow-lg">
                <span class="material-symbols-rounded text-white text-xl"><?= $cfg[0]; ?></span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900"><?= $jenis_labels[$jenis] ?? ucfirst($jenis); ?></h2>
                <p class="text-gray-400 text-sm"><?= count($items); ?> klien</p>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($items as $k): ?>
            <div class="group bg-white rounded-2xl p-5 shadow-md shadow-slate-200/50 border-2 border-slate-200/80 hover:shadow-lg hover:shadow-brand-500/20 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-start gap-4">
                    <?php if (!empty($k->logo)): ?>
                    <img src="<?= base_url('application/assets/images/klien/' . $k->logo); ?>" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 border-2 border-slate-200 group-hover:scale-110 group-hover:border-brand-300 transition-all duration-300" onerror="this.style.display='none'">
                    <?php else: ?>
                    <div class="w-14 h-14 <?= $cfg[2]; ?> rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 border-2 <?= $cfg[4]; ?>">
                        <span class="material-symbols-rounded <?= $cfg[3]; ?> text-2xl"><?= $cfg[0]; ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-gray-900 truncate"><?= $k->nama_klien; ?></h3>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold <?= $cfg[3]; ?> <?= $cfg[2]; ?> px-2 py-0.5 rounded-full border <?= $cfg[4]; ?> mt-1">
                            <?= $jenis_labels[$k->jenis] ?? ucfirst($k->jenis); ?>
                        </span>
                        <?php if (!empty($k->website)): ?>
                        <a href="<?= $k->website; ?>" target="_blank" class="text-brand-600 hover:text-brand-700 text-xs font-semibold mt-2 inline-flex items-center gap-1">
                            <span class="material-symbols-rounded text-[12px]">open_in_new</span> Website
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="text-center py-20">
        <span class="material-symbols-rounded text-gray-300 text-6xl">groups</span>
        <p class="text-gray-400 mt-4 text-lg">Belum ada data klien.</p>
    </div>
    <?php endif; ?>

    <!-- CTA -->
    <div class="gradient-bg rounded-3xl p-10 text-center relative overflow-hidden animate-fade-in-up">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200"><defs><pattern id="client-dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="white"/></pattern></defs><rect width="100%" height="100%" fill="url(#client-dots)"/></svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3">Ingin Bekerja Sama dengan Kami?</h2>
            <p class="text-white/80 max-w-lg mx-auto mb-6\">Hubungi kami untuk mendiskusikan kebutuhan perjalanan instansi, perusahaan, atau komunitas Anda.</p>
            <a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-2 bg-white text-brand-700 px-8 py-3.5 rounded-2xl font-bold hover:bg-white/90 transition shadow-xl">
                <span class="material-symbols-rounded text-[20px]">luggage</span> Lihat Paket Kami
            </a>
        </div>
    </div>
</main>
