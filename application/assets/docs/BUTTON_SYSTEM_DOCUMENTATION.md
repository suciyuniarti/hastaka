# BUTTON DESIGN SYSTEM - DOKUMENTASI

## 📦 File Structure
```
application/assets/
├── css/
│   ├── button-system.css          # Vanilla CSS approach
│   └── button-system-tailwind.css # Tailwind @layer approach
└── js/
    └── button-icons.js            # Icon automation
```

---

## 🎨 PENDEKATAN 1: TAILWIND CSS (@layer components)

### Cara Penggunaan:

#### 1. Include CSS file di header
```php
<!-- application/views/templates/header.php -->
<link rel="stylesheet" href="<?= base_url('application/assets/css/button-system-tailwind.css'); ?>">
```

#### 2. Gunakan class-class berikut:

**A. BUTTON UKURAN MEDIUM (Page Header)**
```html
<!-- Simpan/Konfirmasi -->
<a href="#" class="btn btn-md btn-flat-success">
  Simpan Nilai
</a>

<!-- Batal/Tolak -->
<a href="#" class="btn btn-md btn-flat-danger">
  Batal
</a>

<!-- Hapus -->
<a href="#" class="btn btn-md btn-flat-warning">
  Hapus Data
</a>

<!-- Edit -->
<a href="#" class="btn btn-md btn-flat-light">
  Edit Data
</a>

<!-- Detail -->
<a href="#" class="btn btn-md btn-flat-muted">
  Lihat Detail
</a>

<!-- Primary Action (Solid) -->
<button class="btn btn-md btn-solid-primary">
  Konfirmasi
</button>
```

**B. BUTTON UKURAN SMALL (Kolom Aksi Tabel)**
```html
<!-- Edit (Light) -->
<a href="<?= base_url('admin/paket/edit/' . $p->id_paket); ?>" 
   class="btn btn-sm btn-flat-light" title="Edit">
  Edit
</a>

<!-- Hapus (Warning) -->
<a href="<?= base_url('admin/paket/hapus/' . $p->id_paket); ?>" 
   class="btn btn-sm btn-flat-warning" title="Hapus" 
   onclick="return confirm('Yakin hapus?')">
  Hapus
</a>

<!-- Konfirmasi (Success) -->
<a href="<?= base_url('admin/transaksi/konfirmasi/' . $t->id_pemesanan); ?>" 
   class="btn btn-sm btn-flat-success" title="Konfirmasi"
   onclick="return confirm('Konfirmasi?')">
  Konfirmasi
</a>

<!-- Batalkan (Danger) -->
<a href="<?= base_url('admin/transaksi/batalkan/' . $t->id_pemesanan); ?>" 
   class="btn btn-sm btn-flat-danger" title="Batalkan"
   onclick="return confirm('Batalkan?')">
  Batal
</a>
```

**C. BUTTON UKURAN LARGE (CTA Publik)**
```html
<a href="<?= base_url('booking'); ?>" 
   class="btn btn-lg btn-solid-primary">
  Pesan Sekarang
</a>

<a href="<?= base_url('paket'); ?>" 
   class="btn btn-lg btn-outlined-success">
  Lihat Paket
</a>
```

**D. BUTTON OUTLINED (Alternatif)**
```html
<!-- Success Outlined -->
<a href="#" class="btn btn-md btn-outlined-success">
  Konfirmasi
</a>

<!-- Danger Outlined -->
<a href="#" class="btn btn-md btn-outlined-danger">
  Tolak
</a>
```

---

## 🎨 PENDEKATAN 2: VANILLA CSS (CSS Murni)

### Cara Penggunaan:

#### 1. Include CSS file di header
```php
<!-- application/views/templates/header.php -->
<link rel="stylesheet" href="<?= base_url('application/assets/css/button-system.css'); ?>">
```

#### 2. Gunakan class-class berikut:

**A. BUTTON UKURAN MEDIUM**
```html
<a href="#" class="btn btn-md btn-flat-success">Simpan Nilai</a>
<a href="#" class="btn btn-md btn-flat-danger">Batal</a>
<a href="#" class="btn btn-md btn-flat-warning">Hapus Data</a>
<a href="#" class="btn btn-md btn-flat-light">Edit Data</a>
<a href="#" class="btn btn-md btn-flat-muted">Lihat Detail</a>
<button class="btn btn-md btn-solid-primary">Konfirmasi</button>
```

**B. BUTTON UKURAN SMALL**
```html
<a href="edit/1" class="btn btn-sm btn-flat-light">Edit</a>
<a href="hapus/1" class="btn btn-sm btn-flat-warning" onclick="return confirm('Yakin?')">Hapus</a>
<a href="konfirmasi/1" class="btn btn-sm btn-flat-success">Konfirmasi</a>
<a href="batalkan/1" class="btn btn-sm btn-flat-danger">Batal</a>
```

