<?php

namespace App\Http\Controllers\EntryData\SKPD\Akuntansi;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Penerimaan\Penerimaan;
use App\Models\Pengeluaran\Pengeluaran;
use App\Models\Pengaturan\Pengguna;
use App\Models\Akuntansi\Jurnal;
use App\Models\Akuntansi\ProsesPosting;
use App\Models\Kode\MasterJurnal;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EntryData\Helper\AkuntansiHelper;
use App\Jobs\Akuntansi\PostingJob;

class PostingController extends Controller
{
    private $url;
    private $cari;
    private $jumPerPage = 10;
    private $jumPerModal = 6;

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
    public function index(Request $request)
    {
        $var['url'] = $this->url;
        $listPengguna = null;
        $jenisTransaksiPenerimaan = ['11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26'];
        $jenisTransaksiPengeluaran = ['31','32','33','42','43','44','45','46','47','48','49','50','51','52','58','80','83','84','85','86','87'];
        $var['bulan'] = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni',
                7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'Nopember', 12=>'Desember'];
        $var['jenis_transaksi'] = getPostingJenisTransaksi();
        if(Auth::user()->view == 2){
            $inputBy = Auth::user()->kode_pengguna;
            $kodeOrganisasi = Auth::user()->organisasi;
        }else if(Auth::user()->view == 1){
            $inputBy = $request->kode_pengguna;
            $kodeOrganisasi = $request->kode_organisasi;
        }

