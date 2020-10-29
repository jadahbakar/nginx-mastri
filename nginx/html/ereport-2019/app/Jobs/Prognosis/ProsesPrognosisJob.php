<?php

namespace App\Jobs\Prognosis;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Kode\KodeAkun;
use App\Models\Akuntansi\ProsesPrognosis;
use App\Models\Kode\KodeAkunPrognosis;
use App\Events\Prognosis\NotifikasiKonvertEvent;
use Illuminate\Support\Facades\Event;

class ProsesPrognosisJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue;
    public $inputBy;
    public $kodeOrganisasi;
    public $tahun;
    public $viewData;
    public $idProsesPrognosis;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dataQueue)
    {
        Log::info('Mulai proses konvert kode akun ke kode akun prognosis');
        $this->queue = 'proses_konvert_prognosis';
        $this->inputBy = $dataQueue['inputBy'];
        $this->kodeOrganisasi = $dataQueue['kodeOrganisasi'];
        $this->tahun = $dataQueue['tahun'];
        $this->idProsesPrognosis = $dataQueue['idProsesPrognosis'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $prosesPrognosis = ProsesPrognosis::find($this->idProsesPrognosis);

        try {
            $inputBy = $this->inputBy;
            $kodeOrganisasi = $this->kodeOrganisasi;

            $kodeAkun1 = KodeAkun::whereRaw('length(kdRekening) <= 6');
            $kodeAkun2 = KodeAkun::whereRaw('substring(kdRekening,8,9) = "'.$kodeOrganisasi.'"')->union($kodeAkun1)->get();

            Log::info('Konvert ke kode akun prognosis');
            foreach($kodeAkun2 as $item){
                $kodeExist = KodeAkunPrognosis::find($item['kdRekening']);
                if(empty($kodeExist)){
                    Log::info('Proses Konvert - Simpan kode rekening : '.$item['kdRekening']);
                    $kodeAkunPrognosis = new KodeAkunPrognosis();
                    $kodeAkunPrognosis->kdRekening = $item['kdRekening'];
                    $kodeAkunPrognosis->nmRekening = $item['nmRekening'];
                    if(strlen($item['kdRekening']) >= 23) $kodeAkunPrognosis->kode_kegiatan = substr($item['kdRekening'],0,23);
                    if(strlen($item['kdRekening']) >= 35) $kodeAkunPrognosis->kode_rincian_objek = substr($item['kdRekening'],24,11);
                    $kodeAkunPrognosis->kdOrganisasi = $kodeOrganisasi;
                    $kodeAkunPrognosis->anggaran = mataUang($item['jumlah']);
                    $kodeAkunPrognosis->jenis_input = 'Konvert';
                    $kodeAkunPrognosis->kode_organisasi = $kodeOrganisasi;
                    $kodeAkunPrognosis->kode_pengguna = $inputBy;
                    $kodeAkunPrognosis->save();
                }else{
                    Log::info('Proses Konvert - Update kode rekening : '.$item['kdRekening']);
                    $kodeAkunPrognosis = KodeAkunPrognosis::find($item['kdRekening']);
                    $kodeAkunPrognosis->anggaran = mataUang($item['jumlah']);
                    $kodeAkunPrognosis->jenis_input = 'Konvert';
                    $kodeAkunPrognosis->kode_organisasi = $kodeOrganisasi;
                    $kodeAkunPrognosis->kode_pengguna = $inputBy;
                    $kodeAkunPrognosis->save();
                }
            }

            $prosesPrognosis->status = 'Sukses';
            $prosesPrognosis->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesPrognosis' => $this->idProsesPrognosis,
                'status' => $prosesPrognosis->status, 'createdAt' => $prosesPrognosis->created_at,
                'kodeOrganisasi' => $kodeOrganisasi
            ];
            Event::fire(new NotifikasiKonvertEvent($this->dataEvent));
            Log::info('Konvert ke kode akun prognosis sukses');
        } catch(\Exception $e) {
            $prosesPrognosis->status = 'Gagal';
            $prosesPrognosis->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesPrognosis' => $this->idProsesPrognosis,
                'status' => $prosesPrognosis->status, 'createdAt' => $prosesPrognosis->created_at,
                'kodeOrganisasi' => $kodeOrganisasi
            ];
            $this->failed($e);
        }
    }

    public function tags()
    {
        return ['konvertPrognosis : '.$this->inputBy];
    }

    public function failed($e)
    {
        Event::fire(new NotifikasiKonvertEvent($this->dataEvent));
        Log::error('Konvert ke kode akun prognosis gagal: '.$e->getMessage());
    }
}
