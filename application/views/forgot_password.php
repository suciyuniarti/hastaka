<div class="min-h-screen flex">
    <!-- Left: Illustration -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 400"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="relative z-10 flex flex-col justify-center px-16 text-white">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8 backdrop-blur">
                <span class="material-symbols-rounded text-4xl">lock_reset</span>
            </div>
            <h1 class="text-5xl font-extrabold leading-tight mb-4">Atur Ulang<br>Kata Sandi</h1>
            <p class="text-xl text-white/80 leading-relaxed max-w-md">Masukkan email akun Anda dan kami akan membantu mengatur ulang kata sandi.</p>
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

            <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Lupa Kata Sandi</h2>
            <p class="text-slate-500 mb-8">Masukkan email yang terdaftar untuk mendapatkan token reset</p>

            <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-2 border-red-200 text-red-800 px-5 py-4 rounded-2xl mb-6 flex items-start gap-3 animate-slide-down shadow-lg shadow-red-500/10">
                <div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-rounded text-white text-lg">error</span>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-sm mb-0.5">Gagal</p>
                    <p class="text-sm text-red-700"><?= $this->session->flashdata('error'); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-2 border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 flex items-start gap-3 animate-slide-down shadow-lg shadow-emerald-500/10">
                <div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-rounded text-white text-lg">check_circle</span>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-sm mb-0.5">Berhasil</p>
                    <p class="text-sm text-emerald-700"><?= $this->session->flashdata('success'); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?= form_open('auth/forgot_password', ['class' => 'space-y-5']); ?>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                        <input type="email" name="email" value="<?= set_value('email'); ?>"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                            placeholder="nama@email.com" required>
                    </div>
                    <?= form_error('email', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <button type="submit" class="w-full gradient-bg text-white py-3.5 rounded-full font-semibold text-sm hover:opacity-90 transition shadow-lg shadow-sky-500/25 flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">key</span> Kirim Token Reset
                </button>

            <?= form_close(); ?>

            <p class="text-center text-slate-500 text-sm mt-6">
                Ingat kata sandi Anda?
                <a href="<?= base_url('auth/login'); ?>" class="text-sky-600 font-semibold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>