<?php

namespace App\Events\Prognosis;

use Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotifikasiLaporanPrognosisPermenEvent implements ShouldBroadcast
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
        Log:info('Broadcast notifikasi event laporan prognosis permen | channel-name-'.$dataEvent['inputBy']);
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
        return ['channel-name-'.$this->inputBy, 'channel-name-'.$this->kodeOrganisasi, 'channel-name-main-admin'];
    }

    public function tags()
    {
        return ['notifikasiLaporanPrognosis : '.$this->inputBy];
    }
}
