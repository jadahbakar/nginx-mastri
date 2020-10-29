<?php

namespace App\Models\Kode;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Akuntansi\Posting;
use App\Http\Controllers\Prognosis\Helper\PrognosisHelper;

class KodeAkunPrognosis extends Model
{
    protected $primaryKey = 'kdRekening';
    public $incrementing = false;
    protected $table = 'kd_akun_prognosis';
    protected $fillable = [
        'kdRekening', 'nmRekening', 'kode_kegiatan', 'kode_rincian_objek', 'kdLapor', 
        'kdOrganisasi', 'anggaran', 'realisasi', 'sisa', 'tambah_kurang', 'jumlah',
        'jenis_input', 'kode_organisasi', 'kode_pengguna'
    ];

    public function scopeCariKodeRincianObjekPrognosis($query, $cari){
        return $query ->where('kdRekening', 'like', '%'.$cari.'%')
            ->orWhere('nmRekening', 'like', '%'.$cari.'%')
            ->orWhere('anggaran', 'like', '%'.$cari.'%');
    }

    public function scopeViewPengguna($query){
        if(Auth::user()->view == 2) {
            $queryView = $query->where('kode_organisasi', Auth::user()->organisasi);
        }else if(Auth::user()->view == 1){
            $queryView = null;
        }

        return $queryView;
    }

    public function setAnggaranAttribute($data) {
        $this->attributes['anggaran'] = hilangTiTik($data);
    }

    public function getAnggaranAttribute($value){
        return mataUang($value);
    }

    public function setRealisasiAttribute($data) {
        $this->attributes['realisasi'] = hilangTiTik($data);
    }

    public function getRealisasiAttribute($value){
        return mataUang($value);
    }

    public function setSisaAttribute($data) {
        $this->attributes['sisa'] = hilangTiTik($data);
    }

    public function getSisaAttribute($value){
        return mataUang($value);
    }

    public function setTambahKurangAttribute($data) {
        $this->attributes['tambah_kurang'] = hilangTiTik($data);
    }

    public function getTambahKurangAttribute($value){
        return mataUang($value);
    }

    public function setJumlahAttribute($data) {
        $this->attributes['jumlah'] = hilangTiTik($data);
    }

    public function getJumlahAttribute($value){
        return mataUang($value);
    }

    public function getJumAnggaranPrognosis(){
        $helper = new PrognosisHelper();
        $sql = 'kdRekening regexp "^'.$this->kdRekening.'"';
        if(Auth::user()->view == 2){
            $viewData = Auth::user()->view;
            $kodePengguna =  Auth::user()->kode_pengguna;
            $kodeOrganisasi = Auth::user()->organisasi;
        }else if(Auth::user()->view == 1){
            $viewData = $this->pengguna->view;
            $kodePengguna =  $this->kode_pengguna;
            $kodeOrganisasi = $this->kode_organisasi;
        }

        $jumAnggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);;
        return $jumAnggaran;
    }

    public function pengguna() {
        return $this->belongsTo('App\Models\Pengaturan\Pengguna', 'kode_pengguna');
    }

    public function getJumRealisasiPrognosis($tahun = null){
        $helper = new PrognosisHelper();
        
        if($tahun == null) $tahun = Carbon::now()->format('Y');

        $kodeRekening = trim($this->kdRekening);
        $sql = 'kode_rekening regexp "^'.$kodeRekening.'"';
        if(Auth::user()->view == 2){
            $viewData = Auth::user()->view;
            $kodePengguna =  Auth::user()->kode_pengguna;
            $kodeOrganisasi = Auth::user()->organisasi;
        }else if(Auth::user()->view == 1){
            $viewData = $this->pengguna->view;
            $kodePengguna =  $this->kode_pengguna;
            $kodeOrganisasi = $this->kode_organisasi;
        }

        $sqlBlud = [
            'debet' => 'akun_debet_lra13="'.$this->kdRekening.'"', 
            'kredit' => 'akun_kredit_lra13="'.$this->kdRekening.'"'
        ];

        if($kodeRekening[24] == "4"){
            $jumRealisasi = $helper->jumRealisasiPendapatan13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
        }else if($kodeRekening[24] == "5"){
            $jumRealisasi = $helper->jumRealisasiPengeluaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
        }else if($kodeRekening[24] == "6"){
            $kodePembiayaanDebet = $kodeRekening[24]." ".$kodeRekening[26];
            if($kodePembiayaanDebet=="6 1"){
                $jumRealisasi = $helper->jumRealisasiPendapatan13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
            }else if($kodePembiayaanDebet=="6 2"){
                $jumRealisasi = $helper->jumRealisasiPengeluaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
            }
        }

        return $jumRealisasi;
    }

    public function updateDataKodeAkunPrognosis($anggaran, $realisasi, $sisa, $tambahKurang, $prognosis){
        $kodeAkunPrognosis = KodeAkunPrognosis::find($this->kdRekening);
        $kodeAkunPrognosis->anggaran = $anggaran;
        $kodeAkunPrognosis->realisasi = $realisasi;
        $kodeAkunPrognosis->sisa = $sisa;
        $kodeAkunPrognosis->tambah_kurang = $tambahKurang;
        $kodeAkunPrognosis->jumlah = $prognosis;
        $kodeAkunPrognosis->save();
    }
}
