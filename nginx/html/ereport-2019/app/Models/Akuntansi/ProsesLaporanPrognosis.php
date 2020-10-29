<?php

namespace App\Models\Akuntansi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProsesLaporanPrognosis extends Model
{
    protected $table = 'proses_laporan_prognosis';
    protected $fillable = [
        'jenis_laporan', 'status', 'tahun', 'url_file', 'direktori_file', 'nama_file', 'kode_organisasi', 'kode_pengguna'
    ];

    public function scopeCariProsesLaporanPrognosis($query, $cari){
    	return $query ->where('status', 'like', '%'.$cari.'%')
            ->orWhere('tahun', 'like', '%'.$cari.'%')
            ->orWhere('kode_organisasi', 'like', '%'.$cari.'%')
            ->orWhere('kode_pengguna', 'like', '%'.$cari.'%');
    }

    public function scopeViewPengguna($query){
        if(Auth::user()->view == 2) {
            $queryView = $query->where('kode_organisasi', Auth::user()->organisasi);
        }else if(Auth::user()->view == 1) {
            $queryView = null;
        }

        return $queryView;
    }

    public function organisasi() {
        return $this->belongsTo('App\Models\Kode\KodeOrganisasi', 'kode_organisasi');
    }
}