        //-------------------PENERIMAAN-----------------------------
        $queryTransaksi = Penerimaan::selectRaw('no_trans, tanggal as tanggal_transaksi, jns_transaksi as jenis_transaksi,
            kode_rekening, penerimaan as jumlah, created_at')->where('status_verifikasi', '1')
            ->whereNotIn('no_trans', function ($queryIn) use ($kodeOrganisasi) {
                $queryIn->selectRaw('no_transaksi')->distinct()
                    ->from('jurnal')
                    ->where('status', 'POSTING');
                if(Auth::user()->view == 2){
                    $queryIn->where('kode_organisasi', Auth::user()->organisasi);
                }else if(Auth::user()->view == 1){
                    if($kodeOrganisasi != "")  $queryIn->where('kode_organisasi', $kodeOrganisasi);
                }
            });
        if(Auth::user()->view == 2){
            $queryTransaksi->where('kode_organisasi', Auth::user()->organisasi);
        }else if(Auth::user()->view == 1){
            $queryTransaksi->where('kode_organisasi', $kodeOrganisasi);
        }
        if($request->no_trans != "") $queryTransaksi->where('no_trans', 'like', '%'.$request->no_trans.'%');
        if($request->jenis_transaksi != ""){
            $queryTransaksi->where('jns_transaksi', $request->jenis_transaksi);
        }else{
            $queryTransaksi->whereIn('jns_transaksi', $jenisTransaksiPenerimaan);
        }
        if($request->bulan != "") $queryTransaksi->whereMonth('tanggal', $request->bulan);
        if($request->tahun != "") $queryTransaksi->whereYear('tanggal', $request->tahun);

        //------------------------------PENGELUARAN----------------------------
        $queryTransaksi2 = Pengeluaran::selectRaw('no_trans, tanggal_transaksi, jenis_transaksi, kode_rekening, jumlah, created_at')
            ->where('status_verifikasi', '1')
            ->whereNotIn('no_trans', function ($queryIn) use ($kodeOrganisasi) {
                $queryIn->selectRaw('no_transaksi')->distinct()
                    ->from('jurnal')
                    ->where('status', 'POSTING');
                if(Auth::user()->view == 2){
                    $queryIn->where('kode_organisasi', Auth::user()->organisasi);
                }else if(Auth::user()->view == 1){
                    if($kodeOrganisasi != "")  $queryIn->where('kode_organisasi', $kodeOrganisasi);
                }
            });
        if(Auth::user()->view == 2){
            $queryTransaksi2->where('kode_organisasi', Auth::user()->organisasi);
        }else if(Auth::user()->view == 1){
            $queryTransaksi2->where('kode_organisasi', $kodeOrganisasi);
        }
        if($request->no_trans != "") $queryTransaksi2->where('no_trans', 'like', '%'.$request->no_trans.'%');
        if($request->jenis_transaksi != ""){
            $queryTransaksi2->where('jenis_transaksi', $request->jenis_transaksi);
        }else{
            $queryTransaksi2->whereIn('jenis_transaksi', $jenisTransaksiPengeluaran);
        }
        if($request->bulan != "") $queryTransaksi2->whereMonth('tanggal_transaksi', $request->bulan);
        if($request->tahun != "") $queryTransaksi2->whereYear('tanggal_transaksi', $request->tahun);

        //------------------------------JURNAL----------------------------
        $queryJurnal = Jurnal::distinct('no_transaksi')->where('status', 'POSTING');
        if(Auth::user()->view == 2){
            $queryJurnal->where('kode_organisasi', Auth::user()->organisasi);
        }else if(Auth::user()->view == 1){
            $queryJurnal->where('kode_organisasi', $kodeOrganisasi);
        }
        if($request->no_trans != "") $queryJurnal->where('no_transaksi', 'like', '%'.$request->no_trans.'%');
        if($request->jenis_transaksi != ""){
            $queryJurnal->where('jenis_transaksi', $request->jenis_transaksi);
        }else{
            $queryJurnal->whereIn('jenis_transaksi', $jenisTransaksiPengeluaran);
        }
        if($request->bulan != "") $queryJurnal->whereMonth('tgl_transaksi', $request->bulan);
        if($request->tahun != "") $queryJurnal->whereYear('tgl_transaksi', $request->tahun);

        //-----------------------------------------------------------------------

        $listTransaksi = $queryTransaksi->union($queryTransaksi2)->orderBy('created_at', 'desc')->get();
        $listTransaksiSemua = new LengthAwarePaginator($listTransaksi->forPage($request->page, $this->jumPerPage), $listTransaksi->count(),
                        $this->jumPerPage, $request->page, ['path'=>'posting'.$var['url']['cari']]);
        $var['jumlahTerposting'] = $queryJurnal->count('no_transaksi');
        $helper = new AkuntansiHelper();

        $queryProsesPosting = ProsesPosting::orderBy('id', 'desc');
        (!empty($this->cari))?$queryProsesPosting->CariProsesPrognosis($this->cari):'';
        $queryProsesPosting->ViewPengguna();
        $listProsesPosting = $queryProsesPosting->limit($this->jumPerPage)->get();


        // if(Auth::user()->view == 1){
        //     $pengguna = Pengguna::get();
        //     $listPengguna = ['semua' => 'Semua Organisasi / User'];
        //     foreach($pengguna as $item) {
        //         $listPengguna[$item['kode_pengguna']] = $item['kode_pengguna']." | ".$item['nama']." | ".$item['organisasi'];
        //     }
        // }

        return view('entry-data.skpd.akuntansi.posting.posting-tabel', compact('var', 'listTransaksiSemua', 'helper', 'listProsesPosting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            if(Auth::user()->view == 2){
                $inputBy = Auth::user()->kode_pengguna;
                $kodeOrganisasi = Auth::user()->organisasi;
                $viewData = 2;
                $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi];
            }else if(Auth::user()->view == 1){
                if($request->kode_pengguna != 'semua'){
                    $inputBy = $request->kode_pengguna;
                    $kodeOrganisasi = $request->kode_organisasi;
                    $listDataUser[] = ['inputBy'=>$inputBy, 'kodeOrganisasi'=>$kodeOrganisasi];
                }else if($request->kode_pengguna == 'semua'){
                    $organisasi = KodeOrganisasi::get();
                    foreach($organisasi as $item){
                        $listDataUser[] = ['inputBy'=>Auth::user()->kode_pengguna, 'kodeOrganisasi'=>$item['kode_organisasi']];
                    }
                }
            }

            foreach($listDataUser as $itemUser){
                $prosesPosting = new ProsesPosting();
                $prosesPosting->status = 'Berjalan';
                $prosesPosting->kode_organisasi = $itemUser['kodeOrganisasi'];
                $prosesPosting->kode_pengguna = $itemUser['inputBy'];
                $prosesPosting->save();

                $idProsesPosting = $prosesPosting->id;

                $dataQueue = [
                    'inputBy' => $itemUser['inputBy'], 'kodeOrganisasi' => $itemUser['kodeOrganisasi'], 'idProsesPosting' => $idProsesPosting
                ];
                PostingJob::dispatch($dataQueue);
            }

            Session::flash('pesanSukses', 'Data Berhasil Diposting');
        } catch (\Exception $e) {
            Session::flash('pesanError', 'Data Gagal Diposting');
            return redirect('entry-data/skpd/akuntansi/posting');
        }

