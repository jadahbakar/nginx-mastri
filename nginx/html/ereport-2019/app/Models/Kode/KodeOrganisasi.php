<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;

class KodeOrganisasi extends Model
{
    protected $primaryKey = 'kode_organisasi';
    public $incrementing = false;
    protected $table = 'm_organisasi';
    protected $fillable = [
        'kode_organisasi', 'nama_organisasi', 'nama1', 'nip1', 'jabatankepala', 
        'nama2', 'nip2', 'jabatanppk'
    ];
}
