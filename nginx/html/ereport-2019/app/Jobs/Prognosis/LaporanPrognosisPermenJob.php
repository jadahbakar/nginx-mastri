<?php

namespace App\Jobs\Prognosis;

use Log;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Kode\KodeOrganisasi;
use App\Http\Controllers\Prognosis\Helper\PrognosisHelper;
use App\Models\Akuntansi\ProsesLaporanPrognosis;
use App\Events\Prognosis\NotifikasiLaporanPrognosisPermenEvent;
use Illuminate\Support\Facades\Event;

class LaporanPrognosisPermenJob implements ShouldQueue
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
        Log::info('Mulai proses laporan prognosis PERMEN skpd '.$dataQueue['kodeOrganisasi']);
        $this->queue = 'proses_cetak_laporan_prognosis';
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
        $prosesLaporanPrognosis = ProsesLaporanPrognosis::find($this->idProsesLaporan);

        try {
            $inputBy = $this->inputBy;
            $kodeOrganisasi = $this->kodeOrganisasi;
            $viewData = $this->viewData;

            $organisasi = KodeOrganisasi::find($kodeOrganisasi);

            $var['view_data'] = $viewData;
            $var['kode_pengguna'] = $inputBy;
            $var['tahun'] = $this->tahun;
            $var['kode_organisasi'] = $kodeOrganisasi;
            $var['nama_organisasi'] = $organisasi['nama_organisasi'];

            $helper = new PrognosisHelper();
            $pdf = PDF::loadView('prognosis.laporan.lra-permen.lra-permen-print', compact('var', 'helper'));
            $namaFile = date("DdMY").'_'.time().'_Laporan Prognosis PERMEN_'.$kodeOrganisasi.'.pdf';
            if(env('APP_ENV') == 'production'){
                $pdf->save('/usr/share/nginx/html/ereport-2019/public/laporan/prognosis/laporan-permen/'.$namaFile);
            }else{
                $pdf->save('public/laporan/prognosis/laporan-permen/'.$namaFile);
            }
            $direktoriFile =  '/laporan/prognosis/laporan-permen/'.$namaFile;
            $urlFile =  url('/').'/laporan/prognosis/laporan-permen/'.$namaFile;

            $prosesLaporanPrognosis->status = 'Sukses';
            $prosesLaporanPrognosis->direktori_file = $direktoriFile;
            $prosesLaporanPrognosis->url_file = $urlFile;
            $prosesLaporanPrognosis->nama_file = $namaFile;
            $prosesLaporanPrognosis->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesLaporan' => $this->idProsesLaporan,
                'status' => $prosesLaporanPrognosis->status, 'createdAt' => $prosesLaporanPrognosis->created_at,
                'direktoriFile' => $direktoriFile, 'kodeOrganisasi' => $kodeOrganisasi
            ];
            Event::fire(new NotifikasiLaporanPrognosisPermenEvent($this->dataEvent));
            Log::info('Laporan Prognosis PERMEN sukses');
        } catch(\Exception $e) {
            $prosesLaporanPrognosis->status = 'Gagal';
            $prosesLaporanPrognosis->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesLaporan' => $this->idProsesLaporan,
                'status' => $prosesLaporanPrognosis->status, 'createdAt' => $prosesLaporanPrognosis->created_at,
                'direktoriFile' => '', 'kodeOrganisasi' => $kodeOrganisasi
            ];
            $this->failed($e);
        }
    }

    public function tags()
    {
        return ['laporanPrognosisPERMEN : '.$this->inputBy];
    }

    public function failed($e)
    {
        Event::fire(new NotifikasiLaporanPrognosisPermenEvent($this->dataEvent));
        Log::error('Laporan Prognosis PERMEN gagal: '.$e->getMessage());
    }
}
