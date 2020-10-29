<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	    <meta name="description" content="E-Report Pemerintah Kota Semarang, Keuangan Pemerintah Kota Semarang, Akuntansi, Pengeluaran, Penerimaan, Konsolidasi">
	    <meta name="keywords" content="E-Report Pemerintah Kota Semarang, Keuangan Pemerintah Kota Semarang, Akuntansi, Pengeluaran, Penerimaan, Konsolidasi">
	    <meta name="author" content="Visualmedia Semarang">
	    <link rel="shortcut icon" type="image/x-icon" href="{{ url('my-assets/gambar/logo-icon-128.png') }}">
        <link href="{{ asset('my-assets/print.css') }}" rel="stylesheet">
        <style>
            div,p {font-size:16px}
            table tr td {font-size:16px}
            table tr th {font-size:16px}
        </style>
	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	    <title>E-Report Pemerintah Kota Semarang</title>
	</head>
	<body>
		<h3 style="text-align:center;">PEMERINTAH KOTA SEMARANG</h3>
		<h3 style="text-align:center;">LAPORAN REALISASI SEMESTER PERTAMA APBD DAN PROGNOSIS 6 (ENAM) BULAN BERIKUTNYA</h3>
		<h3 style="text-align:center;">TAHUN ANGGARAN {!! $var['tahun'] !!}</h3>
		<h3 style="text-align:center;">{!! $var['nama_organisasi'] !!}</h3>
		<br /><br />

		<p style="text-align: right;"><b>SKPD / PPKD</b></p>
		@php
			$viewData = $var['view_data'];
			$kodePengguna = $var['kode_pengguna'];
			$kodeOrganisasi = $var['kode_organisasi'];
			$tahun = $var['tahun'];
			$sql2 = array();

			$jumAnggaranPendapatan = 0;
			$jumRealisasiPendapatan = 0;
			$jumPrognosisPendapatan = 0;

			$jumAnggaranPengeluaran = 0;
			$jumRealisasiPengeluaran = 0;
			$jumPrognosisPengeluaran = 0;

			$jumAnggaranPenerimaanPembiayaan = 0;
			$jumRealisasiPenerimaanPembiayaan = 0;
			$jumPrognosisPenerimaanPembiayaan = 0;

			$jumAnggaranPengeluaranPembiayaan = 0;
			$jumRealisasiPengeluaranPembiayaan = 0;
			$jumPrognosisPengeluaranPembiayaan = 0;
		@endphp

		<table width="100%" class="table-border" cellpadding="2" cellspacing="2" style="table-layout: fixed; word-wrap: break-word;">
			<thead style="background-color: #cdcdcd; font-size: 13px;">
				<tr>
					<th height="50px" width="5%"><center><b>No.</b></center></th>
					<th width="30%"><center><b>Uraian</b></center></th>
					<th><center><b>Jumlah Anggaran</b></center></th>
					<th><center><b>Realisasi Semester Pertama</b></center></th>
					<th><center><b>Sisa Anggaran s.d. Semester Pertama</b></center></th>
					<th><center><b>Prognosis</b></center></th>
					<th><center><b>Total</b></center></th>
					<th width="5%"><center><b>Ket.</b></center></th>
				</tr>
				<tr>
					<th><center><b>1</b></center></th>
					<th><center><b>2</b></center></th>
					<th><center><b>3</b></center></th>
					<th><center><b>4</b></center></th>
					<th><center><b>5</b></center></th>
					<th><center><b>6</b></center></th>
					<th><center><b>7</b></center></th>
					<th><center><b>8</b></center></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>1</b></center></td>
					<td class="bottom-top"><b>PENDAPATAN DAERAH</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) in ("4 1 1", "4 1 2", "4 1 3", "4 1 4")',
						'kredit' => 'substring(akun_kredit_lra13,25,5) in ("4 1 1", "4 1 2", "4 1 3", "4 1 4")'
					];
					$sql = 'substring(kdRekening,25,5) in ("4 1 1", "4 1 2", "4 1 3", "4 1 4")';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) in ("4 1 1", "4 1 2", "4 1 3", "4 1 4")';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>1.1</b></center></td>
					<td class="bottom-top"><b>Pendapatan Asli Daerah</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($anggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($realisasi) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($sisaAnggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($prognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($totalPrognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 1 1"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 1 1"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 1 1"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 1 1"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.1.1</center></td>
					<td class="bottom-top">Pajak Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 1 2"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 1 2"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 1 2"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 1 2"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.1.2</center></td>
					<td class="bottom-top">Retribusi Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 1 3"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 1 3"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 1 3"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 1 3"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.1.3</center></td>
					<td class="bottom-top">Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 1 4"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 1 4"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 1 4"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 1 4"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.1.4</center></td>
					<td class="bottom-top">Lain - lain Pendapatan Asli Daerah yang Sah </td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,8) in ("4 2 1 01", "4 2 1 02")',
						'kredit' => 'substring(akun_kredit_lra13,25,8) in ("4 2 1 01", "4 2 1 02")'
					];
					$sql = 'substring(kdRekening,25,8) in ("4 2 1 01", "4 2 1 02")';
					$anggaran_1 = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,8) in ("4 2 1 01", "4 2 1 02")';
					$realisasi_1 = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran_1 = $helper->sisaAnggaran($anggaran_1, $realisasi_1);
					$prognosis_1 = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran_1);
					$totalPrognosis_1 = $helper->totalPrognosis($realisasi_1, $prognosis_1);

					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) in ("4 2 2", "4 2 3")',
						'kredit' => 'substring(akun_kredit_lra13,25,5) in ("4 2 2", "4 2 3")'
					];
					$sql = 'substring(kdRekening,25,5) in ("4 2 2", "4 2 3")';
					$anggaran_2 = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) in ("4 2 2", "4 2 3")';
					$realisasi_2 = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran_2 = $helper->sisaAnggaran($anggaran_2, $realisasi_2);
					$prognosis_2 = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran_2);
					$totalPrognosis_2 = $helper->totalPrognosis($realisasi_2, $prognosis_2);

					$anggaran = $anggaran_1 + $anggaran_2;
					$realisasi = $realisasi_1 + $realisasi_2;
					$sisaAnggaran = $sisaAnggaran_1 + $sisaAnggaran_2;
					$prognosis = $prognosis_1 + $prognosis_2;
					$totalPrognosis = $totalPrognosis_1 + $totalPrognosis_2;
				@endphp
				<tr>
					<td class="bottom-top"><center><b>1.2</b></center></td>
					<td class="bottom-top"><b>Dana Perimbangan</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($anggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($realisasi) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($sisaAnggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($prognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($totalPrognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,8) = "4 2 1 01"',
						'kredit' => 'substring(akun_kredit_lra13,25,8) = "4 2 1 01"'
					];
					$sql = 'substring(kdRekening,25,8) = "4 2 1 01"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,8) = "4 2 1 01"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.2.1</center></td>
					<td class="bottom-top">Dana Bagi Hasil Pajak</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,8) = "4 2 1 02"',
						'kredit' => 'substring(akun_kredit_lra13,25,8) = "4 2 1 02"'
					];
					$sql = 'substring(kdRekening,25,8) = "4 2 1 02"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,8) = "4 2 1 02"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">Dana Bagi Hasil Bukan Pajak</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 2 2"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 2 2"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 2 2"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 2 2"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.2.2</center></td>
					<td class="bottom-top">Dana Alokasi Umum</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 2 3"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 2 3"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 2 3"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 2 3"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.2.3</center></td>
					<td class="bottom-top">Dana Alokasi Khusus</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) in ("4 3 1", "4 3 2", "4 3 3", "4 3 4", "4 3 5", "4 3 6")',
						'kredit' => 'substring(akun_kredit_lra13,25,5) in ("4 3 1", "4 3 2", "4 3 3", "4 3 4", "4 3 5", "4 3 6")'
					];
					$sql = 'substring(kdRekening,25,5) in ("4 3 1", "4 3 2", "4 3 3", "4 3 4", "4 3 5", "4 3 6")';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) in ("4 3 1", "4 3 2", "4 3 3", "4 3 4", "4 3 5", "4 3 6")';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>1.3</b></center></td>
					<td class="bottom-top"><b>Lain - Lain Pendapatan Daerah yang Sah</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($anggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($realisasi) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($sisaAnggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($prognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($totalPrognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 3 1"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 3 1"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 3 1"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 3 1"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.3.1</center></td>
					<td class="bottom-top">Hibah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 3 2"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 3 2"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 3 2"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 3 2"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.3.2</center></td>
					<td class="bottom-top">Dana Darurat</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 3 3"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 3 3"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 3 3"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 3 3"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.3.3</center></td>
					<td class="bottom-top">Dana Bagi Hasil dari Provinsi dan Pemerintah Daerah Lain</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 3 4"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 3 4"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 3 4"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 3 4"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.3.4</center></td>
					<td class="bottom-top">Dana Penyesuaian dan Otonomi Khusus</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 3 5"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 3 5"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 3 5"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 3 5"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="top"><center>1.3.5</center></td>
					<td class="top">Bantuan Keuangan dari Provinsi atau Pemerintah Daaerah Lainnya</td>
					<td class="top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "4 3 6"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "4 3 6"'
					];
					$sql = 'substring(kdRekening,25,5) = "4 3 6"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "4 3 6"';
					$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPendapatan += $anggaran;
					$jumRealisasiPendapatan += $realisasi;
					$jumPrognosisPendapatan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>1.3.6</center></td>
					<td class="bottom-top">Dana Insentif Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaranPendapatan = $helper->sisaAnggaran($jumAnggaranPendapatan, $jumRealisasiPendapatan);
					$jumTotalPendapatan = $helper->totalPrognosis($jumRealisasiPendapatan, $jumPrognosisPendapatan);
				@endphp
				<tr>
					<td>&nbsp;</td>
					<td style="text-align: right;"><b>Jumlah Pendapatan</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumAnggaranPendapatan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumRealisasiPendapatan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumSisaAnggaranPendapatan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumPrognosisPendapatan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumTotalPendapatan) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>2</b></center></td>
					<td class="bottom-top"><b>BELANJA DAERAH</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) in ("5 1 1", "5 1 2", "5 1 3", "5 1 4", "5 1 5", "5 1 6", "5 1 7", "5 1 8")',
						'kredit' => 'substring(akun_kredit_lra13,25,5) in ("5 1 1", "5 1 2", "5 1 3", "5 1 4", "5 1 5", "5 1 6", "5 1 7", "5 1 8")'
					];
					$sql = 'substring(kdRekening,25,5) in ("5 1 1", "5 1 2", "5 1 3", "5 1 4", "5 1 5", "5 1 6", "5 1 7", "5 1 8")';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) in ("5 1 1", "5 1 2", "5 1 3", "5 1 4", "5 1 5", "5 1 6", "5 1 7", "5 1 8")';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>2.1</b></center></td>
					<td class="bottom-top"><b>Belanja Tidak Langsung</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($anggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($realisasi) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($sisaAnggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($prognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($totalPrognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 1"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 1"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 1"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 1"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.1</center></td>
					<td class="bottom-top">Belanja Pegawai</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 2"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 2"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 2"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 2"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.2</center></td>
					<td class="bottom-top">Belanja Bunga</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 3"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 3"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 3"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 3"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.3</center></td>
					<td class="bottom-top">Belanja Subsidi</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 4"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 4"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 4"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 4"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.4</center></td>
					<td class="bottom-top">Belanja Hibah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 5"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 5"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 5"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 5"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.5</center></td>
					<td class="bottom-top">Belanja Bantuan Sosial</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 6"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 6"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 6"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 6"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.6</center></td>
					<td class="bottom-top">Belanja Bagi Hasil</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 7"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 7"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 7"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 7"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.7</center></td>
					<td class="bottom-top">Belanja Bantuan Keuangan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 1 8"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 1 8"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 1 8"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 1 8"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.1.8</center></td>
					<td class="bottom-top">Belanja Tidak Terduga</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) in ("5 2 1", "5 2 2", "5 2 3")',
						'kredit' => 'substring(akun_kredit_lra13,25,5) in ("5 2 1", "5 2 2", "5 2 3")'
					];
					$sql = 'substring(kdRekening,25,5) in ("5 2 1", "5 2 2", "5 2 3")';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) in ("5 2 1", "5 2 2", "5 2 3")';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>2.2</b></center></td>
					<td class="bottom-top"><b>Belanja Langsung</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($anggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($realisasi) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($sisaAnggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($prognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($totalPrognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 2 1"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 2 1"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 2 1"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 2 1"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.2.1</center></td>
					<td class="bottom-top">Belanja Pegawai</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 2 2"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 2 2"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 2 2"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 2 2"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.2.2</center></td>
					<td class="bottom-top">Belanja Barang dan Jasa</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra13,25,5) = "5 2 3"',
						'kredit' => 'substring(akun_kredit_lra13,25,5) = "5 2 3"'
					];
					$sql = 'substring(kdRekening,25,5) = "5 2 3"';
					$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql3 = 'substring(kode_rekening,25,5) = "5 2 3"';
					$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaran += $anggaran;
					$jumRealisasiPengeluaran += $realisasi;
					$jumPrognosisPengeluaran += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>2.2.3</center></td>
					<td class="bottom-top">Belanja Modal</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaranPengeluaran = $helper->sisaAnggaran($jumAnggaranPengeluaran, $jumRealisasiPengeluaran);
					$jumTotalPengeluaran = $helper->totalPrognosis($jumRealisasiPengeluaran, $jumPrognosisPengeluaran);
				@endphp
				<tr>
					<td>&nbsp;</td>
					<td style="text-align: right;"><b>Jumlah Belanja</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumAnggaranPengeluaran) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumRealisasiPengeluaran) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumSisaAnggaranPengeluaran) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumPrognosisPengeluaran) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumTotalPengeluaran) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				@php
					$anggaranSurplusDefisit = $jumAnggaranPendapatan-$jumAnggaranPengeluaran;
					$realisasiSurplusDefisit = $jumRealisasiPendapatan-$jumRealisasiPengeluaran;
					$sisaAnggaranSurplusDefisit = $helper->sisaAnggaran($anggaranSurplusDefisit, $realisasiSurplusDefisit);
					$prognosisSurplusDefisit = $jumPrognosisPendapatan-$jumPrognosisPengeluaran;
					$totalSurplusDefisit = $helper->totalPrognosis($realisasiSurplusDefisit, $prognosisSurplusDefisit);
				@endphp
				<tr>
					<td>&nbsp;</td>
					<td style="text-align: right;"><b>Surplus / (Defisit)</b></td>
					<td style="text-align: right;"><b>{{ mataUang($anggaranSurplusDefisit) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($realisasiSurplusDefisit) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($sisaAnggaranSurplusDefisit) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($prognosisSurplusDefisit) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalSurplusDefisit) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>3</b></center></td>
					<td class="bottom-top"><b>PEMBIAYAAN DAERAH</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5) in ("6 1 1", "6 1 2", "6 1 3", "6 1 4", "6 1 5", "6 1 6")';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5) in ("6 1 1", "6 1 2", "6 1 3", "6 1 4", "6 1 5", "6 1 6")',
							'kredit' => 'substring(akun_kredit_lra13,25,5) in ("6 1 1", "6 1 2", "6 1 3", "6 1 4", "6 1 5", "6 1 6")'
							];
					$sql3 = 'substring(kode_rekening,25,5) in ("6 1 1", "6 1 2", "6 1 3", "6 1 4", "6 1 5", "6 1 6")';
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>3.1</b></center></td>
					<td class="bottom-top"><b>Penerimaan Pembiayaan</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($anggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($realisasi) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($sisaAnggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($prognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($totalPrognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 1 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 1 1"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 1 1"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 1 1"';
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPenerimaanPembiayaan += $anggaran;
					$jumRealisasiPenerimaanPembiayaan += $realisasi;
					$jumPrognosisPenerimaanPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.1.1</center></td>
					<td class="bottom-top">Penggunaan Sisa Lebih Perhitungan Anggaran (SILPA)</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 1 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 1 2"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 1 2"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 1 2"';
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPenerimaanPembiayaan += $anggaran;
					$jumRealisasiPenerimaanPembiayaan += $realisasi;
					$jumPrognosisPenerimaanPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="top"><center>3.1.2</center></td>
					<td class="top">Pencairan Dana Cadangan</td>
					<td class="top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 1 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 1 3"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 1 3"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 1 3"';
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPenerimaanPembiayaan += $anggaran;
					$jumRealisasiPenerimaanPembiayaan += $realisasi;
					$jumPrognosisPenerimaanPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.1.3</center></td>
					<td class="bottom-top">Hasil Penjualan Kekayaan Daerah yang Dipisahkan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 1 4"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 1 4"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 1 4"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 1 4"';
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPenerimaanPembiayaan += $anggaran;
					$jumRealisasiPenerimaanPembiayaan += $realisasi;
					$jumPrognosisPenerimaanPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.1.4</center></td>
					<td class="bottom-top">Penerimaan Pinjaman Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 1 5"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 1 5"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 1 5"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 1 5"';
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPenerimaanPembiayaan += $anggaran;
					$jumRealisasiPenerimaanPembiayaan += $realisasi;
					$jumPrognosisPenerimaanPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.1.5</center></td>
					<td class="bottom-top">Penerimaan Kembali Pemberian Pinjaman Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 1 6"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 1 6"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 1 6"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 1 6"';
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPenerimaanPembiayaan += $anggaran;
					$jumRealisasiPenerimaanPembiayaan += $realisasi;
					$jumPrognosisPenerimaanPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.1.6</center></td>
					<td class="bottom-top">Penerimaan Piutang Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaranPenerimaanPembiayaan = $helper->sisaAnggaran($jumAnggaranPenerimaanPembiayaan, $jumRealisasiPenerimaanPembiayaan);
					$jumTotalPenerimaanPembiayaan = $helper->totalPrognosis($jumRealisasiPenerimaanPembiayaan, $jumPrognosisPenerimaanPembiayaan);
				@endphp
				<tr>
					<td>&nbsp;</td>
					<td style="text-align: right;"><b>Jumlah Penerimaan Pembiayaan</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumAnggaranPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumRealisasiPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumSisaAnggaranPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumPrognosisPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumTotalPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5) in ("6 2 1", "6 2 2", "6 2 3", "6 2 4")';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5) in ("6 2 1", "6 2 2", "6 2 3", "6 2 4")',
							'kredit' => 'substring(akun_kredit_lra13,25,5) in ("6 2 1", "6 2 2", "6 2 3", "6 2 4")'
							];
					$sql3 = 'substring(kode_rekening,25,5) in ("6 2 1", "6 2 2", "6 2 3", "6 2 4")';
					$realisasi = $helper->jumRealisasiPembiayaanPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>3.2</b></center></td>
					<td class="bottom-top"><b>Pengeluaran Pembiayaan</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($anggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($realisasi) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($sisaAnggaran) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($prognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($totalPrognosis) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 2 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 2 1"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 2 1"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 2 1"';
					$realisasi = $helper->jumRealisasiPembiayaanPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaranPembiayaan += $anggaran;
					$jumRealisasiPengeluaranPembiayaan += $realisasi;
					$jumPrognosisPengeluaranPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.2.1</center></td>
					<td class="bottom-top">Pembentukan Dana Cadangan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 2 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 2 2"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 2 2"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 2 2"';
					$realisasi = $helper->jumRealisasiPembiayaanPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaranPembiayaan += $anggaran;
					$jumRealisasiPengeluaranPembiayaan += $realisasi;
					$jumPrognosisPengeluaranPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.2.2</center></td>
					<td class="bottom-top">Penyertaan Modal (Investasi) Pemerintah Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 2 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 2 3"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 2 3"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 2 3"';
					$realisasi = $helper->jumRealisasiPembiayaanPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaranPembiayaan += $anggaran;
					$jumRealisasiPengeluaranPembiayaan += $realisasi;
					$jumPrognosisPengeluaranPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.2.3</center></td>
					<td class="bottom-top">Pembayaran Pokok Utang</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdRekening,25,5)="6 2 4"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = [
							'debet' => 'substring(akun_debet_lra13,25,5)="6 2 4"',
							'kredit' => 'substring(akun_kredit_lra13,25,5)="6 2 4"'
							];
					$sql3 = 'substring(kode_rekening,25,5)="6 2 4"';
					$realisasi = $helper->jumRealisasiPembiayaanPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaranPengeluaranPembiayaan += $anggaran;
					$jumRealisasiPengeluaranPembiayaan += $realisasi;
					$jumPrognosisPengeluaranPembiayaan += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>3.2.4</center></td>
					<td class="bottom-top">Pemberian Pinjaman Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaranPengeluaranPembiayaan = $helper->sisaAnggaran($jumAnggaranPengeluaranPembiayaan, $jumRealisasiPengeluaranPembiayaan);
					$jumTotalPengeluaranPembiayaan = $helper->totalPrognosis($jumRealisasiPengeluaranPembiayaan, $jumPrognosisPengeluaranPembiayaan);
				@endphp
				<tr>
					<td>&nbsp;</td>
					<td style="text-align: right;"><b>Jumlah Pengeluaran Pembiayaan</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumAnggaranPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumRealisasiPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumSisaAnggaranPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumPrognosisPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($jumTotalPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$anggaranPembiayaanNetto = $jumAnggaranPenerimaanPembiayaan-$jumAnggaranPengeluaranPembiayaan;
					$realisasiPembiayaanNetto = $jumRealisasiPenerimaanPembiayaan-$jumRealisasiPengeluaranPembiayaan;
					$sisaAnggaranPembiayaanNetto = $helper->sisaAnggaran($anggaranPembiayaanNetto, $realisasiPembiayaanNetto);
					$prognosisPembiayaanNetto = $jumPrognosisPenerimaanPembiayaan-$jumPrognosisPengeluaranPembiayaan;
					$totalPembiayaanNetto =  $helper->totalPrognosis($realisasiPembiayaanNetto, $prognosisPembiayaanNetto);
				@endphp
				<tr>
					<td>&nbsp;</td>
					<td style="text-align: right;"><b>Pembiayaan Netto</b></td>
					<td style="text-align: right;"><b>{{ mataUang($anggaranPembiayaanNetto) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($realisasiPembiayaanNetto) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($sisaAnggaranPembiayaanNetto) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($prognosisPembiayaanNetto) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalPembiayaanNetto) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				@php
					$anggaranSisaLebih = $anggaranSurplusDefisit+$anggaranPembiayaanNetto;
					$realisasiSisaLebih = $realisasiSurplusDefisit+$realisasiPembiayaanNetto;
					$sisaAnggaranSisaLebih = $helper->sisaAnggaran($anggaranSisaLebih, $realisasiSisaLebih);
					$prognosisSisaLebih = $prognosisSurplusDefisit+$prognosisPembiayaanNetto;
					$totalSisaLebih =  $helper->totalPrognosis($realisasiSisaLebih, $prognosisSisaLebih);
				@endphp
				<tr>
					<td><center><b>3.3</b></center></td>
					<td style="text-align: right;"><b>Sisa Lebih Pembiayaan Anggaran Tahun Berkenaan</b></td>
					<td style="text-align: right;"><b>{{ mataUang($anggaranSisaLebih) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($realisasiSisaLebih) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($sisaAnggaranSisaLebih) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($prognosisSisaLebih) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalSisaLebih) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
