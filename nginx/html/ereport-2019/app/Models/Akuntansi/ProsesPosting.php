<?php

namespace App\Models\Akuntansi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProsesPosting extends Model
{
    protected $table = 'proses_posting';
    protected $fillable = [
        'status', 'bulan', 'tahun', 'kode_pengguna', 'kode_organisasi'
    ];

    public function scopeCariProsesPosting($query, $cari){
    	return $query ->where('status', 'like', '%'.$cari.'%')
            ->orWhere('bulan', 'like', '%'.$cari.'%')
            ->orWhere('tahun', 'like', '%'.$cari.'%')
            ->orWhere('kode_pengguna', 'like', '%'.$cari.'%')
            ->orWhere('kode_organisasi', 'like', '%'.$cari.'%');
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
