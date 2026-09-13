<?php if ($this->session->flashdata('success')): ?>
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
                                    <a href="<?= base_url('admin/users/toggle/' . $u->id_user); ?>" class="btn btn-danger btn-icon-sm" onclick="event.preventDefault(); konfirmasiToggleUser(<?= $u->id_user; ?>, '<?= htmlspecialchars($u->nama_lengkap, ENT_QUOTES); ?>', '<?= $u->status == 'aktif' ? 'nonaktif' : 'aktif'; ?>')"><span class="material-symbols-rounded text-sm"><?= $u->status == 'aktif' ? 'toggle_off' : 'toggle_on'; ?></span> <?= $u->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?></a>
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

<!-- Modal Konfirmasi Toggle Status User -->
<div id="modal-toggle-user" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-toggle-user')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-blue-500">toggle_on</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Ubah Status User?</h3>
            <p class="text-sm text-gray-500">Yakin ingin mengubah status <strong id="toggle-user-nama"></strong> menjadi <strong id="toggle-user-action" class="font-bold"></strong>?</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="button" class="btn btn-primary" onclick="prosesToggleUser()">
                <span class="material-symbols-rounded text-sm">check</span> Ya, Ubah
            </button>
        </div>
    </div>
</div>

<script>
var pendingToggleUserId = null;
var pendingToggleUserUrl = null;

function konfirmasiToggleUser(id, nama, aksi) {
    pendingToggleUserId = id;
    pendingToggleUserUrl = '<?= base_url('admin/users/toggle/'); ?>' + id;

    var namaEl = document.getElementById('toggle-user-nama');
    var actionEl = document.getElementById('toggle-user-action');
    if (namaEl) namaEl.textContent = nama;
    if (actionEl) actionEl.textContent = aksi === 'aktif' ? 'Aktif' : 'Nonaktif';

    openModal('modal-toggle-user');
}

function prosesToggleUser() {
    if (pendingToggleUserUrl) {
        window.location.href = pendingToggleUserUrl;
    }
}
</script>
