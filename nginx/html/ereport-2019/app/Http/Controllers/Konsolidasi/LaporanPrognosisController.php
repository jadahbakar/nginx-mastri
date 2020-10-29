<?php

namespace App\Http\Controllers\Konsolidasi;

use Session;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Konsolidasi\ProsesLaporanKonsolidasi;
use Illuminate\Support\Facades\Auth;
use App\Jobs\Konsolidasi\LaporanKonsolidasiPrognosisSapJob;
use App\Jobs\Konsolidasi\LaporanKonsolidasiPrognosisPermenJob;

class LaporanPrognosisController extends Controller
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

        $queryProsesLaporanPrognosis = ProsesLaporanKonsolidasi::orderBy('id', 'desc')->where('jenis_laporan', 'Laporan Konsolidasi Prognosis (SAP)');
        (!empty($this->cari))?$queryProsesLaporanPrognosis->CariProsesLaporanKonsolidasi($this->cari):'';
        $listProsesLaporanPrognosis = $queryProsesLaporanPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listProsesLaporanPrognosis->setPath('lra-prognosis-sap'.$var['url']['cari']):'';

        return view('konsolidasi.prognosis.lra-sap.lra-sap-form', compact('var', 'listProsesLaporanPrognosis'));
    }

    public function printLraPrognosisSap(Request $request)
    {
    	try {
            $inputBy = Auth::user()->kode_pengguna;
            $kodeOrganisasi = 'konsolidasi';
            $viewData = 'konsolidasi';
            $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
        
            foreach($listDataUser as $itemUser){
                $var['tahun'] = $request->tahun;   
                $var['kode_organisasi'] = $itemUser['kodeOrganisasi'];

                $prosesLaporanKonsolidasi = new ProsesLaporanKonsolidasi();
                $prosesLaporanKonsolidasi->jenis_laporan = 'Laporan Konsolidasi Prognosis (SAP)';
                $prosesLaporanKonsolidasi->status = 'Berjalan';
                $prosesLaporanKonsolidasi->tahun = $var['tahun'];
                $prosesLaporanKonsolidasi->kode_pengguna = $itemUser['inputBy'];
                $prosesLaporanKonsolidasi->save();

                $dataQueue = [ 
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'], 
                    'viewData' => $itemUser['viewData'], 'tahun' => $request->tahun, 'idProsesLaporan' => $prosesLaporanKonsolidasi->id
                ];
                LaporanKonsolidasiPrognosisSapJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Laporan Konsolidasi Prognosis SAP Sedang Diproses');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Laporan Konsoldiasi Prognosis SAP Gagal Diproses');
            return redirect('konsolidasi/prognosis/lra-prognosis-sap')->withInput();
        }

        return redirect('konsolidasi/prognosis/lra-prognosis-sap');
    }

    public function formLraPrognosisPermen()
    {
        $var['url'] = $this->url;

        $queryProsesLaporanPrognosis = ProsesLaporanKonsolidasi::orderBy('id', 'desc')->where('jenis_laporan', 'Laporan Konsolidasi Prognosis (PERMEN)');
        (!empty($this->cari))?$queryProsesLaporanPrognosis->CariProsesLaporanKonsolidasi($this->cari):'';
        $listProsesLaporanPrognosis = $queryProsesLaporanPrognosis->paginate($this->jumPerPage);
        (!empty($this->cari))?$listProsesLaporanPrognosis->setPath('lra-prognosis-permen'.$var['url']['cari']):'';

        return view('konsolidasi.prognosis.lra-permen.lra-permen-form', compact('var', 'listProsesLaporanPrognosis'));
    }

    public function printLraPrognosisPermen(Request $request)
    {
    	try {
            $inputBy = Auth::user()->kode_pengguna;
            $kodeOrganisasi = 'konsolidasi';
            $viewData = 'konsolidasi';
            $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi, 'viewData'=>$viewData];
        
            foreach($listDataUser as $itemUser){
                $var['tahun'] = $request->tahun;   
                $var['kode_organisasi'] = $itemUser['kodeOrganisasi'];

                $prosesLaporanKonsolidasi = new ProsesLaporanKonsolidasi();
                $prosesLaporanKonsolidasi->jenis_laporan = 'Laporan Konsolidasi Prognosis (PERMEN)';
                $prosesLaporanKonsolidasi->status = 'Berjalan';
                $prosesLaporanKonsolidasi->tahun = $var['tahun'];
                $prosesLaporanKonsolidasi->kode_pengguna = $itemUser['inputBy'];
                $prosesLaporanKonsolidasi->save();

                $dataQueue = [ 
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'], 
                    'viewData' => $itemUser['viewData'], 'tahun' => $request->tahun, 'idProsesLaporan' => $prosesLaporanKonsolidasi->id
                ];
                LaporanKonsolidasiPrognosisPermenJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Laporan Konsolidasi Prognosis PERMEN Sedang Diproses');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Laporan Konsoldiasi Prognosis PERMEN Gagal Diproses');
            return redirect('konsolidasi/prognosis/lra-prognosis-permen')->withInput();
        }

        return redirect('konsolidasi/prognosis/lra-prognosis-permen');
    }
}
