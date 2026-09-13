<?php
    // Mencegah browser men-cache form saat user menekan tombol Back (UX issue)
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
    }
?>

<?php if (!isset($paket) || !$paket): ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center">
            <span class="material-symbols-rounded text-red-500 text-4xl mb-2">error</span>
            <p class="text-red-700 font-semibold">Paket tidak ditemukan!</p>
            <a href="<?= base_url('paket'); ?>" class="inline-flex items-center gap-1 text-brand-600 hover:text-brand-700 text-sm font-medium mt-4 transition">Kembali ke Daftar Paket</a>
        </div>
    </div>
    <?php return; ?>
<?php endif; ?>
<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10 overflow-x-hidden">
    <a href="<?= base_url("paket/detail/{$paket->id_paket}"); ?>" class="inline-flex items-center gap-1 text-brand-600 hover:text-brand-700 text-sm font-medium mb-6 transition group">
        <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Kembali
    </a>

    <div class="flex flex-wrap items-center gap-3 mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 animate-fade-in-up">Booking <span class="gradient-text">Paket</span></h1>
        <span class="px-3 py-1 rounded-full bg-brand-100 text-brand-700 text-xs font-bold border border-brand-200 animate-fade-in-up">Form Pemesanan</span>
    </div>

    <!-- Grid checkout: kiri = semua input form (stack vertikal), kanan = Ringkasan Tagihan sticky -->
    <div class="grid lg:grid-cols-3 gap-6">

        <?= form_open_multipart("pemesanan/booking/{$paket->id_paket}", ['class' => 'contents']); ?>

        <!-- ===================== KOLOM KIRI ===================== -->
        <div class="lg:col-span-2 space-y-6 animate-fade-in-up stagger-1">
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border-2 border-slate-200/80 overflow-hidden">
<div class="bg-gradient-to-br from-brand-50 to-sky-50 border-b-2 border-brand-200 px-4 sm:px-8 py-5 flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm flex-shrink-0">
                        <span class="material-symbols-rounded text-brand-600 text-xl">luggage</span>
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-brand-900"><?= $paket->nama_paket; ?></p>
                        <p class="text-brand-600 text-xs flex flex-wrap items-center gap-2 mt-0.5">
                            <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[12px]">schedule</span> <?= $paket->durasi_hari; ?> Hari <?= $paket->durasi_hari > 1 ? ($paket->durasi_hari - 1) . ' Malam' : ''; ?></span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[12px]">place</span> <?= $paket->jumlah_destinasi; ?> Destinasi</span>
                        </p>
                    </div>
                </div>

                <div class="p-4 sm:p-8 space-y-6">
                    <?php if (validation_errors()): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-rounded text-red-500 text-[20px] mt-0.5">error</span>
                            <div>
                                <p class="font-bold text-red-800 text-sm mb-1">Mohon perbaiki kesalahan berikut:</p>
                                <ul class="text-red-700 text-xs space-y-1 list-disc list-inside">
                                    <?= validation_errors('<li>', '</li>'); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- a. Data Diri Pemesan -->
                    <div class="form-section">
                        <p class="section-label">
                            <span class="material-symbols-rounded text-[16px]">person</span>
                            Data Pemesan
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="relative">
                                    <input type="text" name="nama_pemesan" value="<?= set_value('nama_pemesan', $this->session->userdata('nama_lengkap')); ?>"
                                        class="form-input" required>
                                </div>
                                <?= form_error('nama_pemesan', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <label class="form-label">No. Telepon / WhatsApp</label>
                                <div class="relative">
                                    <input type="tel" name="no_telepon" value="<?= set_value('no_telepon'); ?>"
                                        class="form-input" placeholder="08xxxxxxxxxx" required maxlength="15" inputmode="numeric" pattern="[0-9]*"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <p class="form-help" style="margin-top:6px; color:#64748b;">Gunakan 10-15 digit angka.</p>
                                </div>

                                <?= form_error('no_telepon', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Titik Kumpul / Lokasi Penjemputan</label>
                            <div class="relative">
                                <input type="text" name="titik_kumpul" value="<?= set_value('titik_kumpul'); ?>"
                                    class="form-input" placeholder="Contoh: Terminal Bungurasih, Surabaya" required>
                            </div>
                            <?= form_error('titik_kumpul', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                        </div>
                    </div>

                    <!-- b. Detail Keberangkatan -->
                    <div class="form-section">
                        <p class="section-label">
                            <span class="material-symbols-rounded text-[16px]">event</span>
                            Detail Keberangkatan
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">Tanggal Keberangkatan</label>
                                <div class="relative">
                                    <input type="date" name="tgl_keberangkatan" value="<?= set_value('tgl_keberangkatan'); ?>"
                                        min="<?= date('Y-m-d', strtotime('+1 day')); ?>"
                                        class="form-input" required>
                                </div>
                                <?= form_error('tgl_keberangkatan', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                                <p id="return-date-info" class="text-emerald-600 text-xs mt-1.5 flex items-center gap-1 hidden">
                                    <span class="material-symbols-rounded text-[14px]">event_available</span>
                                    <span>Estimasi kembali: <strong id="return-date-text"></strong></span>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jam Keberangkatan</label>
                                <div class="relative">
                                    <input type="time" name="jam_keberangkatan" value="<?= set_value('jam_keberangkatan'); ?>"
                                        class="form-input" required>
                                </div>
                                <?= form_error('jam_keberangkatan', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Peserta</label>
                            <div class="relative">
                                <input type="number" name="jumlah_peserta" id="jml-peserta" value="<?= set_value('jumlah_peserta', $paket->min_peserta ?? '1'); ?>"
                                    min="<?= $paket->min_peserta ?? 1; ?>" max="50"
                                    class="form-input" required>
                            </div>
                            <?= form_error('jumlah_peserta', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                            <p class="form-help">Minimal <strong><?= $paket->min_peserta ?? 1; ?> peserta</strong> untuk paket ini</p>
                        </div>
                    </div>

                    <!-- c. Tipe Pembayaran -->
                    <div class="form-section">
                        <p class="section-label">
                            <span class="material-symbols-rounded text-[16px]">payments</span>
                            Tipe Pembayaran
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="flex items-center gap-3 px-4 py-3 border-2 border-brand-500 bg-brand-50 rounded-xl cursor-pointer transition" id="label-full">
                                <input type="radio" name="tipe_pembayaran" value="full" checked
                                    class="text-brand-600 focus:ring-brand-500" onchange="updatePaymentType('full')">
                                <div>
                                    <p class="font-semibold text-sm text-gray-800">Lunas (Full)</p>
                                    <p class="text-xs text-gray-400">Bayar penuh sekarang</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 px-4 py-3 border-2 border-gray-200 rounded-xl cursor-pointer transition" id="label-dp">
                                <input type="radio" name="tipe_pembayaran" value="dp"
                                    class="text-brand-600 focus:ring-brand-500" onchange="updatePaymentType('dp')">
                                <div>
                                    <p class="font-semibold text-sm text-gray-800">DP (Uang Muka)</p>
                                    <p class="text-xs text-gray-400">Minimal 20% dari total</p>
                                </div>
                            </label>
                        </div>
                        <?= form_error('tipe_pembayaran', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                        <div id="dp-info" class="hidden mt-3 bg-brand-50 border border-brand-200 rounded-xl p-3 flex items-start gap-2">
                            <span class="material-symbols-rounded text-brand-600 text-[16px] mt-0.5">info</span>
                            <p class="text-xs text-brand-700">Minimal DP <strong>20%</strong> dari total tagihan. Sisa pembayaran dilunasi sebelum keberangkatan.</p>
                        </div>
                    </div>

                    <!-- d. Layanan Tambahan (Akomodasi) -->
                    <div class="form-section">
                        <p class="section-label">
                            <span class="material-symbols-rounded text-[16px]">luggage</span>
                            Layanan Tambahan
                            <span class="text-slate-400 font-normal">(Opsional — bisa pilih lebih dari satu)</span>
                        </p>
                        <p style="font-size: 12px; color: #6b7280; font-style: italic; margin-bottom: 12px;">
                            Layanan di luar paket standar. Tim kami akan menghubungi Anda untuk konfirmasi ketersediaan.
                        </p>
                        <?php if (!empty($akomodasi_list)): ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <?php foreach ($akomodasi_list as $a): ?>
                            <label class="akomodasi-card" style="display: flex; align-items: flex-start; gap: 12px; padding: 12px 16px; border: 1.5px solid #e5e7eb; border-radius: 10px; transition: all 0.15s ease; cursor: pointer;" data-id="<?= $a->id_akomodasi; ?>" data-harga="<?= (int) $a->harga_tambahan; ?>">
                                <input type="checkbox" name="id_akomodasi[]" value="<?= $a->id_akomodasi; ?>" class="text-brand-600 focus:ring-brand-500" onchange="updateAkomodasi()" style="margin-top: 10px;">
                                <span class="material-symbols-rounded flex-shrink-0" style="font-size: 24px; color: #0ea5e9; background: #EFF8FF; border-radius: 8px; padding: 6px;"><?= $a->icon; ?></span>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-sm text-gray-800" style="font-weight: 500; font-size: 14px;"><?= $a->nama_akomodasi; ?></p>
                                    <?php if (!empty($a->deskripsi)): ?>
                                    <p class="text-xs text-gray-500 mt-0.5" style="font-size: 12px; color: #6b7280; line-height: 1.5;"><?= $a->deskripsi; ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($a->wilayah)): ?>
                                    <p class="text-xs mt-0.5 flex items-center gap-1" style="font-size: 11px; color: #9ca3af;">
                                        <span class="material-symbols-rounded text-[12px]">place</span>
                                        <?= $a->wilayah; ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="font-semibold" style="font-weight: 600; color: #0ea5e9; font-size: 14px;">Rp <?= number_format($a->harga_tambahan, 0, ',', '.'); ?></p>
                                    <p style="font-size: 11px; color: #6b7280;">/orang</p>
                                    <p class="text-xs font-medium mt-0.5 estimasi-text" style="color: #16a34a; font-weight: 500; font-size: 12px; display: none;">
                                        + Rp <span class="estimasi-total"><?= number_format($a->harga_tambahan * ($paket->min_peserta ?? 1), 0, ',', '.'); ?></span>
                                    </p>
                                    <p class="text-xs font-medium estimasi-text" style="color: #16a34a; font-weight: 500; font-size: 11px; display: none;">
                                        Estimasi (<span class="peserta-count"><?= $paket->min_peserta ?? 1; ?></span> peserta)
                                    </p>
                                </div>
                            </label>
                            <?php endforeach; ?>
                        </div>
                        <p style="font-size: 12px; color: #6b7280; margin-top: 8px;">💡 Layanan bersifat kondisional. Tim kami akan konfirmasi ketersediaan setelah pemesanan.</p>
                        <?php else: ?>
                        <div class="text-center py-8 bg-slate-50 rounded-xl border-2 border-dashed border-slate-200">
                            <span class="material-symbols-rounded text-slate-300 text-4xl mb-2">info</span>
                            <p class="text-sm text-slate-500">Belum ada akomodasi tersedia untuk paket ini.</p>
                            <p class="text-xs text-slate-400 mt-1">Silakan hubungi admin untuk informasi lebih lanjut.</p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- e. Catatan (Opsional) -->
                    <div class="form-section">
                        <p class="section-label">
                            <span class="material-symbols-rounded text-[16px]">notes</span>
                            Catatan
                            <span class="text-slate-400 font-normal">(Opsional)</span>
                        </p>
                        <div class="form-group">
                            <textarea name="catatan" rows="2"
                                class="form-input"
                                placeholder="Permintaan khusus, alergi, kebutuhan khusus, dll."><?= set_value('catatan'); ?></textarea>
                        </div>
                    </div>

                    <!-- Instruksi Pembayaran -->
                    <div class="form-section">
                        <p class="section-label">
                            <span class="material-symbols-rounded text-[16px]">account_balance</span>
                            Instruksi Pembayaran
                        </p>

<div class="bg-sky-50 border border-sky-200 rounded-2xl p-4">
                            <div class="flex flex-wrap items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <p class="text-xs text-sky-800 font-semibold uppercase tracking-wide">Transfer ke rekening</p>
                                    <p class="text-slate-900 font-extrabold text-lg mt-1 flex items-center gap-2 flex-wrap">
                                        <span class="material-symbols-rounded text-sky-600 text-[20px]">account_balance</span>
                                        BCA <span class="font-mono">1234567890</span>
                                    </p>
                                    <p class="text-slate-700 text-sm mt-1">a/n <span class="font-semibold">Hastaka Holiday</span></p>
                                </div>

                                <button type="button"
                                    class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-white border border-sky-200 text-sky-700 font-semibold text-sm hover:bg-sky-100 transition flex-shrink-0"
                                    onclick="copyRek('BCA 1234567890 a/n Hastaka Holiday', this)">
                                    <span class="material-symbols-rounded text-[18px]">content_copy</span>
                                    Salin
                                </button>
                            </div>

                            <p id="copy-rek-hint" class="hidden mt-3 text-emerald-700 text-sm inline-flex items-center gap-2">
                                <span class="material-symbols-rounded text-emerald-600">check_circle</span>
                                Tersalin!
                            </p>
                        </div>
                    </div>

                    <!-- Bukti Pembayaran -->
                    <div class="form-section">
                        <p class="section-label">
                            <span class="material-symbols-rounded text-[16px]">receipt</span>
                            Bukti Pembayaran
                        </p>
                        <div class="form-group">
                            <label class="form-label">Upload Bukti Transfer</label>
                            <input type="file" name="bukti_transfer" accept="image/*"
                                class="form-input file-input" required>
                            <p class="form-help">Format: JPG/PNG, maksimal 2MB</p>
                            <?= form_error('bukti_transfer', '<p class="form-error"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================== KOLOM KANAN: RINGKASAN TAGIHAN ===================== -->
        <div class="lg:col-span-1 animate-fade-in-up stagger-2">
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border-2 border-slate-200/80 overflow-hidden lg:sticky lg:top-6">
                <div class="bg-slate-50 border-b border-slate-100 px-6 py-4">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <span class="material-symbols-rounded text-brand-600">receipt_long</span> Ringkasan Tagihan
                    </h3>
                </div>
                <div class="p-6">
                    <img src="<?= base_url("application/assets/images/paket/{$paket->foto}?v=" . time()); ?>" class="w-full h-36 object-cover rounded-2xl mb-4 border border-slate-100" onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                    <h4 class="font-bold text-slate-900"><?= $paket->nama_paket; ?></h4>
                    <p class="text-slate-500 text-xs mt-1"><?= $paket->durasi_hari; ?> Hari <?= $paket->durasi_hari > 1 ? ($paket->durasi_hari - 1) . ' Malam' : ''; ?> &bull; <?= $paket->jumlah_destinasi; ?> Destinasi</p>
                    <div class="border-t border-slate-100 mt-4 pt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Harga paket/orang</span>
                            <span class="font-semibold">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Jumlah peserta</span>
                            <span class="font-semibold" id="sum-peserta">1</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Subtotal paket</span>
                            <span class="font-semibold" id="sum-subtotal-paket">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></span>
                        </div>

                        <!-- Akomodasi breakdown (ditampilkan sebelum Total Tagihan) -->
                        <div id="akomodasi-breakdown" class="hidden space-y-2 pt-2 border-t border-slate-100">
                            <p class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Akomodasi:</p>
                            <div id="akomodasi-list" class="space-y-1.5 pl-2">
                                <!-- Items will be added here by JS -->
                            </div>
                            <div class="flex justify-between text-sm font-semibold pt-1 border-t border-slate-200">
                                <span class="text-slate-600">Total Akomodasi</span>
                                <span id="sum-total-akomodasi">Rp 0</span>
                            </div>
                        </div>

                        <!-- Total Tagihan (paket + akomodasi) -->
                        <div class="flex justify-between bg-brand-50 -mx-2 px-4 py-3 rounded-xl border border-brand-100">
                            <span class="font-bold text-brand-800 text-sm">Total Tagihan</span>
                            <span class="font-extrabold gradient-text text-xl" id="sum-total">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></span>
                        </div>
                        <div id="dp-summary" class="hidden space-y-2">
                            <div class="flex justify-between text-sm bg-brand-50 -mx-2 px-4 py-2.5 rounded-xl border border-brand-100">
                                <span class="font-bold text-brand-800">DP (20%)</span>
                                <span class="font-extrabold text-brand-700 text-lg" id="sum-dp">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-xs text-slate-500 -mx-2 px-4">
                                <span>Sisa dilunasi sebelum keberangkatan</span>
                                <span class="font-semibold" id="sum-remaining">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol submit di dalam card ringkasan tagihan -->
                    <button type="submit" class="w-full mt-6 gradient-bg text-white py-4 rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-brand-500/40 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded text-[20px]">check_circle</span> Konfirmasi Pemesanan
                    </button>
                    <a href="https://wa.me/6287719646932?text=<?= urlencode("Halo Hastaka Holiday, saya tertarik dengan paket {$paket->nama_paket}. Bisa info lebih lanjut?"); ?>" target="_blank" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white py-3 rounded-2xl font-bold text-sm hover:from-emerald-600 hover:to-emerald-700 hover:shadow-xl hover:shadow-emerald-500/40 hover:scale-105 active:scale-95 transition-all duration-300 mt-2">
                        <span class="material-symbols-rounded text-[20px]">chat</span> Tanya via WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <?= form_close(); ?>
    </div>
</main>

<style>
.form-section {
    background: #f8fafc;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}
.form-section:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}
.section-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #64748b;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e2e8f0;
}
.form-group {
    margin-bottom: 16px;
}
.form-group:last-child {
    margin-bottom: 0;
}
.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}
.form-input {
    width: 100%;
    padding: 10px 12px;
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    color: #1e293b;
    transition: all 0.2s;
}
.form-input:focus {
    outline: none;
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}
.form-input::placeholder {
    color: #94a3b8;
}
.form-error {
    color: #ef4444;
    font-size: 12px;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.form-help {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 6px;
    line-height: 1.5;
}
.file-input {
    padding: 8px;
}
.checkbox-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 13px;
    font-weight: 500;
    color: #475569;
}
.checkbox-item:hover {
    border-color: #0ea5e9;
    background: #f0f9ff;
}
</style>

<script>

const durasiHari = <?= (int) $paket->durasi_hari; ?>;
const hargaPerOrang = <?= (int) $paket->harga; ?>;
let currentPaymentType = 'full';

function formatRp(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
}

function updateTotal() {
    const jml = parseInt(document.getElementById('jml-peserta').value) || 1;

    // Calculate subtotal paket
    const subtotalPaket = hargaPerOrang * jml;
    document.getElementById('sum-peserta').textContent = jml;
    document.getElementById('sum-subtotal-paket').textContent = formatRp(subtotalPaket);

    // Calculate akomodasi breakdown
    let totalAkomodasi = 0;
    const akomodasiList = document.getElementById('akomodasi-list');
    const akomodasiBreakdown = document.getElementById('akomodasi-breakdown');
    akomodasiList.innerHTML = '';

    document.querySelectorAll('input[name="id_akomodasi[]"]:checked').forEach(chk => {
        const card = chk.closest('.akomodasi-card');
        const harga = parseInt(card.dataset.harga);
        const nama = card.querySelector('.font-semibold').textContent;
        const subtotalItem = harga * jml;
        totalAkomodasi += subtotalItem;

        // Add item to breakdown list
        const itemDiv = document.createElement('div');
        itemDiv.className = 'flex justify-between text-xs';
        itemDiv.innerHTML = `
            <span class="text-slate-600">· ${nama} × ${jml}</span>
            <span class="font-semibold text-slate-700">+ ${formatRp(subtotalItem)}</span>
        `;
        akomodasiList.appendChild(itemDiv);
    });

    // Show/hide akomodasi breakdown
    if (document.querySelectorAll('input[name="id_akomodasi[]"]:checked').length > 0) {
        akomodasiBreakdown.classList.remove('hidden');
    } else {
        akomodasiBreakdown.classList.add('hidden');
    }

    document.getElementById('sum-total-akomodasi').textContent = formatRp(totalAkomodasi);

    // Calculate grand total
    const total = subtotalPaket + totalAkomodasi;
    document.getElementById('sum-total').textContent = formatRp(total);
    updateDpDisplay(total);
}

function updatePaymentType(type) {
    currentPaymentType = type;
    const labelFull = document.getElementById('label-full');
    const labelDp = document.getElementById('label-dp');
    const dpInfo = document.getElementById('dp-info');
    const dpSummary = document.getElementById('dp-summary');

    if (type === 'full') {
        labelFull.classList.add('border-brand-500', 'bg-brand-50');
        labelFull.classList.remove('border-gray-200');
        labelDp.classList.add('border-gray-200');
        labelDp.classList.remove('border-brand-500', 'bg-brand-50');
        dpInfo.classList.add('hidden');
        dpSummary.classList.add('hidden');
    } else {
        labelDp.classList.add('border-brand-500', 'bg-brand-50');
        labelDp.classList.remove('border-gray-200');
        labelFull.classList.add('border-gray-200');
        labelFull.classList.remove('border-brand-500', 'bg-brand-50');
        dpInfo.classList.remove('hidden');
        dpSummary.classList.remove('hidden');
    }
    updateTotal();
}

function updateDpDisplay(total) {
    const dpAmount = Math.ceil(total * 0.2);
    const remaining = total - dpAmount;
    document.getElementById('sum-dp').textContent = formatRp(dpAmount);
    document.getElementById('sum-remaining').textContent = formatRp(remaining);
}

function updateAkomodasi() {
    // Update visual selection state
    document.querySelectorAll('.akomodasi-card').forEach(card => {
        const chk = card.querySelector('input[type="checkbox"]');
        if (chk.checked) {
            card.classList.remove('border-gray-200');
            card.classList.add('border-brand-500', 'bg-brand-50');
        } else {
            card.classList.remove('border-brand-500', 'bg-brand-50');
            card.classList.add('border-gray-200');
        }
    });

    // Update estimasi text for each card
    const jml = parseInt(document.getElementById('jml-peserta').value) || 1;
    document.querySelectorAll('.akomodasi-card').forEach(card => {
        const estimasiTexts = card.querySelectorAll('.estimasi-text');
        const estimasiTotal = card.querySelector('.estimasi-total');
        const pesertaCount = card.querySelector('.peserta-count');
        const harga = parseInt(card.dataset.harga);

        if (estimasiTotal && pesertaCount) {
            pesertaCount.textContent = jml;
            estimasiTotal.textContent = formatRp(harga * jml);
        }

        // Show/hide estimasi texts based on checkbox state
        if (estimasiTexts.length > 0) {
            const chk = card.querySelector('input[type="checkbox"]');
            estimasiTexts.forEach(text => {
                if (chk.checked) {
                    text.style.display = 'block';
                } else {
                    text.style.display = 'none';
                }
            });
        }
    });

    updateTotal();
}

function copyRek(textToCopy, btnEl) {
    try {
        navigator.clipboard.writeText(textToCopy);
        const hint = document.getElementById('copy-rek-hint');
        if (hint) {
            hint.classList.remove('hidden');
            setTimeout(() => hint.classList.add('hidden'), 1500);
        }

        if (btnEl) {
            btnEl.disabled = true;
            setTimeout(() => { btnEl.disabled = false; }, 1200);
        }
    } catch (e) {
        alert('Gagal menyalin. Silakan salin manual.');
    }
}

function calcReturnDate() {

    const input = document.querySelector('input[name="tgl_keberangkatan"]');
    const info = document.getElementById('return-date-info');
    const text = document.getElementById('return-date-text');
    if (input.value) {
        const dep = new Date(input.value);
        dep.setDate(dep.getDate() + durasiHari - 1);
        const opts = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        text.textContent = dep.toLocaleDateString('id-ID', opts);
        info.classList.remove('hidden');
    } else {
        info.classList.add('hidden');
    }
}

document.querySelector('input[name="tgl_keberangkatan"]').addEventListener('change', calcReturnDate);
document.getElementById('jml-peserta').addEventListener('input', updateTotal);

document.addEventListener('DOMContentLoaded', function() {
    updateAkomodasi();
    updateTotal();
});
</script>
