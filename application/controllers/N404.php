<?php

defined('BASEPATH') or exit('No direct script access allowed');

class N404 extends CI_Controller
{

    public function index()
    {
        $data = [
            'tittle' => 'Ada Yang Salah Nih'
        ];
        $this->load->view('404.php', $data);
    }
}

/* End of file N404.php */
