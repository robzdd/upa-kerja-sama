<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'artikels';


    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'slug',
        'excerpt',
        'konten',
        'thumbnail',
        'meta_description',
        'tags',
        'status',
        'published_at',
        'reading_time',
        'is_featured'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategori_id');
    }
}
