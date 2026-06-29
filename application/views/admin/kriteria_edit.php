<div class="space-y-6">
    <div class="admin-form-wrap max-w-2xl">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                <span class="material-symbols-rounded text-sky-600 text-xl">tune</span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900">Edit Kriteria</h1>
                <p class="text-sm text-slate-500"><?= $kriteria->nama_kriteria; ?></p>
            </div>
        </div>

        <?= form_open('admin/kriteria/edit/' . $kriteria->id_kriteria, ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">badge</span> Nama Kriteria
            </label>
            <input type="text" value="<?= $kriteria->nama_kriteria; ?>" disabled
                class="form-input" style="background: #f1f5f9; color: #64748b;">
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500">tune</span> Bobot
                </label>
                <input type="number" name="bobot" value="<?= set_value('bobot', $kriteria->bobot); ?>" step="any" min="0" max="1"
                    class="form-input" required>
                <p class="form-help">Nilai antara 0 - 1</p>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500">toggle_on</span> Sifat
                </label>
                <select name="sifat" class="form-input" required>
                    <option value="benefit" <?= set_select('sifat', 'benefit', $kriteria->sifat == 'benefit'); ?>>Benefit (Semakin besar semakin baik)</option>
                    <option value="cost" <?= set_select('sifat', 'cost', $kriteria->sifat == 'cost'); ?>>Cost (Semakin kecil semakin baik)</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg">save</span> Update
            </button>
            <a href="<?= base_url('admin/kriteria'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded">close</span> Batal
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>