<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use App\User;

class UserController extends Controller
{
    private $url;
    private $cari;
    private $jumPerPage = 10;

    function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->cari = Input::get('cari', '');
        $this->url = makeUrl($request->query());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var['url'] = $this->url;

        $query = User::orderBy('id', 'desc');
        (!empty($this->cari))?$query->Cari($this->cari):'';
        $listUser = $query->paginate($this->jumPerPage);
        (!empty($this->cari))?$listUser->setPath('user'.$var['url']['cari']):'';

        return view('user.user-1', compact('var', 'listUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $var['method'] =  'create';
        return view('user.user-2', compact('var'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request['password'] = $request->username;
            User::create($request->all());
            Session::flash('pesanSukses', 'Data User Berhasil Disimpan ...');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data User Gagal Disimpan ...');
            return redirect('user/create')->withInput();
        }

        return redirect('user/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $var['method'] = 'show';
        $listUser = User::find($id);;

        return view('user.user-2', compact('listUser', 'var'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $var['url'] = $this->url;
        $var['method'] = 'edit';
        $listUser = User::find($id);;

        return view('user.user-2', compact('listUser', 'var'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $var['url'] = $this->url;

        try {
            $tabel = User::find($id);
            $tabel->update($request->all());

            Session::flash('pesanSukses', 'Data User Berhasil Diupdate ...');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data User Gagal Diupdate ...');
        }

        return redirect('user'.$var['url']['all']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $var['url'] = $this->url;

        try {
            $tabel = User::find($id);
            $tabel->delete();

            if($request->nomor == '1'){
                $input = $request->query();
                $input['page'] = '1';
                $var['url'] = makeUrl($input);
            }

            Session::flash('pesanSukses', 'Data User Berhasil Dihapus ...');
        } catch (\Exception $e) {
            dd($e);
            die;
            Session::flash('pesanError', 'Data User Gagal Dihapus ...');
        }

        return redirect('user'.$var['url']['all']);
    }

    public function cekValidasi(Request $request)
    {
        if($request->kolom == 'email'){
            $kriteria = $request->email;
        }else if($request->kolom == 'username'){
            $kriteria = $request->username;
        }else if($request->kolom == 'nip'){
            $kriteria = $request->nip;
        }


        if($request->aksi == 'create'){
            $jumlah = User::where($request->kolom, $kriteria)->count();

            if ($jumlah != 0) {
                return Response::json(false);
            }else{
                return Response::json(true);
            }
        }else if($request->aksi == 'edit'){
            $jumlah = User::where($request->kolom, $kriteria)->count();

            if ($jumlah != 0) {
                $jumlah2 = User::where($request->kolom, $kriteria)->where('id', $request->pk)->count();

                if($jumlah2 == 1){
                   return Response::json(true); 
                }else{
                    return Response::json(false);
                }
            }else{
                return Response::json(true);
            }
        }
    }
}