**C. BUTTON UKURAN LARGE**
```html
<a href="booking" class="btn btn-lg btn-solid-primary">Pesan Sekarang</a>
<a href="paket" class="btn btn-lg btn-outlined-success">Lihat Paket</a>
```

**D. BUTTON OUTLINED**
```html
<a href="#" class="btn btn-md btn-outlined-success">Konfirmasi</a>
<a href="#" class="btn btn-md btn-outlined-danger">Tolak</a>
```

---

## 🤖 JAVASCRIPT ICON AUTOMATION

### Cara Penggunaan:

#### 1. Include JS file sebelum tag </body>
```php
<!-- application/views/templates/footer_admin.php -->
<script src="<?= base_url('application/assets/js/button-icons.js'); ?>"></script>
</body>
</html>
```

#### 2. Tambahkan data attribute untuk icon (opsional, jika tidak ingin pakai JS)
```html
<!-- Tanpa JS: tambahkan icon secara manual -->
<a href="#" class="btn btn-md btn-flat-success" data-icon="save">
  Simpan
</a>

<!-- Dengan JS: cukup text, icon akan otomatis muncul -->
<a href="#" class="btn btn-md btn-flat-success">
  Simpan Nilai
</a>
```

#### 3. Keyword yang dikenali:
- **Simpan/Save** → Icon save
- **Tambah/Add** → Icon plus
- **Edit/Ubah** → Icon edit
- **Hapus/Delete** → Icon trash
- **Batal/Cancel/Tolak** → Icon X
- **Konfirmasi/Confirm** → Icon check
- **Detail/Lihat/View** → Icon eye
- **Cari/Search** → Icon search
- **Filter** → Icon filter
- **Cetak/Print** → Icon printer
- **Download/Export** → Icon download
- **Kembali/Back** → Icon arrow-left
- **Nilai/Calculate** → Icon calculator
- **Aktifkan** → Icon user-plus
- **Nonaktifkan** → Icon user-minus

---

## 📝 CONTOH IMPLEMENTASI DI HALAMAN ADMIN

### Contoh 1: Page Header (Tambah Data)
```php
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
  <div>
    <p class="text-xs text-sky-500 font-bold uppercase tracking-widest">ADMIN</p>
    <h1 class="text-2xl font-extrabold text-slate-900">Kelola Paket Wisata</h1>
    <p class="text-slate-500 text-sm"><?= $total_paket; ?> paket terdaftar</p>
  </div>
  <a href="<?= base_url('admin/paket/tambah'); ?>" 
     class="btn btn-md btn-flat-success">
    Tambah Paket
  </a>
</div>
```

### Contoh 2: Kolom Aksi Tabel
```php
<td class="px-6 py-4 text-center">
  <div class="flex items-center justify-center gap-2">
    <a href="<?= base_url('admin/nilai/' . $p->id_paket); ?>" 
       class="btn btn-sm btn-flat-warning" 
       title="Nilai">
      Nilai
    </a>
    <a href="<?= base_url('admin/paket/edit/' . $p->id_paket); ?>" 
       class="btn btn-sm btn-flat-light" 
       title="Edit">
      Edit
    </a>
    <a href="<?= base_url('admin/paket/hapus/' . $p->id_paket); ?>" 
       class="btn btn-sm btn-flat-danger" 
       title="Hapus"
       onclick="return confirm('Yakin hapus?')">
      Hapus
    </a>
  </div>
</td>
```

### Contoh 3: Form Submit
```php
<div class="flex gap-3 pt-6 border-t border-slate-100">
  <button type="submit" class="btn btn-md btn-flat-success">
    Simpan Nilai
  </button>
  <a href="<?= base_url('admin/paket'); ?>" 
     class="btn btn-md btn-flat-danger">
    Batal
  </a>
</div>
```

### Contoh 4: Transaksi Actions
```php
<td class="px-6 py-4">
  <div class="flex items-center justify-center gap-1.5">
    <?php if ($t->status_pemesanan == 'pending'): ?>
    <a href="<?= base_url('admin/transaksi/konfirmasi/' . $t->id_pemesanan); ?>" 
       class="btn btn-sm btn-flat-success" 
       title="Konfirmasi"
       onclick="return confirm('Konfirmasi?')">
      Konfirmasi
    </a>
    <a href="<?= base_url('admin/transaksi/batalkan/' . $t->id_pemesanan); ?>" 
       class="btn btn-sm btn-flat-danger" 
       title="Batalkan"
       onclick="return confirm('Batalkan?')">
      Batal
    </a>
    <?php elseif ($t->status_pemesanan == 'dikonfirmasi'): ?>
    <span class="btn btn-sm btn-flat-success" style="cursor: default;">
      Dikonfirmasi
    </span>
    <?php else: ?>
    <span class="btn btn-sm btn-flat-muted" style="cursor: default;">
      <?= ucfirst($t->status_pemesanan); ?>
    </span>
    <?php endif; ?>
  </div>
</td>
```

