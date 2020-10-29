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
            div,p {font-size:16;}
            table tr td {font-size:16;}
            table tr th {font-size:16;}
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

			$jumAnggaran7 = 0;
			$jumRealisasi7 = 0;
			$jumPrognosis7 = 0;

			$jumAnggaran15 = 0;
			$jumRealisasi15 = 0;
			$jumPrognosis15 = 0;

			$jumAnggaran20 = 0;
			$jumRealisasi20 = 0;
			$jumPrognosis20 = 0;

			$jumAnggaran25 = 0;
			$jumRealisasi25 = 0;
			$jumPrognosis25 = 0;

			$jumAnggaran32 = 0;
			$jumRealisasi32 = 0;
			$jumPrognosis32 = 0;

			$jumAnggaran43 = 0;
			$jumRealisasi43 = 0;
			$jumPrognosis43 = 0;

			$jumAnggaran52 = 0;
			$jumRealisasi52 = 0;
			$jumPrognosis52 = 0;

			$jumAnggaran56 = 0;
			$jumRealisasi56 = 0;
			$jumPrognosis56 = 0;

			$jumAnggaran57 = 0;
			$jumRealisasi57 = 0;
			$jumPrognosis57 = 0;

			$jumAnggaran65 = 0;
			$jumRealisasi65 = 0;
			$jumPrognosis65 = 0;

			$jumAnggaran66 = 0;
			$jumRealisasi66 = 0;
			$jumPrognosis66 = 0;

			$jumAnggaran68 = 0;
			$jumRealisasi68 = 0;
			$jumPrognosis68 = 0;

			$jumAnggaran85 = 0;
			$jumRealisasi85 = 0;
			$jumPrognosis85 = 0;

			$jumAnggaran99 = 0;
			$jumRealisasi99 = 0;
			$jumPrognosis99 = 0;
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
					<td class="bottom"><center><b>01</b></center></td>
					<td class="bottom"><b>PENDAPATAN</b></td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
					<td class="bottom">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>02</b></center></td>
					<td class="bottom-top"><b>PENDAPATAN ASLI DAERAH</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="4 1 1"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="4 1 1"'
					];
					$sql = 'substring(kdakun64,1,5)="4 1 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran7 += $anggaran;
					$jumRealisasi7 += $realisasi;
					$jumPrognosis7 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>03</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Pajak Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="4 1 2"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="4 1 2"'
					];
					$sql = 'substring(kdakun64,1,5)="4 1 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran7 += $anggaran;
					$jumRealisasi7 += $realisasi;
					$jumPrognosis7 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>04</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Retribusi Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="4 1 3"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="4 1 3"'
					];
					$sql = 'substring(kdakun64,1,5)="4 1 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran7 += $anggaran;
					$jumRealisasi7 += $realisasi;
					$jumPrognosis7 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>05</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="4 1 4"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="4 1 4"'
					];
					$sql = 'substring(kdakun64,1,5)="4 1 4"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran7 += $anggaran;
					$jumRealisasi7 += $realisasi;
					$jumPrognosis7 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>06</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Lain - lain PAD yang Sah </td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran7 = $helper->sisaAnggaran($jumAnggaran7, $jumRealisasi7);
					$jumTotalPrognosis7 = $helper->totalPrognosis($jumRealisasi7, $jumPrognosis7);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>07</b></center></td>
					<td class="bottom-top"><b>Jumlah Pendapatan Asli Daerah (3 s/d 6)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran7) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi7) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran7) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis7) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis7) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>08</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>09</b></center></td>
					<td class="bottom-top"><b>PENDAPATAN TRANSFER</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>10</b></center></td>
					<td class="bottom-top"><b>TRANSFER PEMERINTAH PUSAT - DANA PERIMBANGAN</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,8)="4 2 1 01"',
						'kredit' => 'substring(akun_kredit_lra64,25,8)="4 2 1 01"'
					];
					$sql = 'substring(kdakun64,1,8)="4 2 1 01"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran15 += $anggaran;
					$jumRealisasi15 += $realisasi;
					$jumPrognosis15 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>11</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Dana Bagi Hasil Pajak</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,8)="4 2 1 02"',
						'kredit' => 'substring(akun_kredit_lra64,25,8)="4 2 1 02"'
					];
					$sql = 'substring(kdakun64,1,8)="4 2 1 02"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran15 += $anggaran;
					$jumRealisasi15 += $realisasi;
					$jumPrognosis15 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>12</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Dana Bagi Hasil Sumber Daya Alam</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,8)="4 2 1 03"',
						'kredit' => 'substring(akun_kredit_lra64,25,8)="4 2 1 03"'
					];
					$sql = 'substring(kdakun64,1,8)="4 2 1 03"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran15 += $anggaran;
					$jumRealisasi15 += $realisasi;
					$jumPrognosis15 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>13</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Dana Alokasi Umum</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,8) in ("4 2 1 04","4 2 2 03")',
						'kredit' => 'substring(akun_kredit_lra64,25,8) in ("4 2 1 04","4 2 2 03")'
					];
					$sql = 'substring(kdakun64,1,8) in ("4 2 1 04","4 2 2 03")';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran15 += $anggaran;
					$jumRealisasi15 += $realisasi;
					$jumPrognosis15 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>14</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Dana Alokasi Khusus</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran15 = $helper->sisaAnggaran($jumAnggaran15, $jumRealisasi15);
					$jumTotalPrognosis15 = $helper->totalPrognosis($jumRealisasi15, $jumPrognosis15);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>15</b></center></td>
					<td class="bottom-top"><b>Jumlah Pendapatan Transfer Dana Perimbangan (11 s/d 14)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran15) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi15) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran15) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis15) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis15) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>16</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>17</b></center></td>
					<td class="bottom-top"><b>TRANSFER PEMERINTAH PUSAT PUSAT - LAINNYA</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>18</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Dana Otonomi Khusus</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="top"><center>19</center></td>
					<td class="top" style="padding-left: 30px;">Dana Penyesuaian</td>
					<td class="top" style="text-align: right;">0</td>
					<td class="top" style="text-align: right;">0</td>
					<td class="top" style="text-align: right;">0</td>
					<td class="top" style="text-align: right;">0</td>
					<td class="top" style="text-align: right;">0</td>
					<td class="top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran20 = $helper->sisaAnggaran($jumAnggaran20, $jumRealisasi20);
					$jumTotalPrognosis20 = $helper->totalPrognosis($jumRealisasi20, $jumPrognosis20);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>20</b></center></td>
					<td class="bottom-top"><b>Jumlah Pendapatan Transfer Pemerintah Pusat - Lainnya (18 s/d 19)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran20) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi20) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran20) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis20) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis20) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>21</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>22</b></center></td>
					<td class="bottom-top"><b>TRANSFER PEMERINTAH PROVINSI</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="4 2 3"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="4 2 3"'
					];
					$sql = 'substring(kdakun64,1,5)="4 2 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran25 += $anggaran;
					$jumRealisasi25 += $realisasi;
					$jumPrognosis25 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>23</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Bagi Hasil Pajak</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>24</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Bagi Hasil Lainnya</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran25 = $helper->sisaAnggaran($jumAnggaran25, $jumRealisasi25);
					$jumTotalPrognosis25 = $helper->totalPrognosis($jumRealisasi25, $jumPrognosis25);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>25</b></center></td>
					<td class="bottom-top"><b>Jumlah Transfer Pemerintah Provinsi (23 s/d 24)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran25) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi25) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran25) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis25) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis25) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumAnggaran26 = $jumAnggaran15 + $jumAnggaran20 + $jumAnggaran25;
					$jumRealisasi26 = $jumRealisasi15 + $jumRealisasi20 + $jumRealisasi25;
					$jumPrognosis26 = $jumPrognosis15 + $jumPrognosis20 + $jumPrognosis25;
					$jumSisaAnggaran26 = $helper->sisaAnggaran($jumAnggaran26, $jumRealisasi26);
					$jumTotalPrognosis26 = $helper->totalPrognosis($jumRealisasi26, $jumPrognosis26);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>26</b></center></td>
					<td class="bottom-top"><b>Total Pendapatan Transfer (15 + 20 + 25)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran26) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi26) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran26) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis26) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis26) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>27</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>28</b></center></td>
					<td class="bottom-top"><b>LAIN - LAIN PENDAPATAN YANG SAH</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,8)="4 3 1 06"',
						'kredit' => 'substring(akun_kredit_lra64,25,8)="4 3 1 06"'
					];
					$sql = 'substring(kdakun64,1,8)="4 3 1 06"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran32 += $anggaran;
					$jumRealisasi32 += $realisasi;
					$jumPrognosis32 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>29</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Hibah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>30</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Dana Darurat</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="4 2 4"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="4 2 4"'
					];
					$sql = 'substring(kdakun64,1,5)="4 2 4"';
					$anggaran_1 = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi_1 = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran_1 = $helper->sisaAnggaran($anggaran_1, $realisasi_1);
					$prognosis_1 = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran_1);
					$totalPrognosis_1 = $helper->totalPrognosis($realisasi_1, $prognosis_1);

					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,8)="4 2 5 01"',
						'kredit' => 'substring(akun_kredit_lra64,25,8)="4 2 5 01"'
					];
					$sql = 'substring(kdakun64,1,8)="4 2 5 01"';
					$anggaran_2 = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi_2 = $helper->jumRealisasiPendapatan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran_2 = $helper->sisaAnggaran($anggaran_2, $realisasi_2);
					$prognosis_2 = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran_2);
					$totalPrognosis_2 = $helper->totalPrognosis($realisasi_2, $prognosis_2);

					$anggaran = $anggaran_1 + $anggaran_2;
					$realisasi = $realisasi_1 + $realisasi_2;
					$sisaAnggaran = $sisaAnggaran_1 + $sisaAnggaran_2;
					$prognosis = $prognosis_1 + $prognosis_2;
					$totalPrognosis = $totalPrognosis_1 + $totalPrognosis_2;

					$jumAnggaran32 += $anggaran;
					$jumRealisasi32 += $realisasi;
					$jumPrognosis32 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>31</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pendapatan Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran32 = $helper->sisaAnggaran($jumAnggaran32, $jumRealisasi32);
					$jumTotalPrognosis32 = $helper->totalPrognosis($jumRealisasi32, $jumPrognosis32);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>32</b></center></td>
					<td class="bottom-top"><b>Jumlah Lain - lain Pendapatan yang Sah (29 / 31)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran32) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi32) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran32) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis32) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis32) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumAnggaran33 = $jumAnggaran7 + $jumAnggaran26 + $jumAnggaran32;
					$jumRealisasi33 = $jumRealisasi7 + $jumRealisasi26 + $jumRealisasi32;
					$jumPrognosis33 = $jumPrognosis7 + $jumPrognosis26 + $jumPrognosis32;
					$jumSisaAnggaran33 = $helper->sisaAnggaran($jumAnggaran33, $jumRealisasi33);
					$jumTotalPrognosis33 = $helper->totalPrognosis($jumRealisasi33, $jumPrognosis33);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>33</b></center></td>
					<td class="bottom-top"><b>JUMLAH PENDAPATAN (7 + 26 + 32)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran33) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi33) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran33) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis33) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis33) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>34</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>35</b></center></td>
					<td class="bottom-top"><b>BELANJA</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>36</b></center></td>
					<td class="bottom-top"><b>BELANJA OPERASI</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 1 1"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 1 1"'
					];
					$sql = 'substring(kdakun64,1,5)="5 1 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran43 += $anggaran;
					$jumRealisasi43 += $realisasi;
					$jumPrognosis43 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>37</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Pegawai</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 1 2"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 1 2"'
					];
					$sql = 'substring(kdakun64,1,5)="5 1 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran43 += $anggaran;
					$jumRealisasi43 += $realisasi;
					$jumPrognosis43 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>38</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Barang</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 1 3"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 1 3"'
					];
					$sql = 'substring(kdakun64,1,5)="5 1 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran43 += $anggaran;
					$jumRealisasi43 += $realisasi;
					$jumPrognosis43 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>39</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Bunga</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 1 4"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 1 4"'
					];
					$sql = 'substring(kdakun64,1,5)="5 1 4"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran43 += $anggaran;
					$jumRealisasi43 += $realisasi;
					$jumPrognosis43 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>40</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Subsidi</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 1 5"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 1 5"'
					];
					$sql = 'substring(kdakun64,1,5)="5 1 5"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran43 += $anggaran;
					$jumRealisasi43 += $realisasi;
					$jumPrognosis43 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>41</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Hibah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 1 6"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 1 6"'
					];
					$sql = 'substring(kdakun64,1,5)="5 1 6"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran43 += $anggaran;
					$jumRealisasi43 += $realisasi;
					$jumPrognosis43 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>42</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Bantuan Sosial</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>42a</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Bantuan Keuangan</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran43 = $helper->sisaAnggaran($jumAnggaran43, $jumRealisasi43);
					$jumTotalPrognosis43 = $helper->totalPrognosis($jumRealisasi43, $jumPrognosis43);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>43</b></center></td>
					<td class="bottom-top"><b>Jumlah Belanja Operasi (37 s/d 42a)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran43) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi43) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran43) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis43) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis43) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>44</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>45</b></center></td>
					<td class="bottom-top"><b>BELANJA MODAL</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 2 1"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 2 1"'
					];
					$sql = 'substring(kdakun64,1,5)="5 2 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran52 += $anggaran;
					$jumRealisasi52 += $realisasi;
					$jumPrognosis52 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>46</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Tanah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 2 2"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 2 2"'
					];
					$sql = 'substring(kdakun64,1,5)="5 2 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran52 += $anggaran;
					$jumRealisasi52 += $realisasi;
					$jumPrognosis52 += $prognosis;
				@endphp
				<tr>
					<td class="top"><center>47</center></td>
					<td class="top" style="padding-left: 30px;">Belanja Peralatan dan Mesin</td>
					<td class="top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 2 3"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 2 3"'
					];
					$sql = 'substring(kdakun64,1,5)="5 2 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran52 += $anggaran;
					$jumRealisasi52 += $realisasi;
					$jumPrognosis52 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>48</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Gedung dan Bangunan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 2 4"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 2 4"'
					];
					$sql = 'substring(kdakun64,1,5)="5 2 4"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran52 += $anggaran;
					$jumRealisasi52 += $realisasi;
					$jumPrognosis52 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>49</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Jalan, Irigasi dan Jaringan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 2 5"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 2 5"'
					];
					$sql = 'substring(kdakun64,1,5)="5 2 5"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran52 += $anggaran;
					$jumRealisasi52 += $realisasi;
					$jumPrognosis52 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>50</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Aset Tetap Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>51</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Aset Lainnya</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran52 = $helper->sisaAnggaran($jumAnggaran52, $jumRealisasi52);
					$jumTotalPrognosis52 = $helper->totalPrognosis($jumRealisasi52, $jumPrognosis52);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>52</b></center></td>
					<td class="bottom-top"><b>Jumlah Belanja Modal (46 s/d 51)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran52) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi52) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran52) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis52) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis52) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>53</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>54</b></center></td>
					<td class="bottom-top"><b>BELANJA TAK TERDUGA</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="5 3 1"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="5 3 1"'
					];
					$sql = 'substring(kdakun64,1,5)="5 3 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran52 += $anggaran;
					$jumRealisasi52 += $realisasi;
					$jumPrognosis52 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>55</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Belanja Tak Terduga</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran56 = $helper->sisaAnggaran($jumAnggaran56, $jumRealisasi56);
					$jumTotalPrognosis56 = $helper->totalPrognosis($jumRealisasi56, $jumPrognosis56);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>56</b></center></td>
					<td class="bottom-top"><b>Belanja Tak Terduga (55)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran56) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi56) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran56) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis56) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis56) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumAnggaran57 = $jumAnggaran43 + $jumAnggaran52 + $jumAnggaran56;
					$jumRealisasi57 = $jumRealisasi43 + $jumRealisasi52 + $jumRealisasi56;
					$jumPrognosis57 = $jumPrognosis43 + $jumPrognosis52 + $jumPrognosis56;
					$jumSisaAnggaran57 = $helper->sisaAnggaran($jumAnggaran57, $jumRealisasi57);
					$jumTotalPrognosis57 = $helper->totalPrognosis($jumRealisasi57, $jumPrognosis57);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>57</b></center></td>
					<td class="bottom-top"><b>JUMLAH BELANJA (43 + 52 + 56)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran57) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi57) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran57) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis57) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis57) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>58</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>59</b></center></td>
					<td class="bottom-top"><b>TRANSFER</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>60</b></center></td>
					<td class="bottom-top"><b>TRANSFER / BAGI HASIL KE DESA</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="6 1 1"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="6 1 1"'
					];
					$sql = 'substring(kdakun64,1,5)="6 1 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran65 += $anggaran;
					$jumRealisasi65 += $realisasi;
					$jumPrognosis65 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>61</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Bagi Hasil Pajak</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="6 1 2"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="6 1 2"'
					];
					$sql = 'substring(kdakun64,1,5)="6 1 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran65 += $anggaran;
					$jumRealisasi65 += $realisasi;
					$jumPrognosis65 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>62</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Bagi Hasil Retribusi</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,5)="6 1 3"',
						'kredit' => 'substring(akun_kredit_lra64,25,5)="6 1 3"'
					];
					$sql = 'substring(kdakun64,1,5)="6 1 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran65 += $anggaran;
					$jumRealisasi65 += $realisasi;
					$jumPrognosis65 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>63</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Bagi Hasil Pendapatan Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sqlBlud = [
						'debet' => 'substring(akun_debet_lra64,25,3)="6 2"',
						'kredit' => 'substring(akun_kredit_lra64,25,3)="6 2"'
					];
					$sql = 'substring(kdakun64,1,3)="6 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$realisasi = $helper->jumRealisasiPengeluaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran65 += $anggaran;
					$jumRealisasi65 += $realisasi;
					$jumPrognosis65 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>64</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Bantuan Keuangan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran65 = $helper->sisaAnggaran($jumAnggaran65, $jumRealisasi65);
					$jumTotalPrognosis65 = $helper->totalPrognosis($jumRealisasi65, $jumPrognosis65);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>65</b></center></td>
					<td class="bottom-top"><b>JUMLAH TRANSFER / BAGI HASIL KE DESA (61 s/d 64)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran65) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi65) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran65) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis65) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis65) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumAnggaran66 = $jumAnggaran57 + $jumAnggaran65;
					$jumRealisasi66 = $jumRealisasi57 + $jumRealisasi65;
					$jumPrognosis66 = $jumPrognosis57 + $jumPrognosis65;
					$jumSisaAnggaran66 = $helper->sisaAnggaran($jumAnggaran66, $jumRealisasi66);
					$jumTotalPrognosis66 = $helper->totalPrognosis($jumRealisasi66, $jumPrognosis66);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>66</b></center></td>
					<td class="bottom-top"><b>JUMLAH BELANJA DAN TRANSFER (57 + 65)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran66) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi66) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran66) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis66) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis66) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>67</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$jumAnggaran68 = $jumAnggaran33 - $jumAnggaran66;
					$jumRealisasi68 = $jumRealisasi33 - $jumRealisasi66;
					$jumPrognosis68 = $jumPrognosis33 - $jumPrognosis66;
					$jumSisaAnggaran68 = $helper->sisaAnggaran($jumAnggaran68, $jumRealisasi68);
					$jumTotalPrognosis68 = $helper->totalPrognosis($jumRealisasi68, $jumPrognosis68);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>68</b></center></td>
					<td class="bottom-top"><b>SURPLUS / DEFISIT (33 - 66)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran68) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi68) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran68) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis68) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis68) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>69</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>70</b></center></td>
					<td class="bottom-top"><b>PEMBIAYAAN</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>71</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>72</b></center></td>
					<td class="bottom-top"><b>PENERIMAAN PEMBIAYAAN</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,5)="7 1 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,5)="7 1 1"', 'kredit' => 'substring(akun_kredit_lra64,25,5)="7 1 1"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>73</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Penggunaan SILPA</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,5)="7 1 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,5)="7 1 2"', 'kredit' => 'substring(akun_kredit_lra64,25,5)="7 1 2"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>74</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pencairan Dana Cadangan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,5)="7 1 3"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,5)="7 1 3"', 'kredit' => 'substring(akun_kredit_lra64,25,5)="7 1 3"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="top"><center>75</center></td>
					<td class="top" style="padding-left: 30px;">Hasil Penjualan Kekayaan Daerah yang Dipisahkan</td>
					<td class="top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 4 04"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 4 04"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 4 04"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>76</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pinjaman Dalam Negeri - Pemerintah Pusat</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 4 05"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 4 05"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 4 05"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>77</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pinjaman Dalam Negeri - Pemerintah Daerah Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 4 01"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 4 01"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 4 01"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>78</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pinjaman Dalam Negeri - Lembaga Keuangan Bank</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 4 02"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 4 02"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 4 02"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>79</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pinjaman Dalam Negeri - Lembaga Keuangan Bukan Bank</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 4 03"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 4 03"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 4 03"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>80</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pinjaman Dalam Negeri - Obligasi </td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 4 06"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 4 06"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 4 06"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>81</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pinjaman Dalam Negeri - Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 5 01"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 5 01"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 5 01"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>82</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Penerimaan Kembali Pinjaman Kepada Perusahaan Negara</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 5 02"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 5 02"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 5 02"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>83</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Penerimaan Kembali Pinjaman Kepada Perusahaan Daerah</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 1 5 04"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 1 5 04"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 1 5 04"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran85 += $anggaran;
					$jumRealisasi85 += $realisasi;
					$jumPrognosis85 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>84</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Penerimaan Kembali Pinjaman Kepada Perusahaan Daerah Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran85 = $helper->sisaAnggaran($jumAnggaran85, $jumRealisasi85);
					$jumTotalPrognosis85 = $helper->totalPrognosis($jumRealisasi85, $jumPrognosis85);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>85</b></center></td>
					<td class="bottom-top"><b>Jumlah Penerimaan (72 s/d 84)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran85) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi85) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran85) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis85) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis85) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>86</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center><b>87</b></center></td>
					<td class="bottom-top"><b>PENGELUARAN PEMBIAYAAN</b></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,5)="7 2 1"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,5)="7 2 1"', 'kredit' => 'substring(akun_kredit_lra64,25,5)="7 2 1"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>88</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pembentukan Dana Cadangan</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,5)="7 2 2"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,5)="7 2 2"', 'kredit' => 'substring(akun_kredit_lra64,25,5)="7 2 2"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>89</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Penyertaan Modal Pemerintah Daerah </td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 3 04"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 3 04"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 3 04"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>90</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pembayaran Pokok Pinjaman Dalam Negeri - Pemerintah Pusat</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 3 06"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 3 06"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 3 06"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>91</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pembayaran Pokok Pinjaman Dalam Negeri - Pemerintah Daerah Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 3 01"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 3 01"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 3 01"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>92</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pembayaran Pokok Pinjaman Dalam Negeri - Lembaga Keuangan Bank</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>93</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pembayaran Pokok Pinjaman Dalam Negeri - Lembaga Keuangan Bukan Bank</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 3 03"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 3 03"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 3 03"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>94</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pembayaran Pokok Pinjaman Dalam Negeri - Obligasi</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 3 06"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 3 06"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 3 06"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>95</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pembayaran Pokok Pinjaman Dalam Negeri - Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>95a</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pengembalian Sisa Dana DPPID</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">0</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 4 01"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 4 01"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 4 01"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>96</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pemberian Pinjaman kepada Perusahaan Negara</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 4 02"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 4 02"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 4 02"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="top"><center>97</center></td>
					<td class="top" style="padding-left: 30px;">Pemberian Pinjaman kepada Perusahaan Daerah</td>
					<td class="top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$sql = 'substring(kdakun64,1,8)="7 2 4 04"';
					$anggaran = $helper->jumAnggaran64($sql, $viewData, $kodePengguna, $kodeOrganisasi);
					$sql2 = ['debet' => 'substring(akun_debet_lra64,25,8)="7 2 4 04"', 'kredit' => 'substring(akun_kredit_lra64,25,8)="7 2 4 04"'];
					$realisasi = $helper->jumRealisasiPembiayaanPenerimaan64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
					$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
					$prognosis = $helper->jumPrognosis64($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
					$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

					$jumAnggaran99 += $anggaran;
					$jumRealisasi99 += $realisasi;
					$jumPrognosis99 += $prognosis;
				@endphp
				<tr>
					<td class="bottom-top"><center>98</center></td>
					<td class="bottom-top" style="padding-left: 30px;">Pemberian Pinjaman kepada Perusahaan Daerah Lainnya</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($anggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($realisasi) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($sisaAnggaran) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($prognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">{{ mataUang($totalPrognosis) }}</td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumSisaAnggaran99 = $helper->sisaAnggaran($jumAnggaran99, $jumRealisasi99);
					$jumTotalPrognosis99 = $helper->totalPrognosis($jumRealisasi99, $jumPrognosis99);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>99</b></center></td>
					<td class="bottom-top"><b>Jumlah Pengeluaran (87 s/d 98)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran99) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi99) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran99) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis99) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis99) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				@php
					$jumAnggaran100 = $jumAnggaran85 - $jumAnggaran99;
					$jumRealisasi100 = $jumRealisasi85 - $jumRealisasi99;
					$jumPrognosis100 = $jumPrognosis85 - $jumPrognosis99;
					$jumSisaAnggaran100 = $helper->sisaAnggaran($jumAnggaran100, $jumRealisasi100);
					$jumTotalPrognosis100 = $helper->totalPrognosis($jumRealisasi100, $jumPrognosis100);
				@endphp
				<tr>
					<td class="bottom-top"><center><b>100</b></center></td>
					<td class="bottom-top"><b>PEMBIAYAAN NETTO (85 - 99)</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumAnggaran100) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumRealisasi100) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran100) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumPrognosis100) }}</b></td>
					<td class="bottom-top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis100) }}</b></td>
					<td class="bottom-top" style="text-align: right;">&nbsp;</td>
				</tr>
				<tr>
					<td class="bottom-top"><center>101</center></td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
					<td class="bottom-top">&nbsp;</td>
				</tr>
				@php
					$jumAnggaran102 = $jumAnggaran68 + $jumAnggaran100;
					$jumRealisasi102 = $jumRealisasi68 + $jumRealisasi100;
					$jumPrognosis102 = $jumPrognosis68 + $jumPrognosis100;
					$jumSisaAnggaran102 = $helper->sisaAnggaran($jumAnggaran102, $jumRealisasi102);
					$jumTotalPrognosis102 = $helper->totalPrognosis($jumRealisasi102, $jumPrognosis102);
				@endphp
				<tr>
					<td class="top"><center><b>102</b></center></td>
					<td class="top"><b>Sisa Lebih Pembiayaan Anggaran (68 + 100) </b></td>
					<td class="top" style="text-align: right;"><b>{{ mataUang($jumAnggaran102) }}</b></td>
					<td class="top" style="text-align: right;"><b>{{ mataUang($jumRealisasi102) }}</b></td>
					<td class="top" style="text-align: right;"><b>{{ mataUang($jumSisaAnggaran102) }}</b></td>
					<td class="top" style="text-align: right;"><b>{{ mataUang($jumPrognosis102) }}</b></td>
					<td class="top" style="text-align: right;"><b>{{ mataUang($jumTotalPrognosis102) }}</b></td>
					<td class="top" style="text-align: right;">&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
