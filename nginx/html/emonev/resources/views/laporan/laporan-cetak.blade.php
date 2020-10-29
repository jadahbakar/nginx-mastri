<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('material/assets/images/favicon-copy.png') }}">
    <link href="{{ asset('pluginku/print.css') }}" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style type="text/css">
    	 @page { 
    	 	margin: 50px 50px 50px 50px; 
    	 	size: a3 landscape;
    	 }
    </style>
</head>
	<body>
		<center>
			<h4>LAPORAN SERAPAN SP2D dan SPJ</h4>
			<h4>PERIODE {{ strtoupper(nama_bulan($var['bulan']))}} {{ $var['tahun'] }}</h4>
		</center>
		<br />
		<table border="1" width="100%" class="table-border" style="table-layout: fixed; word-wrap: break-word;">
			<thead style="background-color: #cdcdcd;">
				<tr>
					<th width="1.5%" rowspan="3"><center><b>NO</b></center></th>
					<th width="5.5%" rowspan="3"><center><b>NAMA OPD</b></center></th>
					<th colspan="3"><center><b>ANGGARAN DANA DAERAH</b></center></th>
					<th><center><b>ANGGARAN DANA MANDIRI / PUSAT</b></center></th>
					<th colspan="3"><center><b>ANGGARAN</b></center></th>
					<th colspan="3"><center><b>SP2D</b></center></th>
					<th colspan="3"><center><b>PERSENTASE SP2D</b></center></th>
					<th colspan="3"><center><b>SPJ DANA DAERAH</b></center></th>
					<th colspan="3"><center><b>PERSENTASE SPJ DANA DAERAH</b></center></th>
					<th><center><b>SPJ DANA MANDIRI / PUSAT</b></center></th>
					<th><center><b>PERSENTASE SPJ DANA MANDIRI / PUSAT</b></center></th>
					<th colspan="3"><center><b>SPJ</b></center></th>
					<th colspan="3"><center><b>PERSENTASE SPJ</b></center></th>
				</tr>
				<tr>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
					<th><center><b>BELANJA TIDAK LANGSUNG</b></center></th>
					<th><center><b>BELANJA LANGSUNG</b></center></th>
					<th><center><b>TOTAL</b></center></th>
				</tr>
				<tr>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>Rp.</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>%</b></center></th>
					<th><center><b>%</b></center></th>
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
					<th><center><b>9</b></center></th>
					<th><center><b>10</b></center></th>
					<th><center><b>11</b></center></th>
					<th><center><b>12</b></center></th>
					<th><center><b>13</b></center></th>
					<th><center><b>14</b></center></th>
					<th><center><b>15</b></center></th>
					<th><center><b>16</b></center></th>
					<th><center><b>17</b></center></th>
					<th><center><b>18</b></center></th>
					<th><center><b>19</b></center></th>
					<th><center><b>20</b></center></th>
					<th><center><b>21</b></center></th>
					<th><center><b>22</b></center></th>
					<th><center><b>23</b></center></th>
					<th><center><b>24</b></center></th>
					<th><center><b>25</b></center></th>
					<th><center><b>26</b></center></th>
					<th><center><b>27</b></center></th>
					<th><center><b>28</b></center></th>
					<th><center><b>29</b></center></th>
				</tr>
			</thead>
			<tbody>
			@php
				$totalKolom3 = 0;
				$totalKolom4 = 0;
				$totalKolom5 = 0;
				$totalKolom6 = 0;
				$totalKolom7 = 0;
				$totalKolom8 = 0;
				$totalKolom9 = 0;
				$totalKolom10 = 0;
				$totalKolom11 = 0;
				$totalKolom12 = 0;
				$totalKolom16 = 0;
				$totalKolom17 = 0;
				$totalKolom18 = 0;
				$totalKolom22 = 0;
				$totalKolom24 = 0;
				$totalKolom25 = 0;
				$totalKolom26 = 0;
			@endphp

			@foreach($data as $item)
				@php
					$totalKolom3 += $item['kolom3'];
					$totalKolom4 += $item['kolom4'];
					$totalKolom5 += $item['kolom5'];
					$totalKolom6 += $item['kolom6'];
					$totalKolom7 += $item['kolom7'];
					$totalKolom8 += $item['kolom8'];
					$totalKolom9 += $item['kolom9'];
					$totalKolom10 += $item['kolom10'];
					$totalKolom11 += $item['kolom11'];
					$totalKolom12 += $item['kolom12'];
					$totalKolom16 += $item['kolom16'];
					$totalKolom17 += $item['kolom17'];
					$totalKolom18 += $item['kolom18'];
					$totalKolom22 += $item['kolom22'];
					$totalKolom24 += $item['kolom24'];
					$totalKolom25 += $item['kolom25'];
					$totalKolom26 += $item['kolom26'];
				@endphp
				<tr>
					<td><center>{{ $item['no_urut'] }}</center></td>
					<td>{{ $item['nama_organisasi'] }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom3']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom4']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom5']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom6']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom7']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom8']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom9']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom10']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom11']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom12']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom13']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom14']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom15']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom16']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom17']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom18']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom19']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom20']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom21']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom22']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom23']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom24']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom25']) }}</td>
					<td style="text-align: right;">{{ mataUang($item['kolom26']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom27']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom28']) }}</td>
					<td style="text-align: center;">{{ persen($item['kolom29']) }}</td>
				</tr>
			@endforeach
				<tr>	
					<td colspan="2" style="text-align: center;"><b>Total</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom3) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom4) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom5) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom6) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom7) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom8) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom9) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom10) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom11) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom12) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom16) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom17) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom18) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom22) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom24) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom25) }}</b></td>
					<td style="text-align: right;"><b>{{ mataUang($totalKolom26) }}</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
					<td style="text-align: right;"><b>&nbsp;</b></td>
				</tr>
			</tbody>
		</table>
		
	</body>
</html>
