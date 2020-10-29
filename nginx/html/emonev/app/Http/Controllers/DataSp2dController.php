<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Sp2d;

class DataSp2dController extends Controller
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

        $query = Sp2d::orderBy('id', 'desc');
        (!empty($this->cari))?$query->Cari($this->cari):'';
        $listSp2d = $query->paginate($this->jumPerPage);
        (!empty($this->cari))?$listSp2d->setPath('data-sp2d'.$var['url']['cari']):'';

        return view('data-sp2d.data-sp2d-1', compact('var', 'listSp2d'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            $listSp2d = DB::connection('mysql2')
                ->select('SELECT a.id, a.tahun_anggaran AS tahunAnggaran, a.tanggal_sp2d AS tanggalSP2D, a.jenis_sp2d AS jenisSP2D,
                    SUBSTRING(b.kode_rekening,1,6) AS kodeUrusan, SUBSTRING(b.kode_rekening,8,9) AS kodeOPD,
                    SUBSTRING(b.kode_rekening,18,2) AS kodeProgram,SUBSTRING(b.kode_rekening,21,3) AS kodeKegiatan,
                    SUBSTRING(b.kode_rekening,25,1) AS kodeAkun,SUBSTRING(b.kode_rekening,27,1) AS kodeKelompok,
                    SUBSTRING(b.kode_rekening,29,1) AS kodeJenis, SUBSTRING(b.kode_rekening,31,2) AS kodeObjek,
                    SUBSTRING(b.kode_rekening,34,2) AS kodeRincian, b.kode_rekening AS kodeRekening,b.jml_pengajuan AS jumlahSP2D
                    FROM sp2d a,spp_up_rincian b
                    WHERE a.tahun_anggaran="'.$request->tahun.'" AND a.nomor_spp=b.no_spp AND a.jenis_sp2d IN ("2","3","4")
                    and a.diambil="0" ORDER BY tanggalSP2D, kodeOPD');

            foreach($listSp2d as $item){
                $sp2d = new Sp2d();
                $sp2d->sp2d_id = $item->id;
                $sp2d->tahun_anggaran = $item->tahunAnggaran;
                $sp2d->tanggal_sp2d = $item->tanggalSP2D;
                $sp2d->jenis_sp2d = $item->jenisSP2D;
                $sp2d->kode_urusan = $item->kodeUrusan;
                $sp2d->kode_opd = $item->kodeOPD;
                $sp2d->kode_program = $item->kodeProgram;
                $sp2d->kode_kegiatan = $item->kodeKegiatan;
                $sp2d->kode_akun = $item->kodeAkun;
                $sp2d->kode_kelompok = $item->kodeKelompok;
                $sp2d->kode_jenis = $item->kodeJenis;
                $sp2d->kode_objek = $item->kodeObjek;
                $sp2d->kode_rincian = $item->kodeRincian;
                $sp2d->kode_rekening = $item->kodeRekening;
                $sp2d->jumlah_sp2d = $item->jumlahSP2D;
                $sp2d->input_by = Auth::user()->id;
                $sp2d->save();

                DB::connection('mysql2')->statement('update sp2d set diambil="1" where id="'.$item->id.'"');
            }

            $listSp2dUp = DB::connection('mysql2')
                ->select('SELECT a.id,a.tahun_anggaran AS tahunAnggaran, a.tanggal_sp2d AS tanggalSP2D, a.jenis_sp2d AS jenisSP2D,
                    SUBSTRING(a.kode_skpd,1,6) AS kodeUrusan, a.kode_skpd AS kodeOPD,"00" AS kodeProgram, "000" AS kodeKegiatan,
                        "1" AS kodeAkun, "1" AS kodeKelompok, "1" AS kodeJenis, "03" AS kodeObjek, "01" AS kodeRincian,
                        CONCAT(SUBSTRING(a.kode_skpd,1,6)," ", a.kode_skpd," ","00"," ","000"," ","1"," ","1"," ","1"," ","03"," ","01") 
                        AS kodeRekening, a.jml_pengajuan AS jumlahSP2D
                        FROM sp2d a
                        WHERE a.tahun_anggaran="'.$request->tahun.'" AND a.jenis_sp2d="1" and a.diambil="0"
                        ORDER BY tanggalSP2D,kodeOPD');

            foreach($listSp2dUp as $item){
                $sp2d = new Sp2d();
                $sp2d->sp2d_id = $item->id;
                $sp2d->tahun_anggaran = $item->tahunAnggaran;
                $sp2d->tanggal_sp2d = $item->tanggalSP2D;
                $sp2d->jenis_sp2d = $item->jenisSP2D;
                $sp2d->kode_urusan = $item->kodeUrusan;
                $sp2d->kode_opd = $item->kodeOPD;
                $sp2d->kode_program = $item->kodeProgram;
                $sp2d->kode_kegiatan = $item->kodeKegiatan;
                $sp2d->kode_akun = $item->kodeAkun;
                $sp2d->kode_kelompok = $item->kodeKelompok;
                $sp2d->kode_jenis = $item->kodeJenis;
                $sp2d->kode_objek = $item->kodeObjek;
                $sp2d->kode_rincian = $item->kodeRincian;
                $sp2d->kode_rekening = $item->kodeRekening;
                $sp2d->jumlah_sp2d = $item->jumlahSP2D;
                $sp2d->input_by = Auth::user()->id;
                $sp2d->save();

                DB::connection('mysql2')->statement('update sp2d set diambil="1" where id="'.$item->id.'"');
            }

            Session::flash('pesanSukses', 'Data SP2D Berhasil Disimpan ...');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data SP2D Gagal Disimpan ...');
            return redirect('data-sp2d')->withInput();
        }

        return redirect('data-sp2d');
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
