<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RiwayatPendidikan extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'riwayat_pendidikan';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'nama_sekolah',
        'strata',
        'tahun_masuk',
        'tahun_lulus',
        'deskripsi',
    ];

    protected $casts = [
        'tahun_masuk' => 'date',
        'tahun_lulus' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'user_id', 'user_id');
    }
}