<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DokumenPendukung extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'dokumen_pendukungs';
    protected $fillable = [
        'alumni_id',
        'tipe_dokumen',
        'nama_dokumen',
        'path_file',
        'ukuran_file',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'id');
    }
}
