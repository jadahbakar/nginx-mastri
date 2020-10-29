<?php

namespace App\Jobs\Konsolidasi;

use Log;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Prognosis\Helper\PrognosisHelper;
use App\Models\Konsolidasi\ProsesLaporanKonsolidasi;
use Illuminate\Support\Facades\Event;
use App\Events\Konsolidasi\NotifikasiLaporanKonsolidasiPrognosisPermenEvent;
use App\Models\Pengaturan\TandaTangan;

class LaporanKonsolidasiPrognosisPermenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue;
    public $inputBy;
    public $kodeOrganisasi;
    public $viewData;
    public $tahun;
    public $idProsesLaporan;
    public $dataEvent = array();

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dataQueue)
    {
        Log::info('Mulai proses laporan konsolidasi prognosis PERMEN skpd '.$dataQueue['kodeOrganisasi']);
        $this->queue = 'proses_cetak_laporan_konsolidasi';
        $this->inputBy = $dataQueue['inputBy'];
        $this->kodeOrganisasi = $dataQueue['kodeOrganisasi'];
        $this->viewData = $dataQueue['viewData'];
        $this->tahun = $dataQueue['tahun'];
        $this->idProsesLaporan = $dataQueue['idProsesLaporan'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $prosesLaporanKonsolidasi = ProsesLaporanKonsolidasi::find($this->idProsesLaporan);

        try {
            $inputBy = $this->inputBy;
            $kodeOrganisasi = $this->kodeOrganisasi;
            $viewData = $this->viewData;

            $var['view_data'] = $viewData;
            $var['kode_pengguna'] = $inputBy;
            $var['tahun'] = $this->tahun;
            $var['kode_organisasi'] = $kodeOrganisasi;

            $helper = new PrognosisHelper();
            $tandaTangan = TandaTangan::find(1);
            $pdf = PDF::loadView('konsolidasi.prognosis.lra-permen.lra-permen-print', compact('var', 'helper', 'tandaTangan'));
            $namaFile = date("DdMY").'_'.time().'_Laporan Konsolidasi Prognosis PERMEN_'.$kodeOrganisasi.'.pdf';
            if(env('APP_ENV') == 'production'){
                $pdf->save('/usr/share/nginx/html/ereport-2019/public/laporan/konsolidasi/prognosis/laporan-permen/'.$namaFile);
            }else{
                $pdf->save('public/laporan/konsolidasi/prognosis/laporan-permen/'.$namaFile);
            }
            $direktoriFile =  '/laporan/konsolidasi/prognosis/laporan-permen/'.$namaFile;
            $urlFile =  url('/').'/laporan/konsolidasi/prognosis/laporan-permen/'.$namaFile;

            $prosesLaporanKonsolidasi->status = 'Sukses';
            $prosesLaporanKonsolidasi->direktori_file = $direktoriFile;
            $prosesLaporanKonsolidasi->url_file = $urlFile;
            $prosesLaporanKonsolidasi->nama_file = $namaFile;
            $prosesLaporanKonsolidasi->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesLaporan' => $this->idProsesLaporan,
                'status' => $prosesLaporanKonsolidasi->status, 'createdAt' => $prosesLaporanKonsolidasi->created_at,
                'direktoriFile' => $direktoriFile, 'kodeOrganisasi' => $kodeOrganisasi
            ];
            Event::fire(new NotifikasiLaporanKonsolidasiPrognosisPermenEvent($this->dataEvent));
            Log::info('Laporan Konsolidasi Prognosis PERMEN sukses');
        } catch(\Exception $e) {
            $prosesLaporanKonsolidasi->status = 'Gagal';
            $prosesLaporanKonsolidasi->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesLaporan' => $this->idProsesLaporan,
                'status' => $prosesLaporanKonsolidasi->status, 'createdAt' => $prosesLaporanKonsolidasi->created_at,
                'direktoriFile' => '', 'kodeOrganisasi' => $kodeOrganisasi
            ];
            $this->failed($e);
        }
    }

    public function tags()
    {
        return ['laporanKonsolidasiPrognosisSAP : '.$this->inputBy];
    }

    public function failed($e)
    {
        Event::fire(new NotifikasiLaporanKonsolidasiPrognosisPermenEvent($this->dataEvent));
        Log::error('Laporan Konsolidasi Prognosis PERMEN gagal: '.$e->getMessage());
    }
}
