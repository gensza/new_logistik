<?php

function check_already_login1()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userlog');
	if ($user_session) {
		redirect('Home');
	}
}
function check_already_login2()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userlogin');
	if ($user_session) {
		redirect('StrukUser');
	}
}