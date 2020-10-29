<?php

namespace App\Models\Akuntansi;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnal';
    protected $fillable = [
        'id', 'no_transaksi', 'tgl_transaksi', 'jenis_transaksi', 'no_urut', 'kode_akun',
        'jenis_jurnal', 'kode_pengguna', 'kode_lapor', 'kode_organisasi', 'kd_org_catat',
        'akun_debet', 'akun_kredit', 'jumlah', 'keterangan', 'status', 'urut_tampil'
    ];
}
