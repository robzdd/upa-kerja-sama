# API Documentation - UPA Kerjasama Mobile

## Base URL
```
http://localhost:8000/api
```

## Authentication
API menggunakan Laravel Sanctum untuk authentication. Token akan dikirim melalui header `Authorization: Bearer {token}`.

## Endpoints

### 1. Login
**POST** `/login`

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password"
}
```

**Response Success (200):**
```json
{
    "message": "Login berhasil",
    "token": "1|abc123...",
    "user": {
        "id": "uuid-here",
        "name": "John Doe",
        "email": "john@example.com",
        "role": "alumni"
    }
}
```

**Response Error (401):**
```json
{
    "message": "Email atau password salah"
}
```

### 2. Register
**POST** `/register`

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password",
    "nim": "1234567890",
    "no_hp": "081234567890"
}
```

**Response Success (201):**
```json
{
    "success": true,
    "message": "Registrasi berhasil",
    "data": {
        "user": {
            "id": "uuid-here",
            "name": "John Doe",
            "email": "john@example.com",
            "roles": ["alumni"]
        },
        "profile": {
            "id": "profile-uuid",
            "user_id": "user-uuid",
            "nim": "1234567890",
            "no_hp": "081234567890"
        },
        "token": "1|abc123..."
    }
}
```

### 3. Logout
**POST** `/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
    "message": "Logout berhasil"
}
```

### 4. Get Profile
**GET** `/profile`

**Headers:**
```
Authorization: Bearer {token}
```

**Response Success (200):**
```json
{
    "user": {
        "id": "uuid-here",
        "name": "John Doe",
        "email": "john@example.com",
        "role": "alumni"
    },
    "profile": {
        "id": "profile-uuid",
        "user_id": "user-uuid",
        "nim": "1234567890",
        "no_hp": "081234567890",
        "tempat_lahir": "Jakarta",
        "tanggal_lahir": "1995-01-01",
        "jenis_kelamin": "Laki-laki",
        "alamat": "Jl. Contoh No. 123",
        "kota": "Jakarta",
        "provinsi": "DKI Jakarta",
        "kode_pos": "12345",
        "tentang_saya": "Saya adalah seorang alumni yang sedang mencari pekerjaan."
    }
}
```

### 5. Get Jobs List
**GET** `/jobs`

**Query Parameters (Optional):**
- `search`: Keyword untuk mencari lowongan

**Example:**
```
GET /jobs?search=developer
```

**Response Success (200):**
```json
[
    {
        "id": "job-uuid",
        "judul": "Software Developer",
        "deskripsi": "Kami mencari Software Developer yang berpengalaman...",
        "lokasi": "Jakarta",
        "gaji_min": "8000000",
        "gaji_max": "12000000",
        "jenis_pekerjaan": "Full Time",
        "pengalaman_minimal": "2-5 tahun",
        "jenjang_pendidikan": "S1 Teknik Informatika",
        "skill_required": "[\"JavaScript\", \"React\", \"Node.js\", \"MySQL\"]",
        "rincian_lowongan": "Minimal 2 tahun pengalaman...",
        "tanggal_penerimaan_lamaran": "2024-12-31",
        "status_aktif": true,
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z",
        "mitra_perusahaan": {
            "id": "mitra-uuid",
            "nama_perusahaan": "PT. Teknologi Indonesia",
            "sektor": "Teknologi Informasi",
            "kontak": "021-1234567",
            "tautan": "https://teknoindonesia.com"
        }
    }
]
```

### 6. Get Job Detail
**GET** `/jobs/{id}`

**Response Success (200):**
```json
{
    "id": "job-uuid",
    "judul": "Software Developer",
    "deskripsi": "Kami mencari Software Developer yang berpengalaman...",
    "lokasi": "Jakarta",
    "gaji_min": "8000000",
    "gaji_max": "12000000",
    "jenis_pekerjaan": "Full Time",
    "pengalaman_minimal": "2-5 tahun",
    "jenjang_pendidikan": "S1 Teknik Informatika",
    "skill_required": "[\"JavaScript\", \"React\", \"Node.js\", \"MySQL\"]",
    "rincian_lowongan": "Minimal 2 tahun pengalaman...",
    "tanggal_penerimaan_lamaran": "2024-12-31",
    "status_aktif": true,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "mitra_perusahaan": {
        "id": "mitra-uuid",
        "nama_perusahaan": "PT. Teknologi Indonesia",
        "sektor": "Teknologi Informasi",
        "kontak": "021-1234567",
        "tautan": "https://teknoindonesia.com"
    }
}
```

**Response Error (404):**
```json
{
    "message": "Lowongan tidak ditemukan"
}
```

## Test Credentials

### Alumni
- Email: `john@example.com`
- Password: `password`

### Mitra
- Email: `mitra@example.com`
- Password: `password`

### Admin
- Email: `admin@example.com`
- Password: `password`

## Testing dengan Postman/Insomnia

1. **Login Request:**
   - Method: POST
   - URL: `http://localhost:8000/api/login`
   - Headers: `Content-Type: application/json`
   - Body: 
     ```json
     {
         "email": "john@example.com",
         "password": "password"
     }
     ```

2. **Get Profile Request:**
   - Method: GET
   - URL: `http://localhost:8000/api/profile`
   - Headers: 
     ```
     Content-Type: application/json
     Authorization: Bearer {token_dari_login}
     ```

3. **Get Jobs Request:**
   - Method: GET
   - URL: `http://localhost:8000/api/jobs`
   - Headers: `Content-Type: application/json`

## Error Handling

Semua error response mengikuti format:
```json
{
    "message": "Error message here"
}
```

Status codes yang digunakan:
- `200`: Success
- `201`: Created (untuk register)
- `401`: Unauthorized (login gagal, token invalid)
- `404`: Not Found
- `422`: Validation Error
- `500`: Server Error
