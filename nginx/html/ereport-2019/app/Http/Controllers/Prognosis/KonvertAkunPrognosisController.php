<?php

namespace App\Http\Controllers\Prognosis;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Kode\KodeAkun;
use App\Models\Akuntansi\ProsesPrognosis;
use App\Models\Kode\KodeAkunPrognosis;
use App\Models\Kode\KodeOrganisasi;
use Illuminate\Support\Facades\Auth;
use App\Jobs\Prognosis\ProsesPrognosisJob;
use App\Models\Pengaturan\Pengguna;

class KonvertAkunPrognosisController extends Controller
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
        $listPengguna = null;

        $queryProsesPrognosis = ProsesPrognosis::orderBy('id', 'desc');
        (!empty($this->cari))?$queryProsesPrognosis->CariProsesPrognosis($this->cari):'';
        $queryProsesPrognosis->ViewPengguna();
        $listProsesPrognosis = $queryProsesPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listProsesPrognosis->setPath('konvert-akun-prognosis'.$var['url']['cari']):'';

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            $listPengguna = ['semua' => 'Semua Organisasi / User'];
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.konvert-akun.konvert-akun-tabel', compact('var', 'listProsesPrognosis', 'listPengguna'));
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
            if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
                $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi];
            }else if(Auth::user()->view == 1){
                if($request->kode_pengguna != 'semua'){
                    $inputBy = $request->kode_pengguna;
                    $pengguna = Pengguna::find($request->kode_pengguna);
                    $kodeOrganisasi = $pengguna->organisasi;
                    $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi];
                }else if($request->kode_pengguna == 'semua'){
                    $organisasi = KodeOrganisasi::get();
                    foreach($organisasi as $item){
                        $listDataUser[] = ['inputBy'=>Auth::user()->kode_pengguna, 'kodeOrganisasi'=>$item['kode_organisasi']];
                    }
                }
            }
            $tahun = $request->tahun;

            foreach($listDataUser as $itemUser){
                $prosesPrognosis = new ProsesPrognosis();
                $prosesPrognosis->status = 'Berjalan';
                $prosesPrognosis->tahun = $tahun;
                $prosesPrognosis->kode_organisasi = $itemUser['kodeOrganisasi'];
                $prosesPrognosis->kode_pengguna = $itemUser['inputBy'];
                $prosesPrognosis->save();

                $idProsesPrognosis = $prosesPrognosis->id;

                $dataQueue = [
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'],
                    'tahun' => $tahun, 'idProsesPrognosis' => $idProsesPrognosis
                ];
                ProsesPrognosisJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Data Kode Akun Prognosis Sedang Diproses');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Kode Akun Prognosis Gagal Diproses');
            return redirect('prognosis/konvert-akun-prognosis')->withInput();
        }

        return redirect('prognosis/konvert-akun-prognosis');
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
