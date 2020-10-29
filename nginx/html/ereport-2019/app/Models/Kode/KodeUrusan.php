<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;

class KodeUrusan extends Model
{
    protected $primaryKey = 'id_urusan';
    public $incrementing = false;
    protected $table = 'm_urusan';
    protected $fillable = [
        'kd_urusan', 'nm_urusan', 'kd_org', 'nm_org'
    ];
}
