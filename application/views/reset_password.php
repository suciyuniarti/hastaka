<div class="min-h-screen flex">
    <!-- Left: Illustration -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 400"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="relative z-10 flex flex-col justify-center px-16 text-white">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8 backdrop-blur">
                <span class="material-symbols-rounded text-4xl">password</span>
            </div>
            <h1 class="text-5xl font-extrabold leading-tight mb-4">Buat Kata<br>Sandi Baru</h1>
            <p class="text-xl text-white/80 leading-relaxed max-w-md">Masukkan kata sandi baru untuk akun Anda.</p>
        </div>
    </div>

    <!-- Right: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-white">
        <div class="w-full max-w-md animate-fade-in-up">

            <div class="lg:hidden flex items-center gap-2 mb-8">
                <div class="w-9 h-9 gradient-bg rounded-xl flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-lg">explore</span>
                </div>
                <span class="font-extrabold text-xl gradient-text">Hastaka Holiday</span>
            </div>

            <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Reset Kata Sandi</h2>
            <p class="text-slate-500 mb-8">Buat kata sandi baru untuk akun Anda</p>

            <?php if ($this->session->flashdata('error')): ?>
            <div class="flex items-center gap-3 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-xl mb-6 animate-slide-down">
                <span class="material-symbols-rounded text-red-400">error</span>
                <span class="text-sm"><?= $this->session->flashdata('error'); ?></span>
            </div>
            <?php endif; ?>

            <?= form_open('auth/reset_password/' . $token, ['class' => 'space-y-5']); ?>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                        <input type="password" name="password" id="new-pwd"
                            class="w-full pl-11 pr-12 py-3 bg-slate-50 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                            placeholder="Minimal 6 karakter" required>
                        <button type="button" onclick="toggleNewPwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <span class="material-symbols-rounded text-[20px]" id="new-pwd-icon">visibility_off</span>
                        </button>
                    </div>
                    <?= form_error('password', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                        <input type="password" name="konfirmasi_password" id="confirm-pwd"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                            placeholder="Ulangi kata sandi baru" required>
                    </div>
                    <?= form_error('konfirmasi_password', '<p class="text-red-500 text-xs mt-1">', '</p>'); ?>
                </div>

                <button type="submit" class="w-full gradient-bg text-white py-3.5 rounded-full font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-sky-500/25 flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">check_circle</span> Simpan Kata Sandi Baru
                </button>

            <?= form_close(); ?>

            <p class="text-center text-slate-500 text-sm mt-6">
                <a href="<?= base_url('auth/login'); ?>" class="text-sky-600 font-semibold hover:underline">Kembali ke Login</a>
            </p>
        </div>
    </div>
</div>

<script>
function toggleNewPwd() {
    const inp = document.getElementById('new-pwd');
    const icon = document.getElementById('new-pwd-icon');
    if (inp.type === 'password') { inp.type = 'text'; icon.textContent = 'visibility'; }
    else { inp.type = 'password'; icon.textContent = 'visibility_off'; }
}
</script>