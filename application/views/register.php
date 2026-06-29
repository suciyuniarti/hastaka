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
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50">
        <div class="w-full max-w-md animate-fade-in-up">

            <div class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-9 h-9 gradient-bg rounded-xl flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-lg">explore</span>
                </div>
                <span class="font-extrabold text-xl gradient-text">Hastaka Holiday</span>
            </div>

            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Daftar Akun</h2>
            <p class="text-gray-500 mb-8">Isi data diri Anda untuk membuat akun</p>
            
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-8 border-2 border-slate-200/80">

            <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-2 border-red-200 text-red-800 px-5 py-4 rounded-2xl mb-6 flex items-start gap-3 animate-slide-down shadow-lg shadow-red-500/10">
                <div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-rounded text-white text-lg">error</span>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-sm mb-0.5">Gagal Mendaftar</p>
                    <p class="text-sm text-red-700"><?= $this->session->flashdata('error'); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?= form_open('auth/register', ['class' => 'space-y-5']); ?>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">person</span>
                        <input type="text" name="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>"
                            class="w-full pl-12 pr-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-300 hover:border-slate-300"
                            placeholder="Nama lengkap Anda" required>
                    </div>
                    <?= form_error('nama_lengkap', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Email</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                        <input type="email" name="email" value="<?= set_value('email'); ?>"
                            class="w-full pl-12 pr-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-300 hover:border-slate-300"
                            placeholder="nama@email.com" required>
                    </div>
                    <?= form_error('email', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Password</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                        <input type="password" name="password" id="reg-pwd"
                            class="w-full pl-12 pr-12 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-300 hover:border-slate-300"
                            placeholder="Minimal 6 karakter" required>
                        <button type="button" onclick="toggleRegPwd('reg-pwd','reg-pwd-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-600 transition">
                            <span class="material-symbols-rounded text-[20px]" id="reg-pwd-icon">visibility_off</span>
                        </button>
                    </div>
                    <?= form_error('password', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                        <input type="password" name="konfirmasi_password" id="reg-pwd2"
                            class="w-full pl-12 pr-12 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-300 hover:border-slate-300"
                            placeholder="Ulangi password" required>
                        <button type="button" onclick="toggleRegPwd('reg-pwd2','reg-pwd2-icon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-600 transition">
                            <span class="material-symbols-rounded text-[20px]" id="reg-pwd2-icon">visibility_off</span>
                        </button>
                    </div>
                    <?= form_error('konfirmasi_password', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <button type="submit" class="group w-full gradient-bg text-white py-3.5 rounded-xl font-bold text-sm hover:shadow-xl hover:shadow-brand-500/40 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">person_add</span> Daftar Sekarang
                </button>

            <?= form_close(); ?>
            </div>

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
