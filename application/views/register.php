<div class="min-h-screen flex">
    <!-- Left: Illustration -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 400"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="relative z-10 flex flex-col justify-center px-16 text-white">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8 backdrop-blur">
                <span class="material-symbols-rounded text-4xl">person_add</span>
            </div>
            <h1 class="text-5xl font-extrabold leading-tight mb-4">Buat Akun<br>Gratis Sekarang</h1>
            <p class="text-xl text-white/80 leading-relaxed max-w-md">Daftar dan nikmati kemudahan booking paket wisata dengan rekomendasi cerdas.</p>
            <div class="mt-12 space-y-4">
                <div class="flex items-center gap-3"><span class="material-symbols-rounded text-white/80">check_circle</span><span class="text-white/90">Rekomendasi paket berbasis SAW</span></div>
                <div class="flex items-center gap-3"><span class="material-symbols-rounded text-white/80">check_circle</span><span class="text-white/90">Booking online mudah & cepat</span></div>
                <div class="flex items-center gap-3"><span class="material-symbols-rounded text-white/80">check_circle</span><span class="text-white/90">Invoice digital & riwayat pesanan</span></div>
            </div>
        </div>
    </div>

    <!-- Right: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-blue-50">
        <div class="w-full max-w-md animate-fade-in-up">

            <div class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-9 h-9 gradient-bg rounded-xl flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-lg">explore</span>
                </div>
                <span class="font-extrabold text-xl gradient-text">Hastaka Holiday</span>
            </div>

            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Daftar Akun</h2>
            <p class="text-gray-500 mb-8">Isi data diri Anda untuk membuat akun</p>

            <?php if ($this->session->flashdata('error')): ?>
            <div class="flex items-center gap-3 bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 animate-slide-down">
                <span class="material-symbols-rounded text-red-400">error</span>
                <span class="text-sm"><?= $this->session->flashdata('error'); ?></span>
            </div>
            <?php endif; ?>

            <?= form_open('auth/register', ['class' => 'space-y-4']); ?>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">person</span>
                        <input type="text" name="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>"
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                            placeholder="Nama lengkap Anda" required>
                    </div>
                    <?= form_error('nama_lengkap', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">mail</span>
                        <input type="email" name="email" value="<?= set_value('email'); ?>"
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                            placeholder="nama@email.com" required>
                    </div>
                    <?= form_error('email', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">lock</span>
                        <input type="password" name="password" id="reg-pwd"
                            class="w-full pl-11 pr-12 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                            placeholder="Minimal 6 karakter" required>
                        <button type="button" onclick="toggleRegPwd('reg-pwd','reg-pwd-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <span class="material-symbols-rounded text-[20px]" id="reg-pwd-icon">visibility_off</span>
                        </button>
                    </div>
                    <?= form_error('password', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">lock</span>
                        <input type="password" name="konfirmasi_password" id="reg-pwd2"
                            class="w-full pl-11 pr-12 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                            placeholder="Ulangi password" required>
                        <button type="button" onclick="toggleRegPwd('reg-pwd2','reg-pwd2-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <span class="material-symbols-rounded text-[20px]" id="reg-pwd2-icon">visibility_off</span>
                        </button>
                    </div>
                    <?= form_error('konfirmasi_password', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <button type="submit" class="w-full gradient-bg text-white py-3.5 rounded-xl font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">person_add</span> Daftar Sekarang
                </button>

            <?= form_close(); ?>

            <p class="text-center text-gray-500 text-sm mt-8">
                Sudah punya akun?
                <a href="<?= base_url('auth/login'); ?>" class="text-brand-600 font-semibold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>

<script>
function toggleRegPwd(inputId, iconId) {
    const inp = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (inp.type === 'password') { inp.type = 'text'; icon.textContent = 'visibility'; }
    else { inp.type = 'password'; icon.textContent = 'visibility_off'; }
}
</script>
