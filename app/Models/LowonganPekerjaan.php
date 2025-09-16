<?php
namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowonganPekerjaan extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'lowongan_pekerjaan';


    protected $fillable = ['mitra_id', 'judul', 'deskripsi', 'lokasi', 'tanggal_mulai', 'tanggal_selesai'];

    public function mitra()
    {
        return $this->belongsTo(MitraPerusahaan::class, 'mitra_id');
    }

    public function pelamar()
    {
        return $this->hasMany(Pelamar::class, 'lowongan_id');
    }
}

