<?php
namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowonganPekerjaan extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'lowongan_pekerjaans';


    protected $fillable = [
        'mitra_id',
        'judul',
        'posisi',
        'deskripsi',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_pekerjaan',
        'jenjang_pendidikan',
        'prodi_diizinkan',
        'persyaratan_dokumen',
        'rincian_lowongan',
        'jumlah_pelamar',
        'status_aktif',
        'tanggal_penerimaan_lamaran',
        'tanggal_pengumuman',
        'gaji_min',
        'gaji_max',
        'pengalaman_minimal',
        'skill_required'
    ];

    protected $casts = [
        'prodi_diizinkan' => 'array',
        'persyaratan_dokumen' => 'array',
        'skill_required' => 'array',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_penerimaan_lamaran' => 'date',
        'tanggal_pengumuman' => 'date',
        'status_aktif' => 'boolean'
    ];

    public function mitra()
    {
        return $this->belongsTo(MitraPerusahaan::class, 'mitra_id');
    }

    public function pelamar()
    {
        return $this->hasMany(Pelamar::class, 'lowongan_id');
    }

    
}

