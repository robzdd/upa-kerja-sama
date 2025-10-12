<?php
namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumni extends Model
{

    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'alumnis';
    protected $fillable = [
        'user_id',
        'nim',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'tentang_saya',
        'nama_bank',
        'no_rekening',
        'file_cv',
        'cv_updated_at',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'cv_updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataAkademik()
    {
        return $this->hasOne(DataAkademik::class);
    }

    public function dataKeluarga()
    {
        return $this->hasOne(DataKeluarga::class);
    }

    public function dokumenPendukung()
    {
        return $this->hasMany(DokumenPendukung::class);
    }
}
