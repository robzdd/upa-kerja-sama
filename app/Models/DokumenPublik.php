<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumenPublik extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'dokumen_publik';

    protected $fillable =
    [
    'user_id',
    'judul',
    'file_path'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
