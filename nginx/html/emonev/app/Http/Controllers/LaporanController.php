<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use Carbon\Carbon;
use Session;
use App\Sp2d;
use App\Spj;

class LaporanController extends Controller
{
    function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var['bulan'] = ['1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus', 
                '9'=>'September', '10'=>'Oktober', '11'=>'Nopember', '12'=>'Desember'];

        return view('laporan.laporan', compact('var'));
    }

    public function cetak (Request $request)
    {
        $var['tahun'] = $request->tahun;
        $var['bulan'] = $request->bulan;
        $no = 0;
        $data = array();

        $listOrganisasi = DB::connection('mysql3')->table('m_organisasi')->selectRaw('kode_organisasi, nama_organisasi')
                        ->orderBy('kode_organisasi', 'asc')->get();


        foreach($listOrganisasi as $item){
            $no ++;

            $kolom3 = $this->kolom3($item->kode_organisasi);
            $kolom4 = $this->kolom4($item->kode_organisasi);
            $kolom5 = $this->kolom5($item->kode_organisasi);
            $kolom6 = $this->kolom6($item->kode_organisasi);
            $kolom7 = $this->kolom7($item->kode_organisasi);
            $kolom8 = $this->kolom8($item->kode_organisasi);
            $kolom9 = $this->kolom9($item->kode_organisasi);
            $kolom10 = $this->kolom10($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom11 = $this->kolom11($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom12 = $this->kolom12($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom13 = ($kolom7 == 0 ? 0 : ($kolom10/$kolom7) *100);
            $kolom14 = ($kolom8 == 0 ? 0 : ($kolom11/$kolom8) *100);
            $kolom15 = ($kolom9 == 0 ? 0 : ($kolom12/$kolom9) *100);
            $kolom16 = $this->kolom16($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom17 = $this->kolom17($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom18 = $this->kolom18($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom19 = ($kolom3 == 0 ? 0 : ($kolom16/$kolom3) *100);
            $kolom20 = ($kolom4 == 0 ? 0 : ($kolom17/$kolom4) *100);
            $kolom21 = ($kolom5 == 0 ? 0 : ($kolom18/$kolom5) *100);
            $kolom22 = $this->kolom22($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom23 = ($kolom6 == 0 ? 0 : ($kolom22/$kolom6) *100);
            $kolom24 = $this->kolom24($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom25 = $this->kolom25($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom26 = $this->kolom26($item->kode_organisasi, $var['bulan'], $var['tahun']);
            $kolom27 = ($kolom7 == 0 ? 0 : ($kolom24/$kolom7) *100);
            $kolom28 = ($kolom8 == 0 ? 0 : ($kolom25/$kolom8) *100);
            $kolom29 = ($kolom9 == 0 ? 0 : ($kolom26/$kolom9) *100);

            $data[] = [
                'no_urut' => $no,
                'kode_organisasi' => $item->kode_organisasi,
                'nama_organisasi' => $item->nama_organisasi,
                'kolom3' => $kolom3,
                'kolom4' => $kolom4,
                'kolom5' => $kolom5,
                'kolom6' => $kolom6,
                'kolom7' => $kolom7,
                'kolom8' => $kolom8,
                'kolom9' => $kolom9,
                'kolom10' => $kolom10,
                'kolom11' => $kolom11,
                'kolom12' => $kolom12,
                'kolom13' => $kolom13,
                'kolom14' => $kolom14,
                'kolom15' => $kolom15,
                'kolom16' => $kolom16,
                'kolom17' => $kolom17,
                'kolom18' => $kolom18,
                'kolom19' => $kolom19,
                'kolom20' => $kolom20,
                'kolom21' => $kolom21,
                'kolom22' => $kolom22,
                'kolom23' => $kolom23,
                'kolom24' => $kolom24,
                'kolom25' => $kolom25,
                'kolom26' => $kolom26,
                'kolom27' => $kolom27,
                'kolom28' => $kolom28,
                'kolom29' => $kolom29
            ];   
        }

        if($request->format=="pdf"){
           $pdf = PDF::loadView('laporan.laporan-cetak', compact('var', 'data'));

            return $pdf->stream('laporan-serapan-SP2D-SPJ.pdf'); 
        }else if($request->format=="xls"){
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=laporan-serapan-SP2D-SPJ.xls");//ganti nama sesuai keperluan
            header("Pragma: no-cache");
            header("Expires: 0");

            return view('laporan.laporan-cetak', compact('var', 'data'));
        }else if($request->format=="doc"){
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=laporan-serapan-SP2D-SPJ.doc");//ganti nama sesuai keperluan
            header("Pragma: no-cache");
            header("Expires: 0");

            return view('laporan.laporan-cetak', compact('var', 'data'));
        }
    }

    private function kolom3($kodeOrganisasi)
    {
        $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
            where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
            and substring(kdRekening,25,3)="5 1"'))->first();

        return $kolom->jumlah;
    }

    private function kolom4($kodeOrganisasi)
    {
        if($kodeOrganisasi == '1.1.02.01' || $kodeOrganisasi == '1.1.02.02'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,3)="5 2" and substring(kdRekening,18,2)!="31"'))->first();
        }else if($kodeOrganisasi == '1.2.09.01'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,3)="5 2" and substring(kdRekening,18,2)!="23"'))->first();
        }else if($kodeOrganisasi == '1.1.01.01'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,3)="5 2" and substring(kdRekening,18,6) not in("16 772","16 773")'))->first();
        }else{
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,3)="5 2"'))->first();
        }
        
        return $kolom->jumlah;
    }

    private function kolom5($kodeOrganisasi)
    {
        if($kodeOrganisasi == '1.1.02.01' || $kodeOrganisasi == '1.1.02.02'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,1)="5" and substring(kdRekening,18,2)!="31"'))->first();
        }else if($kodeOrganisasi == '1.2.09.01'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,1)="5" and substring(kdRekening,18,2)!="23"'))->first();
        }else if($kodeOrganisasi == '1.1.01.01'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,1)="5" and substring(kdRekening,18,6) not in("16 772","16 773")'))->first();
        }else{
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,1)="5"'))->first();
        }
        
        return $kolom->jumlah;
    }

    private function kolom6($kodeOrganisasi)
    {
        if($kodeOrganisasi == '1.1.02.01' || $kodeOrganisasi == '1.1.02.02'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,3)="5 2" and substring(kdRekening,18,2)="31"'))->first();
            $jumlah = $kolom->jumlah;
        }else if($kodeOrganisasi == '1.2.09.01'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,3)="5 2" and substring(kdRekening,18,2)="23"'))->first();
            $jumlah = $kolom->jumlah;
        }else if($kodeOrganisasi == '1.1.01.01'){
            $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
                where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
                and substring(kdRekening,25,3)="5 2" and substring(kdRekening,18,6) in("16 772","16 773")'))->first();
            $jumlah = $kolom->jumlah;
        }else{
            $jumlah = 0;
        }
        
        return $jumlah;
    }

    private function kolom7($kodeOrganisasi)
    {
        $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
            where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
            and substring(kdRekening,25,3)="5 1"'))->first();

        return $kolom->jumlah;
    }

    private function kolom8($kodeOrganisasi)
    {
        $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
            where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
            and substring(kdRekening,25,3)="5 2"'))->first();

        return $kolom->jumlah;
    }

    private function kolom9($kodeOrganisasi)
    {
        $kolom = collect(DB::connection('mysql3')->select('select sum(jumlah)as jumlah from kd_akun 
            where substring(kdRekening,8,9)="'.$kodeOrganisasi.'" and length(kdRekening)="35"
            and substring(kdRekening,25,1)="5"'))->first();

        return $kolom->jumlah;
    }

    private function kolom10($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Sp2d::selectRaw('sum(jumlah_sp2d)as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')->where('kode_kelompok', '1')
            ->whereMonth('tanggal_sp2d', '<=', $bulan)->whereYear('tanggal_sp2d', $tahun)->first();

        return $kolom->jumlah;
    }

    private function kolom11($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Sp2d::selectRaw('sum(jumlah_sp2d)as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')->where('kode_kelompok', '2')
            ->whereMonth('tanggal_sp2d', '<=', $bulan)->whereYear('tanggal_sp2d', $tahun)->first();

        return $kolom->jumlah;
    }

    private function kolom12($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Sp2d::selectRaw('sum(jumlah_sp2d)as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')
            ->whereMonth('tanggal_sp2d', '<=', $bulan)->whereYear('tanggal_sp2d', $tahun)->first();

        return $kolom->jumlah;
    }

    private function kolom16($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Spj::selectRaw('(sum(debet)-sum(kredit))as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')->where('kode_kelompok', '1')
            ->whereMonth('tanggal_spj', '<=', $bulan)->whereYear('tanggal_spj', $tahun)
            ->whereIn('jenis_transaksi', ['58','80','83','84','85','86','87'])->first();

        return $kolom->jumlah;
    }

    private function kolom17($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Spj::selectRaw('(sum(debet)-sum(kredit))as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')->where('kode_kelompok', '2')
            ->whereMonth('tanggal_spj', '<=', $bulan)->whereYear('tanggal_spj', $tahun)
            ->whereIn('jenis_transaksi', ['58','80','83','84','85','86','87'])->first();

        return $kolom->jumlah;
    }

    private function kolom18($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Spj::selectRaw('(sum(debet)-sum(kredit))as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')
            ->whereMonth('tanggal_spj', '<=', $bulan)->whereYear('tanggal_spj', $tahun)
            ->whereIn('jenis_transaksi', ['58','80','83','84','85','86','87'])->first();

        return $kolom->jumlah;
    }

    private function kolom22($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Spj::selectRaw('(sum(debet)-sum(kredit))as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')->where('kode_kelompok', '2')
            ->whereMonth('tanggal_spj', '<=', $bulan)->whereYear('tanggal_spj', $tahun)
            ->whereIn('jenis_transaksi', ['64'])->first();

        return $kolom->jumlah;
    }

    private function kolom24($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Spj::selectRaw('(sum(debet)-sum(kredit))as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')->where('kode_kelompok', '1')
            ->whereMonth('tanggal_spj', '<=', $bulan)->whereYear('tanggal_spj', $tahun)
            ->whereIn('jenis_transaksi', ['58','80','83','84','85','86','87','64'])->first();

        return $kolom->jumlah;
    }

    private function kolom25($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Spj::selectRaw('(sum(debet)-sum(kredit))as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')->where('kode_kelompok', '2')
            ->whereMonth('tanggal_spj', '<=', $bulan)->whereYear('tanggal_spj', $tahun)
            ->whereIn('jenis_transaksi', ['58','80','83','84','85','86','87','64'])->first();

        return $kolom->jumlah;
    }

    private function kolom26($kodeOrganisasi, $bulan, $tahun)
    {
        $kolom = Spj::selectRaw('(sum(debet)-sum(kredit))as jumlah')->where('kode_opd', $kodeOrganisasi)
            ->whereRaw('length(kode_rekening) = "35"')->where('kode_akun', '5')
            ->whereMonth('tanggal_spj', '<=', $bulan)->whereYear('tanggal_spj', $tahun)
            ->whereIn('jenis_transaksi', ['58','80','83','84','85','86','87','64'])->first();

        return $kolom->jumlah;
    }
}
