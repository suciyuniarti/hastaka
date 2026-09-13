<?php if ($this->session->flashdata('success')): ?>
<?php endif; ?>

<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">receipt_long</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Transaksi</h1>
        <p><?= $total_transaksi ?? count($transaksi ?? []); ?> transaksi tercatat</p>
    </div>
</div>

<div class="admin-table-wrap">
    <div class="overflow-x-auto">
        <table class="admin-table text-sm">
            <thead>
                <tr class="table-header">
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Kode Booking</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Pelanggan</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Paket</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider">Keberangkatan</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center">Tipe Bayar</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center">Status</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center">Kontak</th>
                    <th class="py-4 px-4 text-xs font-bold uppercase tracking-wider text-center w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transaksi)): ?>
                <?php foreach ($transaksi as $t): ?>
                 <tr class="border-b border-slate-100 hover:bg-sky-50/60 transition">
                     <td class="py-4 px-4 font-mono text-xs font-bold text-sky-600 whitespace-nowrap"><?= $t->kode_booking; ?></td>
                     <td class="py-4 px-4 whitespace-normal">
                         <div class="font-semibold text-slate-800"><?= $t->nama_lengkap; ?></div>
                         <div class="text-xs text-slate-500 mt-0.5"><?= $t->no_telepon ?? '-'; ?></div>
                     </td>
                     <td class="py-4 px-4 text-slate-600 whitespace-normal"><?= $t->nama_paket; ?></td>
                     <td class="py-4 px-4 text-slate-600 whitespace-normal">
                         <div><?= date('d M Y', strtotime($t->tgl_keberangkatan)); ?></div>
                         <div class="text-xs text-slate-500"><?= !empty($t->jam_keberangkatan) ? date('H:i', strtotime($t->jam_keberangkatan)) : '-'; ?></div>
                     </td>
                      <td class="py-4 px-4 text-center whitespace-nowrap">
                          <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold <?= ($t->tipe_pembayaran ?? 'full') == 'dp' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700'; ?>">
                              <?= ($t->tipe_pembayaran ?? 'full') == 'dp' ? 'DP' : 'Lunas'; ?>
                          </span>
                      </td>
                      <td class="py-4 px-4 text-center whitespace-nowrap">
                          <span class="badge <?= 'badge-' . $t->status_pemesanan; ?>"><?= ucfirst($t->status_pemesanan); ?></span>
                      </td>
                      <td class="py-4 px-4 text-center whitespace-nowrap">
                          <?php if (!empty($t->no_telepon)): ?>
                              <?php
                                  // Format nomor telepon ke format internasional (628xxx)
                                  $nomor_wa = preg_replace('/^0/', '62', $t->no_telepon);
                                  $pesan_wa = urlencode("Halo {$t->nama_lengkap}, terkait pemesanan Anda dengan kode booking {$t->kode_booking} - {$t->nama_paket}");
                              ?>
                              <a href="https://wa.me/<?= $nomor_wa; ?>?text=<?= $pesan_wa; ?>" 
                                 target="_blank" 
                                 rel="noopener noreferrer"
                                 class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition"
                                 title="Hubungi via WhatsApp">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                  </svg>
                              </a>
                          <?php else: ?>
                              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-400 opacity-40 cursor-not-allowed" title="Nomor tidak tersedia">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                  </svg>
                              </span>
                          <?php endif; ?>
                      </td>
                      <td class="py-4 px-4 whitespace-nowrap">
                         <div class="flex items-center justify-center gap-1.5">
                             <button onclick="showDetailModal(<?= $t->id_pemesanan; ?>)" 
                                     class="btn btn-primary btn-icon-sm" 
                                     title="Detail">
                                 <span class="material-symbols-rounded text-sm">visibility</span> Detail
                             </button>
                             <?php if ($t->status_pemesanan == 'pending'): ?>
                             <a href="<?= base_url('admin/transaksi/konfirmasi/' . $t->id_pemesanan); ?>" class="btn btn-success btn-icon-sm" title="Konfirmasi" onclick="event.preventDefault(); konfirmasiTransaksi(<?= $t->id_pemesanan; ?>)"><span class="material-symbols-rounded text-sm">check_circle</span></a>
                             <a href="<?= base_url('admin/transaksi/batalkan/' . $t->id_pemesanan); ?>" class="btn btn-danger btn-icon-sm" title="Batalkan" onclick="event.preventDefault(); batalkanTransaksi(<?= $t->id_pemesanan; ?>)"><span class="material-symbols-rounded text-sm">close</span></a>
                             <?php elseif ($t->status_pemesanan == 'dikonfirmasi'): ?>
                             <span class="btn btn-secondary btn-icon-sm" style="cursor: default;" title="Dikonfirmasi"><span class="material-symbols-rounded text-sm">check_circle</span></span>
                             <?php else: ?>
                             <span class="btn btn-secondary btn-icon-sm" style="cursor: default;" title="<?= ucfirst($t->status_pemesanan); ?>"><span class="material-symbols-rounded text-sm"><?= ucfirst($t->status_pemesanan == 'selesai' ? 'check_circle' : 'close'); ?></span></span>
                             <?php endif; ?>
                         </div>
                     </td>
                 </tr>
                <?php endforeach; ?>
                <?php else: ?>
                 <tr><td colspan="8" class="py-16 text-center">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <span class="material-symbols-rounded">receipt_long</span>
                        </div>
                        <h3>Belum ada transaksi.</h3>
                    </div>
                </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($total_pages) && $total_pages > 1): ?>
    <?php $current_page = isset($current_page) ? (int)$current_page : 0; ?>
    <div class="pagination">
        <p class="pagination-info">Halaman <?= $current_page + 1; ?> dari <?= $total_pages; ?></p>
        <div class="pagination-buttons">
            <?php if ($current_page > 0): ?>
            <a href="<?= base_url('admin/transaksi/' . ($current_page - 1)); ?>" class="pagination-btn prev">Sebelumnya</a>
            <?php endif; ?>
            <?php for ($i = 0; $i < $total_pages; $i++): ?>
            <a href="<?= base_url('admin/transaksi/' . $i); ?>" class="pagination-num <?= $i == $current_page ? 'active' : ''; ?>"><?= $i + 1; ?></a>
            <?php endfor; ?>
            <?php if ($current_page < $total_pages - 1): ?>
            <a href="<?= base_url('admin/transaksi/' . ($current_page + 1)); ?>" class="pagination-btn next">Selanjutnya</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
