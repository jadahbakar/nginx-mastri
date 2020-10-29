<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Spj;

class DataSpjController extends Controller
{
    private $url;
    private $cari;
    private $jumPerPage = 10;

    function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->cari = Input::get('cari', '');
        $this->url = makeUrl($request->query());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var['url'] = $this->url;

        $query = Spj::orderBy('id', 'desc');
        (!empty($this->cari))?$query->Cari($this->cari):'';
        $listSpj = $query->paginate($this->jumPerPage);
        (!empty($this->cari))?$listSpj->setPath('data-spj'.$var['url']['cari']):'';

        return view('data-spj.data-spj-1', compact('var', 'listSpj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $listSpJ_1 = DB::connection('mysql3')
                ->select('SELECT a.no_trans,YEAR(a.tanggal_transaksi) AS tahunAnggaran,a.tanggal_transaksi AS tanggalSPJ,
                    a.jenis_transaksi AS jenisTransaksi, a.jenis AS jenisSPJ,SUBSTRING(a.kode_rekening,1,6) AS kodeUrusan,
                    SUBSTRING(a.kode_rekening,8,9) AS kodeOPD, SUBSTRING(a.kode_rekening,18,2) AS kodeProgram,
                    SUBSTRING(a.kode_rekening,21,3) AS kodeKegiatan,SUBSTRING(a.kode_rekening,25,1) AS kodeAkun,
                    SUBSTRING(a.kode_rekening,27,1) AS kodeKelompok,SUBSTRING(a.kode_rekening,29,1) AS kodeJenis,
                    SUBSTRING(a.kode_rekening,21,2) AS kodeObjek,SUBSTRING(a.kode_rekening,34,2) AS kodeRincian,
                    a.kode_rekening AS kodeRekening,a.jumlah AS debet,0 AS kredit
                    FROM pengeluaran a
                    WHERE a.jenis_transaksi IN ("58","80","84","85","86","87") AND YEAR(a.tanggal_transaksi)="'.$request->tahun.'"
                    and a.diambil="0" ORDER BY tanggalSPJ,kodeOPD');

            foreach($listSpJ_1 as $item){
                $deleteSpj = Spj::where('no_transaksi', $item->no_trans)->delete();

                $spj = new Spj();
                $spj->no_transaksi = $item->no_trans;
                $spj->tahun_anggaran = $item->tahunAnggaran;
                $spj->tanggal_spj = $item->tanggalSPJ;
                $spj->jenis_transaksi = $item->jenisTransaksi;
                $spj->jenis_spj = $item->jenisSPJ;
                $spj->kode_urusan = $item->kodeUrusan;
                $spj->kode_opd = $item->kodeOPD;
                $spj->kode_program = $item->kodeProgram;
                $spj->kode_kegiatan = $item->kodeKegiatan;
                $spj->kode_akun = $item->kodeAkun;
                $spj->kode_kelompok = $item->kodeKelompok;
                $spj->kode_jenis = $item->kodeJenis;
                $spj->kode_objek = $item->kodeObjek;
                $spj->kode_rincian = $item->kodeRincian;
                $spj->kode_rekening = $item->kodeRekening;
                $spj->debet = $item->debet;
                $spj->kredit = $item->kredit;
                $spj->input_by = Auth::user()->id;
                $spj->save();

                DB::connection('mysql3')->statement('update pengeluaran set diambil="1" where no_trans="'.$item->no_trans.'"');
            }

            $listSpJ_2 = DB::connection('mysql3')
                ->select('SELECT a.no_trans,YEAR(a.tanggal_transaksi) AS tahunAnggaran,a.tanggal_transaksi AS tanggalSPJ,
                    a.jenis_transaksi AS jenisTransaksi, a.jenis AS jenisSPJ,SUBSTRING(a.kode_rekening,1,6) AS kodeUrusan,
                    SUBSTRING(a.kode_rekening,8,9) AS kodeOPD, SUBSTRING(a.kode_rekening,18,2) AS kodeProgram,
                    SUBSTRING(a.kode_rekening,21,3) AS kodeKegiatan,SUBSTRING(a.kode_rekening,25,1) AS kodeAkun,
                    SUBSTRING(a.kode_rekening,27,1) AS kodeKelompok,SUBSTRING(a.kode_rekening,29,1) AS kodeJenis,
                    SUBSTRING(a.kode_rekening,21,2) AS kodeObjek,SUBSTRING(a.kode_rekening,34,2) AS kodeRincian,
                    a.kode_rekening AS kodeRekening,0 AS debet,a.jumlah AS kredit
                    FROM pengeluaran a
                    WHERE a.jenis_transaksi="83" AND YEAR(a.tanggal_transaksi)="'.$request->tahun.'" and a.diambil="0"
                    ORDER BY tanggalSPJ,kodeOPD');

            foreach($listSpJ_2 as $item){
                $deleteSpj = Spj::where('no_transaksi', $item->no_trans)->delete();

                $spj = new Spj();
                $spj->no_transaksi = $item->no_trans;
                $spj->tahun_anggaran = $item->tahunAnggaran;
                $spj->tanggal_spj = $item->tanggalSPJ;
                $spj->jenis_transaksi = $item->jenisTransaksi;
                $spj->jenis_spj = $item->jenisSPJ;
                $spj->kode_urusan = $item->kodeUrusan;
                $spj->kode_opd = $item->kodeOPD;
                $spj->kode_program = $item->kodeProgram;
                $spj->kode_kegiatan = $item->kodeKegiatan;
                $spj->kode_akun = $item->kodeAkun;
                $spj->kode_kelompok = $item->kodeKelompok;
                $spj->kode_jenis = $item->kodeJenis;
                $spj->kode_objek = $item->kodeObjek;
                $spj->kode_rincian = $item->kodeRincian;
                $spj->kode_rekening = $item->kodeRekening;
                $spj->debet = $item->debet;
                $spj->kredit = $item->kredit;
                $spj->input_by = Auth::user()->id;
                $spj->save();

                DB::connection('mysql3')->statement('update pengeluaran set diambil="1" where no_trans="'.$item->no_trans.'"');
            }

            $listSpJ_3 = DB::connection('mysql3')
                ->select('SELECT a.no_transaksi,YEAR(a.tanggal) AS tahunAnggaran,a.tanggal AS tanggalSPJ,a.jenis_transaksi AS jenisTransaksi,
                    "7" AS jenisSPJ, SUBSTRING(a.akun_debet_lra13,1,6) AS kodeUrusan,SUBSTRING(a.akun_debet_lra13,8,9) AS kodeOPD,
                    SUBSTRING(a.akun_debet_lra13,18,2) AS kodeProgram, SUBSTRING(a.akun_debet_lra13,21,3) AS kodeKegiatan,
                    SUBSTRING(a.akun_debet_lra13,25,1) AS kodeAkun,SUBSTRING(a.akun_debet_lra13,27,2) AS kodeKelompok,
                    SUBSTRING(a.akun_debet_lra13,29,1) AS kodeJenis,SUBSTRING(a.akun_debet_lra13,21,2) AS kodeObjek,
                    SUBSTRING(a.akun_debet_lra13,34,2) AS kodeRincian,a.akun_debet_lra13 AS kodeRekening,
                    a.jumlah AS debet,0 AS kredit
                    FROM akuntansi a
                    WHERE YEAR(a.tanggal)="'.$request->tahun.'" AND a.jenis_transaksi="64" AND SUBSTRING(a.akun_debet_lra13,25,1)="5" 
                    and a.diambil="0" ORDER BY tanggalSPJ,kodeOPD');

            foreach($listSpJ_3 as $item){
                $deleteSpj = Spj::where('no_transaksi', $item->no_transaksi)->delete();

                $spj = new Spj();
                $spj->no_transaksi = $item->no_transaksi;
                $spj->tahun_anggaran = $item->tahunAnggaran;
                $spj->tanggal_spj = $item->tanggalSPJ;
                $spj->jenis_transaksi = $item->jenisTransaksi;
                $spj->jenis_spj = $item->jenisSPJ;
                $spj->kode_urusan = $item->kodeUrusan;
                $spj->kode_opd = $item->kodeOPD;
                $spj->kode_program = $item->kodeProgram;
                $spj->kode_kegiatan = $item->kodeKegiatan;
                $spj->kode_akun = $item->kodeAkun;
                $spj->kode_kelompok = $item->kodeKelompok;
                $spj->kode_jenis = $item->kodeJenis;
                $spj->kode_objek = $item->kodeObjek;
                $spj->kode_rincian = $item->kodeRincian;
                $spj->kode_rekening = $item->kodeRekening;
                $spj->debet = $item->debet;
                $spj->kredit = $item->kredit;
                $spj->input_by = Auth::user()->id;
                $spj->save();

                DB::connection('mysql3')->statement('update akuntansi set diambil="1" where no_transaksi="'.$item->no_transaksi.'"');
            }

            $listSpJ_4 = DB::connection('mysql3')
                ->select('SELECT a.no_transaksi,YEAR(a.tanggal) AS tahunAnggaran,a.tanggal AS tanggalSPJ,a.jenis_transaksi AS jenisTransaksi,
                    "7" AS jenisSPJ, SUBSTRING(a.akun_debet_lra13,1,6) AS kodeUrusan,SUBSTRING(a.akun_debet_lra13,8,9) AS kodeOPD,
                    SUBSTRING(a.akun_debet_lra13,18,2) AS kodeProgram, SUBSTRING(a.akun_debet_lra13,21,3) AS kodeKegiatan,
                    SUBSTRING(a.akun_debet_lra13,25,1) AS kodeAkun,SUBSTRING(a.akun_debet_lra13,27,2) AS kodeKelompok,
                    SUBSTRING(a.akun_debet_lra13,29,1) AS kodeJenis,SUBSTRING(a.akun_debet_lra13,21,2) AS kodeObjek,
                    SUBSTRING(a.akun_debet_lra13,34,2) AS kodeRincian,a.akun_debet_lra13 AS kodeRekening,
                    0 AS debet,a.jumlah AS kredit
                    FROM akuntansi a
                    WHERE YEAR(a.tanggal)="'.$request->tahun.'" AND a.jenis_transaksi="64" AND SUBSTRING(a.akun_kredit_lra13,25,1)="5" 
                    and a.diambil="0" ORDER BY tanggalSPJ,kodeOPD');

            foreach($listSpJ_4 as $item){
                $deleteSpj = Spj::where('no_transaksi', $item->no_transaksi)->delete();

                $spj = new Spj();
                $spj->no_transaksi = $item->no_transaksi;
                $spj->tahun_anggaran = $item->tahunAnggaran;
                $spj->tanggal_spj = $item->tanggalSPJ;
                $spj->jenis_transaksi = $item->jenisTransaksi;
                $spj->jenis_spj = $item->jenisSPJ;
                $spj->kode_urusan = $item->kodeUrusan;
                $spj->kode_opd = $item->kodeOPD;
                $spj->kode_program = $item->kodeProgram;
                $spj->kode_kegiatan = $item->kodeKegiatan;
                $spj->kode_akun = $item->kodeAkun;
                $spj->kode_kelompok = $item->kodeKelompok;
                $spj->kode_jenis = $item->kodeJenis;
                $spj->kode_objek = $item->kodeObjek;
                $spj->kode_rincian = $item->kodeRincian;
                $spj->kode_rekening = $item->kodeRekening;
                $spj->debet = $item->debet;
                $spj->kredit = $item->kredit;
                $spj->input_by = Auth::user()->id;
                $spj->save();

                DB::connection('mysql3')->statement('update akuntansi set diambil="1" where no_transaksi="'.$item->no_transaksi.'"');
            }

            Session::flash('pesanSukses', 'Data SPJ Berhasil Disimpan ...');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data SPJ Gagal Disimpan ...');
            return redirect('data-spj')->withInput();
        }

        return redirect('data-spj');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
