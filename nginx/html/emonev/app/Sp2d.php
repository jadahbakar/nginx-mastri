<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sp2d extends Model
{
    protected $table = 'sp2d';
    protected $fillable = [
        'sp2d_id', 'tahun_anggaran', 'tanggal_sp2d', 'jenis_sp2d', 'kode_urusan', 'kode_opd', 'kode_program', 'kode_kegiatan',
        'kode_akun', 'kode_kelompok', 'kode_jenis', 'kode_objek', 'kode_rincian', 'kode_rekening', 'jumlah_sp2d',
        'input_by'
    ];

    public function scopeCari($query, $cari) {
        return $query->where('tahun_anggaran', 'like', '%'.$cari.'%')
                ->orWhere('tanggal_sp2d', 'like', '%'.$cari.'%')
                ->orWhere('kode_urusan', 'like', '%'.$cari.'%') 
                ->orWhere('kode_opd', 'like', '%'.$cari.'%') 
                ->orWhere('kode_program', 'like', '%'.$cari.'%') 
                ->orWhere('kode_kegiatan', 'like', '%'.$cari.'%') 
                ->orWhere('kode_akun', 'like', '%'.$cari.'%') 
                ->orWhere('kode_kelompok', 'like', '%'.$cari.'%') 
                ->orWhere('kode_jenis', 'like', '%'.$cari.'%') 
                ->orWhere('kode_objek', 'like', '%'.$cari.'%') 
                ->orWhere('kode_rincian', 'like', '%'.$cari.'%') 
                ->orWhere('kode_rekening', 'like', '%'.$cari.'%') 
                ->orWhere('jumlah_sp2d', 'like', '%'.$cari.'%') 
                ->orWhere('input_by', 'like', '%'.$cari.'%');
    }

    public function setTanggalSp2dAttribute($tanggal) {
        $this->attributes['tanggal_sp2d'] = Carbon::parse($tanggal)->format('Y-m-d');
    }

    public function getTanggalSp2dAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setJumlahSp2dAttribute($data) {
         $this->attributes['jumlah_sp2d'] = hilangTiTik($data);
    }

    public function getJumlahSp2dAttribute($value){
        return mataUang($value);
    }
}
