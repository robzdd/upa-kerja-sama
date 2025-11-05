<?php

// ===== FILE: app/Models/PengalamanKerjaOrganisasi.php =====

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKerjaOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'pengalaman_kerja_organisasi';

    protected $fillable = [
        'user_id',
        'type',
        'perusahaan_organisasi',
        'posisi',
        'mulai_kerja',
        'selesai_kerja',
        'deskripsi_piri',
    ];

    protected $casts = [
        'mulai_kerja' => 'date',
        'selesai_kerja' => 'date',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'user_id', 'user_id');
    }
}
