<?php
namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MitraPerusahaan extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'mitra_perusahaan';

    protected $fillable = [
    'user_id',
    'nama_perusahaan',
    'logo',
    'sektor',
    'deskripsi',
    'alamat',
    'kontak',
    'tautan',
    'mulai_kerjasama',
    'akhir_kerjasama'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan()
    {
        return $this->hasMany(LowonganPekerjaan::class, 'mitra_id');
    }
}
