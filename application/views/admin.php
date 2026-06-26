<?php $this->load->view('templates/header'); ?>

<div class="flex min-h-screen bg-gradient-to-br from-slate-50 via-sky-50/30 to-slate-100">

  <!-- SIDEBAR -->
  <aside id="sidebar" class="w-64 fixed left-0 top-0 h-screen flex flex-col z-50 border-r transition-transform duration-300 ease-in-out admin-sidebar">
    <?php $this->load->view('admin/sidebar'); ?>
  </aside>

  <!-- Mobile Overlay -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300 opacity-0" onclick="toggleSidebar()"></div>

  <!-- Mobile Menu Button -->
  <button id="menuToggle" class="lg:hidden fixed top-4 left-4 z-50 w-12 h-12 bg-white rounded-xl shadow-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition-colors hidden" onclick="toggleSidebar()">
    <span class="material-symbols-rounded text-slate-700 text-2xl">menu</span>
  </button>

  <!-- MAIN AREA -->
  <div class="ml-0 lg:ml-64 flex-1 flex flex-col min-h-screen admin-main w-full">
    <!-- KONTEN HALAMAN -->
    <main class="flex-1 admin-content">
      <?php $this->load->view($content_view ?? 'admin/dashboard'); ?>
    </main>
  </div>
</div>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const menuToggle = document.getElementById('menuToggle');
  const icon = menuToggle.querySelector('.material-symbols-rounded');
  const isHidden = sidebar.classList.contains('hidden-mobile');

  if (isHidden) {
    sidebar.classList.remove('hidden-mobile');
    sidebar.classList.add('visible-mobile');
    overlay.classList.remove('hidden');
    overlay.classList.add('active');
    icon.textContent = 'close';
    document.body.style.overflow = 'hidden';
  } else {
    sidebar.classList.add('hidden-mobile');
    sidebar.classList.remove('visible-mobile');
    overlay.classList.add('hidden');
    overlay.classList.remove('active');
    icon.textContent = 'menu';
    document.body.style.overflow = '';
  }
}

function initSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const menuToggle = document.getElementById('menuToggle');
  const isMobile = window.innerWidth < 1024;

  if (isMobile) {
    sidebar.classList.add('hidden-mobile');
    sidebar.classList.remove('visible-mobile');
    overlay.classList.add('hidden');
    menuToggle.style.display = 'flex';
    menuToggle.classList.remove('hidden');
  } else {
    sidebar.classList.remove('hidden-mobile');
    sidebar.classList.remove('visible-mobile');
    overlay.classList.add('hidden');
    menuToggle.style.display = 'none';
    menuToggle.classList.add('hidden');
    document.body.style.overflow = '';
  }
}

document.addEventListener('DOMContentLoaded', initSidebar);
window.addEventListener('resize', initSidebar);
</script>

<?php $this->load->view('templates/footer_admin'); ?>
