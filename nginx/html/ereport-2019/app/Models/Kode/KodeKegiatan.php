<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;

class KodeKegiatan extends Model
{
    protected $primaryKey = 'kdkegiatan';
    public $incrementing = false;
    protected $table = 'm_kegiatan';
    protected $fillable = [
        'kdkegiatan', 'nmkegiatan'
    ];
}
