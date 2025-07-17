# Location API Setup

Fitur lokasi menggunakan API Raja Ongkir untuk mendapatkan data provinsi, kota, dan kode pos di Indonesia.

## Setup

### 1. Daftar API Key Raja Ongkir

1. Kunjungi [Raja Ongkir](https://rajaongkir.com/)
2. Daftar akun dan pilih paket "Starter" (gratis)
3. Dapatkan API Key dari dashboard

### 2. Konfigurasi Environment Variables

Tambahkan variabel berikut ke file `.env`:

```env
# Raja Ongkir API Key for location data
RAJAONGKIR_API_KEY=your_api_key_here
RAJAONGKIR_BASE_URL=https://api.rajaongkir.com/starter
```

### 3. Fitur yang Tersedia

#### Dropdown Provinsi
- Menampilkan semua provinsi di Indonesia
- Data di-cache selama 1 jam untuk performa

#### Dropdown Kota
- Menampilkan kota berdasarkan provinsi yang dipilih
- Update otomatis saat provinsi berubah

#### Dropdown Kode Pos
- Menampilkan kode pos berdasarkan kota yang dipilih
- Update otomatis saat kota berubah

#### Pencarian Kota (Opsional)
- Fitur pencarian kota berdasarkan keyword
- Menampilkan hasil pencarian dengan format "Tipe Kota, Provinsi"

### 4. Fallback Data

Jika API Raja Ongkir tidak tersedia, sistem akan menggunakan data statis yang mencakup:
- 12 provinsi utama di Indonesia
- 16 kota utama dengan kode pos
- Data fallback untuk memastikan aplikasi tetap berfungsi

### 5. API Endpoints

- `GET /api/cities?province_id={id}` - Mendapatkan kota berdasarkan ID provinsi
- `GET /api/cities/search?keyword={keyword}` - Mencari kota berdasarkan keyword
- `GET /api/postal-codes?city_id={id}` - Mendapatkan kode pos berdasarkan ID kota

### 6. Penggunaan

1. User memilih provinsi dari dropdown
2. Sistem otomatis memuat kota-kota di provinsi tersebut
3. User memilih kota
4. Sistem otomatis memuat kode pos untuk kota tersebut
5. User memilih kode pos

### 7. Cache

Data lokasi di-cache menggunakan Laravel Cache untuk:
- Meningkatkan performa
- Mengurangi request ke API eksternal
- Memastikan aplikasi tetap responsif

Cache akan expire setelah 1 jam dan akan di-refresh otomatis.

### 8. Error Handling

- Jika API tidak tersedia, sistem akan menggunakan data fallback
- Error akan di-log untuk monitoring
- User experience tetap terjaga dengan data statis

### 9. Customization

Untuk menambahkan data statis tambahan, edit file `app/Services/LocationService.php`:
- `getStaticProvinces()` - Tambah provinsi baru
- `getStaticCities()` - Tambah kota baru
- `getStaticPostalCodes()` - Tambah kode pos baru 