<?php
namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriArtikel extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'kategori_artikels';


    protected $fillable = ['nama', 'deskripsi'];

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'kategori_id');
    }
}

