<?php

namespace App\Models\Akuntansi;

use Illuminate\Database\Eloquent\Model;

class Akuntansi extends Model
{
    protected $primaryKey = 'no_transaksi';
    public $incrementing = false;
    protected $table = 'akuntansi';
    protected $fillable = [
        'no_transaksi', 'kode_pengguna', 'tanggal', 'jenis_transaksi', 'no_bukti', 'akun_debet_lo', 
        'akun_kredit_lo', 'akun_debet_lra13', 'akun_kredit_lra13', 'akun_debet_lra64', 'akun_kredit_lra64',
        'akun_debet_ppkd', 'akun_kredit_ppkd', 'jumlah', 'keterangan', 'kode_lapor', 'kode_organisasi', 'diambil'
    ];

    public function scopeViewPengguna($query){
        if(Auth::user()->view == 2) {
            $queryView = $query->where('kode_organisasi', Auth::user()->organisasi);
        }

        return $queryView;
    }
}