---

## 🎯 VARIAN WARNA

### Flat Variants (Recommended untuk Table Actions)
| Class | Warna | Penggunaan |
|-------|-------|------------|
| `.btn-flat-success` | Emerald-600 | Simpan, Konfirmasi, Aktifkan |
| `.btn-flat-danger` | Red-500 | Batal, Tolak, Hapus |
| `.btn-flat-warning` | Amber-500 | Hapus, Peringatan |
| `.btn-flat-light` | Sky-500 | Edit, Ubah |
| `.btn-flat-muted` | Slate-600 | Detail, Lihat |

### Outlined Variants (Untuk Secondary Actions)
| Class | Warna | Penggunaan |
|-------|-------|------------|
| `.btn-outlined-success` | Emerald | Konfirmasi |
| `.btn-outlined-danger` | Red | Tolak |

### Solid Variants (Untuk Primary CTA)
| Class | Warna | Penggunaan |
|-------|-------|------------|
| `.btn-solid-primary` | Blue-800 | Submit, Primary Action |

---

## 🔧 KONFIGURASI

### Option 1: Pakai Tailwind (@layer)
```css
/* button-system-tailwind.css */
@layer components {
  /* Paste semua class yang sudah dibuat */
}
```

### Option 2: Pakai Vanilla CSS
```css
/* button-system.css */
/* Paste semua class yang sudah dibuat */
```

### Option 3: Mix keduanya
```php
<!-- Include both -->
<link rel="stylesheet" href="button-system.css">
<link rel="stylesheet" href="button-system-tailwind.css">
```

---

## ⚡ QUICK START

### Minimal Implementation:
```php
<!-- 1. Include CSS di header -->
<head>
  <link rel="stylesheet" href="<?= base_url('application/assets/css/button-system-tailwind.css'); ?>">
</head>

<!-- 2. Include JS di footer -->
<body>
  <!-- Konten -->
  <script src="<?= base_url('application/assets/js/button-icons.js'); ?>"></script>
</body>

<!-- 3. Gunakan class btn di HTML -->
<a href="#" class="btn btn-md btn-flat-success">Simpan</a>
<a href="#" class="btn btn-sm btn-flat-light">Edit</a>
<a href="#" class="btn btn-sm btn-flat-danger">Hapus</a>
```

---

## 📦 KEUNTUNGAN

✅ **Konsisten**: Semua button memiliki style yang seragam
✅ **Modular**: Bisa pakai Tailwind atau Vanilla CSS
✅ **Otomatis**: JavaScript inject icon berdasarkan teks
✅ **Fleksibel**: Mudah di-customize via CSS variables
✅ **Responsif**: Sudah include hover, active, transition
✅ **Aksesibel**: Support title attribute untuk tooltip

---

## 🚀 BEST PRACTICES

1. **Gunakan btn-flat-* untuk table actions** (karena tidak terlalu dominan)
2. **Gunakan btn-solid-primary untuk CTA utama** (submit form, konfirmasi penting)
3. **Gunakan btn-outlined-* untuk secondary actions** (cancel, back)
4. **Jangan mix variant dalam satu action group** (misal: Edit + Hapus pakai flat-light + flat-danger)
5. **Gunakan size yang sesuai**:
   - `btn-md`: Page header buttons
   - `btn-sm`: Table action buttons
   - `btn-lg`: Landing page CTA

---

## 📌 CATATAN PENTING

- Icon automation hanya bekerja jika button memiliki **text content**
- Jika ingin custom icon, tambahkan `<svg>` manual di dalam button
- Untuk disabled state, tambahkan class `opacity-50 pointer-events-none`
- Untuk loading state, tambahkan class `pointer-events-none` dan ganti text dengan spinner

---

## 🔗 INTEGRASI DENGAN MATERIAL SYMBOLS

Jika masih ingin pakai Material Symbols (untuk icon yang tidak ada di JS automation):

```html
<a href="#" class="btn btn-md btn-flat-light">
  <span class="material-symbols-rounded text-lg">edit</span>
  Edit
</a>
```

JS automation akan **skip** button yang sudah memiliki SVG/Material Symbols icon.

---

## 📞 SUPPORT

Untuk pertanyaan atau customization lebih lanjut, silakan hubungi tim development.