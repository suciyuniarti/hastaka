<div class="min-h-screen flex">
    <!-- Left: Illustration -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 400"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="relative z-10 flex flex-col justify-center px-16 text-white">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8 backdrop-blur">
                <span class="material-symbols-rounded text-4xl">explore</span>
            </div>
            <h1 class="text-5xl font-extrabold leading-tight mb-4">Jelajahi Dunia<br>Bersama Kami</h1>
            <p class="text-xl text-white/80 leading-relaxed max-w-md">Temukan paket wisata terbaik dengan rekomendasi cerdas menggunakan metode SAW.</p>
            <div class="flex gap-8 mt-12">
                <div><p class="text-3xl font-bold">50+</p><p class="text-white/70 text-sm">Destinasi</p></div>
                <div><p class="text-3xl font-bold">1000+</p><p class="text-white/70 text-sm">Pelanggan</p></div>
                <div><p class="text-3xl font-bold">4.9</p><p class="text-white/70 text-sm">Rating</p></div>
            </div>
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

            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang!</h2>
            <p class="text-gray-500 mb-8">Masuk ke akun Anda untuk melanjutkan</p>

            <?php if ($this->session->flashdata('error')): ?>
            <div class="flex items-center gap-3 bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 animate-slide-down">
                <span class="material-symbols-rounded text-red-400">error</span>
                <span class="text-sm"><?= $this->session->flashdata('error'); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl mb-6 animate-slide-down">
                <span class="material-symbols-rounded text-emerald-400">check_circle</span>
                <span class="text-sm"><?= $this->session->flashdata('success'); ?></span>
            </div>
            <?php endif; ?>

            <?= form_open('auth/login', ['class' => 'space-y-5']); ?>

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
                        <input type="password" name="password" id="pwd-input"
                            class="w-full pl-11 pr-12 py-3 border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition"
                            placeholder="Masukkan password" required>
                        <button type="button" onclick="togglePwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <span class="material-symbols-rounded text-[20px]" id="pwd-icon">visibility_off</span>
                        </button>
                    </div>
                    <?= form_error('password', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <button type="submit" class="w-full gradient-bg text-white py-3.5 rounded-xl font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-brand-500/25 flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">login</span> Masuk
                </button>

            <?= form_close(); ?>

            <p class="text-center text-gray-500 text-sm mt-6">
                <a href="<?= base_url('auth/forgot_password'); ?>" class="text-brand-600 font-semibold hover:underline">Lupa Kata Sandi?</a>
            </p>

            <p class="text-center text-gray-500 text-sm mt-4">
                Belum punya akun?
                <a href="<?= base_url('auth/register'); ?>" class="text-brand-600 font-semibold hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePwd() {
    const inp = document.getElementById('pwd-input');
    const icon = document.getElementById('pwd-icon');
    if (inp.type === 'password') { inp.type = 'text'; icon.textContent = 'visibility'; }
    else { inp.type = 'password'; icon.textContent = 'visibility_off'; }
}
</script>
