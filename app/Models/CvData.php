<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CvData extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'cv_data';

    protected $fillable = [
        'alumni_id',
        'tipe_data',
        'judul',
        'deskripsi',
        'periode',
        'instansi',
        'metadata',
        'urutan',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
