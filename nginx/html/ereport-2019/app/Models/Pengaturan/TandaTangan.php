<?php

namespace App\Models\Pengaturan;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    protected $table = 'tanda_tangan';
    protected $fillable = [
        'status', 'tanggal', 'pejabat_penanda_tangan_1', 'pejabat_penanda_tangan_2', 'nama', 'nip', 'jabatan'
    ];

    public function setTanggalAttribute($tanggal) {
        $this->attributes['tanggal'] = Carbon::parse($tanggal)->format('Y-m-d');
    }

    public function getTanggalAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }
}
