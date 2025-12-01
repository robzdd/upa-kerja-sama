<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumenPublik extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'dokumen_publiks';

    protected $fillable = [
        'user_id',
        'kategori_dokumen_id',
        'judul',
        'deskripsi',
        'file_path',
        'file_type',
        'file_size',
        'download_count'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'download_count' => 'integer',
    ];

    /**
     * Relationship: Dokumen belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Dokumen belongs to Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_dokumen_id');
    }

    /**
     * Accessor: Format file size to human readable
     */
    public function getFileSizeFormattedAttribute()
    {
        if (!$this->file_size) {
            return '-';
        }

        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }

    /**
     * Method: Increment download counter
     */
    public function incrementDownload()
    {
        $this->increment('download_count');
    }
}
