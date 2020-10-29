<?php

namespace App\Models\Pengeluaran;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $primaryKey = 'no_trans';
    public $incrementing = false;
    protected $table = 'pengeluaran';
    protected $fillable = [
        'no_trans', 'kode_pengguna', 'kode_bendahara_pembantu', 'tanggal_transaksi', 'jenis_transaksi', 'no_transaksi_2',
        'nomor_spp', 'tanggal_spp', 'nomor_spm', 'tanggal_spm', 'nomor_sp2d', 'tanggal_sp2d', 'jenis', 'uraian', 'kode_rekening',
        'jumlah', 'nama_perusahaan', 'nama_rekanan', 'npwp_rekanan', 'nama_bendahara', 'npwp_bendahara', 'kode_akun_pajak',
        'jenis_pajak', 'jumlah_pajak', 'ntpn', 'keterangan', 'status_verifikasi', 'tgl_pengesahan', 'kdlapor', 'kduptd',
        'kode_lapor', 'kode_organisasi', 'status_data'
    ];

    public function scopeViewPengguna($query){
        if(Auth::user()->view == 2) {
            $queryView = $query->where('kode_organisasi', Auth::user()->organisasi);
        }

        return $queryView;
    }
}
