<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sp2d;
use App\Spj;
use App\User;
use Carbon\Carbon;

class BerandaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$var['jum_sp2d'] = Sp2d::count();
    	$var['jum_spj'] = Spj::count();
    	$var['jum_user'] = User::count();

    	//chart bar
        $var['bulan'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
        for($i=1;$i<=count($var['bulan']);$i++){
            $jumUP = Sp2d::whereMonth('tanggal_sp2d', $i)->whereYear('tanggal_sp2d', Carbon::now()->format('Y'))->where('jenis_sp2d','1')->sum('jumlah_sp2d');
            $listJumUP[] = $jumUP;

            $jumGU = Sp2d::whereMonth('tanggal_sp2d', $i)->whereYear('tanggal_sp2d', Carbon::now()->format('Y'))->where('jenis_sp2d','2')->sum('jumlah_sp2d');
            $listJumGU[] = $jumGU;

            $jumTU = Sp2d::whereMonth('tanggal_sp2d', $i)->whereYear('tanggal_sp2d', Carbon::now()->format('Y'))->where('jenis_sp2d','3')->sum('jumlah_sp2d');
            $listJumTU[] = $jumTU;

            $jumLS = Sp2d::whereMonth('tanggal_sp2d', $i)->whereYear('tanggal_sp2d', Carbon::now()->format('Y'))->where('jenis_sp2d','3')->sum('jumlah_sp2d');
            $listJumLS[] = $jumLS;

            $listJumTotal[] = $jumUP + $jumGU + $jumTU + $jumLS;
        }

        $var['bulan2'] = json_encode($var['bulan']);
        $var['listJumUP'] = json_encode($listJumUP);
        $var['listJumGU'] = json_encode($listJumGU);
        $var['listJumTU'] = json_encode($listJumTU);
        $var['listJumLS'] = json_encode($listJumLS);
        $var['listJumTotal'] = json_encode($listJumTotal);

        for($i=1;$i<=count($var['bulan']);$i++){
            $jumSpj = Spj::selectRaw('sum(debet) as jumDebet, sum(kredit) as jumKredit')->whereMonth('tanggal_spj', $i)->whereYear('tanggal_spj', Carbon::now()->format('Y'))->first();
            $listJumSpjDebet[] = $jumSpj['jumDebet'];
            $listJumSpjKredit[] = $jumSpj['jumKredit'];
        }

        $var['listJumSpjDebet'] = json_encode($listJumSpjDebet);
        $var['listJumSpjKredit'] = json_encode($listJumSpjKredit);

    	return view('beranda', compact('var'));
    }
}
