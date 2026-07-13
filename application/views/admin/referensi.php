<?php if ($this->session->flashdata('success')): ?>
<?php endif; ?>

<div class="page-header">
    <div class="page-header-icon">
        <span class="material-symbols-rounded">partner_exchange</span>
    </div>
    <div class="page-header-content">
        <h1>Kelola Referensi Partner</h1>
        <p>Kelola daftar PO Bus dan Hotel yang ditampilkan di halaman depan</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <!-- Bus Partners -->
    <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 border-2 border-slate-200/80 overflow-hidden">
        <div class="bg-gradient-to-br from-brand-50 to-sky-50 border-b-2 border-brand-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                    <span class="material-symbols-rounded text-brand-600 text-xl">directions_bus</span>
                </div>
                <div>
                    <h3 class="font-bold text-brand-900">PO Bus Langganan</h3>
                    <p class="text-xs text-brand-600"><?= $total_bus ?? count($bus_list ?? []); ?> mitra bus</p>
                </div>
            </div>
            <button onclick="showTambahBusModal()" class="btn btn-primary btn-sm">
                <span class="material-symbols-rounded text-sm">add</span> Tambah
            </button>
        </div>
        <div class="p-6">
            <?php if (!empty($bus_list)): ?>
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    <?php foreach ($bus_list as $bus): ?>
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100 hover:border-brand-200 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center border border-slate-200">
                                <span class="material-symbols-rounded text-brand-600">directions_bus</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800"><?= $bus->nama; ?></p>
                                <?php if ($bus->kota): ?>
                                <p class="text-xs text-gray-500"><?= $bus->kota; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="editBus(<?= $bus->id; ?>)" class="btn btn-primary btn-icon-sm" title="Edit">
                                <span class="material-symbols-rounded text-sm">edit</span>
                            </button>
                            <button onclick="deleteBus(<?= $bus->id; ?>)" class="btn btn-danger btn-icon-sm" title="Hapus">
                                <span class="material-symbols-rounded text-sm">delete</span>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-slate-300 text-5xl mb-2">directions_bus</span>
                    <p class="text-slate-500 text-sm">Belum ada mitra bus</p>
                    <button onclick="showTambahBusModal()" class="btn btn-primary btn-sm mt-3">
                        <span class="material-symbols-rounded text-sm">add</span> Tambah Bus Pertama
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Hotel Partners -->
    <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/50 border-2 border-slate-200/80 overflow-hidden">
        <div class="bg-gradient-to-br from-sky-50 to-cyan-50 border-b-2 border-sky-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                    <span class="material-symbols-rounded text-sky-600 text-xl">hotel</span>
                </div>
                <div>
                    <h3 class="font-bold text-sky-900">Rekomendasi Hotel</h3>
                    <p class="text-xs text-sky-600"><?= $total_hotel ?? count($hotel_list ?? []); ?> tipe hotel</p>
                </div>
            </div>
            <button onclick="showTambahHotelModal()" class="btn btn-primary btn-sm">
                <span class="material-symbols-rounded text-sm">add</span> Tambah
            </button>
        </div>
        <div class="p-6">
            <?php if (!empty($hotel_list)): ?>
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    <?php foreach ($hotel_list as $hotel): ?>
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-100 hover:border-sky-200 transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center border border-slate-200">
                                <span class="material-symbols-rounded text-sky-600"><?= $hotel->icon ?? 'hotel'; ?></span>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-semibold text-gray-800"><?= $hotel->nama; ?></p>
                                    <?php if ($hotel->bintang): ?>
                                    <div class="flex items-center gap-0.5">
                                        <?php for ($i = 0; $i < $hotel->bintang; $i++): ?>
                                        <span class="material-symbols-rounded text-amber-400 text-[14px]">star</span>
                                        <?php endfor; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($hotel->deskripsi): ?>
                                <p class="text-xs text-gray-500 mt-0.5"><?= character_limiter($hotel->deskripsi, 50); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="editHotel(<?= $hotel->id; ?>)" class="btn btn-primary btn-icon-sm" title="Edit">
                                <span class="material-symbols-rounded text-sm">edit</span>
                            </button>
                            <button onclick="deleteHotel(<?= $hotel->id; ?>)" class="btn btn-danger btn-icon-sm" title="Hapus">
                                <span class="material-symbols-rounded text-sm">delete</span>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-slate-300 text-5xl mb-2">hotel</span>
                    <p class="text-slate-500 text-sm">Belum ada rekomendasi hotel</p>
                    <button onclick="showTambahHotelModal()" class="btn btn-primary btn-sm mt-3">
                        <span class="material-symbols-rounded text-sm">add</span> Tambah Hotel Pertama
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Bus -->
<div id="busModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900" id="busModalTitle">Tambah PO Bus</h3>
                <button onclick="closeBusModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <?= form_open_multipart('admin/referensi/simpan_bus', ['id' => 'busForm']); ?>
                <input type="hidden" name="id" id="busId">
                <div class="form-group">
                    <label class="form-label">Nama PO Bus <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="busNama" class="form-input" required placeholder="Contoh: Jackal Holiday">
                </div>
                <div class="form-group">
                    <label class="form-label">Kota Keberangkatan</label>
                    <input type="text" name="kota" id="busKota" class="form-input" placeholder="Contoh: Surabaya">
                </div>
                <div class="form-group">
                    <label class="form-label">Gambar (Logo/Photo)</label>
                    <input type="file" name="gambar" id="busGambar" class="form-input file-input" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, maksimal 2MB</p>
                    <div id="busGambarPreview" class="mt-2 hidden">
                        <img src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-slate-200">
                    </div>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="btn btn-primary flex-1">
                        <span class="material-symbols-rounded text-sm">save</span> Simpan
                    </button>
                    <button type="button" onclick="closeBusModal()" class="btn btn-secondary">Batal</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Hotel -->
