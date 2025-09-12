<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudi extends Model
{
 use HasFactory, SoftDeletes;

    protected $table = 'program_studi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['program_studi'];

    public function alumni()
    {
        return $this->hasMany(Alumni::class);
    }
}
