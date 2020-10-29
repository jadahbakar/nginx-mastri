<?php

namespace App\Events\Konsolidasi;

use Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotifikasiLaporanKonsolidasiPrognosisPermenEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $queue;
    public $inputBy;
    public $idProsesLaporan;
    public $status;
    public $labelHtml;
    public $direktoriFile;
    public $createdAt;
    public $kodeOrganisasi;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($dataEvent)
    {
        Log:info('Broadcast notifikasi event laporan konsolidasi prognosis permen | channel-name-konsolidasi');
        $this->queue = 'notifikasi';
        $this->inputBy = $dataEvent['inputBy'];
        $this->idProsesLaporan = $dataEvent['idProsesLaporan'];
        $this->status = $dataEvent['status'];
        $this->labelHtml = statusProses($dataEvent['status']);
        $this->direktoriFile = $dataEvent['direktoriFile'];
        $this->createdAt = $dataEvent['createdAt'];
        $this->kodeOrganisasi = $dataEvent['kodeOrganisasi'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['channel-name-konsolidasi'];
    }

    public function tags()
    {
        return ['notifikasiLaporanKonsolidasiPrognosis : '.$this->inputBy];
    }
}
