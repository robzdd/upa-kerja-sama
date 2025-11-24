<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'alumnis';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'program_studi_id',
        'nim',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'nama_bank',
        'no_rekening',
        'tentang_saya',
        'keahlian',
        'soft_skills',
        'cv_generated',
        'cv_uri',
        'cv_public',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'cv_generated' => 'boolean',
        'cv_public' => 'boolean',
    ];

    // ===== RELATIONSHIPS =====

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataKeluarga()
    {
        return $this->hasOne(DataKeluarga::class, 'alumni_id', 'id');
    }

    public function dokumenPendukung()
    {
        return $this->hasMany(DokumenPendukung::class, 'alumni_id', 'id');
    }

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'user_id', 'user_id')
                    ->orderBy('tahun_masuk', 'desc');
    }

    public function pengalamanKerja()
    {
        return $this->hasMany(PengalamanKerjaOrganisasi::class, 'user_id', 'user_id')
                    ->orderBy('mulai_kerja', 'desc');
    }

    public function sertifikasi()
    {
        return $this->hasMany(PengalamanSertifikasi::class, 'user_id', 'user_id')
                    ->orderBy('mulai_berlaku', 'desc');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    // ===== HELPER METHODS =====

    /**
     * Get full address
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->alamat,
            $this->kota,
            $this->provinsi,
            $this->kode_pos
        ]);

        return implode(', ', $parts);
    }

    /**
     * Get hard skills as array
     */
    public function getHardSkillsArrayAttribute()
    {
        if (empty($this->keahlian)) {
            return [];
        }

        return array_filter(array_map('trim', explode(',', $this->keahlian)));
    }

    /**
     * Get soft skills as array
     */
    public function getSoftSkillsArrayAttribute()
    {
        if (empty($this->soft_skills)) {
            return [];
        }

        return array_filter(array_map('trim', explode(',', $this->soft_skills)));
    }

    /**
     * Check if profile is complete
     */
    public function isProfileComplete()
    {
        $requiredFields = [
            $this->nama_lengkap,
            $this->no_hp,
            $this->alamat,
            $this->jenis_kelamin,
            $this->tempat_lahir,
            $this->tanggal_lahir,
        ];

        foreach ($requiredFields as $field) {
            if (empty($field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get profile completion percentage
     */
    public function getProfileCompletionPercentage()
    {
        $fields = [
            'nama_lengkap',
            'no_hp',
            'alamat',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'tentang_saya',
            'keahlian',
            'soft_skills',
        ];

        $filledCount = 0;
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filledCount++;
            }
        }

        // Add relation checks
        if ($this->dataKeluarga) {
            $filledCount += 0.5;
        }
        if ($this->riwayatPendidikan && $this->riwayatPendidikan->count() > 0) {
            $filledCount += 1;
        }
        if ($this->pengalamanKerja && $this->pengalamanKerja->count() > 0) {
            $filledCount += 1;
        }
        if ($this->sertifikasi && $this->sertifikasi->count() > 0) {
            $filledCount += 1;
        }

        $totalFields = count($fields) + 5; // 9 direct fields + 5 relation checks

        return round(($filledCount / $totalFields) * 100);
    }
}