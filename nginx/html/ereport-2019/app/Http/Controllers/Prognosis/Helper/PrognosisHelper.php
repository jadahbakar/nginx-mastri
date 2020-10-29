<?php

namespace App\Http\Controllers\Prognosis\Helper;

use Log;
use App\Models\Kode\KodeAkunPrognosis;
use App\Models\Penerimaan\Penerimaan;
use App\Models\Pengeluaran\Pengeluaran;
use App\Models\Akuntansi\Akuntansi;

class PrognosisHelper
{
	public function jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi)
	{
		$queryAnggaran = KodeAkunPrognosis::whereRaw('length(kdRekening) >= 35')
				->whereRaw('substring(kdRekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		if($viewData == 2 || $viewData == 1) $queryAnggaran->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$jumlah = $queryAnggaran->sum('anggaran');
		return $jumlah;
	}

	public function jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran)
	{
		$queryTambahKurang = KodeAkunPrognosis::whereRaw('length(kdRekening) >= 35')
				->whereRaw('substring(kdRekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		if($viewData == 2 || $viewData == 1) $queryTambahKurang->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$jumlah = $queryTambahKurang->sum('tambah_kurang');

		$prognosis = ($sisaAnggaran*-1) + $jumlah;
		return $prognosis;
	}

	public function jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$queryRealisasiPositif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['11', '12', '13', '14']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('penerimaan');

		$queryRealisasiNegatif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['15', '16', '17', '18']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('penerimaan');

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "KreditDebet");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Penerimaan laporan prognosis SAP '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$queryRealisasiPositif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['58', '80', '84', '85', '86', '87']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('jumlah');

		$queryRealisasiNegatif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['83']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('jumlah');

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "DebetKredit");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Pengeluaran laporan prognosis SAP '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$jumlahRealisasiPositif = 0;
		$jumlahRealisasiNegatif = 0;

		$queryRealisasiPositif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['11', '12', '13', '14']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('penerimaan');

		$queryRealisasiNegatif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['15', '16', '17', '18']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('penerimaan');		

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "KreditDebet");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Pembiayaan Penerimaan laporan prognosis SAP '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function jumRealisasiPembiayaanPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$jumlahRealisasiPositif = 0;
		$jumlahRealisasiNegatif = 0;
		
		$queryRealisasiPositif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['58', '80', '84', '85', '86', '87']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('jumlah');

		$queryRealisasiNegatif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['83']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw('substring(kode_rekening,25,11) in (select kdakun13 from kdakun_mapping where '.$sql.')');
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('jumlah');

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "DebetKredit");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Pembiayaan Pengeluaran laporan prognosis SAP '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi)
	{
		$queryAnggaran = KodeAkunPrognosis::whereRaw('length(kdRekening) >= 35')->whereRaw($sql);
		if($viewData == 2 || $viewData == 1) $queryAnggaran->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$jumlah = $queryAnggaran->sum('anggaran');
		return $jumlah;
	}

	public function jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran)
	{
		$queryTambahKurang = KodeAkunPrognosis::whereRaw('length(kdRekening) >= 35')->whereRaw($sql);
		if($viewData == 2 || $viewData == 1) $queryTambahKurang->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$jumlah = $queryTambahKurang->sum('tambah_kurang');

		$prognosis = ($sisaAnggaran*-1) + $jumlah;
		return $prognosis;
	}

	public function jumRealisasiPendapatan13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$queryRealisasiPositif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['11', '12', '13', '14']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw($sql);
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('penerimaan');

		$queryRealisasiNegatif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['15', '16', '17', '18']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw($sql);
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('penerimaan');

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "KreditDebet");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Penerimaan laporan prognosis PERMEN '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function jumRealisasiPengeluaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$queryRealisasiPositif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['58', '80', '84', '85', '86', '87']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw($sql);
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('jumlah');

		$queryRealisasiNegatif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['83']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw($sql);
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('jumlah');

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "DebetKredit");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Pengeluaran laporan prognosis PERMEN '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function jumRealisasiPembiayaanPenerimaan13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$jumlahRealisasiPositif = 0;
		$jumlahRealisasiNegatif = 0;
		
		$queryRealisasiPositif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['11', '12', '13', '14']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw($sql);
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('penerimaan');

		$queryRealisasiNegatif = Penerimaan::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)->whereIn('jns_transaksi', ['15', '16', '17', '18']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw($sql);
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('penerimaan');

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "KreditDebet");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Pembiayaan Penerimaan laporan prognosis PERMEN '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function jumRealisasiPembiayaanPengeluaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud)
	{
		$jumlahRealisasiPositif = 0;
		$jumlahRealisasiNegatif = 0;
		
		$queryRealisasiPositif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['58', '80', '84', '85', '86', '87']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiPositif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiPositif->whereRaw($sql);
		$jumlahRealisasiPositif = $queryRealisasiPositif->sum('jumlah');

		$queryRealisasiNegatif = Pengeluaran::whereMonth('tanggal_transaksi', '<=', '6')->whereYear('tanggal_transaksi', $tahun)->whereIn('jenis_transaksi', ['83']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiNegatif->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiNegatif->whereRaw($sql);
		$jumlahRealisasiNegatif = $queryRealisasiNegatif->sum('jumlah');

		$realisasiBlud = $this->realisasiBlud($sqlBlud, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, "DebetKredit");
		$realisasi = $jumlahRealisasiPositif - $jumlahRealisasiNegatif + $realisasiBlud;
		Log::info('Realisasi Pembiayaan Pengeluaran laporan prognosis PERMEN '.$kodeOrganisasi.' : '.$realisasi.' = '.$jumlahRealisasiPositif.' - '.$jumlahRealisasiNegatif);

		return $realisasi;
	}

	public function realisasiBlud($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $jenis)
	{
		$queryRealisasiDebet = Akuntansi::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)
				->whereIn('jenis_transaksi', ['64']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiDebet->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiDebet->whereRaw($sql['debet']);
		$jumlahRealisasiDebet = $queryRealisasiDebet->sum('jumlah');

		$queryRealisasiKredit = Akuntansi::whereMonth('tanggal', '<=', '6')->whereYear('tanggal', $tahun)
				->whereIn('jenis_transaksi', ['64']);
		if($viewData == 2 || $viewData == 1) $queryRealisasiKredit->whereRaw('kode_organisasi="'.$kodeOrganisasi.'"');
		$queryRealisasiKredit->whereRaw($sql['kredit']);
		$jumlahRealisasiKredit = $queryRealisasiKredit->sum('jumlah');

		if($jenis == 'KreditDebet'){
			$jumlah = $jumlahRealisasiKredit - $jumlahRealisasiDebet;
		}else if($jenis == 'DebetKredit'){
			$jumlah = $jumlahRealisasiDebet - $jumlahRealisasiKredit;
		}

		return $jumlah;
	}

	public function getListRekeningPendapatan($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,25,1)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,27,1)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,29,1)," ","")as signed)as uruttiga'
				)
				->whereRaw('substring(kdRekening,25,1)="4"')->whereRaw('length(kdRekening) <= 29');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPendapatan = $queryRekening->orderByRaw('urut, urutdua, uruttiga asc')->get();
		Log::info('List Rekening Rincian Pendapatan SKPD : '.$kodeOrganisasi);

		return $listRekeningPendapatan;
	}

	public function getListRekeningPengeluaran($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,18,2)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,21,3)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,25,5)," ","")as signed)as uruttiga,
					cast(replace(substring(kdRekening,31,2)," ","")as signed)as urutempat,
					cast(replace(substring(kdRekening,34,2)," ","")as signed)as urutlima 
				')
				->whereRaw('(substring(kdRekening,25,1)="5" or (substring(kdRekening,18,2)!="00" and length(kdRekening)<="23"))')
				->whereRaw('substring(kdRekening,1,16) in (select kd_urusan from m_urusan where kd_org="'.$kodeOrganisasi.'" order by id_urusan asc)')
				->whereRaw('length(kdRekening) <= 29');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPengeluaran = $queryRekening->orderByRaw('urut, urutdua, uruttiga, urutempat, urutlima asc')->get();
		Log::info('List Rekening Rincian Pengeluaran SKPD : '.$kodeOrganisasi);

		return $listRekeningPengeluaran;
	}

	public function getListRekeningPenerimaanPembiayaan($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,25,1)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,27,1)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,29,1)," ","")as signed)as uruttiga'
				)
				->whereRaw('substring(kdRekening,25,1)="6"')->whereRaw('length(kdRekening) <= 29')
				->whereRaw('substring(kdRekening,25,3) != "6 2"');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPenerimaanPembiayaan = $queryRekening->orderByRaw('urut, urutdua, uruttiga asc')->get();
		Log::info('List Rekening Rincian Penerimaan Pembiayaan SKPD : '.$kodeOrganisasi);

		return $listRekeningPenerimaanPembiayaan;
	}

	public function getListRekeningPengeluaranPembiayaan($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,25,1)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,27,1)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,29,1)," ","")as signed)as uruttiga'
				)
				->whereRaw('substring(kdRekening,25,3)="6 2"')->whereRaw('length(kdRekening) <= 29');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPengeluaranPembiayaan = $queryRekening->orderByRaw('urut, urutdua, uruttiga asc')->get();
		Log::info('List Rekening Rincian Pengeluaran Pembiayaan SKPD : '.$kodeOrganisasi);

		return $listRekeningPengeluaranPembiayaan;
	}

	public function getListRekeningPendapatanPenjabaran($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,25,1)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,27,1)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,29,1)," ","")as signed)as uruttiga,
					cast(replace(substring(kdRekening,31,2)," ","")as signed)as urutempat,
					cast(replace(substring(kdRekening,34,2)," ","")as signed)as urutlima'
				)
				->whereRaw('substring(kdRekening,25,1)="4"');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPendapatan = $queryRekening->orderByRaw('urut, urutdua, uruttiga, urutempat, urutlima asc')->get();
		Log::info('List Rekening Penjabaran Pendapatan SKPD : '.$kodeOrganisasi);

		return $listRekeningPendapatan;
	}

	public function getListRekeningPengeluaranPenjabaran($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,18,2)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,21,3)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,25,5)," ","")as signed)as uruttiga,
					cast(replace(substring(kdRekening,31,2)," ","")as signed)as urutempat,
					cast(replace(substring(kdRekening,34,2)," ","")as signed)as urutlima 
				')
				->whereRaw('(substring(kdRekening,25,1)="5" or (substring(kdRekening,18,2)!="00" and length(kdRekening)<="23"))')
				->whereRaw('substring(kdRekening,1,16) in (select kd_urusan from m_urusan where kd_org="'.$kodeOrganisasi.'" order by id_urusan asc)');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPengeluaran = $queryRekening->orderByRaw('urut, urutdua, uruttiga, urutempat, urutlima asc')->get();
		Log::info('List Rekening Penjabaran Pengeluaran SKPD : '.$kodeOrganisasi);

		return $listRekeningPengeluaran;
	}

	public function getListRekeningPenerimaanPembiayaanPenjabaran($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,25,1)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,27,1)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,29,1)," ","")as signed)as uruttiga,
					cast(replace(substring(kdRekening,31,2)," ","")as signed)as urutempat,
					cast(replace(substring(kdRekening,34,2)," ","")as signed)as urutlima'
				)
				->whereRaw('substring(kdRekening,25,1)="6"')
				->whereRaw('substring(kdRekening,25,3) != "6 2"');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPenerimaanPembiayaan = $queryRekening->orderByRaw('urut, urutdua, uruttiga, urutempat, urutlima asc')->get();
		Log::info('List Rekening Penjabaran Penerimaan Pembiayaan SKPD : '.$kodeOrganisasi);

		return $listRekeningPenerimaanPembiayaan;
	}

	public function getListRekeningPengeluaranPembiayaanPenjabaran($viewData, $kodePengguna, $kodeOrganisasi, $tahun)
	{
		$queryRekening = KodeAkunPrognosis::selectRaw('kdRekening,nmRekening,
					cast(replace(substring(kdRekening,25,1)," ","")as signed)as urut,
					cast(replace(substring(kdRekening,27,1)," ","")as signed)as urutdua,
					cast(replace(substring(kdRekening,29,1)," ","")as signed)as uruttiga,
					cast(replace(substring(kdRekening,31,2)," ","")as signed)as urutempat,
					cast(replace(substring(kdRekening,34,2)," ","")as signed)as urutlima'
				)
				->whereRaw('substring(kdRekening,25,3)="6 2"');
		if($viewData == 2 || $viewData == 1) $queryRekening->whereRaw('substring(kdRekening,8,9)="'.$kodeOrganisasi.'"');
		$listRekeningPengeluaranPembiayaan = $queryRekening->orderByRaw('urut, urutdua, uruttiga, urutempat, urutlima asc')->get();
		Log::info('List Rekening Penjabaran Pengeluaran Pembiayaan SKPD : '.$kodeOrganisasi);

		return $listRekeningPengeluaranPembiayaan;
	}

	public function sisaAnggaran($anggaran, $realisasi)
	{
		$sisaAnggaran = $realisasi - $anggaran;
		return $sisaAnggaran;
	}

	public function totalPrognosis($realisasi, $prognosis)
	{
		$totalPrognosis = $realisasi + $prognosis;
		return $totalPrognosis;
	}

	public function percobaan($kode)
	{
		Log::info('Kode Rekening : '.$kode);
		return 0;
	}
}