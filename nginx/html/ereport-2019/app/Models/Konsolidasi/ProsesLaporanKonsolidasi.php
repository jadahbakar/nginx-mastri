<?php

namespace App\Models\Konsolidasi;

use Illuminate\Database\Eloquent\Model;

class ProsesLaporanKonsolidasi extends Model
{
    protected $table = 'proses_laporan_konsolidasi';
    protected $fillable = [
        'jenis_laporan', 'status', 'tahun', 'url_file', 'direktori_file', 'nama_file', 'kode_pengguna'
    ];

    public function scopeCariProsesLaporanKonsolidasi($query, $cari){
    	return $query ->where('status', 'like', '%'.$cari.'%')
            ->orWhere('tahun', 'like', '%'.$cari.'%')
            ->orWhere('kode_pengguna', 'like', '%'.$cari.'%');
    }
}
