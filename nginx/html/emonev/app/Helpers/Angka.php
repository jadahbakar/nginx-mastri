<?php
	function mataUang($data){
		$nilai = number_format($data,0,'','.');
		return $nilai;
	}

	function persen($data){
		$nilai = round($data,2);
		$nilai = str_replace(".", ",", $nilai);
		return $nilai;
	}

	function hilangTiTik($data){
		$nilai2 = $data;

		if(strpos($data,".") !== false){
			if(strpos($data,",") !== false){
				$nilai = str_replace(".", "", $data);
				$nilai2 = str_replace(",", ".", $nilai);
			}
		}else if(strpos($data,",") !== false){
			$nilai2 = str_replace(",", ".", $data);
		}

		if($nilai2 == ""){
			$nilai2 = 0;
		}
		
		return $nilai2;
	}

	function in_array_r($item , $array){
	    return preg_match('/"'.$item.'"/i' , json_encode($array));
	}

	function jenis($id){
		if($id=='1'){
			$jenis = "UP";
		}else if($id == '2'){
			$jenis = "GU";
		}else if($id == '3'){
			$jenis = "TU";
		}else if($id == '4'){
			$jenis = "LS";    //4 => LS Barang dan Jasa, 5 => LS Gaji dan Tunjangan, 6 => LS PPKD
		}

		return $jenis;
	}

	function jenis2($id){
		if($id=='1'){
			$jenis = "UP";
		}else if($id == '2'){
			$jenis = "GU";
		}else if($id == '3'){
			$jenis = "TU";
		}else if($id == '4'){
			$jenis = "LS Barang dan Jasa";    
		}else if($id == '5'){
			$jenis = "LS Gaji dan Tunjangan";    
		}else if($id == '6'){
			$jenis = "LS PPKD";    
		}else if($id == '7'){
			$jenis = "BLUD";    
		}

		return $jenis;
	}

	function jenisTransaksi($id){
		if($id == '58'){
			$jenisTransaksi = "Belanja LS PPKD";
		}else if($id == '80'){
			$jenisTransaksi = "Belanja LS Barang Jasa";
		}else if($id == '84'){
			$jenisTransaksi = "Belanja UP / GU";
		}else if($id == '85'){
			$jenisTransaksi = "Belanja TU";
		}else if($id == '86'){
			$jenisTransaksi = "Belanja LS Gaji Tunjangan";
		}else if($id == '87'){
			$jenisTransaksi = "Pemindahbukuan Belanja UP / GU / TU / LS";
		}else if($id == '83'){
			$jenisTransaksi = "Koreksi Belanja UP / GU / TU / LS";
		}else if($id == '64'){
			$jenisTransaksi = "BLUD";
		}

		return $jenisTransaksi;
	}

function nama_bulan($bulan) {
    if($bulan == 1) {
        $namabulan = "Januari";
    } else if($bulan == 2) {
        $namabulan = "Februari";
    } else if($bulan == 3) {
        $namabulan = "Maret";
    } else if($bulan == 4) {
        $namabulan = "April";
    } else if($bulan == 5) {
        $namabulan = "Mei";
    } else if($bulan == 6) {
        $namabulan = "Juni";
    } else if($bulan == 7) {
        $namabulan = "Juli";
    } else if($bulan == 8) {
        $namabulan = "Agustur";
    } else if($bulan == 9) {
        $namabulan = "September";
    } else if($bulan == 10) {
        $namabulan = "Oktober";
    } else if($bulan == 11) {
        $namabulan = "Nopember";
    } else if($bulan == 12) {
        $namabulan = "Desember";
    }

    return $namabulan;
}
?>