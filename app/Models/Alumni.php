<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'alumni';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'program_studi_id', 'nim', 'nama', 'angkatan', 'deskripsi_diri'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }

}

