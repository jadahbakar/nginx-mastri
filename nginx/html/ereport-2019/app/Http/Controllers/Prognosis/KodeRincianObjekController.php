<?php

namespace App\Http\Controllers\Prognosis;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Models\Kode\KodeOrganisasi;
use App\Models\Kode\KodeAkunPrognosis;
use App\Models\Kode\KodeKegiatanPrognosis;
use App\Models\Kode\MasterAkunBas;
use App\Models\Kode\KodeAkun;
use App\Models\Pengaturan\Pengguna;

class KodeRincianObjekController extends Controller
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

        $queryKodeRincianObjekPrognosis = KodeAkunPrognosis::orderByRaw('cast(replace(substring(kdRekening,18,18)," ","")as signed) asc')
            ->whereRaw('length(kdRekening) = 35');
        (!empty($this->cari))?$queryKodeRincianObjekPrognosis->CariKodeRincianObjekPrognosis($this->cari):'';
        $queryKodeRincianObjekPrognosis->ViewPengguna();
        $listKodeRincianObjekPrognosis = $queryKodeRincianObjekPrognosis->paginate($this->jumPerPage);

        return view('prognosis.kode-rincian-objek.kode-rincian-objek-tabel', compact('var', 'listKodeRincianObjekPrognosis', 'helper'));
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

        return view('prognosis.kode-rincian-objek.kode-rincian-objek-form', compact('var', 'listPengguna'));
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
                $kodeLapor = Auth::user()->kode_lapor;
                $kodeOrganisasiUser = Auth::user()->organisasi;
            }else if(Auth::user()->view == 1){
                $inputBy = $request->kode_pengguna;
                $pengguna = Pengguna::find($request->kode_pengguna);
                $kodeLapor = $pengguna->kode_lapor;
                $kodeOrganisasiUser = $request->kode_organisasi;
            }

            $kodeRekeningFull = $request->kode_kegiatan." ".$request->kode_rincian_objek;
            $kodeUrusan = substr($kodeRekeningFull,0,6);
            $kodeOrganisasi = substr($kodeRekeningFull,0,16);
            $kodeProgram = substr($kodeRekeningFull,0,19);
            $kodeKegiatan = substr($kodeRekeningFull,0,23);
            $kodeAkunUtama = substr($kodeRekeningFull,0,25);
            $kodeAkunKelompok = substr($kodeRekeningFull,0,27);
            $kodeAkunJenis = substr($kodeRekeningFull,0,29);
            $kodeAkunObjek = substr($kodeRekeningFull,0,32);

            $arrKode = [0=>$kodeUrusan, 1=>$kodeOrganisasi, 2=>$kodeProgram, 3=>$kodeKegiatan, 4=>$kodeAkunUtama, 5=>$kodeAkunKelompok,
                    6=>$kodeAkunJenis, 7=>$kodeAkunObjek, 8=>$kodeRekeningFull];

            foreach($arrKode as $key=>$value){
                $kodeAkunPrognosis = KodeAkunPrognosis::find($value);

                if($kodeAkunPrognosis['kdRekening'] == ''){
                    if(strlen($value) <= 23){
                        $sqlNamaRekening = KodeAkun::find($value);

                        if($sqlNamaRekening['kdRekening'] != ''){
                            $namaRekening = $sqlNamaRekening['nmRekening'];
                        }else{
                            $sqlKodeKegiatanPrognosis = KodeKegiatanPrognosis::where('kode_kegiatan_full', $value)->first();
                            $namaRekening = $sqlKodeKegiatanPrognosis['uraian_kegiatan'];
                        }
                    }else{
                        $kodePotong = substr($value,24);
                        $sqlNamaRekening = MasterAkunBas::where('akun_bas', $kodePotong)->where('jenis_akun', 'LRA 13')->first();
                        $namaRekening = $sqlNamaRekening['nama_akun'];
                    }

                    $kodeAkunPrognosis = new KodeAkunPrognosis();
                    $kodeAkunPrognosis->kdRekening = $value;
                    $kodeAkunPrognosis->nmRekening = $namaRekening;
                    if(strlen($value) >= 23) $kodeAkunPrognosis->kode_kegiatan = $request->kode_kegiatan;
                    if(strlen($value) >= 35) $kodeAkunPrognosis->kode_rincian_objek = $request->kode_rincian_objek;
                    $kodeAkunPrognosis->kdLapor = $kodeLapor;
                    $kodeAkunPrognosis->kdOrganisasi = $kodeOrganisasiUser;
                    $kodeAkunPrognosis->anggaran = $request->anggaran;
                    $kodeAkunPrognosis->jenis_input = 'Form';
                    $kodeAkunPrognosis->kode_organisasi = $kodeOrganisasiUser;
                    $kodeAkunPrognosis->kode_pengguna = $inputBy;
                    $kodeAkunPrognosis->save();
                }
            }

            Session::flash('pesanSukses', 'Data Kode Rincian Objek Prognosis Berhasil Disimpan');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Kode Rincian Objek Prognosis Gagal Disimpan');
            return redirect('prognosis/kode-rincian-objek/create')->withInput();
        }

        return redirect('prognosis/kode-rincian-objek/create');
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
        $var['url'] = $this->url;
        $var['method'] = 'edit';
        $listPengguna = null;

        $listKodeAkunPrognosis = KodeAkunPrognosis::find($id);
        $kodeKegiatanPrognosis = KodeKegiatanPrognosis::where('kode_kegiatan_full', $listKodeAkunPrognosis->kode_kegiatan)->first();
        $listKodeAkunPrognosis['uraian_kode_kegiatan'] = $kodeKegiatanPrognosis['uraian_kegiatan'];
        $listKodeAkunPrognosis['uraian_kode_rincian_objek'] = $listKodeAkunPrognosis->nmRekening;
        $namaOrganisasi = KodeOrganisasi::find($listKodeAkunPrognosis->kdOrganisasi);
        $listKodeAkunPrognosis['nama_organisasi'] = $namaOrganisasi->nama_organisasi;
        $listKodeAkunPrognosis['kode_organisasi'] = $listKodeAkunPrognosis->kdOrganisasi;

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.kode-rincian-objek.kode-rincian-objek-form', compact('listKodeAkunPrognosis', 'var', 'listPengguna'));
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
                $kodeLapor = Auth::user()->kode_lapor;
                $kodeOrganisasiUser = Auth::user()->organisasi;
            }else if(Auth::user()->view == 1){
                $dataUser = KodeAkunPrognosis::find($id);
                $inputBy = $dataUser->kode_pengguna;
                $pengguna = Pengguna::find($dataUser->kode_pengguna);
                $kodeLapor = $pengguna->kode_lapor;
                $kodeOrganisasiUser = $dataUser->kode_organisasi;
            }
            $kodeKegiatanFull = $request->kode_program." ".$request->kode_kegiatan;

            $kodeAkunPrognosis = KodeAkunPrognosis::find($id);
            $kodeAkunPrognosis->kdLapor = $kodeLapor;
            $kodeAkunPrognosis->kdOrganisasi = $kodeOrganisasiUser;
            $kodeAkunPrognosis->anggaran = $request->anggaran;
            $kodeAkunPrognosis->realisasi = $request->realisasi;
            $kodeAkunPrognosis->sisa = $request->sisa;
            $kodeAkunPrognosis->tambah_kurang = $request->tambah_kurang;
            $kodeAkunPrognosis->jumlah = $request->jumlah;
            $kodeAkunPrognosis->kode_organisasi = $kodeOrganisasiUser;
            $kodeAkunPrognosis->kode_pengguna = $inputBy;
            $kodeAkunPrognosis->save();

            Session::flash('pesanSukses', 'Data Kode Rincian Objek Prognosis Berhasil Diupdate');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Kode Rincian Objek Prognosis Gagal Diupdate');
        }

        return redirect('prognosis/kode-rincian-objek'.$var['url']['all']);
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

    public function getListKodeKegiatan(Request $request)
    {
        $queryKodeKegiatanPrognosis = KodeKegiatanPrognosis::orderBy('id', 'desc');
        if(Auth::user()->view == 2){
            $queryKodeKegiatanPrognosis->where('kode_organisasi', Auth::user()->organisasi);
        }else if(Auth::user()->view == 1){
            if($request->kodePengguna != ''){
                $pengguna = Pengguna::find($request->kodePengguna);
                $queryKodeKegiatanPrognosis->where('kode_organisasi', $pengguna['organisasi']);
            }
        }
        (!empty($this->cari))?$queryKodeKegiatanPrognosis->CariModalKodeKegiatanPrognosis($this->cari):'';
        $listKodeKegiatanPrognosis = $queryKodeKegiatanPrognosis->paginate($this->jumPerModal);

        return view('prognosis.kode-rincian-objek.kode-kegiatan', compact('listKodeKegiatanPrognosis'));
    }

    public function getKodeKegiatan(Request $request)
    {
        $kodeKegiatan = KodeKegiatanPrognosis::find($request->id);
        return response()->json($kodeKegiatan);
    }

    public function getListKodeRincianObjek(Request $request)
    {
        $queryKodeRincianObjek = MasterAkunBas::orderBy('id', 'asc')->whereRaw('length(akun_bas) = 11')->where('jenis_akun', 'LRA 13');
        (!empty($this->cari))?$queryKodeRincianObjek->CariModalMasterAkunBas($this->cari):'';
        $listKodeRincianObjek = $queryKodeRincianObjek->paginate($this->jumPerModal);

        return view('prognosis.kode-rincian-objek.kode-rincian-objek', compact('listKodeRincianObjek'));
    }

    public function getKodeRincianObjek(Request $request)
    {
        $kodeRincianObjek = MasterAkunBas::find($request->id);
        return response()->json($kodeRincianObjek);
    }

    public function getOrganisasi(Request $request)
    {
        $pengguna = Pengguna::find($request->kodePengguna);
        $organisasi = KodeOrganisasi::find($pengguna['organisasi']);
        return response()->json($organisasi);
    }
}
