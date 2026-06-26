<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">tune</span>
    </div>
    <div class="page-header-content">
        <h1>Edit Kriteria</h1>
        <p><?= $kriteria->nama_kriteria; ?></p>
    </div>
</div>

<div class="admin-form-wrap">
    <?= form_open('admin/kriteria/edit/' . $kriteria->id_kriteria, ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500 text-xl">badge</span> Nama Kriteria
            </label>
            <input type="text" value="<?= $kriteria->nama_kriteria; ?>" disabled
                class="form-input" style="background: #f1f5f9; color: #64748b;">
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">tune</span> Bobot
                </label>
                <input type="number" name="bobot" value="<?= set_value('bobot', $kriteria->bobot); ?>" step="any" min="0" max="1"
                    class="form-input" required>
                <p class="form-help">Nilai antara 0 - 1</p>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <span class="material-symbols-rounded text-sky-500 text-xl">toggle_on</span> Sifat
                </label>
                <select name="sifat" class="form-input" required>
                    <option value="benefit" <?= set_select('sifat', 'benefit', $kriteria->sifat == 'benefit'); ?>>Benefit (Semakin besar semakin baik)</option>
                    <option value="cost" <?= set_select('sifat', 'cost', $kriteria->sifat == 'cost'); ?>>Cost (Semakin kecil semakin baik)</option>
                </select>
            </div>
        </div>

<div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-xl">save</span> Update
            </button>
            <a href="<?= base_url('admin/kriteria'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded text-xl">close</span> Batal
            </a>
        </div>

    <?= form_close(); ?>

</div>