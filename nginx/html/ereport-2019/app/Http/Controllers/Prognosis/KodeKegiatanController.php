<?php

namespace App\Http\Controllers\Prognosis;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kode\KodeOrganisasi;
use App\Models\Kode\KodeAkun;
use App\Models\Kode\KodeKegiatanPrognosis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\Pengaturan\Pengguna;

class KodeKegiatanController extends Controller
{
    private $url;
    private $cari;
    private $jumPerPage = 10;
    private $jumPerModal = 6;

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

        $queryKodeKegiatanPrognosis = KodeKegiatanPrognosis::orderBy('id', 'desc')->where('jenis', 'baru');
        (!empty($this->cari))?$queryKodeKegiatanPrognosis->CariKodeKegiatanPrognosis($this->cari):'';
        $queryKodeKegiatanPrognosis->ViewPengguna();
        $listKodeKegiatan = $queryKodeKegiatanPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listKodeKegiatan->setPath('kode-kegiatan'.$var['url']['cari']):'';

        return view('prognosis.kode-kegiatan.kode-kegiatan-tabel', compact('var', 'listKodeKegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $var['method'] = 'create';
        $listPengguna = null;

        //kode organisasi
        if(Auth::user()->view == 2){
            $kodeOrganisasi = KodeOrganisasi::find(Auth::user()->organisasi);
            $var['kode_organisasi'] = $kodeOrganisasi['kode_organisasi'];
            $var['nama_organisasi'] = $kodeOrganisasi['nama_organisasi'];
        }else if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.kode-kegiatan.kode-kegiatan-form', compact('var', 'listPengguna'));
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
            if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
            }else if(Auth::user()->view == 1){
                $inputBy = $request->kode_pengguna;
                $kodeOrganisasi = $request->kode_organisasi;
            }
            $kodeKegiatanFull = $request->kode_program." ".$request->kode_kegiatan;

            $kodeKegiatanPrognosis = new KodeKegiatanPrognosis();
            $kodeKegiatanPrognosis->jenis = 'baru';
            $kodeKegiatanPrognosis->kode_pengguna = $inputBy;
            $kodeKegiatanPrognosis->kode_program = $request->kode_program;
            $kodeKegiatanPrognosis->uraian_program = $request->uraian_program;
            $kodeKegiatanPrognosis->kode_kegiatan = $request->kode_kegiatan;
            $kodeKegiatanPrognosis->uraian_kegiatan = $request->uraian_kegiatan;
            $kodeKegiatanPrognosis->kode_organisasi = $kodeOrganisasi;
            $kodeKegiatanPrognosis->kode_kegiatan_full = $kodeKegiatanFull;
            $kodeKegiatanPrognosis->save();

            Session::flash('pesanSukses', 'Data Kode Kegiatan Prognosis Berhasil Disimpan');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Kode Kegiatan Prognosis Gagal Disimpan');
            return redirect('prognosis/kode-kegiatan/create')->withInput();
        }

        return redirect('prognosis/kode-kegiatan/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $var['url'] = $this->url;
        $var['method'] = 'show';
        $listPengguna = null;
        $listKodeKegiatan = KodeKegiatanPrognosis::find($id);

        $namaOrganisasi = KodeOrganisasi::find($listKodeKegiatan->kode_organisasi);
        $listKodeKegiatan['nama_organisasi'] = $namaOrganisasi->nama_organisasi;

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.kode-kegiatan.kode-kegiatan-form', compact('listKodeKegiatan', 'var', 'listPengguna'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $var['url'] = $this->url;
        $var['method'] = 'edit';
        $listPengguna = null;
        $listKodeKegiatan = KodeKegiatanPrognosis::find($id);

        $namaOrganisasi = KodeOrganisasi::find($listKodeKegiatan->kode_organisasi);
        $listKodeKegiatan['nama_organisasi'] = $namaOrganisasi->nama_organisasi;

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.kode-kegiatan.kode-kegiatan-form', compact('listKodeKegiatan', 'var', 'listPengguna'));
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
        $var['url'] = $this->url;

        try {
            if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
            }else if(Auth::user()->view == 1){
                $inputBy = $request->kode_pengguna;
                $kodeOrganisasi = $request->kode_organisasi;
            }
            $kodeKegiatanFull = $request->kode_program." ".$request->kode_kegiatan;

            $kodeKegiatanPrognosis = KodeKegiatanPrognosis::find($id);
            $kodeKegiatanPrognosis->kode_pengguna = $inputBy;
            $kodeKegiatanPrognosis->kode_program = $request->kode_program;
            $kodeKegiatanPrognosis->uraian_program = $request->uraian_program;
            $kodeKegiatanPrognosis->kode_kegiatan = $request->kode_kegiatan;
            $kodeKegiatanPrognosis->uraian_kegiatan = $request->uraian_kegiatan;
            $kodeKegiatanPrognosis->kode_organisasi = $kodeOrganisasi;
            $kodeKegiatanPrognosis->kode_kegiatan_full = $kodeKegiatanFull;
            $kodeKegiatanPrognosis->save();

            Session::flash('pesanSukses', 'Data Kode Kegiatan Prognosis Berhasil Diupdate');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Kode Kegiatan Prognosis Gagal Diupdate');
        }

        return redirect('prognosis/kode-kegiatan'.$var['url']['all']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $var['url'] = $this->url;

        try {
            $kodeKegiatanPrognosis = KodeKegiatanPrognosis::find($id)->delete();

            if($request->nomor == 1){
                $input = $request->query();
                $input['page'] = 1;
                $var['url'] = makeUrl($input);
            }

            Session::flash('pesanSukses', 'Data Kode Kegiatan Prognosis Berhasil Dihapus ...');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Kode Kegiatan Prognosis Gagal Dihapus ...');
        }

        return redirect('prognosis/kode-kegiatan'.$var['url']['all']);
    }

    public function getListKodeProgram(Request $request)
    {
        $queryKodeProgram = KodeAkun::orderBy('kdRekening', 'asc')->whereRaw('length(kdRekening) = 19');
        if(Auth::user()->view == 2){
            $queryKodeProgram->whereRaw('substring(kdRekening,8,9)="'.Auth::user()->organisasi.'"');
        }else if(Auth::user()->view == 1){
            if($request->kodePengguna != ''){
                $pengguna = Pengguna::find($request->kodePengguna);
                $queryKodeProgram->whereRaw('substring(kdRekening,8,9)="'.$pengguna['organisasi'].'"');
            }
        }
        (!empty($this->cari))?$queryKodeProgram->CariModalKodeProgramPrognosis($this->cari):'';
        $listKodeProgram = $queryKodeProgram->paginate($this->jumPerModal);

        return view('prognosis.kode-kegiatan.kode-program', compact('listKodeProgram'));
    }

    public function getKodeProgram(Request $request)
    {
        $kodeProgram = KodeAkun::find($request->id);
        return response()->json($kodeProgram);
    }

    public function getOrganisasi(Request $request)
    {
        $pengguna = Pengguna::find($request->kodePengguna);
        $organisasi = KodeOrganisasi::find($pengguna['organisasi']);
        return response()->json($organisasi);
    }
}
