<?php

namespace App\Jobs\Test;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Pengaturan\Pengguna;

class SomeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $pengguna;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pengguna $pengguna)
    {
        $this->pengguna = $pengguna;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        sleep(100);
    }
}
