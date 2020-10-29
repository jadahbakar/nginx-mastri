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
            div,p {font-size:13px}
            table tr td {font-size:13px}
            table tr th {font-size:13px}
            .font15 {font-size: 15px;}
        </style>
	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	    <title>E-Report Pemerintah Kota Semarang</title>
	</head>
	<body>
		<h3 style="text-align:center;">PEMERINTAH KOTA SEMARANG</h3>
		<h3 style="text-align:center;">RINCIAN LAPORAN REALISASI SEMESTER I APBD DAN PROGNOSIS 6 (ENAM) BULAN BERIKUTNYA</h3>
		<h3 style="text-align:center;">TAHUN ANGGARAN {!! $var['tahun'] !!}</h3>
		<br /><br />

		<table border="0">
			<tr>
				<td width="200px" class="font15"><b>URUSAN PEMERINTAH</b></td>
				<td width="10px" class="font15"><b>:</b></td>
				<td width="50%" class="font15"><b>{{ strtoupper($var['nama_urusan']) }}</b></td>
				<td class="font15">&nbsp;</td>
			</tr>
			<tr>
				<td class="font15"><b>ORGANISASI</b></td>
				<td class="font15"><b>:</b></td>
				<td class="font15"><b>{{ strtoupper($var['nama_organisasi']) }}</b></td>
				<td style="text-align: right;" class="font15"><b>SKPD / PPKD</b></td>
			</tr>
		</table>
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
					<th height="50px" width="15%"><center><b>Kode Rekening</b></center></th>
					<th width="25%"><center><b>Uraian</b></center></th>
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
				@php
					$listRekeningPendapatan = $helper->getListRekeningPendapatan($viewData, $kodePengguna, $kodeOrganisasi, $tahun);
					$jumlahAkunPendapatan = 0;
				@endphp
				@foreach($listRekeningPendapatan as $pendapatan)
					@php
						$anggaran = 0;
						$realisasi = 0;
						$sisaAnggaran = 0;
						$prognosis = 0;
						$totalPrognosis = 0;

						$jumlahAkunPendapatan++;
						$check = $helper->percobaan($pendapatan['kdRekening']);

						$styleText = '';

						if(strlen($pendapatan['kdRekening']) <= '27'){
							$styleText = 'font-weight: bold;';
						}

						$sqlBlud = [
							'debet' => 'akun_debet_lra13 regexp "^'.$pendapatan['kdRekening'].'"',
							'kredit' => 'akun_kredit_lra13 regexp "^'.$pendapatan['kdRekening'].'"'
						];
						$sql = 'kdRekening regexp "^'.$pendapatan['kdRekening'].'"';
						$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
						$sql3 = 'kode_rekening regexp "^'.$pendapatan['kdRekening'].'"';
						$realisasi = $helper->jumRealisasiPendapatan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
						$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
						$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
						$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

						if(strlen($pendapatan['kdRekening']) == '29'){
							$jumAnggaranPendapatan += $anggaran;
							$jumRealisasiPendapatan += $realisasi;
							$jumPrognosisPendapatan += $prognosis;
						}
					@endphp
				<tr>
					<td style="{!! $styleText !!}">{{ $pendapatan['kdRekening'] }}</td>
					<td style="{!! $styleText !!}">{{ $pendapatan['nmRekening'] }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($anggaran) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($realisasi) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($sisaAnggaran) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($prognosis) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($totalPrognosis) }}</td>
					<td style="text-align: right; {!! $styleText !!}">&nbsp;</td>
				</tr>
				@endforeach
				@php
					$jumSisaAnggaranPendapatan = $helper->sisaAnggaran($jumAnggaranPendapatan, $jumRealisasiPendapatan);
					$jumTotalPrognosisPendapatan = $helper->totalPrognosis($jumRealisasiPendapatan, $jumPrognosisPendapatan);
				@endphp
				@if($jumlahAkunPendapatan != 0)
				<tr style="background-color: #cdcdcd;">
					<td style="font-weight: bold; text-align: center;" colspan="2">JUMLAH</td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumAnggaranPendapatan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumRealisasiPendapatan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumSisaAnggaranPendapatan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumPrognosisPendapatan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumTotalPrognosisPendapatan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>&nbsp;</b></td>
				</tr>
				@endif
				@php
					$listRekeningPengeluaran = $helper->getListRekeningPengeluaran($viewData, $kodePengguna, $kodeOrganisasi, $tahun);

					$kode_belda = 0;
					$kode_belda_1 = 0;
					$kodeEksekusi = 0;

					$array_belanja_daerah_1= array('5');
					$array_belanja_daerah_2= array('5 1');
					$array_belanja_daerah_3= array('5 1 1','5 2 1','5 2 2','5 2 3','5 1 2','5 1 3','5 1 4','5 1 5','5 1 6','5 1 7','5 1 8');
				@endphp
				@foreach($listRekeningPengeluaran as $pengeluaran)
					@php
						$anggaran = 0;
						$realisasi = 0;
						$sisaAnggaran = 0;
						$prognosis = 0;
						$totalPrognosis = 0;

						$kodeEksekusi = 0;
						$check = $helper->percobaan($pengeluaran['kdRekening']);

						$styleText = '';

						if(strlen($pengeluaran['kdRekening']) <= '27'){
							$styleText = 'font-weight: bold;';
						}

						$kode_belanja_daerah=trim($pengeluaran['kdRekening']);
						$kode_belanja_daerah_2=substr($kode_belanja_daerah,24);

						if(strlen($kode_belanja_daerah)=='25' && in_array($kode_belanja_daerah_2, $array_belanja_daerah_1)){
							if($kode_belda == 0){
								$sqlBlud = [
									'debet' => 'substring(akun_debet_lra13,25,1)="5"',
									'kredit' => 'substring(akun_kredit_lra13,25,1)="5"'
								];
								$kodeEksekusi = 1;
								$kode_belda = 1;
								$sql = 'substring(kdRekening,25,1)="5"';
								$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
								$sql3 = 'substring(kode_rekening,25,1)="5"';
								$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
							}
						}else if(strlen($kode_belanja_daerah)=='27' && in_array($kode_belanja_daerah_2, $array_belanja_daerah_2)){
							if($kode_belanja_daerah_2=='5 1'){
								$sqlBlud = [
									'debet' => 'substring(akun_debet_lra13,25,3)="5 1"',
									'kredit' => 'substring(akun_kredit_lra13,25,3)="5 1"'
								];
								$kodeEksekusi = 1;
								$sql = 'substring(kdRekening,25,3)="5 1"';
								$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
								$sql3 = 'substring(kode_rekening,25,3)="5 1"';
								$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
							}
						}else if(strlen($kode_belanja_daerah)=='19'){
							if($kode_belda_1==0){
								$sqlBlud = [
									'debet' => 'substring(akun_debet_lra13,18,6)!="00 000"',
									'kredit' => 'substring(akun_kredit_lra13,18,6)!="00 000"'
								];
								$kodeEksekusi = 1;
								$kode_belda_1 = 1;
								$sql = 'substring(kdRekening,18,6)!="00 000" and length(kdRekening) >="35"';
								$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
								$sql3 = 'substring(kode_rekening,18,6)!="00 000"';
								$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
								$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
								$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
								$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
								echo '<tr>
									<td style="font-weight: bold;"></td>
									<td style="font-weight: bold;">BELANJA LANGSUNG</td>
									<td style="text-align: right; font-weight: bold;">'.mataUang($anggaran).'</td>
									<td style="text-align: right; font-weight: bold;">'.mataUang($realisasi).'</td>
									<td style="text-align: right; font-weight: bold;">'.mataUang($sisaAnggaran).'</td>
									<td style="text-align: right; font-weight: bold;">'.mataUang($prognosis).'</td>
									<td style="text-align: right; font-weight: bold;">'.mataUang($totalPrognosis).'</td>
									<td style="text-align: right; font-weight: bold;">&nbsp;</td>
								</tr>';

								$sqlBlud = [
									'debet' => 'akun_debet_lra13 regexp "^'.$pengeluaran['kdRekening'].'"',
									'kredit' => 'akun_kredit_lra13 regexp "^'.$pengeluaran['kdRekening'].'"'
								];
								$sql = 'kdRekening regexp "^'.$pengeluaran['kdRekening'].'"';
								$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
								$sql3 = 'kode_rekening regexp "^'.$pengeluaran['kdRekening'].'"';
								$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
							}else{
								$sqlBlud = [
									'debet' => 'akun_debet_lra13 regexp "^'.$pengeluaran['kdRekening'].'"',
									'kredit' => 'akun_kredit_lra13 regexp "^'.$pengeluaran['kdRekening'].'"'
								];
								$kodeEksekusi = 1;
								$sql = 'kdRekening regexp "^'.$pengeluaran['kdRekening'].'"';
								$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
								$sql3 = 'kode_rekening regexp "^'.$pengeluaran['kdRekening'].'"';
								$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
							}
						}else if(strlen($kode_belanja_daerah)=='23' || strlen($kode_belanja_daerah)=='29'){
							$sqlBlud = [
								'debet' => 'akun_debet_lra13 regexp "^'.$pengeluaran['kdRekening'].'"',
								'kredit' => 'akun_kredit_lra13 regexp "^'.$pengeluaran['kdRekening'].'"'
							];
							$kodeEksekusi = 1;
							$sql = 'kdRekening regexp "^'.$pengeluaran['kdRekening'].'"';
							$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
							$sql3 = 'kode_rekening regexp "^'.$pengeluaran['kdRekening'].'"';
							$realisasi = $helper->jumRealisasiPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sqlBlud);
						}

						if($kodeEksekusi == 1){
							$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
							$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
							$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);

							if(strlen($pengeluaran['kdRekening']) == '29'){
								$jumAnggaranPengeluaran += $anggaran;
								$jumRealisasiPengeluaran += $realisasi;
								$jumPrognosisPengeluaran += $prognosis;
							}
						}
					@endphp
					@if($kodeEksekusi == 1)
						<tr>
							<td style="{!! $styleText !!}">{{ $pengeluaran['kdRekening'] }}</td>
							<td style="{!! $styleText !!}">{{ $pengeluaran['nmRekening'] }}</td>
							<td style="text-align: right; {!! $styleText !!}">{{ mataUang($anggaran) }}</td>
							<td style="text-align: right; {!! $styleText !!}">{{ mataUang($realisasi) }}</td>
							<td style="text-align: right; {!! $styleText !!}">{{ mataUang($sisaAnggaran) }}</td>
							<td style="text-align: right; {!! $styleText !!}">{{ mataUang($prognosis) }}</td>
							<td style="text-align: right; {!! $styleText !!}">{{ mataUang($totalPrognosis) }}</td>
							<td style="text-align: right; {!! $styleText !!}">&nbsp;</td>
						</tr>
					@endif
				@endforeach
				@php
					$jumSisaAnggaranPengeluaran = $helper->sisaAnggaran($jumAnggaranPengeluaran, $jumRealisasiPengeluaran);
					$jumTotalPrognosisPengeluaran = $helper->totalPrognosis($jumRealisasiPengeluaran, $jumPrognosisPengeluaran);
				@endphp
				<tr style="background-color: #cdcdcd;">
					<td style="font-weight: bold; text-align: center;" colspan="2">JUMLAH</td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumAnggaranPengeluaran) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumRealisasiPengeluaran) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumSisaAnggaranPengeluaran) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumPrognosisPengeluaran) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumTotalPrognosisPengeluaran) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>&nbsp;</b></td>
				</tr>
				@php
					$jumAnggaranSurdef = $jumAnggaranPendapatan-$jumAnggaranPengeluaran;
					$jumRealisasiSurdef = $jumRealisasiPendapatan-$jumRealisasiPengeluaran;
					$jumSisaAnggaranSurdef = $helper->sisaAnggaran($jumAnggaranSurdef, $jumRealisasiSurdef);
					$jumPrognosisSurdef = $jumPrognosisPendapatan-$jumPrognosisPengeluaran;
					$jumTotalPrognosisSurdef = $helper->totalPrognosis($jumRealisasiSurdef, $jumPrognosisSurdef);
				@endphp
				<tr style="background-color: #cdcdcd;">
					<td style="font-weight: bold; text-align: center;" colspan="2">SURPLUS / (DEFISIT)</td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumAnggaranSurdef) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumRealisasiSurdef) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumSisaAnggaranSurdef) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumPrognosisSurdef) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumTotalPrognosisSurdef) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>&nbsp;</b></td>
				</tr>
				@php
					$listRekeningPenerimaanPembiayaan = $helper->getListRekeningPenerimaanPembiayaan($viewData, $kodePengguna, $kodeOrganisasi, $tahun);
					$jumlahAkunPenerimaanPembiayaan = 0;
				@endphp
				@foreach($listRekeningPenerimaanPembiayaan as $penerimaanPembiayaan)
					@php
						$anggaran = 0;
						$realisasi = 0;
						$sisaAnggaran = 0;
						$prognosis = 0;
						$totalPrognosis = 0;

						$jumlahAkunPenerimaanPembiayaan++;
						$check = $helper->percobaan($penerimaanPembiayaan['kdRekening']);

						$styleText = '';

						if(strlen($penerimaanPembiayaan['kdRekening']) <= '27'){
							$styleText = 'font-weight: bold;';
						}

						if(strlen($penerimaanPembiayaan['kdRekening']) != '25'){
							$sql = 'kdRekening regexp "^'.$penerimaanPembiayaan['kdRekening'].'"';
							$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
							$sql2 = [
								'debet' => 'akun_debet_lra13 regexp "^'.$penerimaanPembiayaan['kdRekening'].'"',
								'kredit' => 'akun_kredit_lra13 regexp "^'.$penerimaanPembiayaan['kdRekening'].'"',
							];
							$sql3 = 'kode_rekening regexp "^'.$penerimaanPembiayaan['kdRekening'].'"';
							$realisasi = $helper->jumRealisasiPembiayaanPenerimaan13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
							$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
							$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
							$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
						}

						if(strlen($penerimaanPembiayaan['kdRekening']) == '29'){
							$jumAnggaranPenerimaanPembiayaan += $anggaran;
							$jumRealisasiPenerimaanPembiayaan += $realisasi;
							$jumPrognosisPenerimaanPembiayaan += $prognosis;
						}
					@endphp
				<tr>
					<td style="{!! $styleText !!}">{{ $penerimaanPembiayaan['kdRekening'] }}</td>
					<td style="{!! $styleText !!}">{{ $penerimaanPembiayaan['nmRekening'] }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($anggaran) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($realisasi) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($sisaAnggaran) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($prognosis) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($totalPrognosis) }}</td>
					<td style="text-align: right; {!! $styleText !!}">&nbsp;</td>
				</tr>
				@endforeach
				@php
					$jumSisaAnggaranPenerimaanPembiayaan = $helper->sisaAnggaran($jumAnggaranPenerimaanPembiayaan, $jumRealisasiPenerimaanPembiayaan);
					$jumTotalPrognosisPenerimaanPembiayaan = $helper->totalPrognosis($jumRealisasiPenerimaanPembiayaan, $jumPrognosisPenerimaanPembiayaan);
				@endphp
				@if($jumlahAkunPenerimaanPembiayaan != 0)
				<tr style="background-color: #cdcdcd;">
					<td style="font-weight: bold; text-align: center;" colspan="2">JUMLAH</td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumAnggaranPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumRealisasiPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumSisaAnggaranPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumPrognosisPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumTotalPrognosisPenerimaanPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>&nbsp;</b></td>
				</tr>
				@endif
				@php
					$listRekeningPengeluaranPembiayaan = $helper->getListRekeningPengeluaranPembiayaan($viewData, $kodePengguna, $kodeOrganisasi, $tahun);
					$jumlahAkunPengeluaranPembiayaan = 0;
				@endphp
				@foreach($listRekeningPengeluaranPembiayaan as $pengeluaranPembiayaan)
					@php
						$anggaran = 0;
						$realisasi = 0;
						$sisaAnggaran = 0;
						$prognosis = 0;
						$totalPrognosis = 0;

						$jumlahAkunPengeluaranPembiayaan++;
						$check = $helper->percobaan($pengeluaranPembiayaan['kdRekening']);

						$styleText = '';

						if(strlen($pengeluaranPembiayaan['kdRekening']) <= '27'){
							$styleText = 'font-weight: bold;';
						}

						if(strlen($pengeluaranPembiayaan['kdRekening']) != '25'){
							$sql = 'kdRekening regexp "^'.$pengeluaranPembiayaan['kdRekening'].'"';
							$anggaran = $helper->jumAnggaran13($sql, $viewData, $kodePengguna, $kodeOrganisasi);
							$sql2 = [
								'debet' => 'akun_debet_lra13 regexp "^'.$pengeluaranPembiayaan['kdRekening'].'"',
								'kredit' => 'akun_kredit_lra13 regexp "^'.$pengeluaranPembiayaan['kdRekening'].'"',
							];
							$sql3 = 'kode_rekening regexp "^'.$pengeluaranPembiayaan['kdRekening'].'"';
							$realisasi = $helper->jumRealisasiPembiayaanPengeluaran13($sql3, $viewData, $kodePengguna, $kodeOrganisasi, $tahun, $sql2);
							$sisaAnggaran = $helper->sisaAnggaran($anggaran, $realisasi);
							$prognosis = $helper->jumPrognosis13($sql, $viewData, $kodePengguna, $kodeOrganisasi, $sisaAnggaran);
							$totalPrognosis = $helper->totalPrognosis($realisasi, $prognosis);
						}

						if(strlen($pengeluaranPembiayaan['kdRekening']) == '29'){
							$jumAnggaranPengeluaranPembiayaan += $anggaran;
							$jumRealisasiPengeluaranPembiayaan += $realisasi;
							$jumPrognosisPengeluaranPembiayaan += $prognosis;
						}
					@endphp
				<tr>
					<td style="{!! $styleText !!}">{{ $pengeluaranPembiayaan['kdRekening'] }}</td>
					<td style="{!! $styleText !!}">{{ $pengeluaranPembiayaan['nmRekening'] }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($anggaran) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($realisasi) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($sisaAnggaran) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($prognosis) }}</td>
					<td style="text-align: right; {!! $styleText !!}">{{ mataUang($totalPrognosis) }}</td>
					<td style="text-align: right; {!! $styleText !!}">&nbsp;</td>
				</tr>
				@endforeach
				@php
					$jumSisaAnggaranPengeluaranPembiayaan = $helper->sisaAnggaran($jumAnggaranPengeluaranPembiayaan, $jumRealisasiPengeluaranPembiayaan);
					$jumTotalPrognosisPengeluaranPembiayaan = $helper->totalPrognosis($jumRealisasiPengeluaranPembiayaan, $jumPrognosisPengeluaranPembiayaan);
				@endphp
				@if($jumlahAkunPengeluaranPembiayaan != 0)
				<tr style="background-color: #cdcdcd;">
					<td style="font-weight: bold; text-align: center;" colspan="2">JUMLAH</td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumAnggaranPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumRealisasiPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumSisaAnggaranPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumPrognosisPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumTotalPrognosisPengeluaranPembiayaan) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>&nbsp;</b></td>
				</tr>
				@endif
				@php
					$jumAnggaranPembiayaanNetto = $jumAnggaranPenerimaanPembiayaan-$jumAnggaranPengeluaranPembiayaan;
					$jumRealisasiPembiayaanNetto= $jumRealisasiPenerimaanPembiayaan-$jumRealisasiPengeluaranPembiayaan;
					$jumSisaAnggaranPembiayaanNetto = $helper->sisaAnggaran($jumAnggaranPembiayaanNetto, $jumRealisasiPembiayaanNetto);
					$jumPrognosisPembiayaanNetto = $jumPrognosisPenerimaanPembiayaan-$jumPrognosisPengeluaranPembiayaan;
					$jumTotalPrognosisPembiayaanNetto = $helper->totalPrognosis($jumRealisasiPembiayaanNetto, $jumPrognosisPembiayaanNetto);
				@endphp
				@if($jumlahAkunPenerimaanPembiayaan != 0 || $jumlahAkunPengeluaranPembiayaan != 0)
				<tr style="background-color: #cdcdcd;">
					<td style="font-weight: bold; text-align: center;" colspan="2">PEMBIAYAAN NETTO</td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumAnggaranPembiayaanNetto) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumRealisasiPembiayaanNetto) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumSisaAnggaranPembiayaanNetto) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumPrognosisPembiayaanNetto) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>{{ mataUang($jumTotalPrognosisPembiayaanNetto) }}</b></td>
					<td style="text-align: right; font-weight: bold;"><b>&nbsp;</b></td>
				</tr>
				@endif
			</tbody>
		</table>
	</body>
</html>
