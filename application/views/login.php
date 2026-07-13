<div class="min-h-screen flex">
    <!-- Left: Illustration -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="deco-circle-1"></div>
            <div class="deco-circle-2"></div>
        </div>
        <div class="relative z-10 flex flex-col justify-center px-16 text-white">
            <div class="flex items-center gap-3 mb-8">
                <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="Hastaka Holiday" class="w-12 h-12 object-contain rounded-xl bg-white/10 p-1">
                <span class="text-lg font-semibold text-white">Hastaka Holiday</span>
            </div>
            <h1 class="text-5xl font-extrabold leading-tight mb-4">Jelajahi Dunia<br>Bersama Kami</h1>
            <p class="text-xl text-white/80 leading-relaxed max-w-md">Temukan paket wisata terbaik sesuai dengan preferensimu.</p>
        </div>
    </div>

    <!-- Right: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50">
        <div class="w-full max-w-md animate-fade-in-up">

            <div class="lg:hidden flex items-center gap-2 mb-8">
                <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="Hastaka Holiday" class="w-9 h-9 object-contain">
                <span class="font-extrabold text-xl gradient-text">Hastaka Holiday</span>
            </div>

            <div class="hidden lg:flex items-center gap-2 mb-6">
                <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="Hastaka Holiday" class="w-8 h-8 object-contain">
                <span class="font-bold text-sm" style="color: #0ea5e9;">Hastaka Holiday</span>
            </div>

            <h2 class="text-3xl font-extrabold text-gray-900 mb-2" style="font-size: 24px; font-weight: 700;">Selamat Datang!</h2>
            <p class="text-gray-500 mb-8">Masuk ke akun Anda untuk melanjutkan</p>
            
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-8 border-2 border-slate-200/80" style="box-shadow: 0 8px 32px rgba(14,165,233,0.12); border: 0.5px solid #e0f2fe;">

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

            <?= form_open('auth/login', ['class' => 'space-y-5', 'id' => 'form-login']); ?>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Email</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                        <input type="email" name="email" id="email" value="<?= set_value('email'); ?>"
                            class="w-full pl-12 pr-4 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-300 hover:border-slate-300"
                            placeholder="nama@email.com" required>
                    </div>
                    <?= form_error('email', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Password</label>
                    <div class="relative">
                        <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                        <input type="password" name="password" id="password"
                            class="w-full pl-12 pr-12 py-3 bg-white border-2 border-slate-200 rounded-xl text-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-300 hover:border-slate-300"
                            placeholder="Masukkan password" required>
                        <button type="button" onclick="togglePwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-brand-600 transition">
                            <span class="material-symbols-rounded text-[20px]" id="pwd-icon">visibility_off</span>
                        </button>
                    </div>
                    <?= form_error('password', '<p class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-rounded text-[14px]">error</span>', '</p>'); ?>
                </div>

                <?php 
                $login_errors = $this->session->flashdata('login_errors'); 
                ?>
                <?php if (!empty($login_errors)): ?>
                <div style="background: #fef2f2; border: 1px solid #fca5a5; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px;">
                    <p style="font-size: 13px; font-weight: 500; color: #b91c1c; margin: 0 0 6px 0;">⚠ Terjadi kesalahan:</p>
                    <ul style="font-size: 12px; color: #b91c1c; margin: 0; padding-left: 16px;">
                        <?php foreach($login_errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div id="error-box-login" style="display: none; background: #fef2f2; border: 1px solid #fca5a5; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px;">
                    <p style="font-size: 13px; font-weight: 500; color: #b91c1c; margin: 0 0 6px 0;">⚠ Terjadi kesalahan:</p>
                    <ul id="error-list-login" style="font-size: 12px; color: #b91c1c; margin: 0; padding-left: 16px;"></ul>
                </div>

                <button type="submit" class="group w-full gradient-bg text-white py-3.5 rounded-xl font-bold text-sm hover:shadow-xl hover:shadow-brand-500/40 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded text-[20px]">login</span> Masuk
                </button>

            <?= form_close(); ?>
            </div>

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
(function(){
  var form = document.getElementById('form-login');
  if (!form) return;

  form.addEventListener('submit', function(e) {
    var errors = [];
    
    var emailEl = form.querySelector('input[name="email"]');
    var passEl = form.querySelector('input[name="password"]');
    
    if (!emailEl || !passEl) return;
    
    var email = emailEl.value.trim();
    var pass = passEl.value;
    
    if (!email) {
      errors.push('Email wajib diisi.');
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      errors.push('Format email tidak valid.');
    }
    
    if (!pass) {
      errors.push('Password wajib diisi.');
    } else if (pass.length < 6) {
      errors.push('Password minimal 6 karakter.');
    }
    
    if (errors.length > 0) {
      e.preventDefault();
      var box = document.getElementById('error-box-login');
      var list = document.getElementById('error-list-login');
      if (!box || !list) {
        alert(errors.join('\n'));
        return;
      }
      list.innerHTML = errors.map(function(e){ return '<li>' + e + '</li>'; }).join('');
      box.style.display = 'block';
      box.scrollIntoView({ behavior:'smooth', block:'center' });
    }
  });

  form.querySelectorAll('input').forEach(function(input) {
    input.addEventListener('input', function() {
      var box = document.getElementById('error-box-login');
      if (box) box.style.display = 'none';
    });
  });
})();
</script>
