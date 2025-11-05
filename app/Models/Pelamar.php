<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pelamar extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    
    protected $table = 'pelamars';
    
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'id',
        'user_id',
        'lowongan_id',
        'status',
        'pesan_lamaran',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }
    
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span>',
            'diterima' => '<span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Diterima</span>',
            'ditolak' => '<span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Ditolak</span>',
        ];
        
        return $badges[$this->status] ?? $badges['pending'];
    }
}

