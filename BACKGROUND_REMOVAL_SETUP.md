# Background Removal Setup Guide

## Overview
Sistem ini menggunakan Remove.bg API untuk otomatis menghapus background dari semua foto sepatu yang diupload.

## Setup

### 1. Dapatkan API Key Remove.bg
1. Kunjungi [remove.bg](https://www.remove.bg/api)
2. Daftar akun gratis (50 foto/bulan)
3. Dapatkan API key

### 2. Konfigurasi Environment
Tambahkan ke file `.env`:
```env
REMOVEBG_API_KEY=your_api_key_here
```

### 3. Fitur yang Tersedia

#### A. Otomatis saat Upload
- Background akan otomatis dihapus saat upload foto baru
- Format output: PNG dengan transparent background
- File disimpan dengan prefix `bg-removed-`

#### B. Command Line untuk Batch Processing
```bash
# Proses semua gambar yang sudah ada
php artisan images:remove-background --all

# Proses gambar untuk sepatu tertentu
php artisan images:remove-background --shoe=1
```

#### C. Manual Processing
```php
use App\Services\BackgroundRemovalService;

$service = new BackgroundRemovalService();
$newPath = $service->removeBackgroundFromPath('path/to/image.jpg');
```

## Cara Kerja

1. **Upload Foto** → Observer mendeteksi → Auto remove background
2. **Batch Processing** → Command line untuk proses semua foto
3. **Manual** → Service class untuk proses satu per satu

## File yang Dibuat

- `app/Services/BackgroundRemovalService.php` - Service utama
- `app/Observers/ShoeObserver.php` - Observer untuk thumbnail
- `app/Observers/ShoePhotoObserver.php` - Observer untuk photos
- `app/Console/Commands/RemoveBackgroundCommand.php` - CLI command

## Catatan

- API key gratis: 50 foto/bulan
- Format output: PNG dengan transparent background
- Error handling: Log error jika API gagal
- Fallback: Jika API gagal, foto original tetap disimpan

## Troubleshooting

1. **API Key Error**: Pastikan `REMOVEBG_API_KEY` sudah diset di `.env`
2. **Quota Exceeded**: Upgrade ke plan berbayar atau tunggu reset bulanan
3. **Image Not Found**: Pastikan path file benar dan file ada
4. **Network Error**: Cek koneksi internet dan API endpoint 