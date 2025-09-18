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
    use HasFactory, Notifiable, SoftDeletes, HasUuid;


    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relasi
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function alumni()
    {
        return $this->hasOne(Alumni::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function mitra()
    {
        return $this->hasOne(MitraPerusahaan::class);
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class);
    }

    public function pelamaran()
    {
        return $this->hasMany(Pelamar::class);
    }

    public function dokumenPublik()
    {
        return $this->hasMany(DokumenPublik::class);
    }
}
