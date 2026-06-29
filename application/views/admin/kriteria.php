<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">tune</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Kriteria SAW</h1>
        <p>Atur bobot dan sifat kriteria untuk perhitungan SAW</p>
    </div>
</div>

<div class="admin-card mb-6 flex items-start gap-3">
    <span class="material-symbols-rounded text-sky-500 mt-0.5">info</span>
    <div class="text-sm text-sky-800">
        <p class="font-bold mb-1">Metode SAW (Simple Additive Weighting)</p>
        <p>Kriteria digunakan dalam perhitungan pembobotan untuk menentukan rekomendasi paket wisata terbaik. <strong class="font-bold">Bobot default</strong> di sini bersifat referensi — bobot aktual ditentukan oleh pengguna di halaman Rekomendasi. <strong class="font-bold">Sifat</strong> menentukan apakah nilai semakin besar semakin baik (benefit) atau semakin kecil semakin baik (cost).</p>
    </div>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table text-sm">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-20">Kode</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Nama Kriteria</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider">Sumber Data</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-20 text-center">Bobot</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-24 text-center">Sifat</th>
                    <th class="py-4 px-5 font-bold text-xs uppercase tracking-wider w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kriteria)): ?>
                <?php foreach ($kriteria as $kr): ?>
                <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap">
                    <td class="py-4 px-5">
                        <span class="w-10 h-10 bg-sky-50 border border-sky-100 text-sky-700 rounded-xl flex items-center justify-center text-sm font-bold"><?= $kr->kode_kriteria; ?></span>
                    </td>
                    <td class="py-4 px-5 font-bold text-slate-800"><?= $kr->nama_kriteria; ?></td>
                    <td class="py-4 px-5">
                        <?php
                        $sumber = [
                            'C1' => ['Harga Paket', 'payments'],
                            'C2' => ['Durasi (Hari)', 'schedule'],
                            'C3' => ['Jml Destinasi', 'place'],
                            'C4' => ['Jml Aktivitas', 'hiking'],
                        ];
                        $src = $sumber[$kr->kode_kriteria] ?? ['-', 'help'];
                        ?>
                        <span class="flex items-center gap-1.5 text-xs text-slate-500">
                            <span class="material-symbols-rounded text-[14px] text-slate-400"><?= $src[1]; ?></span>
                            <?= $src[0]; ?>
                        </span>
                    </td>
                    <td class="py-4 px-5 text-center">
                        <span class="bg-amber-50 text-amber-600 border border-amber-200 px-3 py-1 rounded-full text-xs font-bold"><?= $kr->bobot; ?></span>
                    </td>
                    <td class="py-4 px-5 text-center">
                        <span class="badge <?= 'badge-' . $kr->sifat; ?>"><?= strtoupper($kr->sifat); ?></span>
                    </td>
                    <td class="py-4 px-5 text-center">
                        <a href="<?= base_url('admin/kriteria/edit/' . $kr->id_kriteria); ?>" class="btn btn-primary btn-icon-sm" title="Edit"><span class="material-symbols-rounded text-sm">edit</span> Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="6" class="py-12 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <span class="material-symbols-rounded">tune</span>
                        </div>
                        <h3>Belum ada kriteria.</h3>
                    </div>
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>