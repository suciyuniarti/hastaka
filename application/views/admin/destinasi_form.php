<?php $is_edit = isset($destinasi) && $destinasi; ?>

<div class="space-y-6">
    <div class="admin-form-wrap max-w-2xl">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                <span class="material-symbols-rounded text-sky-600 text-xl"><?= $is_edit ? 'edit' : 'add'; ?></span>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900"><?= $is_edit ? 'Edit' : 'Tambah'; ?> Destinasi</h1>
                <p class="text-sm text-slate-500"><?= $is_edit ? 'Perbarui informasi destinasi wisata' : 'Tambahkan destinasi baru'; ?></p>
            </div>
        </div>

        <?= form_open($is_edit ? 'admin/destinasi/edit/' . $destinasi->id_destinasi : 'admin/destinasi/tambah', ['class' => 'space-y-5']); ?>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">badge</span> Nama Destinasi <span class="required">*</span>
            </label>
            <input type="text" name="nama_destinasi" value="<?= set_value('nama_destinasi', $is_edit ? $destinasi->nama_destinasi : ''); ?>"
                class="form-input" required>
            <?= form_error('nama_destinasi', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
        </div>

        <div class="form-group">
            <label class="form-label">
                <span class="material-symbols-rounded text-sky-500">location_city</span> Kota <span class="required">*</span>
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

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="material-symbols-rounded text-lg"><?= $is_edit ? 'update' : 'save'; ?></span>
                <?= $is_edit ? 'Update' : 'Simpan'; ?>
            </button>
            <a href="<?= base_url('admin/destinasi'); ?>" class="btn btn-secondary">
                <span class="material-symbols-rounded">close</span> Batal
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>