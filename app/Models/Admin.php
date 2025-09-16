<?php
namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'admin';

    protected $fillable = [
    'user_id',
    'jabatan',
    'no_telepon',
    'alamat'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
