<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\User;

class LainLainController extends Controller
{
	function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function formGantiPassword()
    {
        return view('ganti-password.ganti-password');
    }

    public function updatePassword(Request $request)
    {
        try {
            $password = User::find(Auth::user()->id);
            $password->password = $request->password;
            $password->save();

            Session::flash('pesanSukses', 'Password Berhasil Diupdate ...');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Password Gagal Diupdate ...');
        }

        return redirect('ganti-password');
    }
}
