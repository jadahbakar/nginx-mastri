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

class NotifikasiKonvertEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $queue;
    public $inputBy;
    public $idProsesPrognosis;
    public $status;
    public $labelHtml;
    public $createdAt;
    public $kodeOrganisasi;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($dataEvent)
    {
        Log:info('Broadcast notifikasi event konvert prognosis | channel-name-'.$dataEvent['inputBy']);
        $this->queue = 'notifikasi';
        $this->inputBy = $dataEvent['inputBy'];
        $this->idProsesPrognosis = $dataEvent['idProsesPrognosis'];
        $this->status = $dataEvent['status'];
        $this->labelHtml = statusProses($dataEvent['status']);
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
        return ['notifikasiPrognosis : '.$this->inputBy];
    }
}
