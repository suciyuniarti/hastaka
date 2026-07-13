<?php $this->load->view('templates/header'); ?>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-sky-50/30 to-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="text-center mb-12 animate-fade-in-up">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-white-500 to-sky-600 rounded-2xl flex items-center justify-center shadow-xl shadow-sky-500/40">
                    <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="Hastaka Holiday" class="w-9 h-9 object-contain">
                </div>
            </div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Tentang Kami</h1>
            <p class="mt-3 text-lg text-slate-600">Hastaka Holiday — "healing teu make rungsing"</p>
        </div>

        <div class="grid gap-8">
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-rounded text-sky-600 text-xl">info</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Profil Perusahaan</h2>
                </div>
                <p class="text-slate-600 leading-relaxed">
                    <strong>Hastaka Holiday</strong> merupakan perusahaan yang bergerak di bidang jasa travel dan tour meliputi biro perjalanan wisata, transportasi wisata, paket outbound dan MICE di Bandung Raya di bawah naungan PT Hastaka Berkah Sadaya.
                    Hastaka Holiday didirikan oleh pegiat wisata yang sudah yang sangat berpengalaman di bidang tour operations, creative program tour & travel, marketing communications, game master outbound & inbound, goes to campus dan lainnya.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-rounded text-sky-600 text-xl">workspace_premium</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Apa yang Menjadi Prioritas Kami?</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Keamanan -->
                    <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="material-symbols-rounded text-sky-500 text-2xl">shield</span>
                        <div>
                            <p class="font-semibold text-slate-800">Keamanan</p>
                            <p class="text-sm text-slate-500">
                                Kendaraan yang digunakan telah memenuhi standar kelayakan serta memberikan perlindungan bagi peserta selama perjalanan.
                            </p>
                        </div>
                    </div>

                    <!-- Kepuasan -->
                    <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="material-symbols-rounded text-sky-500 text-2xl">sentiment_satisfied</span>
                        <div>
                            <p class="font-semibold text-slate-800">Kepuasan Pelanggan</p>
                            <p class="text-sm text-slate-500">
                                Memberikan pelayanan terbaik agar setiap perjalanan menjadi pengalaman yang menyenangkan dan berkesan.
                            </p>
                        </div>
                    </div>

                    <!-- Kenyamanan -->
                    <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="material-symbols-rounded text-sky-500 text-2xl">airline_seat_recline_normal</span>
                        <div>
                            <p class="font-semibold text-slate-800">Kenyamanan</p>
                            <p class="text-sm text-slate-500">
                                Menyediakan kendaraan, akomodasi, dan destinasi wisata yang nyaman untuk menunjang perjalanan Anda.
                            </p>
                        </div>
                    </div>

                    <!-- Evaluasi -->
                    <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="material-symbols-rounded text-sky-500 text-2xl">fact_check</span>
                        <div>
                            <p class="font-semibold text-slate-800">Evaluasi & Perbaikan</p>
                            <p class="text-sm text-slate-500">
                                Masukan dari pelanggan menjadi dasar untuk terus meningkatkan kualitas layanan dan pengalaman perjalanan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8 animate-fade-in-up" style="animation-delay: 0.5s;">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-rounded text-sky-600 text-xl">layers</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Layanan Kami</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-rounded text-sky-500 mt-0.5">travel_explore</span>
                        <div>
                            <p class="font-semibold text-slate-800">Paket Wisata</p>
                            <p class="text-sm text-slate-500">Berbagai pilihan paket wisata domestik.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-rounded text-sky-500 mt-0.5">directions_bus</span>
                        <div>
                            <p class="font-semibold text-slate-800">Transportasi</p>
                            <p class="text-sm text-slate-500">Bus, pesawat, kereta, dan transportasi lainnya yang nyaman.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-rounded text-sky-500 mt-0.5">hotel</span>
                        <div>
                            <p class="font-semibold text-slate-800">Akomodasi</p>
                            <p class="text-sm text-slate-500">Hotel, villa dan akomodasi lain sesuai budget.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-rounded text-sky-500 mt-0.5">receipt_long</span>
                        <div>
                            <p class="font-semibold text-slate-800">Booking Online</p>
                            <p class="text-sm text-slate-500">Pemesanan mudah dan cepat melalui sistem digital kami.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8 animate-fade-in-up" style="animation-delay: 0.6s;">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-rounded text-sky-600 text-xl">contact_support</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Kontak Kami</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-rounded text-sky-500 mt-0.5">mail</span>
                        <div>
                            <p class="font-semibold text-slate-800">Email</p>
                            <a href="mailto:hastakaholiday@gmail.com" class="text-sm text-sky-600 hover:text-sky-700 transition">hastakaholiday@gmail.com</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-rounded text-sky-500 mt-0.5">chat</span>
                        <div>
                            <p class="font-semibold text-slate-800">WhatsApp</p>
                            <a href="https://wa.me/6287719646932" target="_blank" class="text-sm text-sky-600 hover:text-sky-700 transition">0877-1964-6932</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-rounded text-sky-500 mt-0.5">location_on</span>
                        <div>
                            <p class="font-semibold text-slate-800">Lokasi</p>
                            <p class="text-sm text-slate-500">Bandung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>