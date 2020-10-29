<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kode\KodeOrganisasi;
use App\Models\Kode\KodeAkunPrognosis;
use App\Models\Pengaturan\Pengguna;
use App\Models\Kode\KodeKegiatanPrognosis;

class BerandaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$var['jum_skpd'] = KodeOrganisasi::count();
    	$var['jum_kode_akun'] = KodeAkunPrognosis::count();
    	$var['jum_pengguna'] = Pengguna::count();
    	$var['jum_kode_kegiatan'] = KodeKegiatanPrognosis::count();
    	return view('beranda', compact('var'));
    }
}
