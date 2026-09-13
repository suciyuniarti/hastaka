<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="animate-fade-in-up">
        <a href="<?= base_url('profil'); ?>" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-semibold mb-6 group">
            <span class="material-symbols-rounded text-xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Kembali ke Profil
        </a>

        <div class="flex items-center gap-3 mb-8">
            <div class="w-12 h-12 gradient-bg rounded-2xl flex items-center justify-center shadow-lg shadow-sky-500/25">
                <span class="material-symbols-rounded text-white text-2xl">edit</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold gradient-text">Edit Profil</h1>
                <p class="text-slate-500 text-sm">Perbarui informasi akun Anda</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 p-8 max-w-2xl animate-fade-in-up stagger-1">

        <?= form_open('profil/edit', ['class' => 'space-y-6']); ?>

            <div>
                <label class="flex items-center gap-2 text-slate-700 font-semibold mb-2">
                    <span class="material-symbols-rounded text-sky-500 text-xl">badge</span>
                    Nama Lengkap
                </label>
                <input type="text" name="nama_lengkap" value="<?= set_value('nama_lengkap', $user->nama_lengkap); ?>"
                    class="w-full px-5 py-3 bg-slate-50 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 transition" required>
                <?= form_error('nama_lengkap', '<p class="text-red-500 text-sm mt-2 flex items-center gap-1"><span class="material-symbols-rounded text-sm">error</span>', '</p>'); ?>
            </div>

            <div>
                <label class="flex items-center gap-2 text-slate-700 font-semibold mb-2">
                    <span class="material-symbols-rounded text-sky-500 text-xl">mail</span>
                    Email
                </label>
                <input type="email" value="<?= $user->email; ?>" disabled
                    class="w-full px-5 py-3 bg-slate-100 border-0 rounded-xl text-slate-400 cursor-not-allowed">
                <p class="text-slate-400 text-sm mt-1 flex items-center gap-1">
                    <span class="material-symbols-rounded text-xs">info</span>
                    Email tidak dapat diubah
                </p>
            </div>

            <div>
                <label class="flex items-center gap-2 text-slate-700 font-semibold mb-2">
                    <span class="material-symbols-rounded text-sky-500 text-xl">lock</span>
                    Password Baru <span class="text-slate-400 font-normal text-sm">(Opsional)</span>
                </label>
                <div class="relative">
                    <input type="password" name="password" id="input-password"
                        class="w-full px-5 py-3 pr-12 bg-slate-50 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 transition"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded-lg hover:bg-slate-100 transition text-slate-400 hover:text-slate-600">
                        <span class="material-symbols-rounded text-xl" id="toggle-pw-icon">visibility</span>
                    </button>
                </div>
                <div id="pw-strength" class="mt-2 hidden">
                    <div class="flex gap-1 mb-1">
                        <div id="pw-bar-1" class="h-1 flex-1 rounded-full bg-slate-200 transition-all"></div>
                        <div id="pw-bar-2" class="h-1 flex-1 rounded-full bg-slate-200 transition-all"></div>
                        <div id="pw-bar-3" class="h-1 flex-1 rounded-full bg-slate-200 transition-all"></div>
                        <div id="pw-bar-4" class="h-1 flex-1 rounded-full bg-slate-200 transition-all"></div>
                    </div>
                    <p id="pw-text" class="text-xs text-slate-400"></p>
                </div>
                <p id="pw-hint" class="text-slate-400 text-sm mt-1 flex items-center gap-1">
                    <span class="material-symbols-rounded text-xs">info</span>
                    Minimal 6 karakter
                </p>
            </div>

            <div class="flex gap-3 pt-4">
<button type="submit" class="inline-flex items-center gap-2 gradient-bg text-white px-8 py-3 rounded-full font-semibold hover:shadow-xl hover:shadow-sky-500/40 hover:scale-105 active:scale-95 transition-all duration-300 shadow-lg">
                    <span class="material-symbols-rounded text-xl">save</span>
                    Simpan Perubahan
                </button>
                <a href="<?= base_url('profil'); ?>" class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 px-6 py-3 rounded-full font-semibold hover:bg-slate-200 transition">
                    <span class="material-symbols-rounded text-xl">close</span> Batal
                </a>
            </div>

        <?= form_close(); ?>

    </div>

</main>

<script>
function togglePassword() {
    const input = document.getElementById('input-password');
    const icon = document.getElementById('toggle-pw-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility';
    }
}

document.getElementById('input-password').addEventListener('input', function() {
    const val = this.value;
    const strengthDiv = document.getElementById('pw-strength');
    const hintDiv = document.getElementById('pw-hint');
    const bars = [document.getElementById('pw-bar-1'), document.getElementById('pw-bar-2'), document.getElementById('pw-bar-3'), document.getElementById('pw-bar-4')];
    const text = document.getElementById('pw-text');

    if (!val) {
        strengthDiv.classList.add('hidden');
        hintDiv.classList.remove('hidden');
        return;
    }

    strengthDiv.classList.remove('hidden');
    hintDiv.classList.add('hidden');

    let score = 0;
    if (val.length >= 6) score++;
    if (val.length >= 10) score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/[0-9]/.test(val) && /[^A-Za-z0-9]/.test(val)) score++;

    const colors = ['bg-red-400', 'bg-orange-400', 'bg-yellow-400', 'bg-emerald-400'];
    const labels = ['Lemah', 'Cukup', 'Baik', 'Kuat'];
    const textColors = ['text-red-500', 'text-orange-500', 'text-yellow-500', 'text-emerald-500'];

    bars.forEach((bar, i) => {
        bar.className = 'h-1 flex-1 rounded-full transition-all ' + (i < score ? colors[score - 1] : 'bg-slate-200');
    });
    text.textContent = labels[score - 1] || '';
    text.className = 'text-xs ' + (textColors[score - 1] || 'text-slate-400');
});
</script>