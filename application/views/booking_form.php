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
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <a href="<?= base_url("paket/detail/{$paket->id_paket}"); ?>" class="inline-flex items-center gap-1 text-brand-600 hover:text-brand-700 text-sm font-medium mb-6 transition group">
        <span class="material-symbols-rounded text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Kembali
    </a>

    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 animate-fade-in-up">Booking <span class="gradient-text">Paket</span></h1>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Form -->
        <div class="lg:col-span-2 animate-fade-in-up stagger-1">
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8">
                <?= form_open_multipart("pemesanan/booking/{$paket->id_paket}", ['class' => 'space-y-5']); ?>
                    <!-- Paket Info -->
                    <div class="bg-brand-50 border border-brand-200 rounded-2xl p-4 flex items-center gap-3">
                        <span class="material-symbols-rounded text-brand-500 text-2xl">luggage</span>
                        <div>
                            <p class="font-bold text-brand-800"><?= $paket->nama_paket; ?></p>
                            <p class="text-brand-600 text-sm flex items-center gap-2">
                                <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">schedule</span> <?= $paket->durasi_hari; ?> Hari <?= $paket->durasi_hari > 1 ? ($paket->durasi_hari - 1) . ' Malam' : ''; ?></span>
                                <span>&bull;</span>
                                <span class="flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">place</span> <?= $paket->jumlah_destinasi; ?> Destinasi</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Keberangkatan</label>
                        <div class="relative">
                            <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">calendar_month</span>
                            <input type="date" name="tgl_keberangkatan" value="<?= set_value('tgl_keberangkatan'); ?>"
                                min="<?= date('Y-m-d', strtotime('+1 day')); ?>"
                                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition" required>
                        </div>
                        <?= form_error('tgl_keberangkatan', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                        <p id="return-date-info" class="text-emerald-600 text-xs mt-1.5 flex items-center gap-1 hidden">
                            <span class="material-symbols-rounded text-[14px]">event_available</span>
                            <span>Estimasi kembali: <strong id="return-date-text"></strong></span>
                        </p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Keberangkatan</label>
                            <div class="relative">
                                <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">schedule</span>
                                <input type="time" name="jam_keberangkatan" value="<?= set_value('jam_keberangkatan'); ?>"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition" required>
                            </div>
                            <?= form_error('jam_keberangkatan', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Peserta</label>
                            <div class="relative">
                                <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">group</span>
                                <input type="number" name="jumlah_peserta" id="jml-peserta" value="<?= set_value('jumlah_peserta', $paket->min_peserta ?? '1'); ?>"
                                    min="<?= $paket->min_peserta ?? 1; ?>" max="50"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition" required
                                    oninput="updateTotal(<?= $paket->harga; ?>)">
                            </div>
                            <?= form_error('jumlah_peserta', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                            <p class="text-amber-600 text-xs mt-1.5 flex items-center gap-1">
                                <span class="material-symbols-rounded text-[14px]">info</span>
                                Minimal <strong><?= $paket->min_peserta ?? 1; ?> peserta</strong> untuk paket ini
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">person</span>
                                <input type="text" name="nama_pemesan" value="<?= set_value('nama_pemesan', $this->session->userdata('nama_lengkap')); ?>"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition" required>
                            </div>
                            <?= form_error('nama_pemesan', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Telepon / WhatsApp</label>
                            <div class="relative">
                                <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">phone</span>
                                <input type="tel" name="no_telepon" value="<?= set_value('no_telepon'); ?>"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>
                            <?= form_error('no_telepon', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Titik Kumpul / Lokasi Penjemputan</label>
                        <div class="relative">
                            <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">place</span>
                            <input type="text" name="titik_kumpul" value="<?= set_value('titik_kumpul'); ?>"
                                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                                placeholder="Contoh: Terminal Bungurasih, Surabaya" required>
                        </div>
                        <?= form_error('titik_kumpul', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan (Opsional)</label>
                        <textarea name="catatan" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                            placeholder="Permintaan khusus..."><?= set_value('catatan'); ?></textarea>
                    </div>

                    <!-- Tipe Pembayaran -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Pembayaran</label>
                        <div class="grid grid-cols-2 gap-3">
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
                        <div id="dp-info" class="hidden mt-2 bg-brand-50 border border-brand-200 rounded-xl p-3 flex items-start gap-2">
                            <span class="material-symbols-rounded text-brand-600 text-[16px] mt-0.5">info</span>
                            <p class="text-xs text-brand-700">Minimal DP <strong>20%</strong> dari total tagihan. Sisa pembayaran dilunasi sebelum keberangkatan.</p>
                        </div>
                    </div>

                    <!-- Upload Bukti Transfer -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" accept="image/*"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition" required>
                        <p class="text-gray-400 text-xs mt-1 flex items-center gap-1">
                            <span class="material-symbols-rounded text-[14px]">info</span> Upload bukti pembayaran (JPG/PNG, maks 2MB)
                        </p>
                    </div>
                    <button type="submit" class="w-full gradient-bg text-white py-3.5 rounded-2xl font-bold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded text-[20px]">check_circle</span> Konfirmasi Pemesanan
                    </button>
                    <a href="https://wa.me/6287719646932?text=<?= urlencode("Halo Hastaka Holiday, saya tertarik dengan paket {$paket->nama_paket}. Bisa info lebih lanjut?"); ?>" target="_blank" class="w-full flex items-center justify-center gap-2 bg-emerald-500 text-white py-3 rounded-2xl font-bold text-sm hover:bg-emerald-600 transition mt-3">
                        <span class="material-symbols-rounded text-[20px]">chat</span> Tanya via WhatsApp
                    </a>
                <?= form_close(); ?>
            </div>
        </div>

        <!-- Billing Summary -->
        <div class="animate-fade-in-up stagger-2">
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2"><span class="material-symbols-rounded text-brand-500">receipt_long</span> Ringkasan Tagihan</h3>
                <img src="<?= base_url("application/assets/images/paket/{$paket->foto}?v=" . time()); ?>" class="w-full h-36 object-cover rounded-2xl mb-4" onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e'">
                <h4 class="font-bold text-gray-900"><?= $paket->nama_paket; ?></h4>
                <p class="text-gray-500 text-sm mt-1"><?= $paket->durasi_hari; ?> Hari <?= $paket->durasi_hari > 1 ? ($paket->durasi_hari - 1) . ' Malam' : ''; ?> &bull; <?= $paket->jumlah_destinasi; ?> Destinasi</p>
                <div class="border-t border-gray-100 mt-4 pt-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Harga per peserta</span>
                        <span class="font-semibold">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Jumlah peserta</span>
                        <span class="font-semibold" id="sum-peserta">1</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-semibold" id="sum-subtotal">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></span>
                    </div>
                    <div class="flex justify-between bg-brand-50 -mx-4 px-4 py-3 rounded-xl border border-brand-100">
                        <span class="font-bold text-brand-800">Total Tagihan</span>
                        <span class="font-extrabold gradient-text text-xl" id="sum-total">Rp <?= number_format($paket->harga, 0, ',', '.'); ?></span>
                    </div>
                    <div id="dp-summary" class="hidden">
                        <div class="flex justify-between text-sm bg-brand-50 -mx-4 px-4 py-3 rounded-xl border border-brand-100 mt-2">
                            <span class="font-bold text-brand-800">DP (20%)</span>
                            <span class="font-extrabold text-brand-700 text-lg" id="sum-dp">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 mt-2 -mx-4 px-4">
                            <span>Sisa dilunasi sebelum keberangkatan</span>
                            <span class="font-semibold" id="sum-remaining">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
const durasiHari = <?= (int) $paket->durasi_hari; ?>;
const hargaPerOrang = <?= (int) $paket->harga; ?>;
let currentPaymentType = 'full';

function formatRp(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
}

function updateTotal(harga) {
    const jml = parseInt(document.getElementById('jml-peserta').value) || 1;
    const subtotal = harga * jml;
    document.getElementById('sum-peserta').textContent = jml;
    document.getElementById('sum-subtotal').textContent = formatRp(subtotal);
    document.getElementById('sum-total').textContent = formatRp(subtotal);
    updateDpDisplay(subtotal);
}

function updatePaymentType(type) {
    currentPaymentType = type;
    const labelFull = document.getElementById('label-full');
    const labelDp = document.getElementById('label-dp');
    const dpInfo = document.getElementById('dp-info');
    const dpSummary = document.getElementById('dp-summary');

    if (type === 'full') {
        labelFull.classList.add('border-brand-500', 'bg-brand-50/50');
        labelFull.classList.remove('border-gray-200');
        labelDp.classList.add('border-gray-200');
        labelDp.classList.remove('border-brand-500', 'bg-brand-50/50');
        dpInfo.classList.add('hidden');
        dpSummary.classList.add('hidden');
    } else {
        labelDp.classList.add('border-brand-500', 'bg-brand-50/50');
        labelDp.classList.remove('border-gray-200');
        labelFull.classList.add('border-gray-200');
        labelFull.classList.remove('border-brand-500', 'bg-brand-50/50');
        dpInfo.classList.remove('hidden');
        dpSummary.classList.remove('hidden');
    }
    updateTotal(hargaPerOrang);
}

function updateDpDisplay(total) {
    const dpAmount = Math.ceil(total * 0.2);
    const remaining = total - dpAmount;
    document.getElementById('sum-dp').textContent = formatRp(dpAmount);
    document.getElementById('sum-remaining').textContent = formatRp(remaining);
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
</script>
