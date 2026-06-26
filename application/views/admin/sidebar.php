<div id="sidebarInner" class="flex flex-col h-full admin-sidebar-inner" style="z-index: 40;">

   <!-- Logo -->
   <div class="p-5 flex items-center gap-3 border-b border-white/10">
     <div class="w-11 h-11 bg-white/15 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg relative overflow-hidden sidebar-logo">
       <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent"></div>
       <span class="material-symbols-rounded text-white text-2xl relative z-10">admin_panel_settings</span>
     </div>
     <div>
       <h3 class="font-extrabold text-base text-white tracking-tight leading-tight">
         Hastaka <span class="text-sky-300">Holiday</span>
       </h3>
       <span class="inline-block mt-1 bg-white/10 text-sky-200 text-[10px] px-2 py-0.5 rounded-full font-bold border border-white/20 backdrop-blur-sm">
         Admin Panel
       </span>
     </div>
   </div>

   <!-- Navigation -->
   <nav class="flex-1 p-4 space-y-1 overflow-y-auto sidebar-nav">
     <?php
     $menu = [
       ['url' => 'admin/dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard', 'seg' => 'dashboard'],
       ['url' => 'admin/paket', 'icon' => 'luggage', 'label' => 'Paket Wisata', 'seg' => 'paket'],
       ['url' => 'admin/kategori', 'icon' => 'category', 'label' => 'Kategori Program', 'seg' => 'kategori'],
       ['url' => 'admin/destinasi', 'icon' => 'place', 'label' => 'Destinasi', 'seg' => 'destinasi'],
       ['url' => 'admin/fasilitas', 'icon' => 'inventory_2', 'label' => 'Fasilitas', 'seg' => 'fasilitas'],
       ['url' => 'admin/aktivitas', 'icon' => 'hiking', 'label' => 'Aktivitas', 'seg' => 'aktivitas'],
       ['url' => 'admin/klien', 'icon' => 'groups', 'label' => 'Klien', 'seg' => 'klien'],
       ['url' => 'admin/kriteria', 'icon' => 'tune', 'label' => 'Kriteria SAW', 'seg' => 'kriteria'],
       ['url' => 'admin/users', 'icon' => 'group', 'label' => 'Pelanggan', 'seg' => 'users'],
       ['url' => 'admin/transaksi', 'icon' => 'receipt_long', 'label' => 'Transaksi', 'seg' => 'transaksi'],
       ['url' => 'admin/laporan', 'icon' => 'analytics', 'label' => 'Laporan', 'seg' => 'laporan'],
     ];
     foreach ($menu as $m):
       $active = ($this->uri->segment(2) == $m['seg']) || (!$this->uri->segment(2) && $m['seg'] == 'dashboard');
     ?>
       <a href="<?= base_url($m['url']); ?>"
         class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium group relative overflow-hidden <?= $active ? 'active' : ''; ?>">
         <?php if ($active): ?>
           <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-sky-400 to-sky-600 rounded-r-full"></div>
           <div class="absolute inset-0 bg-gradient-to-r from-sky-500/10 to-transparent opacity-50"></div>
         <?php endif; ?>
         <span class="material-symbols-rounded text-lg group-hover:scale-110 transition-transform duration-200 relative z-10"><?= $m['icon']; ?></span>
         <span class="text-xs font-semibold relative z-10"><?= $m['label']; ?></span>
       </a>
     <?php endforeach; ?>

     <div class="border-t border-white/10 mt-4 pt-3">
       <a href="<?= base_url(); ?>" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium group">
         <span class="material-symbols-rounded text-lg group-hover:scale-110 transition-transform duration-200">home</span>
         <span class="text-xs font-semibold">Ke Beranda</span>
       </a>
     </div>
   </nav>

   <!-- Logout -->
   <div class="mt-auto p-4 border-t border-white/10">
     <a href="<?= base_url('auth/logout'); ?>"
       onclick="return confirm('Yakin ingin logout?')"
       class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-red-300 transition-all duration-200 hover:bg-red-500/20 hover:text-white">

        <span class="material-symbols-rounded text-[20px]">logout</span>
        <span class="font-medium">Logout</span>
     </a>
   </div>