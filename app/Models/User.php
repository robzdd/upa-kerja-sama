<?php

namespace App\Models;

use App\Traits\HasUuid;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasUuid, HasRoles;


    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relasi
    public function alumni()
    {
        return $this->hasOne(Alumni::class);
    }

    public function mitraPerusahaan()
    {
        return $this->hasOne(MitraPerusahaan::class);
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
