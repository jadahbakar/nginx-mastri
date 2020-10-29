<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kode\KodeOrganisasi;
use App\Models\Kode\KodeKegiatan;
use App\Models\Kode\KodeAkun;
use App\Models\Kode\KodeKegiatanPrognosis;
use App\Models\Pengaturan\Pengguna;

class ConvertController extends Controller
{
    public function converKodeKegiatan()
    {
    	$delete = KodeKegiatanPrognosis::where('jenis', 'lama')->delete();
    	$kodeKegiatan = KodeKegiatan::get();
    	foreach($kodeKegiatan as $item) {
    		$pengguna = Pengguna::where('organisasi', substr($item->kdkegiatan,7,9))->where('jabatan', 20)->first();
    		$kodeProgram = substr($item->kdkegiatan, 0, 19);
    		$kodeKegiatan = substr($item->kdkegiatan, 20, 3);
    		$program = KodeAkun::where('kdRekening', $kodeProgram)->first();

    		$kodeKegiatanPrognosis = new KodeKegiatanPrognosis();
            $kodeKegiatanPrognosis->jenis = 'lama';
            $kodeKegiatanPrognosis->kode_pengguna = $pengguna['kode_pengguna'];
            $kodeKegiatanPrognosis->kode_program = $kodeProgram;
            $kodeKegiatanPrognosis->uraian_program = $program['nmRekening'];
            $kodeKegiatanPrognosis->kode_kegiatan = $kodeKegiatan;
            $kodeKegiatanPrognosis->uraian_kegiatan = $item->nmkegiatan;
            $kodeKegiatanPrognosis->kode_organisasi = $pengguna['organisasi'];
            $kodeKegiatanPrognosis->kode_kegiatan_full = $item->kdkegiatan;
            $kodeKegiatanPrognosis->save();
    	}
    }
}