function showBukti(url) {
    document.getElementById('bukti-modal-img').src = url;
    document.getElementById('bukti-modal').classList.remove('hidden');
}
function closeBukti() {
    document.getElementById('bukti-modal').classList.add('hidden');
}
</script>

<div id="bukti-modal" class="hidden fixed inset-0 bg-black/70 z-[1100] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden animate-fade-in-up">
        <div class="flex items-center justify-between p-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-900">Bukti Transfer</h3>
            <button onclick="closeBukti()" class="p-2 rounded-lg hover:bg-slate-100 transition">
                <span class="material-symbols-rounded text-slate-500">close</span>
            </button>
        </div>
        <div class="p-4 flex justify-center bg-slate-50">
            <img id="bukti-modal-img" src="" alt="Bukti Transfer" class="max-h-[75vh] rounded-xl shadow-md object-contain">
        </div>
    </div>
</div>

<!-- Detail Transaksi Modal -->
<div id="detail-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" onclick="closeDetailModal(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden animate-fade-in-up" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-6 border-b border-slate-100 bg-gradient-to-r from-brand-500 to-brand-600">
            <h3 class="font-bold text-white text-lg">Detail Transaksi</h3>
            <button onclick="closeDetailModal()" class="p-2 rounded-lg hover:bg-white/20 transition">
                <span class="material-symbols-rounded text-white">close</span>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]">
            <div id="detail-modal-loading" class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-600"></div>
            </div>
            <div id="detail-modal-content" class="hidden">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Aksi Transaksi (Konfirmasi / Batalkan) -->
