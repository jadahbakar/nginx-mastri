<?php

namespace App\Models\Penerimaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Penerimaan extends Model
{
	protected $primaryKey = 'no_trans';
    public $incrementing = false;
    protected $table = 'penerimaan';
    protected $fillable = [
        'no_trans', 'kode_pengguna', 'tanggal', 'no_bukti', 'penyetor', 
        'jns_transaksi', 'cara_pembayaran', 'kode_rekening', 'penerimaan', 'keterangan',
        'status_verifikasi', 'tgl_pengesahan', 'kdlapor', 'kduptd', 'kode_lapor', 'kode_organisasi'
    ];

    public function scopeViewPengguna($query){
        if(Auth::user()->view == 2) {
            $queryView = $query->where('kode_organisasi', Auth::user()->organisasi);
        }

        return $queryView;
    }
}
