<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStudi extends Model
{
    use HasFactory, SoftDeletes, HasUuid;

    protected $table = 'program_studis';

    protected $fillable = [
        'program_studi',
];



    public function alumni()
    {
        return $this->hasMany(Alumni::class);
    }
}