<div id="modal-aksi-transaksi" class="modal-overlay" onclick="if(event.target===this)closeModal('modal-aksi-transaksi')">
    <div class="modal-box modal-sm">
        <div class="modal-body text-center">
            <div id="aksi-transaksi-icon" class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-[40px] text-blue-500">check_circle</span>
            </div>
            <h3 id="aksi-transaksi-judul" class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Transaksi?</h3>
            <p class="text-sm text-gray-500" id="aksi-transaksi-pesan">Yakin ingin mengkonfirmasi transaksi ini?</p>
        </div>
        <div class="modal-footer" style="justify-content: center;">
            <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
            <button type="button" id="aksi-transaksi-oke" class="btn btn-primary" onclick="prosesAksiTransaksi()">
                <span class="material-symbols-rounded text-sm">check</span> Ya, Konfirmasi
            </button>
        </div>
    </div>
</div>

<script>
// Show detail modal with AJAX data
async function showDetailModal(id_pemesanan) {
    const modal = document.getElementById('detail-modal');
    const loading = document.getElementById('detail-modal-loading');
    const content = document.getElementById('detail-modal-content');
    
    // Show modal with loading state
    modal.classList.remove('hidden');
    loading.classList.remove('hidden');
    content.classList.add('hidden');
    document.body.style.overflow = 'hidden';
    
    try {
        const response = await fetch('<?= base_url("admin/get_detail_transaksi_ajax/"); ?>' + id_pemesanan, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        if (!response.ok) {
            throw new Error('Transaksi tidak ditemukan');
        }
        
        const data = await response.json();
        
        // Build modal content
        let html = '';
        
        // Informasi Pelanggan & Paket
        html += '<div class="space-y-6">';
        
        // Customer & Package Info
        html += '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
        html += '<div class="space-y-3">';
        html += '<h4 class="font-semibold text-slate-900 flex items-center gap-2">';
        html += '<span class="material-symbols-rounded text-brand-600">person</span> Informasi Pelanggan</h4>';
        html += '<div class="bg-slate-50 rounded-xl p-4 space-y-2 text-sm">';
        html += '<div><span class="text-slate-600">Nama:</span> <span class="font-semibold text-slate-900">' + data.nama_lengkap + '</span></div>';
        html += '<div><span class="text-slate-600">Email:</span> <span class="text-slate-900">' + data.email + '</span></div>';
        html += '<div><span class="text-slate-600">No. HP:</span> <span class="text-slate-900">' + (data.no_telepon || '-') + '</span></div>';
        html += '</div></div>';
        
        html += '<div class="space-y-3">';
        html += '<h4 class="font-semibold text-slate-900 flex items-center gap-2">';
        html += '<span class="material-symbols-rounded text-brand-600">travel</span> Informasi Paket</h4>';
        html += '<div class="bg-slate-50 rounded-xl p-4 space-y-2 text-sm">';
        html += '<div><span class="text-slate-600">Paket:</span> <span class="font-semibold text-slate-900">' + data.nama_paket + '</span></div>';
        html += '<div><span class="text-slate-600">Harga:</span> <span class="font-semibold text-slate-900">' + data.harga_paket_formatted + '</span></div>';
        html += '<div><span class="text-slate-600">Keberangkatan:</span> <span class="text-slate-900">' + data.tgl_keberangkatan_formatted + ' ' + data.jam_keberangkatan_formatted + '</span></div>';
        html += '</div></div>';
        html += '</div>';
        
        // Detail Peserta & Lokasi
        html += '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
        html += '<div class="bg-blue-50 rounded-xl p-4 space-y-2">';
        html += '<h4 class="font-semibold text-slate-900 flex items-center gap-2 text-sm">';
        html += '<span class="material-symbols-rounded text-brand-600">group</span> Peserta</h4>';
        html += '<div class="text-sm"><span class="text-slate-600">Jumlah:</span> <span class="font-bold text-slate-900 text-lg">' + data.jumlah_peserta + ' orang</span></div>';
        html += '</div>';
        
        html += '<div class="bg-purple-50 rounded-xl p-4 space-y-2">';
        html += '<h4 class="font-semibold text-slate-900 flex items-center gap-2 text-sm">';
        html += '<span class="material-symbols-rounded text-brand-600">location_on</span> Titik Kumpul</h4>';
        html += '<div class="text-sm text-slate-900">' + (data.titik_kumpul || '-') + '</div>';
        html += '</div>';
        html += '</div>';
        
        // Akomodasi
        if (data.akomodasi_list && data.akomodasi_list.length > 0) {
            html += '<div class="bg-amber-50 rounded-xl p-4">';
            html += '<h4 class="font-semibold text-slate-900 flex items-center gap-2 mb-3">';
            html += '<span class="material-symbols-rounded text-brand-600">hotel</span> Akomodasi</h4>';
            html += '<div class="space-y-2">';
            
            data.akomodasi_list.forEach(function(ak) {
                html += '<div class="flex justify-between items-center text-sm bg-white rounded-lg p-3">';
                html += '<div>';
                html += '<div class="font-semibold text-slate-900">' + ak.nama_akomodasi + '</div>';
                html += '<div class="text-xs text-slate-600">' + ak.jumlah_peserta + ' orang × ' + ak.harga_per_orang_formatted + '</div>';
                html += '</div>';
                html += '<div class="font-bold text-slate-900">' + ak.subtotal_formatted + '</div>';
                html += '</div>';
            });
            
            html += '</div></div>';
        }
        
        // Payment Breakdown
        html += '<div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-5 space-y-3">';
        html += '<h4 class="font-semibold text-slate-900 flex items-center gap-2">';
        html += '<span class="material-symbols-rounded text-brand-600">payments</span> Rincian Pembayaran</h4>';
        html += '<div class="space-y-2 text-sm">';
        html += '<div class="flex justify-between">';
        html += '<span class="text-slate-600">Total Tagihan (Paket):</span>';
        html += '<span class="font-semibold text-slate-900">' + data.payment_breakdown.total_tagihan_formatted + '</span>';
        html += '</div>';
        
        if (data.payment_breakdown.total_akomodasi > 0) {
            html += '<div class="flex justify-between">';
            html += '<span class="text-slate-600">Total Akomodasi:</span>';
            html += '<span class="font-semibold text-slate-900">' + data.payment_breakdown.total_akomodasi_formatted + '</span>';
            html += '</div>';
        }
        
        html += '<div class="flex justify-between pt-2 border-t border-slate-200">';
        html += '<span class="font-semibold text-slate-900">Total Harga Sebenarnya:</span>';
        html += '<span class="font-bold text-slate-900">' + data.payment_breakdown.total_harga_sebenarnya_formatted + '</span>';
        html += '</div>';
        
        // Kondisional: Label berbeda berdasarkan tipe_pembayaran
        if (data.tipe_pembayaran === 'dp') {
            // Untuk pembayaran DP
            html += '<div class="flex justify-between">';
            html += '<span class="text-slate-600">DP yang Sudah Dibayar:</span>';
            html += '<span class="font-semibold text-emerald-700">' + data.payment_breakdown.total_dp_dibayar_formatted + '</span>';
            html += '</div>';
            
            if (data.payment_breakdown.sisa_lunasi > 0) {
                html += '<div class="flex justify-between bg-amber-100 rounded-lg p-2">';
                html += '<span class="font-semibold text-amber-900">Sisa yang Harus Dilunasi:</span>';
                html += '<span class="font-bold text-amber-900">' + data.payment_breakdown.sisa_lunasi_formatted + '</span>';
                html += '</div>';
            }
        } else {
            // Untuk pembayaran Lunas (full)
            html += '<div class="flex justify-between items-center">';
            html += '<span class="text-slate-600">Total yang Sudah Dibayar:</span>';
            html += '<div class="flex items-center gap-2">';
            html += '<span class="font-semibold text-emerald-700">' + data.payment_breakdown.total_dp_dibayar_formatted + '</span>';
            html += '<span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold">';
            html += '<span class="material-symbols-rounded text-sm">check_circle</span> Lunas</span>';
            html += '</div>';
            html += '</div>';
        }
        
        html += '</div></div>';
        
        // Bukti Transfer
        if (data.bukti_transfer) {
            html += '<div class="bg-slate-50 rounded-xl p-4">';
            html += '<h4 class="font-semibold text-slate-900 flex items-center gap-2 mb-3">';
            html += '<span class="material-symbols-rounded text-brand-600">receipt</span> Bukti Transfer</h4>';
            html += '<img src="<?= base_url('application/assets/images/bukti/'); ?>' + data.bukti_transfer + '" ';
            html += 'alt="Bukti Transfer" class="rounded-lg shadow-md max-h-64 object-contain cursor-pointer" ';
            html += 'onclick="showBukti(\'' + '<?= base_url('application/assets/images/bukti/'); ?>' + data.bukti_transfer + '\')">';
            html += '</div>';
        }
        
        html += '</div>';
        
        // Hide loading, show content
        loading.classList.add('hidden');
        content.classList.remove('hidden');
        content.innerHTML = html;
        
    } catch (error) {
        loading.classList.add('hidden');
        content.classList.remove('hidden');
        content.innerHTML = '<div class="text-center py-8 text-red-600">Gagal memuat data: ' + error.message + '</div>';
    }
}

// Close detail modal
function closeDetailModal(event) {
    if (event && event.target !== event.currentTarget) return;
    
    const modal = document.getElementById('detail-modal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const detailModal = document.getElementById('detail-modal');
        const buktiModal = document.getElementById('bukti-modal');
        
        if (!detailModal.classList.contains('hidden')) {
            closeDetailModal();
        }
        if (!buktiModal.classList.contains('hidden')) {
            closeBukti();
        }
    }
});

