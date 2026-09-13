<!-- Modal Konfirmasi Logout (reusable, semua halaman: publik & admin) -->
<div id="logoutModal" class="flash-overlay logout-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle">
  <div class="logout-modal">
    <div class="logout-modal-icon">
      <span class="material-symbols-rounded">logout</span>
    </div>
    <h3 id="logoutModalTitle" class="logout-modal-title">Konfirmasi Logout</h3>
    <p class="logout-modal-desc">Kamu akan keluar dari akun ini. Yakin ingin melanjutkan?</p>
    <div class="logout-modal-actions">
      <button type="button" class="btn-cancel" onclick="closeLogoutModal()">Batal</button>
      <button type="button" class="btn-logout-confirm" onclick="confirmLogout()">
        <span class="material-symbols-rounded">logout</span> Ya, Logout
      </button>
    </div>
  </div>
</div>

<script>
  function openLogoutModal() {
    document.getElementById('logoutModal').classList.add('show');
    document.body.style.overflow = 'hidden';
  }
  function closeLogoutModal() {
    document.getElementById('logoutModal').classList.remove('show');
    document.body.style.overflow = '';
  }
  function confirmLogout() {
    window.location.href = '<?= base_url("auth/logout"); ?>';
  }
  /* Klik overlay di luar card -> tutup */
  document.getElementById('logoutModal').addEventListener('click', function (e) {
    if (e.target === this) closeLogoutModal();
  });
  /* Tombol ESC -> tutup */
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeLogoutModal();
  });
</script>
