<?php
// $ip_server = $_SERVER['SERVER_ADDR'];
// $domain = gethostbyaddr($ip_server);
// if(!empty($domain) && $domain == "localhost"){
// 	$alamat = $domain;
// }
// else{
// 	$alamat = $ip_server;
// }

function check_session()
{
	$CI = &get_instance();
	$session_status = $CI->session->userdata('status_login');
	// $session_username = $CI->session->userdata('username');
	// $session_akses = $CI->session->userdata('akses');
	// var_dump($session_status);exit();
	if ($session_status != 'oke') {
		$CI->session->set_flashdata('notif', '<div class="center"><div class="alert alert-danger" role="alert">Anda Harus Login Terlebih Dahulu !<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div></div>');
		// header("Location: http://localhost/mips/app/index.php/Auth/login");
		$base = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$url = $base . "://" . $_SERVER['HTTP_HOST'] . "/app_logistik_msal/index.php/auth/login";
		header("Location: " . $url);
	}
}

function check_db_pt()
{
	$CI = &get_instance();
	$session_db_pt = strtolower($CI->session->userdata('app_pt'));
	if (empty($session_db_pt)) {
		$db_pt = "center";
	} elseif ($session_db_pt == 'msal') {
		$db_pt = 'msal';
	} elseif ($session_db_pt == 'mapa') {
		$db_pt = 'mapa';
	} elseif ($session_db_pt == 'psam') {
		$db_pt = 'psam';
	} elseif ($session_db_pt == 'peak') {
		$db_pt = 'peak';
	} elseif ($session_db_pt == 'kpp') {
		$db_pt = 'kpp';
	}
	return $db_pt;
}


function db_pt()
{
	$CI = &get_instance();
	$session_db_pt = strtolower($CI->session->userdata('app_pt'));
	if (empty($session_db_pt)) {
		$db_pt = "center";
	} elseif ($session_db_pt == 'msal') {
		$db_pt = 'msal';
	} elseif ($session_db_pt == 'mapa') {
		$db_pt = 'mapa';
	} elseif ($session_db_pt == 'psam') {
		$db_pt = 'psam';
	} elseif ($session_db_pt == 'peak') {
		$db_pt = 'peak';
	} elseif ($session_db_pt == 'kpp') {
		$db_pt = 'kpp';
	}
	return $db_pt;
}
