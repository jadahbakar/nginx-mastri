<?php
	function mataUang($data){
		if($data < 0){
			$nilai = "(".number_format(abs($data),0,',','.').")";
		}else{
			$nilai = number_format((float)$data,0,',','.');
		}

		return $nilai;
	}

	function titik($kata){
		$pecah = explode(".",$kata);
		$satu = implode("",$pecah);
		return $satu;
	}

	function hilangTiTik($data){
		if($data[0] == "("){
			$hilang_kurung_1 = str_replace("(", "", $data);
			$hilang_kurung_2 = str_replace(")", "", $hilang_kurung_1);
			$hilang_semua = trim($hilang_kurung_2);
			$data2 = "-".titik($hilang_semua);
		}else{
			$data2 = titik($data);
		}

		if($data == ""){
			$data2 = 0;
		}

		return $data2;
	}

	function statusProses($status){
		if($status == 'Berhenti'){
			$html = '<div class="badge badge-warning label-square"><i class="font-medium-2"></i><span>'.$status.'</span></div>';
		}else if($status == 'Berjalan'){
			$html = '<div class="badge badge-primary label-square"><i class="font-medium-2"></i><span>'.$status.'</span></div>';
		}else if($status == 'Gagal'){
			$html = '<div class="badge badge-danger label-square"><i class="font-medium-2"></i><span>'.$status.'</span></div>';
		}else if($status == 'Sukses'){
			$html = '<div class="badge badge-success label-square"><i class="font-medium-2"></i><span>'.$status.'</span></div>';
		}

		return $html;
	}

   	function tanggal_format_indonesia($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan   = getBulan(substr($tgl,5,2));
        $tahun   = substr($tgl,0,4);
        return $tanggal.' '.$bulan.' '.$tahun;
   	}

   	function getBulan($bln){
       	switch ($bln){
          	case 1:
          		return "Januari";
          	break;
          	case 2:
          		return "Februari";
          	break;
          	case 3:
          		return "Maret";
          	break;
          	case 4:
          		return "April";
          	break;
          	case 5:
          		return "Mei";
          	break;
          	case 6:
          		return "Juni";
          	break;
          	case 7:
          		return "Juli";
          	break;
          	case 8:
          		return "Agustus";
          	break;
          	case 9:
          		return "September";
          	break;
          	case 10:
          		return "Oktober";
          	break;
          	case 11:
          		return "November";
          	break;
          	case 12:
          		return "Desember";
          	break;
        }
    }

    function getPostingJenisTransaksi(){
        $jenisTransaksi = [
            '11' => 'Terima Pendapatan Tanpa Ketetapan',
            '12' => 'Terima Pendapatan Ditetapkan Tahun Ini',
            '13' => 'Terima Pendapatan Ditetapkan Tahun Lalu',
            '14' => 'Terima Pendapatan Diterima Dimuka',
            '15' => 'Koreksi Terima Pendapatan Tanpa Ketetapan',
            '16' => 'Koreksi Terima Pendapatan Ditetapkan Tahun Ini',
            '17' => 'Koreksi Terima Pendapatan Ditetapkan Tahun Lalu',
            '18' => 'Koreksi Terima Pendapatan Diterima Dimuka',
            '19' => 'Setor Pendapatan',
            '20' => 'Koreksi Setor Pendapatan',
            '21' => 'Penerbitan SKPD',
            '22' => 'Penerbitan SKRD',
            '23' => 'Penerbitan Lainnya',
            '24' => 'Koreksi Penerbitan SKPD',
            '25' => 'Koreksi Penerbitan SKRD',
            '26' => 'Koreksi Penerbitan Lainnya',
            '31' => 'Terima SP2D UP',
            '32' => 'Terima SP2D GU',
            '33' => 'Terima SP2D TU',
            '42' => 'Pengembalian Uang ke Kas Daerah',
            '43' => 'Pemotongan PPh4',
            '44' => 'Setoran PPh4',
            '45' => 'Pemotongan PPh21',
            '46' => 'Setoran PPh21',
            '47' => 'Pemotongan PPh22',
            '48' => 'Setoran PPh22',
            '49' => 'Pemotongan PPh23',
            '50' => 'Setoran PPh23',
            '51' => 'Pemotongan PPN',
            '52' => 'Setoran PPN',
            '58' => 'Belanja LS PPKD',
            '80' => 'Belanja LS Barang Jasa',
            '83' => 'Koreksi Belanja UP / GU / TU / LS',
            '84' => 'Belanja UP / GU',
            '85' => 'Belanja TU',
            '86' => 'Belanja LS Gaji Tunjangan',
            '87' => 'Pemindahbukuan Belanja UP / GU / TU / LS'
        ];

        return $jenisTransaksi;
    }

    function jenisTransaksi($jenis){
        $jenisTransaksi = '';

        if($jenis == '11') $jenisTransaksi = 'Terima Pendapatan Tanpa Ketetapan';
        if($jenis == '12') $jenisTransaksi = 'Terima Pendapatan Ditetapkan Tahun Ini';
        if($jenis == '13') $jenisTransaksi = 'Terima Pendapatan Ditetapkan Tahun Lalu';
        if($jenis == '14') $jenisTransaksi = 'Terima Pendapatan Diterima Dimuka';
        if($jenis == '15') $jenisTransaksi = 'Koreksi Terima Pendapatan Tanpa Ketetapan';
        if($jenis == '16') $jenisTransaksi = 'Koreksi Terima Pendapatan Ditetapkan Tahun Ini';
        if($jenis == '17') $jenisTransaksi = 'Koreksi Terima Pendapatan Ditetapkan Tahun Lalu';
        if($jenis == '18') $jenisTransaksi = 'Koreksi Terima Pendapatan Diterima Dimuka';
        if($jenis == '19') $jenisTransaksi = 'Setor Pendapatan';
        if($jenis == '20') $jenisTransaksi = 'Koreksi Setor Pendapatan';
        if($jenis == '21') $jenisTransaksi = 'Penerbitan SKPD';
        if($jenis == '22') $jenisTransaksi = 'Penerbitan SKRD';
        if($jenis == '23') $jenisTransaksi = 'Penerbitan Lainnya';
        if($jenis == '24') $jenisTransaksi = 'Koreksi Penerbitan SKPD';
        if($jenis == '25') $jenisTransaksi = 'Koreksi Penerbitan SKRD';
        if($jenis == '26') $jenisTransaksi = 'Koreksi Penerbitan Lainnya';
        if($jenis == '31') $jenisTransaksi = 'Terima SP2D UP';
        if($jenis == '32') $jenisTransaksi = 'Terima SP2D GU';
        if($jenis == '33') $jenisTransaksi = 'Terima SP2D TU';
        if($jenis == '42') $jenisTransaksi = 'Pengembalian Uang ke Kas Daerah';
        if($jenis == '43') $jenisTransaksi = 'Pemotongan PPh4';
        if($jenis == '44') $jenisTransaksi = 'Setoran PPh4';
        if($jenis == '45') $jenisTransaksi = 'Pemotongan PPh21';
        if($jenis == '46') $jenisTransaksi = 'Setoran PPh21';
        if($jenis == '47') $jenisTransaksi = 'Pemotongan PPh22';
        if($jenis == '48') $jenisTransaksi = 'Setoran PPh22';
        if($jenis == '49') $jenisTransaksi = 'Pemotongan PPh23';
        if($jenis == '50') $jenisTransaksi = 'Setoran PPh23';
        if($jenis == '51') $jenisTransaksi = 'Pemotongan PPN';
        if($jenis == '52') $jenisTransaksi = 'Setoran PPN';
        if($jenis == '58') $jenisTransaksi = 'Belanja LS PPKD';
        if($jenis == '80') $jenisTransaksi = 'Belanja LS Barang Jasa';
        if($jenis == '83') $jenisTransaksi = 'Koreksi Belanja UP / GU / TU / LS';
        if($jenis == '84') $jenisTransaksi = 'Belanja UP / GU';
        if($jenis == '85') $jenisTransaksi = 'Belanja TU';
        if($jenis == '86') $jenisTransaksi = 'Belanja LS Gaji Tunjangan';
        if($jenis == '87') $jenisTransaksi = 'Pemindahbukuan Belanja UP / GU / TU / LS';

        return $jenisTransaksi;
    }
?>
