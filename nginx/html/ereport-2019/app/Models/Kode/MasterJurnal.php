<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;

class MasterJurnal extends Model
{
    protected $primaryKey = 'no_urut';
    public $incrementing = false;
    protected $table = 'master_jurnal';
    protected $fillable = [
        'jenis_transaksi', 'kode_akun', 'lra_13_debet', 'lra_13_kredit', 'lra_64_debet',
        'lra_64_kredit', 'lo_debet', 'lo_kredit', 'jf_ppkd_debet', 'jf_ppkd_kredit'
    ];
}
