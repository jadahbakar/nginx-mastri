<?php

namespace App\Http\Controllers\Prognosis;

use Session;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kode\KodeOrganisasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Prognosis\Helper\PrognosisHelper;
use App\Jobs\Prognosis\LaporanPrognosisSapJob;
use App\Jobs\Prognosis\LaporanPrognosisPermenJob;
use App\Jobs\Prognosis\LaporanRincianPrognosisJob;
use App\Jobs\Prognosis\LaporanPenjabaranPrognosisJob;
use App\Models\Akuntansi\ProsesLaporanPrognosis;
use Illuminate\Support\Facades\Input;
use App\Models\Pengaturan\Pengguna;

class LaporanController extends Controller
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

    public function formLraPrognosisSap()
    {
        $var['url'] = $this->url;
        $listPengguna = null;

        $queryProsesLaporanPrognosis = ProsesLaporanPrognosis::orderBy('id', 'desc')->where('jenis_laporan', 'Laporan Prognosis (SAP)');
        (!empty($this->cari))?$queryProsesLaporanPrognosis->CariProsesLaporanPrognosis($this->cari):'';
        $queryProsesLaporanPrognosis->ViewPengguna();
        $listProsesLaporanPrognosis = $queryProsesLaporanPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listProsesLaporanPrognosis->setPath('lra-prognosis-sap'.$var['url']['cari']):'';

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            $listPengguna = ['semua' => 'Semua Organisasi / User'];
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.laporan.lra-sap.lra-sap-form', compact('var', 'listProsesLaporanPrognosis', 'listPengguna'));
    }

    public function printLraPrognosisSap(Request $request)
    {
        try {
            if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
                $viewData = Auth::user()->view;
                $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
            }else if(Auth::user()->view == 1){
                if($request->kode_pengguna != 'semua'){
                    $inputBy = $request->kode_pengguna;
                    $pengguna = Pengguna::find($request->kode_pengguna);
                    $kodeOrganisasi = $pengguna->organisasi;
                    $viewData = Auth::user()->view;
                    $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
                }else if($request->kode_pengguna == 'semua'){
                    $listOrganisasi = kodeOrganisasi::get();
                    $viewData = Auth::user()->view;
                    foreach($listOrganisasi as $item){
                        $listDataUser[] = ['inputBy'=>Auth::user()->kode_pengguna, 'kodeOrganisasi'=>$item['kode_organisasi'], 'viewData'=>$viewData];
                    }
                }
            }

            foreach($listDataUser as $itemUser){
                $organisasi = KodeOrganisasi::find($itemUser['kodeOrganisasi']);

                $var['tahun'] = $request->tahun;
                $var['kode_organisasi'] = $itemUser['kodeOrganisasi'];
                $var['nama_organisasi'] = $organisasi['nama_organisasi'];

                $prosesLaporanPrognosis = new ProsesLaporanPrognosis();
                $prosesLaporanPrognosis->jenis_laporan = 'Laporan Prognosis (SAP)';
                $prosesLaporanPrognosis->status = 'Berjalan';
                $prosesLaporanPrognosis->tahun = $var['tahun'];
                $prosesLaporanPrognosis->kode_organisasi = $itemUser['kodeOrganisasi'];
                $prosesLaporanPrognosis->kode_pengguna = $itemUser['inputBy'];
                $prosesLaporanPrognosis->save();

                $dataQueue = [
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'],
                    'viewData' => $itemUser['viewData'], 'tahun' => $request->tahun, 'idProsesLaporan' => $prosesLaporanPrognosis->id
                ];
                LaporanPrognosisSapJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Laporan Prognosis SAP Sedang Diproses');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Laporan Prognosis SAP Gagal Diproses');
            return redirect('prognosis/laporan/lra-prognosis-sap')->withInput();
        }

        return redirect('prognosis/laporan/lra-prognosis-sap');
    }

    public function formLraPrognosisPermen()
    {
        $var['url'] = $this->url;
        $listPengguna = null;

        $queryProsesLaporanPrognosis = ProsesLaporanPrognosis::orderBy('id', 'desc')->where('jenis_laporan', 'Laporan Prognosis (PERMEN)');
        (!empty($this->cari))?$queryProsesLaporanPrognosis->CariProsesLaporanPrognosis($this->cari):'';
        $queryProsesLaporanPrognosis->ViewPengguna();
        $listProsesLaporanPrognosis = $queryProsesLaporanPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listProsesLaporanPrognosis->setPath('lra-prognosis-permen'.$var['url']['cari']):'';

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            $listPengguna = ['semua' => 'Semua Organisasi / User'];
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.laporan.lra-permen.lra-permen-form', compact('var', 'listProsesLaporanPrognosis', 'listPengguna'));
    }

    public function printLraPrognosisPermen(Request $request)
    {
        try {
        	if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
                $viewData = Auth::user()->view;
                $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
            }else if(Auth::user()->view == 1){
                if($request->kode_pengguna != 'semua'){
                    $inputBy = $request->kode_pengguna;
                    $pengguna = Pengguna::find($request->kode_pengguna);
                    $kodeOrganisasi = $pengguna->organisasi;
                    $viewData = Auth::user()->view;
                    $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
                }else if($request->kode_pengguna == 'semua'){
                    $listOrganisasi = kodeOrganisasi::get();
                    $viewData = Auth::user()->view;
                    foreach($listOrganisasi as $item){
                        $listDataUser[] = ['inputBy'=>Auth::user()->kode_pengguna, 'kodeOrganisasi'=>$item['kode_organisasi'], 'viewData'=>$viewData];
                    }
                }
            }

            foreach($listDataUser as $itemUser){
                $organisasi = KodeOrganisasi::find($itemUser['kodeOrganisasi']);

            	$var['tahun'] = $request->tahun;
            	$var['kode_organisasi'] = $itemUser['kodeOrganisasi'];
            	$var['nama_organisasi'] = $organisasi['nama_organisasi'];

                $prosesLaporanPrognosis = new ProsesLaporanPrognosis();
                $prosesLaporanPrognosis->jenis_laporan = 'Laporan Prognosis (PERMEN)';
                $prosesLaporanPrognosis->status = 'Berjalan';
                $prosesLaporanPrognosis->tahun = $var['tahun'];
                $prosesLaporanPrognosis->kode_organisasi = $itemUser['kodeOrganisasi'];
                $prosesLaporanPrognosis->kode_pengguna = $itemUser['inputBy'];
                $prosesLaporanPrognosis->save();

                $dataQueue = [
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'],
                    'viewData' => $itemUser['viewData'], 'tahun' => $request->tahun, 'idProsesLaporan' => $prosesLaporanPrognosis->id
                ];
                LaporanPrognosisPermenJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Laporan Prognosis PERMEN Sedang Diproses');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Laporan Prognosis PERMEN Gagal Diproses');
            return redirect('prognosis/laporan/lra-prognosis-permen')->withInput();
        }

        return redirect('prognosis/laporan/lra-prognosis-permen');
    }

    public function formLraRincianPrognosis()
    {
        $var['url'] = $this->url;
        $listPengguna = null;

        $queryProsesLaporanPrognosis = ProsesLaporanPrognosis::orderBy('id', 'desc')->where('jenis_laporan', 'Laporan Rincian Prognosis');
        (!empty($this->cari))?$queryProsesLaporanPrognosis->CariProsesLaporanPrognosis($this->cari):'';
        $queryProsesLaporanPrognosis->ViewPengguna();
        $listProsesLaporanPrognosis = $queryProsesLaporanPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listProsesLaporanPrognosis->setPath('lra-rincian-prognosis'.$var['url']['cari']):'';

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            $listPengguna = ['semua' => 'Semua Organisasi / User'];
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.laporan.lra-rincian.lra-rincian-form', compact('var', 'listProsesLaporanPrognosis', 'listPengguna'));
    }

    public function printLraRincianPrognosis(Request $request)
    {
        try {
            if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
                $viewData = Auth::user()->view;
                $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
            }else if(Auth::user()->view == 1){
                if($request->kode_pengguna != 'semua'){
                    $inputBy = $request->kode_pengguna;
                    $pengguna = Pengguna::find($request->kode_pengguna);
                    $kodeOrganisasi = $pengguna->organisasi;
                    $viewData = Auth::user()->view;
                    $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
                }else if($request->kode_pengguna == 'semua'){
                    $listOrganisasi = kodeOrganisasi::get();
                    $viewData = Auth::user()->view;
                    foreach($listOrganisasi as $item){
                        $listDataUser[] = ['inputBy'=>Auth::user()->kode_pengguna, 'kodeOrganisasi'=>$item['kode_organisasi'], 'viewData'=>$viewData];
                    }
                }
            }

            foreach($listDataUser as $itemUser){
                $organisasi = KodeOrganisasi::find($itemUser['kodeOrganisasi']);

                $var['tahun'] = $request->tahun;
                $var['kode_organisasi'] = $itemUser['kodeOrganisasi'];
                $var['nama_organisasi'] = $organisasi['nama_organisasi'];

                $prosesLaporanPrognosis = new ProsesLaporanPrognosis();
                $prosesLaporanPrognosis->jenis_laporan = 'Laporan Rincian Prognosis';
                $prosesLaporanPrognosis->status = 'Berjalan';
                $prosesLaporanPrognosis->tahun = $var['tahun'];
                $prosesLaporanPrognosis->kode_organisasi = $itemUser['kodeOrganisasi'];
                $prosesLaporanPrognosis->kode_pengguna = $itemUser['inputBy'];
                $prosesLaporanPrognosis->save();

                $dataQueue = [
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'],
                    'viewData' => $itemUser['viewData'], 'tahun' => $request->tahun, 'idProsesLaporan' => $prosesLaporanPrognosis->id
                ];
                LaporanRincianPrognosisJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Laporan Rincian Prognosis Sedang Diproses');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Laporan Rincian Prognosis Gagal Diproses');
            return redirect('prognosis/laporan/lra-rincian-prognosis')->withInput();
        }

        return redirect('prognosis/laporan/lra-rincian-prognosis');
    }

    public function formLraPenjabaranPrognosis()
    {
        $var['url'] = $this->url;
        $listPengguna = null;

        $queryProsesLaporanPrognosis = ProsesLaporanPrognosis::orderBy('id', 'desc')->where('jenis_laporan', 'Laporan Penjabaran Prognosis');
        (!empty($this->cari))?$queryProsesLaporanPrognosis->CariProsesLaporanPrognosis($this->cari):'';
        $queryProsesLaporanPrognosis->ViewPengguna();
        $listProsesLaporanPrognosis = $queryProsesLaporanPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listProsesLaporanPrognosis->setPath('lra-penjabaran-prognosis'.$var['url']['cari']):'';

        if(Auth::user()->view == 1){
            $pengguna = Pengguna::get();
            $listPengguna = ['semua' => 'Semua Organisasi / User'];
            foreach($pengguna as $item) {
                $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
            }
        }

        return view('prognosis.laporan.lra-penjabaran.lra-penjabaran-form', compact('var', 'listProsesLaporanPrognosis', 'listPengguna'));
    }

    public function printLraPenjabaranPrognosis(Request $request)
    {
        try {
            if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
                $viewData = Auth::user()->view;
                $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
            }else if(Auth::user()->view == 1){
                if($request->kode_pengguna != 'semua'){
                    $inputBy = $request->kode_pengguna;
                    $pengguna = Pengguna::find($request->kode_pengguna);
                    $kodeOrganisasi = $pengguna->organisasi;
                    $viewData = Auth::user()->view;
                    $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
                }else if($request->kode_pengguna == 'semua'){
                    $listOrganisasi = kodeOrganisasi::get();
                    $viewData = Auth::user()->view;
                    foreach($listOrganisasi as $item){
                        $listDataUser[] = ['inputBy'=>Auth::user()->kode_pengguna, 'kodeOrganisasi'=>$item['kode_organisasi'], 'viewData'=>$viewData];
                    }
                }
            }

            foreach($listDataUser as $itemUser){
                $organisasi = KodeOrganisasi::find($itemUser['kodeOrganisasi']);

                $var['tahun'] = $request->tahun;
                $var['kode_organisasi'] = $itemUser['kodeOrganisasi'];
                $var['nama_organisasi'] = $organisasi['nama_organisasi'];

                $prosesLaporanPrognosis = new ProsesLaporanPrognosis();
                $prosesLaporanPrognosis->jenis_laporan = 'Laporan Penjabaran Prognosis';
                $prosesLaporanPrognosis->status = 'Berjalan';
                $prosesLaporanPrognosis->tahun = $var['tahun'];
                $prosesLaporanPrognosis->kode_organisasi = $itemUser['kodeOrganisasi'];
                $prosesLaporanPrognosis->kode_pengguna = $itemUser['inputBy'];
                $prosesLaporanPrognosis->save();

                $dataQueue = [
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'],
                    'viewData' => $itemUser['viewData'], 'tahun' => $request->tahun, 'idProsesLaporan' => $prosesLaporanPrognosis->id
                ];
                LaporanPenjabaranPrognosisJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Laporan Penjabaran Prognosis Sedang Diproses');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Laporan Penjabaran Prognosis Gagal Diproses');
            return redirect('prognosis/laporan/lra-penjabaran-prognosis')->withInput();
        }

        return redirect('prognosis/laporan/lra-penjabaran-prognosis');
    }
}
