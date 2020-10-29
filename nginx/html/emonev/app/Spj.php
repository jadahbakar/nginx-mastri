<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Spj extends Model
{
    protected $table = 'spj';
    protected $fillable = [
        'no_transaksi', 'tahun_anggaran', 'tanggal_spj', 'jenis_transaksi', 'jenis_spj', 'kode_urusan', 'kode_opd', 
        'kode_program', 'kode_kegiatan', 'kode_akun', 'kode_kelompok', 'kode_jenis', 'kode_objek', 'kode_rincian', 'kode_rekening', 
        'debet', 'kredit', 'input_by'
    ];

    public function scopeCari($query, $cari) {
        return $query->where('tahun_anggaran', 'like', '%'.$cari.'%')
                ->orWhere('tanggal_spj', 'like', '%'.$cari.'%')
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
                ->orWhere('debet', 'like', '%'.$cari.'%') 
                ->orWhere('kredit', 'like', '%'.$cari.'%') 
                ->orWhere('input_by', 'like', '%'.$cari.'%');
    }

    public function setTanggalSpjAttribute($tanggal) {
        $this->attributes['tanggal_spj'] = Carbon::parse($tanggal)->format('Y-m-d');
    }

    public function getTanggalSpjAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setDebetAttribute($data) {
         $this->attributes['debet'] = hilangTiTik($data);
    }

    public function getDebetAttribute($value){
        return mataUang($value);
    }

    public function setKreditAttribute($data) {
         $this->attributes['kredit'] = hilangTiTik($data);
    }

    public function getKreditAttribute($value){
        return mataUang($value);
    }
}
