<main class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 px-4 sm:px-6 lg:px-8 py-10">

    <div class="animate-fade-in-up">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-12 h-12 gradient-bg rounded-2xl flex items-center justify-center shadow-lg shadow-sky-500/25">
                <span class="material-symbols-rounded text-white text-2xl">person</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold gradient-text">Profil Saya</h1>
                <p class="text-slate-500 text-sm">Kelola informasi akun Anda</p>
            </div>
        </div>
    </div>

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

    <div class="bg-white rounded-3xl shadow-lg shadow-slate-200/50 p-8 max-w-2xl animate-fade-in-up stagger-1 hover-lift">

        <div class="flex items-center gap-6 mb-8 pb-8 border-b border-slate-100">
            <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center shadow-lg shadow-sky-500/25">
                <span class="material-symbols-rounded text-white text-4xl">person</span>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-800"><?= $user->nama_lengkap; ?></h2>
                <p class="text-slate-500"><?= $user->email; ?></p>
                <span class="text-xs bg-sky-100 text-sky-700 px-3 py-1 rounded-full mt-2 inline-block font-semibold">
                    <?= ucfirst($user->role); ?>
                </span>
            </div>
        </div>

        <div class="space-y-1">
            <?php
            $fields = [
                ['label' => 'Nama Lengkap', 'value' => $user->nama_lengkap, 'icon' => 'badge'],
                ['label' => 'Email', 'value' => $user->email, 'icon' => 'mail'],
                ['label' => 'Role', 'value' => ucfirst($user->role), 'icon' => 'admin_panel_settings'],
                ['label' => 'Status', 'value' => ucfirst($user->status), 'icon' => 'verified', 'color' => $user->status == 'aktif' ? 'emerald' : 'red'],
                ['label' => 'Terdaftar Sejak', 'value' => date('d F Y', strtotime($user->created_at)), 'icon' => 'calendar_today'],
            ];
            foreach ($fields as $f):
            ?>
            <div class="flex items-center justify-between py-4 px-4 rounded-2xl hover:bg-slate-50 transition group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-rounded text-slate-400 group-hover:text-sky-500 transition text-xl"><?= $f['icon']; ?></span>
                    <span class="text-slate-500"><?= $f['label']; ?></span>
                </div>
                <span class="font-semibold <?= isset($f['color']) ? 'text-' . $f['color'] . '-600' : 'text-slate-800'; ?>">
                    <?= $f['value']; ?>
                </span>
            </div>
            <?php endforeach; ?>
        </div>

<a href="<?= base_url('profil/edit'); ?>"
            class="mt-8 inline-flex items-center gap-2 gradient-bg text-white px-8 py-3 rounded-full font-semibold hover:opacity-90 transition shadow-lg">
                <span class="material-symbols-rounded text-xl">edit</span>
                Edit Profil
            </a>
    </div>

</main>