        return redirect('entry-data/skpd/akuntansi/posting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function simpanJurnal(Request $request)
    {
        $noTrans = $request->noTrans;
        $user = $request->user;
        $aksi = $request->aksi;

        if($aksi == 'save'){
            $cekJurnal = Jurnal::where('no_transaksi', $noTrans)->get();
            if(count($cekJurnal) == 0){
                $dataJurnal = Penerimaan::selectRaw('no_trans, tanggal as tanggal_transaksi, jns_transaksi as jenis_transaksi,
                    kode_rekening, penerimaan as jumlah, keterangan')->where('no_trans', $noTrans)->first();
                if(count($dataJurnal) == 0){
                    $dataJurnal = Pengeluaran::selectRaw('no_trans, tanggal_transaksi, jenis_transaksi, kode_rekening, jumlah,
                        jumlah_pajak, keterangan')->where('no_trans', $noTrans)->first();
                }

                if($dataJurnal->jenis_transaksi=='43' || $dataJurnal->jenis_transaksi=='44' || $dataJurnal->jenis_transaksi=='45' ||
                    $dataJurnal->jenis_transaksi=='46' || $dataJurnal->jenis_transaksi=='47' || $dataJurnal->jenis_transaksi=='48' ||
                    $dataJurnal->jenis_transaksi=='49' || $dataJurnal->jenis_transaksi=='50' || $dataJurnal->jenis_transaksi=='51' ||
                    $dataJurnal->jenis_transaksi=='52'){
                    $jumlah = $dataJurnal->jumlah_pajak;
                }else{
                    $jumlah = $dataJurnal->jumlah;
                }

                if($dataJurnal->jenis_transaksi=='19' || $dataJurnal->jenis_transaksi=='20' ||
                    $dataJurnal->jenis_transaksi=='30' || $dataJurnal->jenis_transaksi=='31' || $dataJurnal->jenis_transaksi=='32' ||
                    $dataJurnal->jenis_transaksi=='33' || $dataJurnal->jenis_transaksi=='88'|| $dataJurnal->jenis_transaksi=='42' ||
                    $dataJurnal->jenis_transaksi=='43' || $dataJurnal->jenis_transaksi=='44' || $dataJurnal->jenis_transaksi=='45' ||
                    $dataJurnal->jenis_transaksi=='46' || $dataJurnal->jenis_transaksi=='47' || $dataJurnal->jenis_transaksi=='48' ||
                    $dataJurnal->jenis_transaksi=='49' || $dataJurnal->jenis_transaksi=='50' || $dataJurnal->jenis_transaksi=='51' ||
                    $dataJurnal->jenis_transaksi=='52'){
                    $kodeAkun = "-";
                    $sqlRekening = "";
                }else{
                    $kodeAkun = substr($dataJurnal->kode_rekening, 24, 11);
                }

                $pengguna = Pengguna::find($user);

                $queryMasterJurnal = MasterJurnal::where('jenis_transaksi', $dataJurnal->jenis_transaksi);
                if($kodeAkun != '-') $queryMasterJurnal->where('kode_akun', $kodeAkun);
                $masterJurnal = $queryMasterJurnal->first();

                $noUrutTampil = Jurnal::max('urut_tampil') + 1;

                //------------------LRA 13---------------------------
                if($masterJurnal->lra_13_debet != "" && $masterJurnal->lra_13_kredit != ""){
                    $noUrut = Jurnal::max('no_urut') + 1;
                    $jurnal = new Jurnal();
                    $jurnal->no_transaksi = $dataJurnal->no_trans;
                    $jurnal->tgl_transaksi = $dataJurnal->tanggal_transaksi;
                    $jurnal->jenis_transaksi = $dataJurnal->jenis_transaksi;
                    $jurnal->no_urut = $noUrut;
                    $jurnal->kode_akun = $kodeAkun;
                    $jurnal->jenis_jurnal = 'LRA 13';
                    $jurnal->kode_pengguna = $pengguna->kode_pengguna;
                    $jurnal->kode_lapor = $pengguna->kode_lapor;
                    $jurnal->kode_organisasi = $pengguna->organisasi;
                    $jurnal->kd_org_catat = $pengguna->organisasi;
                    $jurnal->akun_debet = $masterJurnal->lra_13_debet;
                    $jurnal->akun_kredit = $masterJurnal->lra_13_kredit;
                    $jurnal->jumlah = $jumlah;
                    $jurnal->keterangan = $dataJurnal->keterangan;
                    $jurnal->status = 'JURNAL';
                    $jurnal->urut_tampil = $noUrutTampil;
                    $jurnal->save();
                }
                //------------------LRA 64---------------------------
                if($masterJurnal->lra_64_debet != "" && $masterJurnal->lra_64_kredit != ""){
                    $noUrut = Jurnal::max('no_urut') + 1;
                    $jurnal = new Jurnal();
                    $jurnal->no_transaksi = $dataJurnal->no_trans;
                    $jurnal->tgl_transaksi = $dataJurnal->tanggal_transaksi;
                    $jurnal->jenis_transaksi = $dataJurnal->jenis_transaksi;
                    $jurnal->no_urut = $noUrut;
                    $jurnal->kode_akun = $kodeAkun;
                    $jurnal->jenis_jurnal = 'LRA 64';
                    $jurnal->kode_pengguna = $pengguna->kode_pengguna;
                    $jurnal->kode_lapor = $pengguna->kode_lapor;
                    $jurnal->kode_organisasi = $pengguna->organisasi;
                    $jurnal->kd_org_catat = $pengguna->organisasi;
                    $jurnal->akun_debet = $masterJurnal->lra_64_debet;
                    $jurnal->akun_kredit = $masterJurnal->lra_64_kredit;
                    $jurnal->jumlah = $jumlah;
                    $jurnal->keterangan = $dataJurnal->keterangan;
                    $jurnal->status = 'JURNAL';
                    $jurnal->urut_tampil = $noUrutTampil;
                    $jurnal->save();
                }
                //------------------LO---------------------------
                if($masterJurnal->lo_debet != "" && $masterJurnal->lo_kredit != ""){
                    $noUrut = Jurnal::max('no_urut') + 1;
                    $jurnal = new Jurnal();
                    $jurnal->no_transaksi = $dataJurnal->no_trans;
                    $jurnal->tgl_transaksi = $dataJurnal->tanggal_transaksi;
                    $jurnal->jenis_transaksi = $dataJurnal->jenis_transaksi;
                    $jurnal->no_urut = $noUrut;
                    $jurnal->kode_akun = $kodeAkun;
                    $jurnal->jenis_jurnal = 'LO';
                    $jurnal->kode_pengguna = $pengguna->kode_pengguna;
                    $jurnal->kode_lapor = $pengguna->kode_lapor;
                    $jurnal->kode_organisasi = $pengguna->organisasi;
                    $jurnal->kd_org_catat = $pengguna->organisasi;
                    $jurnal->akun_debet = $masterJurnal->lo_debet;
                    $jurnal->akun_kredit = $masterJurnal->lo_kredit;
                    $jurnal->jumlah = $jumlah;
                    $jurnal->keterangan = $dataJurnal->keterangan;
                    $jurnal->status = 'JURNAL';
                    $jurnal->urut_tampil = $noUrutTampil;
                    $jurnal->save();
                }
                //------------------JF PPKD---------------------------
                if($masterJurnal->jf_ppkd_debet != "" && $masterJurnal->jf_ppkd_kredit != ""){
                    $noUrut = Jurnal::max('no_urut') + 1;
                    $jurnal = new Jurnal();
                    $jurnal->no_transaksi = $dataJurnal->no_trans;
                    $jurnal->tgl_transaksi = $dataJurnal->tanggal_transaksi;
                    $jurnal->jenis_transaksi = $dataJurnal->jenis_transaksi;
                    $jurnal->no_urut = $noUrut;
                    $jurnal->kode_akun = $kodeAkun;
                    $jurnal->jenis_jurnal = 'JF PPKD';
                    $jurnal->kode_pengguna = $pengguna->kode_pengguna;
                    $jurnal->kode_lapor = $pengguna->kode_lapor;
                    $jurnal->kode_organisasi = $pengguna->organisasi;
                    $jurnal->kd_org_catat = '3.1.02.01';
                    $jurnal->akun_debet = $masterJurnal->jf_ppkd_debet;
                    $jurnal->akun_kredit = $masterJurnal->jf_ppkd_kredit;
                    $jurnal->jumlah = $jumlah;
                    $jurnal->keterangan = $dataJurnal->keterangan;
                    $jurnal->status = 'JURNAL';
                    $jurnal->urut_tampil = $noUrutTampil;
                    $jurnal->save();
                }
            }
        }else if($aksi == 'delete'){
            $cekJurnal = Jurnal::where('no_transaksi', $noTrans)->get();
            if(count($cekJurnal) != 0) $deleteJurnal =  Jurnal::where('no_transaksi', $noTrans)->delete();
        }

        $tampil = Jurnal::where('kode_pengguna', $user)->where('status', 'JURNAL')->max('urut_tampil');
        $listData = Jurnal::where('urut_tampil', $tampil)->where('status', 'JURNAL')->orderBy('id', 'asc')->get();
        $helper = new AkuntansiHelper();

        return view('entry-data.skpd.akuntansi.posting.jurnal-tabel', compact('listData', 'helper'));
    }

    public function tabelJurnal()
    {
        $listData = collect([]);
        return view('entry-data.skpd.akuntansi.posting.jurnal-tabel', compact('listData'));
    }
}
