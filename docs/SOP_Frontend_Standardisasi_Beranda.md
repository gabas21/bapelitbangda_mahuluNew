# SOP Standardisasi Frontend: Halaman Beranda (Homepage)

Dokumen ini berisi panduan lengkap untuk merekonstruksi atau mengembangkan ulang halaman beranda (Homepage) agar sesuai dengan standar desain Inspektorat Mahakam Ulu.

## 1. Persiapan Aset (Asset Checklist)

Sebelum memulai pengembangan, pastikan seluruh aset berikut telah tersedia di direktori `public/images/`.

### Gambar Utama (Background & Banner)
| Filename | Deskripsi | Ukuran Referensi |
|---|---|---|
| `background.jpg` | Background utama Hero Section (gelap/abstrak) | 1920x1080px |
| `slider1.jpg` | Banner Slider 1 (HUT Mahakam Ulu) | Ratio 21:9 |
| `slider2.png` | Banner Slider 2 (Welcome) | Ratio 21:9 |
| `slider3.png` | Banner Slider 3 (Info APBD) | Ratio 21:9 |
| `say_no_to_gratifikasi.png` | Banner Slider 4 (Kampanye Anti Korupsi) | Ratio 21:9 |

### Gambar Profil & Logo
| Filename | Deskripsi |
|---|---|
| `kepala inspektorat.png` | Foto Kepala Inspektorat (Transparent/Cutout) |
| `logokomdigi.png` | Logo GPR Komdigi Indonesia |

### Logo Aplikasi Eksternal (External Links)
Pastikan logo berikut tersedia untuk bagian "Aplikasi & Layanan Terkait":
- `logo_sipd_kemendagri.png`
- `logo_lapor_go_id.png`
- `logo_srikandi.png`
- `logo_e_catalogue.png`
- `logo_lpse.png`
- `logo_sirup.png`

## 2. Library & Ekosistem Frontend

Halaman ini menggunakan stack berikut:
- **CSS Framework**: Tailwind CSS
- **Icons**: Heroicons (SVG Inline)
- **Fonts**:
    - `Montserrat` (Judul/Headings)
    - `Inter` (Body Text)
- **JS Libraries**:
    - [Swiper.js](https://swiperjs.com/) (untuk Carousel/Slider)
    - [Reveal.js](https://revealjs.com/) (untuk Animasi Scroll - *Custom Implementation*)
    - [UserWay](https://userway.org/) (Widget Aksesibilitas)

## 3. Struktur Halaman (Component Breakdown)

Halaman `landing.blade.php` terdiri dari **7 Bagian Utama**:

### A. Hero Section
- **Background**: `bg-slate-900` dengan overlay `background.jpg` (opacity 60%).
- **Konten**:
    - Judul Besar: "Membangun Mahakam Ulu..." dengan gradient text (`text-transparent bg-clip-text bg-gradient-to-r from-white via-emerald-400 to-white`).
    - **Swiper Banner**: Carousel gambar dengan efek `pagination`.
    - **Lightbox**: Modal popup saat gambar banner diklik.

### B. Welcome Section ("Selamat Datang")
- **Layout**: 2 Kolom (Teks Kiri, Foto Kanan).
- **Elemen Kiri**:
    - Judul dengan font `Montserrat`.
    - Paragraf sambutan.
    - 2 Kartu nilai inti: "Berintegritas" & "Akuntabel" (Icon SVG).
- **Elemen Kanan**:
    - Kartu foto Kepala Inspektorat dengan efek *glassmorphism* dan dekorasi blob background.

### C. Services Grid
- **Background**: `bg-emerald-50/20`.
- **Komponen**: Grid 3 kolom menggunakan komponen Blade `<x-service-card>`.
- **Items**:
    1. Laporan Pengaduan
    2. Cek Pengaduan
    3. Survey Kepuasan Masyarakat

### D. Timeline Alur Pengaduan
- **Desain**: Step-by-step horizontal timeline (4 Langkah).
- **Langkah**:
    1. Buat Laporan
    2. Verifikasi
    3. Tindak Lanjut
    4. Selesai
- **CTA**: Tombol besar "Mulai Buat Laporan" menuju `route('layanan.pengaduan')`.

### E. Berita & Informasi (News Section)
- **Layout**: Grid 12 kolom L-Shape.
    - **Kiri (5 Kolom)**: Carousel "Sorotan Utama" (menggunakan komponen `<x-news-card>`).
    - **Tengah (4 Kolom)**: List Tab "Terbaru" & "Terpopuler" (menggunakan komponen `<x-news-sidebar-item>`).
    - **Kanan (3 Kolom)**: Widget GPR Kominfo/Komdigi.

### F. External Links & Agenda
- **Background**: `bg-teal-950` (Dark Theme).
- **Kiri (9 Kolom)**: Swiper Slider untuk Link Aplikasi Eksternal (`<x-external-link-card>`).
- **Kanan (3 Kolom)**: Widget Kalender Agenda Interaktif.

### G. Footer & Scripts
- Menggunakan `@include('components.footer')`.
- Script inisialisasi Swiper dan kalender custom.

## 4. Data Contracts (Controller Requirements)

Controller `LandingController` **WAJIB** mengirimkan data berikut ke view `landing.blade.php`:

### `$newsItems` (Array of Arrays)
Digunakan untuk Carousel Utama dan List Terbaru.
Format Array:
```php
[
    'image'    => 'url_gambar', // String (URL)
    'category' => 'nama_kategori', // String (e.g., 'berita utama')
    'title'    => 'Judul Berita', // String
    'date'     => 'DD Bulan YYYY', // String
    'views'    => 1234 // Integer
]
```

### `$popularNewsItems` (Array of Arrays)
Digunakan untuk Tab "Terpopuler" di sidebar berita.
Format Array:
```php
[
    'category' => 'nama_kategori',
    'title'    => 'Judul Berita',
    'date'     => 'DD Bulan YYYY',
    'views'    => 1234
]
```
*Catatan: Item ini tidak memerlukan gambar (image).*

### `$allLinks` (Array of Arrays)
Digunakan untuk Slider Aplikasi Eksternal.
Format Array:
```php
[
    'name' => 'Nama Aplikasi', // e.g., 'SIPD'
    'desc' => 'Deskripsi Singkat',
    'logo' => asset('images/nama_file_logo.png'),
    'link' => 'https://url-tujuan.go.id'
]
```

## 5. Instruksi Pembaruan
Jika ingin mengubah tampilan beranda:
1. **Modifikasi Layout**: Edit file `resources/views/landing.blade.php`.
2. **Tambah/Ubah Data Dummy**: Edit `app/Http/Controllers/LandingController.php` (hapus dummy data saat integrasi DB).
3. **Komponen Reusable**: Cek folder `resources/views/components/` untuk mengedit `<x-service-card>`, `<x-news-card>`, dll.
