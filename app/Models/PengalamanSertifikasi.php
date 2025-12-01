<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanSertifikasi extends Model
{
    use HasFactory;

    protected $table = 'pengalaman_sertifikasi';

    protected $fillable = [
        'user_id',
        'nama_sertifikasi',
        'lembaga_sertifikasi',
        'mulai_berlaku',
        'selesai_berlaku',
        'deskripsi',
    ];

    protected $casts = [
        'mulai_berlaku' => 'date',
        'selesai_berlaku' => 'date',
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