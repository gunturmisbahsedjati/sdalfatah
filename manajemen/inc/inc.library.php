<?php

$bulanIndonesia = array(
	"1" => "Januari",
	"2" => "Februari",
	"3" => "Maret",
	"4" => "April",
	"5" => "Mei",
	"6" => "Juni",
	"7" => "Juli",
	"8" => "Agustus",
	"9" => "September",
	"10" => "Oktober",
	"11" => "November",
	"12" => "Desember"
);
#pengaturan slug 
function textToSlug($text)
{
	$text = trim($text);
	if (empty($text)) return '';
	$text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
	$text = strtolower(trim($text));
	$text = str_replace(' ', '-', $text);
	$text = $text_ori = preg_replace('/\-{2,}/', '-', $text);
	return $text;
}

#fungsi get full url
function getFullURL()
{
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
		$link = "https";
	else
		$link = "http";
	$link .= "://";
	$link .= $_SERVER['HTTP_HOST'];
	$link .= $_SERVER['REQUEST_URI'];
	return $link;
}



# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (d-m-Y)
function Indonesia2Tgl($tanggal)
{
	$namaBln = array(
		"01" => "Januari",
		"02" => "Februari",
		"03" => "Maret",
		"04" => "April",
		"05" => "Mei",
		"06" => "Juni",
		"07" => "Juli",
		"08" => "Agustus",
		"09" => "September",
		"10" => "Oktober",
		"11" => "November",
		"12" => "Desember"
	);

	$tgl = substr($tanggal, 8, 2);
	$bln = substr($tanggal, 5, 2);
	$thn = substr($tanggal, 0, 4);
	$tanggal = "$tgl " . $namaBln[$bln] . " $thn";
	return $tanggal;
}

function hariTgl($tgl)
{
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);
	$tgl = $dayList[date('D', strtotime($tgl))];
	return $tgl;
}

function angka2Bln($bulan)
{
	$namaBln = array(
		"1" => "Januari",
		"2" => "Februari",
		"3" => "Maret",
		"4" => "April",
		"5" => "Mei",
		"6" => "Juni",
		"7" => "Juli",
		"8" => "Agustus",
		"9" => "September",
		"10" => "Oktober",
		"11" => "November",
		"12" => "Desember"
	);

	$bulan = $namaBln[$bulan];
	return $bulan;
}
function angka2BlnKapital($bulan)
{
	$namaBln = array(
		"1" => "JANUARI",
		"2" => "FEBRUARI",
		"3" => "MARET",
		"4" => "APRIL",
		"5" => "MEI",
		"6" => "JUNI",
		"7" => "JULI",
		"8" => "AGUSTUS",
		"9" => "SEPTEMBER",
		"10" => "OKTOBER",
		"11" => "NOVEMBER",
		"12" => "DESEMBER"
	);

	$bulan = $namaBln[$bulan];
	return $bulan;
}
function tanggal($tanggal)
{
	$tgl = substr($tanggal, 8, 2);
	$bln = substr($tanggal, 5, 2);
	$thn = substr($tanggal, 0, 4);
	$tanggal = "$tgl-$bln-$thn";
	return $tanggal;
}
function utanggal($tanggal)
{
	$tgl = substr($tanggal, 8, 2);
	$bln = substr($tanggal, 5, 2);
	$thn = substr($tanggal, 0, 4);
	$tanggal = "$tgl-$bln-$thn";
	return $tanggal;
}
function hitungHari($myDate1, $myDate2)
{
	$myDate1 = strtotime($myDate1);
	$myDate2 = strtotime($myDate2);

	return ($myDate2 - $myDate1) / (24 * 3600);
}

function selesihHari($tgl1, $tgl2)
{
	$tgl1 = new DateTime($tgl1);
	$tgl2 = new DateTime($tgl2);
	$d = $tgl2->diff($tgl1)->days + 1;
	return $d;
}



function acakangka($panjang)
{
	$karakter = '1234567890';
	$string = '';
	for ($i = 0; $i < $panjang; $i++) {
		$pos = rand(0, strlen($karakter) - 1);
		$string .= $karakter[$pos];
	}
	return $string;
}
function acakhuruf1($panjang)
{
	$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';
	for ($i = 0; $i < $panjang; $i++) {
		$pos = rand(0, strlen($karakter) - 1);
		$string .= $karakter[$pos];
	}
	return $string;
}
function acakhuruf($panjang)
{
	$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';
	for ($i = 0; $i < $panjang; $i++) {
		$pos = rand(0, strlen($karakter) - 1);
		$string .= $karakter[$pos];
	}
	return $string;
}


function filterString($text)
{
	$find = array(" ", ":", "-", "/");
	$text = str_replace($find, "", $text);
	$text = strtoupper($text);
	return $text;
}


function bersihkan($string)
{
	$find = array(" ", ":", "-", ".");
	$hasil = str_replace($find, "", $string);
	return $hasil;
}

//pengecekean file pdf
$max_size_pdf    = 1000 * 1000;
$maxsizepdf = 2097152;
$arrayCekEks = [];
$arrayCekSize = [];
$arrayPDF = ["pdf", "PDF", "Pdf"];
$arrayImage = ["png", "jpeg", "jpg"];
$arrayResultEks = [1, 1, 1];
$arrayResultSize = [1, 1, 1];



function singkatString($string, $repl, $limit)
{
	if (strlen($string) > $limit) {
		return substr($string, 0, $limit) . $repl;
	} else {
		return $string;
	}
}
