<div class="sticky top-0 z-50 bg-white shadow-sm w-full">
<nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

        <!-- Logo -->
        <a href="<?= base_url(); ?>" class="flex items-center gap-2 group">
            <div class="w-9 h-9 gradient-bg rounded-xl flex items-center justify-center shadow-lg shadow-sky-500/30 group-hover:shadow-sky-500/50 transition-shadow">
                <span class="material-symbols-rounded text-white text-lg">explore</span>
            </div>
            <span class="font-extrabold text-xl text-sky-500 hidden sm:block tracking-tight">Hastaka Holiday</span>
        </a>

        <!-- Desktop Nav -->
        <div class="hidden lg:flex items-center gap-1">
            <?php
            $uri = $this->uri->segment(1);
            $links = [
                '' => ['label'=>'Home','icon'=>'home'],
                'paket' => ['label'=>'Paket Wisata','icon'=>'luggage'],
                'program' => ['label'=>'Program','icon'=>'category'],
                'clients' => ['label'=>'Klien','icon'=>'groups'],
                'rekomendasi' => ['label'=>'Rekomendasi','icon'=>'auto_awesome'],
            ];
            foreach ($links as $seg => $lnk):
                $active = ($uri == $seg) || ($seg == '' && $uri == '');
            ?>
            <a href="<?= base_url($seg); ?>" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium transition-all <?= $active ? 'text-sky-500 font-semibold' : 'text-slate-600 hover:text-sky-500'; ?>">
                <span class="material-symbols-rounded text-[18px]"><?= $lnk['icon']; ?></span>
                <?= $lnk['label']; ?>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Right Side -->
        <div class="hidden lg:flex items-center gap-3">
            <?php if ($this->session->userdata('logged_in')): ?>
                <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="<?= base_url('admin/dashboard'); ?>" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-sky-600 hover:bg-sky-50 transition">
                        <span class="material-symbols-rounded text-[18px]">dashboard</span>
                        Dashboard
                    </a>
                <?php endif; ?>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button onclick="toggleDropdown()" class="flex items-center gap-2 pl-3 pr-2 py-1.5 rounded-xl border border-slate-200 hover:border-sky-300 hover:bg-sky-50 transition-all">
                        <div class="w-7 h-7 gradient-bg rounded-lg flex items-center justify-center">
                            <span class="text-white text-xs font-bold"><?= strtoupper(substr($this->session->userdata('nama_lengkap'), 0, 1)); ?></span>
                        </div>
                        <span class="text-sm font-medium text-slate-700 max-w-[120px] truncate"><?= $this->session->userdata('nama_lengkap'); ?></span>
                        <span class="material-symbols-rounded text-slate-400 text-[18px]" id="dropdown-arrow">expand_more</span>
                    </button>
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 py-2 animate-slide-down">
                        <div class="px-4 py-2 border-b border-slate-100">
                            <p class="text-sm font-semibold text-slate-800"><?= $this->session->userdata('nama_lengkap'); ?></p>
                            <p class="text-xs text-slate-500"><?= $this->session->userdata('email'); ?></p>
                        </div>
                        <a href="<?= base_url('profil'); ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-700 transition">
                            <span class="material-symbols-rounded text-[18px]">person</span> Profil Saya
                        </a>
                        <?php if ($this->session->userdata('role') != 'admin'): ?>
                        <a href="<?= base_url('pemesanan/riwayat'); ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-sky-50 hover:text-sky-700 transition">
                            <span class="material-symbols-rounded text-[18px]">receipt_long</span> Riwayat Pesanan
                        </a>
                        <?php endif; ?>
                        <div class="border-t border-slate-100 mt-1 pt-1">
                            <a href="<?= base_url('auth/logout'); ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                <span class="material-symbols-rounded text-[18px]">logout</span> Keluar
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?= base_url('auth/login'); ?>" class="text-sm font-medium text-slate-600 hover:text-sky-500 px-4 py-2 rounded-xl hover:bg-sky-50 transition">Masuk</a>
                <a href="<?= base_url('auth/register'); ?>" class="text-sm font-semibold text-white gradient-bg px-5 py-2.5 rounded-full hover:opacity-90 transition shadow-lg shadow-sky-500/25">Daftar</a>
            <?php endif; ?>
        </div>

        <!-- Mobile Toggle -->
        <button onclick="toggleMobile()" class="lg:hidden p-2 rounded-xl hover:bg-slate-100 transition">
            <span class="material-symbols-rounded text-slate-600" id="mobile-icon">menu</span>
        </button>
    </div>
</nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white">
        <div class="px-4 py-3 space-y-1">
            <?php foreach ($links as $seg => $lnk): ?>
            <a href="<?= base_url($seg); ?>" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-sky-50 hover:text-sky-700 transition">
                <span class="material-symbols-rounded text-[20px]"><?= $lnk['icon']; ?></span> <?= $lnk['label']; ?>
            </a>
            <?php endforeach; ?>
            <?php if ($this->session->userdata('logged_in')): ?>
                <?php if ($this->session->userdata('role') == 'admin'): ?>
                <a href="<?= base_url('admin/dashboard'); ?>" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-sky-600 hover:bg-sky-50 transition">
                    <span class="material-symbols-rounded text-[20px]">dashboard</span> Dashboard Admin
                </a>
                <?php else: ?>
                <a href="<?= base_url('pemesanan/riwayat'); ?>" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-sky-50 transition">
                    <span class="material-symbols-rounded text-[20px]">receipt_long</span> Riwayat Pesanan
                </a>
                <?php endif; ?>
                <a href="<?= base_url('profil'); ?>" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-sky-50 transition">
                    <span class="material-symbols-rounded text-[20px]">person</span> Profil
                </a>
                <a href="<?= base_url('auth/logout'); ?>" class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition">
                    <span class="material-symbols-rounded text-[20px]">logout</span> Keluar
                </a>
            <?php else: ?>
                <div class="pt-2 flex gap-2">
                    <a href="<?= base_url('auth/login'); ?>" class="flex-1 text-center py-2.5 rounded-full border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">Masuk</a>
                    <a href="<?= base_url('auth/register'); ?>" class="flex-1 text-center py-2.5 rounded-full gradient-bg text-sm font-semibold text-white hover:opacity-90 transition">Daftar</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function toggleMobile() {
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('mobile-icon');
    menu.classList.toggle('hidden');
    icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
}
function toggleDropdown() {
    const dd = document.getElementById('user-dropdown');
    const arrow = document.getElementById('dropdown-arrow');
    dd.classList.toggle('hidden');
    arrow.style.transform = dd.classList.contains('hidden') ? '' : 'rotate(180deg)';
}
document.addEventListener('click', function(e) {
    const dd = document.getElementById('user-dropdown');
    if (dd && !e.target.closest('[x-data]')) dd.classList.add('hidden');
});
</script>