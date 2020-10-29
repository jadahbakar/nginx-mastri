<?php

namespace App\Models\Akuntansi;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Posting extends Model
{
    protected $table = 'posting';
    protected $fillable = [
        'no_transaksi', 'tgl_transaksi', 'jenis_transaksi', 'no_urut', 'kode_akun',
        'jenis_jurnal', 'kode_pengguna', 'kode_lapor', 'kode_organisasi', 'kd_org_catat',
        'kode_rekening', 'debet', 'kredit', 'keterangan'
    ];

    public function scopeViewPengguna($query){
        if(Auth::user()->view == 2) {
            $queryView = $query->where('kode_organisasi', Auth::user()->organisasi);
        }

        return $queryView;
    }

    public function setTglTransaksiAttribute($tanggal) {
        $this->attributes['tgl_transaksi'] = Carbon::parse($tanggal)->format('Y-m-d');
    }

    public function getTglTransaksiAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getDebetAttribute($value){
        return mataUang($value);
    }

    public function setDebetAttribute($data) {
         $this->attributes['debet'] = hilangTiTik($data);
    }

    public function getKreditAttribute($value){
        return mataUang($value);
    }

    public function setKreditAttribute($data) {
         $this->attributes['kredit'] = hilangTiTik($data);
    }
}
