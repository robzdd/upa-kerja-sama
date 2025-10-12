<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataKeluarga extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'data_keluargas';
    protected $fillable = [
        'alumni_id',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'alamat_keluarga',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
