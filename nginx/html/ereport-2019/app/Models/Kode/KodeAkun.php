<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;

class KodeAkun extends Model
{
    protected $primaryKey = 'kdRekening';
    public $incrementing = false;
    protected $table = 'kd_akun';
    protected $fillable = [
        'kdRekening', 'nmRekening', 'jumlah', 'jum_ang_pergeseran', 'jum_ang_perubahan', 
        'kode_urusan', 'kode_skpd', 'kode_program', 'kode_kegiatan', 'kode_akun_utama',
        'kode_akun_kelompok', 'kode_akun_jenis', 'kode_akun_objek', 'kode_akun_rincian',
        'kode_kegiatan_full'
    ];

    public function scopeCariModalKodeProgramPrognosis($query, $cari){
    	return $query ->where('kdRekening', 'like', '%'.$cari.'%')
            ->orWhere('nmRekening', 'like', '%'.$cari.'%');
    }
}