<div id="hotelModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900" id="hotelModalTitle">Tambah Hotel</h3>
                <button onclick="closeHotelModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <?= form_open_multipart('admin/referensi/simpan_hotel', ['id' => 'hotelForm']); ?>
                <input type="hidden" name="id" id="hotelId">
                <div class="form-group">
                    <label class="form-label">Nama Hotel <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="hotelNama" class="form-input" required placeholder="Contoh: Hotel Bintang 3">
                </div>
                <div class="form-group">
                    <label class="form-label">Bintang</label>
                    <select name="bintang" id="hotelBintang" class="form-input">
                        <option value="">- Pilih -</option>
                        <option value="1">1 Bintang</option>
                        <option value="2">2 Bintang</option>
                        <option value="3">3 Bintang</option>
                        <option value="4">4 Bintang</option>
                        <option value="5">5 Bintang</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Icon (Material Symbols)</label>
                    <input type="text" name="icon" id="hotelIcon" class="form-input" placeholder="hotel, cottage, apartment" value="hotel">
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="hotelDeskripsi" rows="2" class="form-input" placeholder="Deskripsi singkat..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Gambar (Foto Hotel)</label>
                    <input type="file" name="gambar" id="hotelGambar" class="form-input file-input" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, maksimal 2MB</p>
                    <div id="hotelGambarPreview" class="mt-2 hidden">
                        <img src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-slate-200">
                    </div>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="btn btn-primary flex-1">
                        <span class="material-symbols-rounded text-sm">save</span> Simpan
                    </button>
                    <button type="button" onclick="closeHotelModal()" class="btn btn-secondary">Batal</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
// Bus Modal Functions
function showTambahBusModal() {
    document.getElementById('busForm').reset();
    document.getElementById('busId').value = '';
    document.getElementById('busModalTitle').textContent = 'Tambah PO Bus';
    document.getElementById('busModal').classList.remove('hidden');
}

function editBus(id) {
    fetch('<?= base_url('admin/referensi/get_bus/'); ?>' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('busId').value = data.id;
            document.getElementById('busNama').value = data.nama;
            document.getElementById('busKota').value = data.kota || '';
            document.getElementById('busModalTitle').textContent = 'Edit PO Bus';
            document.getElementById('busModal').classList.remove('hidden');
        });
}

function closeBusModal() {
    document.getElementById('busModal').classList.add('hidden');
}

function deleteBus(id) {
    if (confirm('Hapus PO Bus ini?')) {
        window.location.href = '<?= base_url('admin/referensi/hapus_bus/'); ?>' + id;
    }
}

// Hotel Modal Functions
function showTambahHotelModal() {
    document.getElementById('hotelForm').reset();
    document.getElementById('hotelId').value = '';
    document.getElementById('hotelModalTitle').textContent = 'Tambah Hotel';
    document.getElementById('hotelModal').classList.remove('hidden');
}

function editHotel(id) {
    fetch('<?= base_url('admin/referensi/get_hotel/'); ?>' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('hotelId').value = data.id;
            document.getElementById('hotelNama').value = data.nama;
            document.getElementById('hotelBintang').value = data.bintang || '';
            document.getElementById('hotelIcon').value = data.icon || 'hotel';
            document.getElementById('hotelDeskripsi').value = data.deskripsi || '';
            document.getElementById('hotelModalTitle').textContent = 'Edit Hotel';
            document.getElementById('hotelModal').classList.remove('hidden');
        });
}

function closeHotelModal() {
    document.getElementById('hotelModal').classList.add('hidden');
}

function deleteHotel(id) {
    if (confirm('Hapus rekomendasi hotel ini?')) {
        window.location.href = '<?= base_url('admin/referensi/hapus_hotel/'); ?>' + id;
    }
}

// Close modal on outside click
document.querySelectorAll('#busModal, #hotelModal').forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
</script>