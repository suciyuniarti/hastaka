<div style="display: flex; min-height: 100vh;">
    <!-- Panel Kiri 50% -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden" style="background: linear-gradient(135deg, #0ea5e9, #0284c7); padding: 48px;">
        <!-- Dekorasi lingkaran -->
        <div style="position: absolute; top: -100px; right: -100px; width: 300px; height: 300px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -100px; left: -100px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
        
        <!-- Konten -->
        <div style="position: relative; z-index: 10; display: flex; flex-direction: column; justify-content: center;">
            <!-- Logo -->
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 32px;">
                <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="Hastaka Holiday" class="w-12 h-12 object-contain rounded-xl bg-white/10 p-1" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="material-symbols-rounded" style="display: none; width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 12px; align-items: center; justify-content: center; color: white; font-size: 28px;">explore</div>
                <span style="font-size: 18px; font-weight: 600; color: white;">Hastaka Holiday</span>
            </div>
            
            <!-- Judul -->
            <h1 style="font-size: 36px; font-weight: 700; color: white; margin-top: 24px; margin-bottom: 16px; line-height: 1.2;">
                Buat Akun<br>Gratis Sekarang
            </h1>
            
            <!-- Subjudul -->
            <p style="color: rgba(255,255,255,0.85); font-size: 16px; line-height: 1.6; max-width: 480px;">
                Daftar dan nikmati kemudahan booking paket wisata.
            </p>
        </div>
    </div>

    <!-- Panel Kanan 50% (Form) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12" style="background: #f0f9ff; overflow-y: auto;">
        <div class="w-full max-w-md">
            <!-- Logo kecil untuk mobile -->
            <div class="lg:hidden flex items-center gap-2 mb-8">
                <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="http://localhost/hastaka/auth/loginHastaka Holiday" class="w-9 h-9 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="material-symbols-rounded" style="display: none; width: 36px; height: 36px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 8px; align-items: center; justify-content: center; color: white; font-size: 20px;">explore</div>
                <span class="font-extrabold text-xl gradient-text">Hastaka Holiday</span>
            </div>

            <!-- Logo kecil untuk desktop -->
            <div class="hidden lg:flex items-center gap-2 mb-8">
                <img src="<?= base_url('application/assets/images/logo-hastaka.png') ?>" alt="Hastaka Holiday" class="w-8 h-8 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="material-symbols-rounded" style="display: none; width: 32px; height: 32px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 8px; align-items: center; justify-content: center; color: white; font-size: 18px;">explore</div>
                <span style="font-size: 14px; font-weight: 600; color: #0ea5e9;">Hastaka Holiday</span>
            </div>

            <!-- Judul Form -->
            <h2 style="font-size: 28px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Daftar Akun</h2>
            <p style="font-size: 14px; color: #6b7280; margin-bottom: 32px;">Buat akun gratis dan temukan paket wisata terbaikmu</p>
            
            <!-- Card Form -->
            <div style="background: white; border-radius: 16px; padding: 32px; box-shadow: 0 4px 24px rgba(14,165,233,0.08); border: 0.5px solid #e0f2fe;">
                
                <?= form_open('auth/register', ['class' => 'space-y-5', 'id' => 'form-register']); ?>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Nama Lengkap</label>
                        <div style="position: relative;">
                            <span class="material-symbols-rounded" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 20px;">person</span>
                            <input type="text" name="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>"
                                style="width: 100%; padding: 12px 12px 12px 44px; background: white; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; transition: all 0.2s;"
                                placeholder="Nama lengkap Anda" required>
                        </div>
                        <?= form_error('nama_lengkap', '<p style="color: #ef4444; font-size: 12px; margin-top: 6px; display: flex; align-items: center; gap: 4px;"><span class="material-symbols-rounded" style="font-size: 14px;">error</span>', '</p>'); ?>
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Email</label>
                        <div style="position: relative;">
                            <span class="material-symbols-rounded" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 20px;">mail</span>
                            <input type="email" name="email" value="<?= set_value('email'); ?>"
                                style="width: 100%; padding: 12px 12px 12px 44px; background: white; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; transition: all 0.2s;"
                                placeholder="nama@email.com" required>
                        </div>
                        <?= form_error('email', '<p style="color: #ef4444; font-size: 12px; margin-top: 6px; display: flex; align-items: center; gap: 4px;"><span class="material-symbols-rounded" style="font-size: 14px;">error</span>', '</p>'); ?>
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Password</label>
                        <div style="position: relative;">
                            <span class="material-symbols-rounded" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 20px;">lock</span>
                            <input type="password" name="password" id="reg-pwd"
                                style="width: 100%; padding: 12px 44px 12px 44px; background: white; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; transition: all 0.2s;"
                                placeholder="Minimal 6 karakter" required>
                            <button type="button" onclick="toggleRegPwd('reg-pwd','reg-pwd-icon')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; background: none; border: none; cursor: pointer; padding: 0;">
                                <span class="material-symbols-rounded" style="font-size: 20px;" id="reg-pwd-icon">visibility_off</span>
                            </button>
                        </div>
                        <?= form_error('password', '<p style="color: #ef4444; font-size: 12px; margin-top: 6px; display: flex; align-items: center; gap: 4px;"><span class="material-symbols-rounded" style="font-size: 14px;">error</span>', '</p>'); ?>
                    </div>

                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Konfirmasi Password</label>
                        <div style="position: relative;">
                            <span class="material-symbols-rounded" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 20px;">lock</span>
                            <input type="password" name="konfirmasi_password" id="reg-pwd2"
                                style="width: 100%; padding: 12px 44px 12px 44px; background: white; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; transition: all 0.2s;"
                                placeholder="Ulangi password" required>
                            <button type="button" onclick="toggleRegPwd('reg-pwd2','reg-pwd2-icon')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; background: none; border: none; cursor: pointer; padding: 0;">
                                <span class="material-symbols-rounded" style="font-size: 20px;" id="reg-pwd2-icon">visibility_off</span>
                            </button>
                        </div>
                        <?= form_error('konfirmasi_password', '<p style="color: #ef4444; font-size: 12px; margin-top: 6px; display: flex; align-items: center; gap: 4px;"><span class="material-symbols-rounded" style="font-size: 14px;">error</span>', '</p>'); ?>
                    </div>

                    <?php 
                    $reg_errors = $this->session->flashdata('errors'); 
                    ?>
                    <?php if (!empty($reg_errors)): ?>
                    <div style="background: #fef2f2; border: 1px solid #fca5a5; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px;">
                        <p style="font-size: 13px; font-weight: 500; color: #b91c1c; margin: 0 0 6px 0;">⚠ Mohon perbaiki kesalahan berikut:</p>
                        <ul style="font-size: 12px; color: #b91c1c; margin: 0; padding-left: 16px;">
                            <?php foreach($reg_errors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div id="error-box-register" style="display: none; background: #fef2f2; border: 1px solid #fca5a5; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px;">
                        <p style="font-size: 13px; font-weight: 500; color: #b91c1c; margin: 0 0 6px 0;">⚠ Mohon perbaiki kesalahan berikut:</p>
                        <ul id="error-list-register" style="font-size: 12px; color: #b91c1c; margin: 0; padding-left: 16px;"></ul>
                    </div>

                    <button type="submit" style="width: 100%; background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; padding: 14px; border-radius: 8px; font-weight: 700; font-size: 14px; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(14,165,233,0.3); transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(14,165,233,0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(14,165,233,0.3)';">
                        <span class="material-symbols-rounded" style="font-size: 20px;">person_add</span> Daftar Sekarang
                    </button>

                <?= form_close(); ?>
            </div>

            <p style="text-align: center; color: #6b7280; font-size: 14px; margin-top: 32px;">
                Sudah punya akun?
                <a href="<?= base_url('auth/login'); ?>" style="color: #0ea5e9; font-weight: 600; text-decoration: none;">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>

<script>
(function(){
  var form = document.getElementById('form-register');
  if (!form) return;

  form.addEventListener('submit', function(e) {
    var errors = [];
    
    var namaEl = form.querySelector('input[name="nama_lengkap"]');
    var emailEl = form.querySelector('input[name="email"]');
    var passEl = form.querySelector('input[name="password"]');
    var konfEl = form.querySelector('input[name="konfirmasi_password"]');
    
    var nama = namaEl ? namaEl.value.trim() : '';
    var email = emailEl ? emailEl.value.trim() : '';
    var pass = passEl ? passEl.value : '';
    var konf = konfEl ? konfEl.value : '';
    
    if (!nama) {
      errors.push('Nama lengkap wajib diisi.');
    } else if (nama.length < 3) {
      errors.push('Nama minimal 3 karakter.');
    } else if (/[^a-zA-Z\s]/.test(nama)) {
      errors.push('Nama hanya boleh berisi huruf dan spasi.');
    }
    
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
    
    if (!konf) {
      errors.push('Konfirmasi password wajib diisi.');
    } else if (pass !== konf) {
      errors.push('Konfirmasi password tidak cocok.');
    }
    
    if (errors.length > 0) {
      e.preventDefault();
      var box = document.getElementById('error-box-register');
      var list = document.getElementById('error-list-register');
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
      var box = document.getElementById('error-box-register');
      if (box) box.style.display = 'none';
    });
  });
})();
</script>
