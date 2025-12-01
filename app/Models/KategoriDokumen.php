<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriDokumen extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'kategori_dokumen';

    protected $fillable = [
        'nama',
        'deskripsi',
        'icon',
        'color',
        'urutan'
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];

    /**
     * Relationship: Kategori has many Dokumen
     */
    public function dokumen()
    {
        return $this->hasMany(DokumenPublik::class, 'kategori_dokumen_id');
    }

    /**
     * Scope: Order by urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Accessor: Get document count
     */
    public function getDokumenCountAttribute()
    {
        return $this->dokumen()->count();
    }
}
