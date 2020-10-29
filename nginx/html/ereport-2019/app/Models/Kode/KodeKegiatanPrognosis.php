<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KodeKegiatanPrognosis extends Model
{
    protected $table = 'm_kegiatan_prognosis';
    protected $fillable = [
        'kode_pengguna', 'jenis', 'kode_program', 'uraian_program', 'kode_kegiatan', 'uraian_kegiatan', 
        'kode_organisasi', 'kode_kegiatan_full'
    ];

    public function scopeCariKodeKegiatanPrognosis($query, $cari){
    	return $query->where('kode_program', 'like', '%'.$cari.'%')
            ->orWhere('uraian_program', 'like', '%'.$cari.'%')
            ->orWhere('kode_kegiatan', 'like', '%'.$cari.'%')
            ->orWhere('uraian_kegiatan', 'like', '%'.$cari.'%')
            ->orWhere('kode_organisasi', 'like', '%'.$cari.'%')
            ->orWhereHas('kodeOrganisasi', function ($queryIn) use ($cari) {
                $queryIn->where('nama_organisasi', 'like', '%'.$cari.'%');
            })
            ->orWhere('kode_kegiatan_full', 'like', '%'.$cari.'%');
    }

    public function scopeCariModalKodeKegiatanPrognosis($query, $cari){
        return $query->where('uraian_kegiatan', 'like', '%'.$cari.'%')
            ->orWhere('kode_kegiatan_full', 'like', '%'.$cari.'%');
    }

    public function scopeViewPengguna($query){
    	if(Auth::user()->view == 2) {
    		$queryView = $query->where('kode_organisasi', Auth::user()->organisasi);
    	}else if(Auth::user()->view == 1){
            $queryView = null;
        }

    	return $queryView;
    }

    public function kodeOrganisasi() {
        return $this->belongsTo('App\Models\Kode\KodeOrganisasi', 'kode_organisasi');
    }
}
