<?php if ($this->session->flashdata('success')): ?>
<div class="flash-success flex items-center gap-3 mb-6">
  <span class="material-symbols-rounded text-emerald-500">check_circle</span>
  <?= $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<div class="flash-error flex items-center gap-3 mb-6">
  <span class="material-symbols-rounded text-red-500">error</span>
  <?= $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('info')): ?>
<div class="flash-info flex items-center gap-3 mb-6">
  <span class="material-symbols-rounded text-sky-500">info</span>
  <?= $this->session->flashdata('info'); ?>
</div>
<?php endif; ?>

<div class="page-header animate-fade-in-up">
  <div class="page-header-icon">
    <span class="material-symbols-rounded">dashboard</span>
  </div>
  <div class="page-header-content">
    <h1>Dashboard</h1>
    <p>Selamat datang, <span class="font-semibold text-sky-600"><?= $this->session->userdata('nama_lengkap'); ?></span>! Berikut ringkasan aktivitas admin.</p>
  </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 animate-fade-in-up" style="animation-delay: 0.1s;">
  <a href="<?= base_url('admin/paket/tambah'); ?>" class="group relative overflow-hidden bg-gradient-to-br from-sky-500 to-sky-600 text-white px-6 py-5 rounded-2xl font-bold text-sm hover:shadow-2xl hover:shadow-sky-500/40 transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
    <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    <div class="relative flex items-center gap-3">
      <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
        <span class="material-symbols-rounded text-xl">add</span>
      </div>
      <div class="text-left">
        <div class="font-bold">Tambah Paket</div>
        <div class="text-xs opacity-90">Buat paket baru</div>
      </div>
    </div>
  </a>
  <a href="<?= base_url('admin/transaksi'); ?>" class="group relative overflow-hidden bg-gradient-to-br from-sky-500 to-sky-600 text-white px-6 py-5 rounded-2xl font-bold text-sm hover:shadow-2xl hover:shadow-sky-500/40 transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
    <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    <div class="relative flex items-center gap-3">
      <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
        <span class="material-symbols-rounded text-xl">receipt_long</span>
      </div>
      <div class="text-left">
        <div class="font-bold">Transaksi</div>
        <div class="text-xs opacity-90">Kelola pesanan</div>
      </div>
    </div>
  </a>
  <a href="<?= base_url('admin/laporan'); ?>" class="group relative overflow-hidden bg-gradient-to-br from-sky-500 to-sky-600 text-white px-6 py-5 rounded-2xl font-bold text-sm hover:shadow-2xl hover:shadow-sky-500/40 transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
    <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    <div class="relative flex items-center gap-3">
      <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
        <span class="material-symbols-rounded text-xl">analytics</span>
      </div>
      <div class="text-left">
        <div class="font-bold">Laporan</div>
        <div class="text-xs opacity-90">Lihat analytics</div>
      </div>
    </div>
  </a>
</div>