// Konfirmasi aksi transaksi (Konfirmasi / Batalkan) via modal custom
var pendingAksiTransaksi = null;

function konfirmasiTransaksi(idPemesanan) {
    pendingAksiTransaksi = {
        url: '<?= base_url('admin/transaksi/konfirmasi/'); ?>' + idPemesanan,
        judul: 'Konfirmasi Transaksi?',
        pesan: 'Yakin ingin mengkonfirmasi transaksi ini? Status akan diubah menjadi "Dikonfirmasi".',
        labelTombol: 'Ya, Konfirmasi',
        warna: 'primary',
        icon: 'check_circle'
    };
    tampilkanModalAksiTransaksi();
}

function batalkanTransaksi(idPemesanan) {
    pendingAksiTransaksi = {
        url: '<?= base_url('admin/transaksi/batalkan/'); ?>' + idPemesanan,
        judul: 'Batalkan Transaksi?',
        pesan: 'Yakin ingin membatalkan transaksi ini? Status akan diubah menjadi "Dibatalkan".',
        labelTombol: 'Ya, Batalkan',
        warna: 'danger',
        icon: 'close'
    };
    tampilkanModalAksiTransaksi();
}

function tampilkanModalAksiTransaksi() {
    if (!pendingAksiTransaksi) return;

    var judulEl = document.getElementById('aksi-transaksi-judul');
    var pesanEl = document.getElementById('aksi-transaksi-pesan');
    var iconEl = document.getElementById('aksi-transaksi-icon');
    var okeEl = document.getElementById('aksi-transaksi-oke');

    if (judulEl) judulEl.textContent = pendingAksiTransaksi.judul;
    if (pesanEl) pesanEl.textContent = pendingAksiTransaksi.pesan;

    if (iconEl) {
        var isDanger = pendingAksiTransaksi.warna === 'danger';
        iconEl.className = 'w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 ' + (isDanger ? 'bg-red-50' : 'bg-blue-50');
        var span = iconEl.querySelector('.material-symbols-rounded');
        if (span) {
            span.className = 'material-symbols-rounded text-[40px] ' + (isDanger ? 'text-red-500' : 'text-blue-500');
            span.textContent = pendingAksiTransaksi.icon;
        }
    }

    if (okeEl) {
        okeEl.className = 'btn ' + (pendingAksiTransaksi.warna === 'danger' ? 'btn-danger' : 'btn-primary');
        okeEl.innerHTML = '<span class="material-symbols-rounded text-sm">' + (pendingAksiTransaksi.warna === 'danger' ? 'close' : 'check') + '</span> ' + pendingAksiTransaksi.labelTombol;
    }

    openModal('modal-aksi-transaksi');
}

function prosesAksiTransaksi() {
    if (pendingAksiTransaksi && pendingAksiTransaksi.url) {
        window.location.href = pendingAksiTransaksi.url;
    }
}
</script>

