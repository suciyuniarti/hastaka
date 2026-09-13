<?php $this->load->view('templates/header'); ?>

<style>
/* Toast Notification System */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    pointer-events: none;
}
.toast {
    min-width: 280px;
    max-width: 380px;
    border-radius: 12px;
    padding: 14px 18px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    display: flex;
    align-items: flex-start;
    gap: 12px;
    position: relative;
    overflow: hidden;
    pointer-events: auto;
    animation: toastSlideIn 0.3s ease-out forwards;
}
.toast.toast-hide {
    animation: toastSlideOut 0.3s ease-in forwards;
}
.toast-success {
    background: #f0fdf4;
    border-left: 4px solid #16a34a;
}
.toast-error {
    background: #fef2f2;
    border-left: 4px solid #dc2626;
}
.toast-warning {
    background: #fffbeb;
    border-left: 4px solid #f59e0b;
}
.toast-icon {
    flex-shrink: 0;
    margin-top: 1px;
}
.toast-success .toast-icon { color: #16a34a; }
.toast-error .toast-icon { color: #dc2626; }
.toast-warning .toast-icon { color: #f59e0b; }
.toast-content {
    flex: 1;
    min-width: 0;
}
.toast-title {
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 2px;
}
.toast-success .toast-title { color: #15803d; }
.toast-error .toast-title { color: #b91c1c; }
.toast-warning .toast-title { color: #b45309; }
.toast-message {
    font-size: 13px;
    line-height: 1.4;
}
.toast-success .toast-message { color: #166534; }
.toast-error .toast-message { color: #991b1b; }
.toast-warning .toast-message { color: #92400e; }
.toast-close {
    flex-shrink: 0;
    background: none;
    border: none;
    cursor: pointer;
    padding: 2px;
    line-height: 1;
    color: #9ca3af;
    transition: color 0.15s;
}
.toast-close:hover {
    color: #374151;
}
.toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    border-radius: 0 0 0 12px;
    animation: toastProgress 3s linear forwards;
}
.toast-success .toast-progress { background: #16a34a; }
.toast-error .toast-progress { background: #dc2626; }
.toast-warning .toast-progress { background: #f59e0b; }
@keyframes toastSlideIn {
    from { opacity: 0; transform: translateX(100%); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes toastSlideOut {
    from { opacity: 1; transform: translateX(0); }
    to { opacity: 0; transform: translateX(100%); }
}
@keyframes toastProgress {
    from { width: 100%; }
    to { width: 0%; }
}

/* Modal System */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease;
}
.modal-overlay.active {
    opacity: 1;
    pointer-events: auto;
}
.modal-box {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    display: flex;
    flex-direction: column;
    transform: scale(0.95);
    transition: transform 0.2s ease;
}
.modal-overlay.active .modal-box {
    transform: scale(1);
}
.modal-header {
    padding: 20px 24px;
    border-bottom: 0.5px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.modal-title {
    font-weight: 600;
    font-size: 18px;
    color: #0f172a;
}
.modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: #9ca3af;
    padding: 4px;
    font-size: 20px;
    line-height: 1;
    text-decoration: none;
    transition: color 0.15s;
}
.modal-close:hover {
    color: #374151;
}
.modal-body {
    padding: 24px;
    overflow-y: auto;
    max-height: calc(90vh - 140px);
}
.modal-footer {
    padding: 16px 24px;
    border-top: 0.5px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
}
.modal-sm { width: 400px; max-width: 95vw; }
.modal-md { width: 700px; max-width: 95vw; }
</style>

<div class="flex min-h-screen bg-gradient-to-br from-slate-50 via-sky-50/30 to-slate-100">

  <!-- Toast Container -->
  <div id="toast-container" class="toast-container"></div>

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

// Toast Notification System
function showToast(type, message) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast toast-' + type;
    
    const iconMap = {
        success: 'check_circle',
        error: 'error',
        warning: 'warning'
    };
    const titleMap = {
        success: 'Berhasil',
        error: 'Gagal',
        warning: 'Perhatian'
    };
    
    toast.innerHTML = '<span class="material-symbols-rounded toast-icon">' + iconMap[type] + '</span>' +
        '<div class="toast-content">' +
        '<div class="toast-title">' + titleMap[type] + '</div>' +
        '<div class="toast-message">' + message + '</div>' +
        '</div>' +
        '<button class="toast-close" onclick="closeToast(this.parentElement)">&times;</button>' +
        '<div class="toast-progress"></div>';
    
    container.appendChild(toast);
    
    let timeout = setTimeout(function() {
        closeToast(toast);
    }, 3000);
    
    let remaining = 3000;
    let start = Date.now();
    
    function pause() {
        clearTimeout(timeout);
        const elapsed = Date.now() - start;
        remaining -= elapsed;
        toast.querySelector('.toast-progress').style.animationPlayState = 'paused';
    }
    
    function resume() {
        start = Date.now();
        timeout = setTimeout(function() {
            closeToast(toast);
        }, remaining);
        toast.querySelector('.toast-progress').style.animationPlayState = 'running';
    }
    
    toast.addEventListener('mouseenter', pause);
    toast.addEventListener('mouseleave', resume);
    
    window._toastHooks = window._toastHooks || [];
    window._toastHooks.push({ pause: pause, resume: resume });
}

function closeToast(toast) {
    if (!toast || toast.classList.contains('toast-hide')) return;
    toast.classList.add('toast-hide');
    setTimeout(function() {
        if (toast.parentElement) toast.remove();
    }, 300);
}

// Auto-show toasts from CI3 flashdata
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($this->session->flashdata('success')): ?>
        showToast('success', '<?= $this->session->flashdata('success'); ?>');
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        showToast('error', '<?= $this->session->flashdata('error'); ?>');
    <?php endif; ?>
    <?php if ($this->session->flashdata('warning')): ?>
        showToast('warning', '<?= $this->session->flashdata('warning'); ?>');
    <?php endif; ?>
});

// Modal helpers
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function tutupModal() {
    const open = document.querySelector('.modal-overlay.active');
    if (open) closeModal(open.id);
}
</script>

<?php $this->load->view('templates/footer_admin'); ?>
