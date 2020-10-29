<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\Pengaturan\Pengguna;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/beranda';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $rememberMe = $request->has('remember') ? true : false; 
        $queryPengguna = Pengguna::where('kode_pengguna', $request->kode_pengguna)->where('password',md5($request->password));
        $jumPengguna = $queryPengguna->count();
        $pengguna = $queryPengguna->first();
        if($jumPengguna == 1){
            Auth::login($pengguna, $rememberMe);
        }

        return redirect('/')
            ->withInput(Input::except('password'))
            ->withErrors(['gagal' => 'Kombinasi kode pengguna / password salah']);
    }
}
