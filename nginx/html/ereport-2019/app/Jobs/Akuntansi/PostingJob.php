<?php

namespace App\Jobs\Akuntansi;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Akuntansi\Jurnal;
use App\Models\Penerimaan\Penerimaan;
use App\Models\Pengeluaran\Pengeluaran;
use App\Models\Akuntansi\Posting;
use App\Models\Akuntansi\ProsesPosting;
use App\Events\Akuntansi\NotifikasiPostingEvent;
use Illuminate\Support\Facades\Event;

class PostingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue;
    public $inputBy;
    public $kodeOrganisasi;
    public $viewData;
    public $idProsesPosting;
    public $dataEvent = array();

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dataQueue)
    {
        Log::info('Mulai proses posting skpd '.$dataQueue['kodeOrganisasi']);
        $this->queue = 'proses_posting';
        $this->inputBy = $dataQueue['inputBy'];
        $this->kodeOrganisasi = $dataQueue['kodeOrganisasi'];
        $this->idProsesPosting = $dataQueue['idProsesPosting'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $prosesPosting = ProsesPosting::find($this->idProsesPosting);

        try {
            $inputBy = $this->inputBy;
            $kodeOrganisasi = $this->kodeOrganisasi;

            $var['kode_pengguna'] = $inputBy;
            $var['kode_organisasi'] = $kodeOrganisasi;

            $listJurnal = Jurnal::where('status', 'JURNAL')->where('kode_pengguna', $var['kode_pengguna'])->get();
            foreach($listJurnal as $item){
                $deletePosting = Posting::where('no_transaksi', $item->no_transaksi)->first();
                if(count($deletePosting) > 0) $deletePosting->delete();

                if($item->jenis_jurnal == 'LRA 64' || $item->jenis_jurnal == 'LO'){
                    $kodeAkunDebet = substr($item->kode_organisasi, 0, 6)." ".$item->kode_organisasi." 00 000 ".$item->akun_debet;
				    $kodeAkunKredit = substr($item->kode_organisasi, 0, 6)." ".$item->kode_organisasi." 00 000 ".$item->akun_kredit;
                }else if($item->jenis_jurnal == 'LRA 13'){
                    if($item->akun_debet[0] == '5' || $item->akun_debet[0] == '4'){
                        $transaksi = Penerimaan::find($item->no_transaksi);
                        if(count($transaksi) != 1){
                            $transaksi = Pengeluaran::find($item->no_transaksi);
                        }
                        $kodeAkunDebet = $transaksi->kode_rekening;
                    }else{
                        $kodeAkunDebet=substr($item->kode_organisasi, 0, 6)." ".$item->kode_organisasi." 00 000 ".$item->akun_debet;
                    }

                    if($item->akun_kredit[0] == '5' || $item->akun_kredit[0] == '4'){
                        $transaksi = Penerimaan::find($item->no_transaksi);
                        if(count($transaksi) != 1){
                            $transaksi = Pengeluaran::find($item->no_transaksi);
                        }
                        $kodeAkunKredit = $transaksi->kode_rekening;
                    }else{
                        $kodeAkunKredit=substr($item->kode_organisasi, 0, 6)." ".$item->kode_organisasi." 00 000 ".$item->akun_debet;
                    }
                }else if($item->jenis_jurnal == 'JF PPKD'){
                    $kodeAkunDebet="3.1.02 3.1.02.01 00 000 ".$item->akun_debet;
                    $kodeAkunKredit="3.1.02 3.1.02.01 00 000 ".$item->akun_kredit;
                }

                $posting = new Posting();
                $posting->no_transaksi = $item->no_transaksi;
                $posting->tgl_transaksi = $item->tgl_transaksi;
                $posting->jenis_transaksi= $item->jenis_transaksi;
                $posting->no_urut = $item->no_urut;
                $posting->kode_akun = $item->kode_akun;
                $posting->jenis_jurnal = $item->jenis_jurnal;
                $posting->kode_pengguna = $item->kode_pengguna;
                $posting->kode_lapor = $item->kode_lapor;
                $posting->kode_organisasi = $item->kode_organisasi;
                $posting->kd_org_catat = $item->kd_org_catat;
                $posting->kode_rekening = $kodeAkunDebet;
                $posting->debet= $item->jumlah;
                $posting->kredit = 0;
                $posting->keterangan = $item->keterangan;
                $posting->save();
                Log::info('Proses Posting Kode Rekening Debet : '.$kodeAkunDebet);

                $posting = new Posting();
                $posting->no_transaksi = $item->no_transaksi;
                $posting->tgl_transaksi = $item->tgl_transaksi;
                $posting->jenis_transaksi= $item->jenis_transaksi;
                $posting->no_urut = $item->no_urut;
                $posting->kode_akun = $item->kode_akun;
                $posting->jenis_jurnal = $item->jenis_jurnal;
                $posting->kode_pengguna = $item->kode_pengguna;
                $posting->kode_lapor = $item->kode_lapor;
                $posting->kode_organisasi = $item->kode_organisasi;
                $posting->kd_org_catat = $item->kd_org_catat;
                $posting->kode_rekening = $kodeAkunKredit;
                $posting->debet= 0;
                $posting->kredit =  $item->jumlah;
                $posting->keterangan = $item->keterangan;
                $posting->save();
                Log::info('Proses Posting Kode Rekening Kredit : '.$kodeAkunKredit);

                $updateJurnal = Jurnal::find($item->id);
                $updateJurnal->status = 'POSTING';
                $updateJurnal->save();
                Log::info('Update Status Jurnal');
            }

            $prosesPosting->status = 'Sukses';
            $prosesPosting->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesPosting' => $this->idProsesPosting,
                'status' => $prosesPosting->status, 'createdAt' => $prosesPosting->created_at,
                'kodeOrganisasi' => $kodeOrganisasi
            ];
            Event::fire(new NotifikasiPostingEvent($this->dataEvent));
            Log::info('Proses Posting user : '.$this->inputBy.' skpd : '.$this->kodeOrganisasi.' sukses');
        } catch(\Exception $e) {
            $prosesPosting->status = 'Gagal';
            $prosesPosting->save();
            $this->dataEvent = [
                'inputBy' => $this->inputBy, 'idProsesPosting' => $this->idProsesPosting,
                'status' => $prosesPosting->status, 'createdAt' => $prosesPosting->created_at,
                'kodeOrganisasi' => $kodeOrganisasi
            ];
            $this->failed($e);
        }
    }

    public function tags()
    {
        return ['prosesPosting user : '.$this->inputBy.' skpd : '.$this->kodeOrganisasi];
    }

    public function failed($e)
    {
        Event::fire(new NotifikasiPostingEvent($this->dataEvent));
        Log::error('Proses Posting user : '.$this->inputBy.' skpd : '.$this->kodeOrganisasi.' gagal: '.$e->getMessage());
    }
}
