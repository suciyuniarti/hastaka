<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">tune</span>
    </div>
    <div class="page-header-content">
        <h1>Nilai Alternatif</h1>
        <p><?= $paket->nama_paket; ?></p>
    </div>
</div>

<div class="admin-form-wrap">
    <?= form_open('admin/nilai/' . $paket->id_paket, ['class' => 'space-y-4']); ?>

    <?php foreach ($kriteria as $kr): ?>
    <?php
    $nilai_kr = null;
    foreach ($nilai as $n) {
        if ($n->id_kriteria == $kr->id_kriteria) { $nilai_kr = $n; break; }
    }
    ?>
    <div class="flex items-center gap-4 py-4 px-5 rounded-2xl hover:bg-sky-50/60 transition border border-slate-100">
        <div class="w-48 flex-shrink-0">
            <div class="flex items-center gap-2.5">
                <span class="w-8 h-8 bg-sky-50 border border-sky-100 text-sky-700 rounded-lg flex items-center justify-center text-xs font-bold"><?= $kr->kode_kriteria; ?></span>
                <p class="font-bold text-slate-800"><?= $kr->nama_kriteria; ?></p>
            </div>
            <p class="text-xs text-slate-500 mt-1.5 ml-10.5">
                <span class="bg-sky-50 text-sky-600 border border-sky-200 px-2 py-0.5 rounded-full font-bold uppercase text-[10px]"><?= $kr->sifat; ?></span>
            </p>
        </div>
        <input type="number" name="nilai_<?= $kr->id_kriteria; ?>" step="any"
            value="<?= $nilai_kr ? $nilai_kr->nilai : 0; ?>"
            class="form-input">
    </div>
    <?php endforeach; ?>

<div class="form-actions">
        <button type="submit" class="btn btn-success">
            <span class="material-symbols-rounded text-lg">save</span> Simpan Nilai
        </button>
        <a href="<?= base_url('admin/paket'); ?>" class="btn btn-secondary">
            <span class="material-symbols-rounded text-lg">close</span> Batal
        </a>
    </div>

    <?= form_close(); ?>

</div>