<div class="stat-grid mb-8">
  <a href="<?= base_url('admin/paket'); ?>" class="stat-card group animate-fade-in-up" style="animation-delay: 0.15s;">
    <div class="stat-icon relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-white/30 to-transparent"></div>
      <span class="material-symbols-rounded relative z-10">luggage</span>
    </div>
    <div class="flex-1">
      <div class="flex items-center justify-between mb-2">
        <p class="stat-label">Total Paket</p>
        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Paket</span>
      </div>
      <p class="stat-number"><?= $total_paket; ?></p>
      <p class="stat-sub"><?= $paket_tersedia; ?> tersedia</p>
    </div>
  </a>

  <a href="<?= base_url('admin/users'); ?>" class="stat-card group animate-fade-in-up" style="animation-delay: 0.2s;">
    <div class="stat-icon relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-white/30 to-transparent"></div>
      <span class="material-symbols-rounded relative z-10">group</span>
    </div>
    <div class="flex-1">
      <div class="flex items-center justify-between mb-2">
        <p class="stat-label">Pelanggan Aktif</p>
        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Users</span>
      </div>
      <p class="stat-number"><?= $pelanggan_aktif; ?></p>
      <p class="stat-sub"><?= round($pelanggan_aktif / max($total_pelanggan, 1) * 100); ?>% dari <?= $total_pelanggan; ?> total</p>
    </div>
  </a>

  <a href="<?= base_url('admin/transaksi'); ?>" class="stat-card group animate-fade-in-up" style="animation-delay: 0.25s;">
    <div class="stat-icon relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-white/30 to-transparent"></div>
      <span class="material-symbols-rounded relative z-10">pending_actions</span>
    </div>
    <div class="flex-1">
      <div class="flex items-center justify-between mb-2">
        <p class="stat-label">Transaksi Berjalan</p>
        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Proses</span>
      </div>
      <p class="stat-number"><?= $transaksi_berjalan; ?></p>
      <p class="stat-sub">Perlu ditindaklanjuti</p>
    </div>
  </a>

  <a href="<?= base_url('admin/laporan'); ?>" class="stat-card group animate-fade-in-up" style="animation-delay: 0.3s;">
    <div class="stat-icon relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-white/30 to-transparent"></div>
      <span class="material-symbols-rounded relative z-10">payments</span>
    </div>
    <div class="flex-1">
      <div class="flex items-center justify-between mb-2">
        <p class="stat-label">Pendapatan Bulan Ini</p>
        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pendapatan</span>
      </div>
      <p class="stat-number">Rp <?= number_format($pendapatan_bulan_ini, 0, ',', '.'); ?></p>
      <p class="stat-sub">Tahun ini: Rp <?= number_format($pendapatan_tahun_ini, 0, ',', '.'); ?></p>
    </div>
  </a>
</div>

<div class="admin-card animate-fade-in-up" style="animation-delay: 0.35s;">
  <div class="flex items-center justify-between mb-5">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-center">
        <span class="material-symbols-rounded text-sky-600 text-xl">receipt_long</span>
      </div>
      <div>
        <h3 class="font-bold text-slate-900">Transaksi Terbaru</h3>
        <p class="text-xs text-slate-500">5 transaksi paling akhir</p>
      </div>
    </div>
    <a href="<?= base_url('admin/transaksi'); ?>" class="btn btn-secondary btn-icon-sm"><span class="material-symbols-rounded text-sm">visibility</span> Lihat Semua</a>
  </div>

  <div class="overflow-x-auto">
    <table class="admin-table">
      <thead>
        <tr class="table-header">
          <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider">Kode Booking</th>
          <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider">Pelanggan</th>
          <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider">Paket</th>
          <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-right">Total</th>
          <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($transaksi_terbaru)): ?>
          <?php foreach ($transaksi_terbaru as $i => $t): ?>
          <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition <?= ($i % 2 == 0) ? '' : 'bg-slate-50/50'; ?>">
            <td class="py-3 px-4 font-mono text-xs font-bold text-sky-600"><?= $t->kode_booking; ?></td>
            <td class="py-3 px-4 font-semibold text-slate-800 text-sm"><?= $t->nama_lengkap; ?></td>
            <td class="py-3 px-4 text-slate-600 text-sm"><?= $t->nama_paket; ?></td>
            <td class="py-3 px-4 font-bold text-right text-sm">Rp <?= number_format($t->total_bayar, 0, ',', '.'); ?></td>
            <td class="py-3 px-4 text-center">
              <span class="badge <?= 'badge-' . $t->status_pemesanan; ?>"><?= ucfirst($t->status_pemesanan); ?></span>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
        <tr>
          <td colspan="5" class="py-8 text-center">
            <p class="text-slate-400 text-sm">Belum ada transaksi.</p>
          </td>
        </tr>
        <?php endif; ?>
       </tbody>
    </table>
  </div>
</div>