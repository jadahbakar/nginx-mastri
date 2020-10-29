<?php

namespace App\Http\Controllers\EntryData\Helper;

use Log;
use App\Models\Pengaturan\Pengguna;
use App\Models\Kode\MasterAkunBas;
use App\Models\Akuntansi\Jurnal;

class AkuntansiHelper
{
    public function cekJurnal($noTransaksi)
    {
        $jurnal = Jurnal::where('no_transaksi', $noTransaksi)->count();
        return $jurnal;
    }

    public function namaAkunBas($akunBas, $jenisAkun)
    {
        $masterAkunBas = MasterAkunBas::where('akun_bas', $akunBas)->where('jenis_akun', $jenisAkun)->first();
        return $masterAkunBas->nama_akun;
    }
}
