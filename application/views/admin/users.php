<?php if ($this->session->flashdata('success')): ?>
<div class="flash-success" onclick="this.classList.add('flash-hide'); setTimeout(() => this.remove(), 300);">
    <span class="material-symbols-rounded">check_circle</span>
    <div class="flash-content">
        <span class="flash-title">Berhasil</span>
        <span class="flash-message"><?= $this->session->flashdata('success'); ?></span>
    </div>
</div>
<div class="flash-overlay" onclick="this.remove()"></div>
<?php endif; ?>

<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">group</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Pelanggan</h1>
        <p><?= count($users ?? []); ?> pengguna terdaftar</p>
    </div>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table text-sm">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider w-12">No</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Nama</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Email</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center">Role</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Terdaftar</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider w-36 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $i => $u): ?>
                        <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition whitespace-nowrap <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
                            <td class="py-4 px-4 text-slate-400 text-sm font-mono td-no"><?= $i + 1; ?></td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-sky-50 border border-sky-100 rounded-full flex items-center justify-center">
                                        <span class="material-symbols-rounded text-sky-600 text-lg">person</span>
                                    </div>
                                    <span class="font-bold text-slate-800"><?= $u->nama_lengkap; ?></span>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-slate-600"><?= $u->email; ?></td>
                            <td class="py-4 px-4 text-center">
                                <span class="bg-<?= $u->role == 'admin' ? 'purple' : 'sky'; ?>-100 text-<?= $u->role == 'admin' ? 'purple' : 'sky'; ?>-700 border border-<?= $u->role == 'admin' ? 'purple' : 'sky'; ?>-300 px-3 py-1 rounded-full text-xs font-bold">
                                    <?= ucfirst($u->role); ?>
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-<?= $u->status == 'aktif' ? 'emerald' : 'red'; ?>-500"></span>
                                    <span class="text-<?= $u->status == 'aktif' ? 'emerald' : 'red'; ?>-600 text-xs font-bold"><?= ucfirst($u->status); ?></span>
                                </span>
                            </td>
                            <td class="py-4 px-4 text-slate-500 text-sm"><?= date('d M Y', strtotime($u->created_at)); ?></td>
                            <td class="py-4 px-4 text-center">
                                <?php if ($u->role != 'admin'): ?>
                                    <a href="<?= base_url('admin/users/toggle/' . $u->id_user); ?>" class="btn btn-danger btn-icon-sm" onclick="return confirm('Yakin ingin mengubah status user ini?')"><span class="material-symbols-rounded text-sm"><?= $u->status == 'aktif' ? 'toggle_off' : 'toggle_on'; ?></span> <?= $u->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?></a>
                                <?php else: ?>
                                    <span class="text-slate-400 text-xs">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="py-16 text-center">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <span class="material-symbols-rounded">group</span>
                                </div>
                                <h3>Belum ada pengguna terdaftar.</h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>