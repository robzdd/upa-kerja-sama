<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DataAkademik extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'data_akademiks';
    protected $fillable = [
        'alumni_id',
        'nim',
        'program_studi',
        'tahun_masuk',
        'tahun_lulus',
        'ipk',
        'universitas',
    ];

    protected $casts = [
        'ipk' => 'float',

    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
