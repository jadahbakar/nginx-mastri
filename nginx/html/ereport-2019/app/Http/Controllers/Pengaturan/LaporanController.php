<?php

namespace App\Http\Controllers\Pengaturan;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengaturan\TandaTangan;

class LaporanController extends Controller
{
    function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function formTandaTangan()
    {
    	$tandaTangan = TandaTangan::find(1);

        return view('pengaturan.laporan.tanda-tangan', compact('tandaTangan'));
    }

    public function updateTandaTangan(Request $request)
    {
        try {
            $tandaTangan = TandaTangan::find(1);
            $tandaTangan->update($request->all());

            Session::flash('pesanSukses', 'Data Pengaturan Tanda Tangan Berhasil Diupdate');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Pengaturan Tanda Tangan Gagal Diupdate');
        }

        return redirect('pengaturan/laporan/tanda-tangan');
    }
}
