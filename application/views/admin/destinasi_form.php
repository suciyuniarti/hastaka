<?php $is_edit = isset($destinasi) && $destinasi; ?>

<div class="page-header animate-fade-in-up">
    <div class="page-header-icon">
        <span class="material-symbols-rounded"><?= $is_edit ? 'edit' : 'add'; ?></span>
    </div>
    <div class="page-header-content">
        <h1><?= $is_edit ? 'Edit' : 'Tambah'; ?> Destinasi</h1>
        <p><?= $is_edit ? 'Perbarui informasi destinasi' : 'Tambahkan destinasi baru'; ?></p>
    </div>
</div>

<div class="admin-form-wrap">
    <?= form_open($is_edit ? 'admin/destinasi/edit/' . $destinasi->id_destinasi : 'admin/destinasi/tambah', ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500 text-xl">badge</span> Nama Destinasi
            </label>
            <input type="text" name="nama_destinasi" value="<?= set_value('nama_destinasi', $is_edit ? $destinasi->nama_destinasi : ''); ?>"
                class="form-input" required>
            <?= form_error('nama_destinasi', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500 text-xl">location_city</span> Kota
            </label>
            <select name="kota" class="form-input" required>
                <option value="" disabled <?= !$is_edit ? 'selected' : ''; ?>>Pilih Kota</option>
                <?php
                $kota_indonesia = [
                    'Aceh' => ['Banda Aceh','Sabang','Lhokseumawe','Meulaboh'],
                    'Sumatera Utara' => ['Medan','Pematangsiantar','Binjai','Tebing Tinggi'],
                    'Sumatera Barat' => ['Padang','Bukittinggi','Payakumbuh','Pariaman'],
                    'Riau' => ['Pekanbaru','Dumai','Bangkinang'],
                    'Kepulauan Riau' => ['Batam','Tanjung Pinang'],
                    'Jambi' => ['Jambi','Muara Bungo'],
                    'Sumatera Selatan' => ['Palembang','Prabumulih','Lubuklinggau'],
                    'Bengkulu' => ['Bengkulu'],
                    'Lampung' => ['Bandar Lampung','Metro'],
                    'Bangka Belitung' => ['Pangkal Pinang'],
                    'Banten' => ['Tangerang','Cilegon','Serang'],
                    'DKI Jakarta' => ['Jakarta Pusat','Jakarta Utara','Jakarta Barat','Jakarta Timur','Jakarta Selatan'],
                    'Jawa Barat' => ['Bandung','Bogor','Bekasi','Depok','Cirebon','Sukabumi','Garut','Tasikmalaya'],
                    'Jawa Tengah' => ['Semarang','Solo','Magelang','Pekalongan','Salatiga','Kudus','Kendal','Wonosobo'],
                    'DI Yogyakarta' => ['Yogyakarta','Sleman','Bantul','Kulon Progo','Gunung Kidul'],
                    'Jawa Timur' => ['Surabaya','Malang','Kediri','Blitar','Mojokerto','Jember','Probolinggo','Pasuruan','Gresik','Sidoarjo','Batu','Tulungagung'],
                    'Bali' => ['Denpasar','Singaraja','Gianyar','Tabanan','Badung','Klungkung','Karangasem'],
                    'Nusa Tenggara Barat' => ['Mataram','Bima','Sumbawa'],
                    'Nusa Tenggara Timur' => ['Kupang','Ende','Maumere','Labuan Bajo','Ruteng'],
                    'Kalimantan Barat' => ['Pontianak','Singkawang'],
                    'Kalimantan Tengah' => ['Palangka Raya'],
                    'Kalimantan Selatan' => ['Banjarmasin','Banjarbaru'],
                    'Kalimantan Timur' => ['Samarinda','Balikpapan','Bontang','Tenggarong'],
                    'Kalimantan Utara' => ['Tanjung Selor','Tarakan'],
                    'Sulawesi Utara' => ['Manado','Bitung','Tomohon'],
                    'Gorontalo' => ['Gorontalo'],
                    'Sulawesi Tengah' => ['Palu','Poso','Toli-Toli'],
                    'Sulawesi Barat' => ['Mamuju','Majene'],
                    'Sulawesi Selatan' => ['Makassar','Parepare','Palopo','Maros','Gowa'],
                    'Sulawesi Tenggara' => ['Kendari','Baubau'],
                    'Maluku' => ['Ambon','Tual'],
                    'Maluku Utara' => ['Ternate','Tidore'],
                    'Papua' => ['Jayapura','Sentani','Wamena'],
                    'Papua Barat' => ['Manokwari','Sorong','Fakfak'],
                    'Papua Selatan' => ['Merauke'],
                    'Papua Tengah' => ['Nabire','Timika'],
                    'Papua Pegunungan' => ['Wamena'],
                ];
                $current_kota = $is_edit ? $destinasi->kota : set_value('kota');
                foreach ($kota_indonesia as $provinsi => $kotas): ?>
                <optgroup label="<?= $provinsi; ?>">
                    <?php foreach ($kotas as $k): ?>
                    <option value="<?= $k; ?>" <?= $current_kota == $k ? 'selected' : ''; ?>><?= $k; ?></option>
                    <?php endforeach; ?>
                </optgroup>
                <?php endforeach; ?>
            </select>
            <?= form_error('kota', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500 text-xl">description</span> Deskripsi
            </label>
            <textarea name="deskripsi" rows="3" class="form-input"><?= set_value('deskripsi', $is_edit ? $destinasi->deskripsi : ''); ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-xl">save</span>
                <?= $is_edit ? 'Update' : 'Simpan'; ?>
            </button>
            <a href="<?= base_url('admin/destinasi'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded text-xl">close</span> Batal
            </a>
        </div>

    <?= form_close(); ?>

</div>