<?php

namespace App\Models\Pengaturan;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'kode_pengguna';
    public $incrementing = false;
    protected $table = 'pengguna';
    protected $fillable = [
        'kode_pengguna', 'nama', 'nip', 'email', 'jabatan', 'organisasi', 'kode_lapor', 'nama_pa', 'nip_pa'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = md5($password);
    }
}
