<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;

class MasterAkunBas extends Model
{
    protected $table = 'master_akun_bas';
    protected $fillable = [
        'akun_bas', 'nama_akun', 'jenis_akun'
    ];

    public function scopeCariModalMasterAkunBas($query, $cari){
        return $query->where('akun_bas', 'like', '%'.$cari.'%')
            ->orWhere('nama_akun', 'like', '%'.$cari.'%');
    }
}
