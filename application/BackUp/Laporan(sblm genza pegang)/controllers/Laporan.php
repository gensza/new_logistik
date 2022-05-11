<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$db_pt = check_db_pt();
		$this->db_logistik = $this->load->database('db_logistik', TRUE);
		$this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

		$this->load->model('M_laporan');
		$this->load->model('M_lapSpp');
		$this->load->model('M_lapSpp_proses');
		$this->load->model('M_lapSpp_disetujui');
		$this->load->model('M_lapSpp_sppi');
		$this->load->model('M_lapSpp_sppa');
		$this->load->model('Retur_m');

		if (!$this->session->userdata('id_user')) {
			$pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
			$this->session->set_flashdata('pesan', $pemberitahuan);
			redirect('Login');
		}
	}

	function list_lapbarang()
	{
		$list = $this->M_laporan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $hasil) {
			$row   = array();
			$id    = "'" . $hasil->id . "'";
			$row[] = $no++;
			$row[] = $hasil->kodebartxt;
			$row[] = $hasil->nopart;
			$row[] = $hasil->nabar;
			// $row[] = $hasil->grp;
			$row[] = $hasil->satuan;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_laporan->count_all(),
			"recordsFiltered" => $this->M_laporan->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	function print_lap_spp()
	{
		$noref = str_replace('.', '/', $this->uri->segment(3));
		$data['ppo'] = $this->db_logistik_pt->get_where('ppo', ['noreftxt' => $noref])->row();
		$data['item_ppo'] = $this->db_logistik_pt->get_where('item_ppo', array('noreftxt' => $noref))->result();

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);
		// $mpdf->SetHTMLHeader('<h3>' . $this->session->userdata('pt') . '</h3>');
		$html = $this->load->view('lapSpp/v_lap_spp_print', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function tampilkan_spp()
	{
		$cmb_devisi = $this->input->post('cmb_devisi');
		// $cmb_devisi = '06';
		$lap_cmb_bagian = $this->input->post('lap_cmb_bagian');

		$txt_periode = str_replace('/', '-', $this->input->post('tglAwalSPP'));
		$txt_periode1 = str_replace('/', '-', $this->input->post('tglAkhirSPP'));

		$tglAwal = date_format(date_create($txt_periode), "Y/m/d");
		$tglAkhir = date_format(date_create($txt_periode1), "Y/m/d");

		$this->M_lapSpp->data_spp($cmb_devisi, $lap_cmb_bagian, $tglAwal, $tglAkhir);

		$list = $this->M_lapSpp->get_datatables();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $hasil) {
			$no++;
			$noref = "'" . $hasil->noreftxt . "'";
			$noref = str_replace("/", ".", $noref);
			$tgl = date_create($hasil->tglppo);

			$row   = array();

			$row[] =  $no . ".";
			$row[] = date_format($tgl, 'd/m/Y');
			$row[] = $hasil->namadept;
			$row[] = $hasil->noreftxt;
			$row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printClick(' . $noref . ')"></button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_lapSpp->count_all(),
			"recordsFiltered" => $this->M_lapSpp->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	public function tampilkan_spp_prosess()
	{
		$cmb_devisi = $this->input->post('cmb_devisi');
		// $cmb_devisi = '06';
		$lap_cmb_bagian = $this->input->post('lap_cmb_bagian');

		$txt_periode = str_replace('/', '-', $this->input->post('tglAwalSPP'));
		$txt_periode1 = str_replace('/', '-', $this->input->post('tglAkhirSPP'));

		$tglAwal = date_format(date_create($txt_periode), "Y/m/d");
		$tglAkhir = date_format(date_create($txt_periode1), "Y/m/d");

		$this->M_lapSpp_proses->data_spp($cmb_devisi, $lap_cmb_bagian, $tglAwal, $tglAkhir);

		$list = $this->M_lapSpp_proses->get_datatables();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $hasil) {
			$no++;
			$noref = "'" . $hasil->noreftxt . "'";
			$noref = str_replace("/", ".", $noref);
			$tgl = date_create($hasil->tglppo);

			$row   = array();

			$row[] =  $no . ".";
			$row[] = date_format($tgl, 'd/m/Y');
			$row[] = $hasil->namadept;
			$row[] = $hasil->noreftxt;
			$row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printClick(' . $noref . ')"></button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_lapSpp_proses->count_all(),
			"recordsFiltered" => $this->M_lapSpp_proses->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function tampilkan_spp_disetujui()
	{
		$cmb_devisi = $this->input->post('cmb_devisi');
		// $cmb_devisi = '06';
		$lap_cmb_bagian = $this->input->post('lap_cmb_bagian');

		$txt_periode = str_replace('/', '-', $this->input->post('tglAwalSPP'));
		$txt_periode1 = str_replace('/', '-', $this->input->post('tglAkhirSPP'));

		$tglAwal = date_format(date_create($txt_periode), "Y/m/d");
		$tglAkhir = date_format(date_create($txt_periode1), "Y/m/d");

		$this->M_lapSpp_disetujui->data_spp($cmb_devisi, $lap_cmb_bagian, $tglAwal, $tglAkhir);

		$list = $this->M_lapSpp_disetujui->get_datatables();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $hasil) {
			$no++;
			$noref = "'" . $hasil->noreftxt . "'";
			$noref = str_replace("/", ".", $noref);
			$tgl = date_create($hasil->tglppo);

			$row   = array();

			$row[] =  $no . ".";
			$row[] = date_format($tgl, 'd/m/Y');
			$row[] = $hasil->namadept;
			$row[] = $hasil->noreftxt;
			$row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printClick(' . $noref . ')"></button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_lapSpp_disetujui->count_all(),
			"recordsFiltered" => $this->M_lapSpp_disetujui->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function tampilkan_spp_sppi()
	{
		$cmb_devisi = $this->input->post('cmb_devisi');
		// $cmb_devisi = '06';
		$lap_cmb_bagian = $this->input->post('lap_cmb_bagian');

		$txt_periode = str_replace('/', '-', $this->input->post('tglAwalSPP'));
		$txt_periode1 = str_replace('/', '-', $this->input->post('tglAkhirSPP'));

		$tglAwal = date_format(date_create($txt_periode), "Y/m/d");
		$tglAkhir = date_format(date_create($txt_periode1), "Y/m/d");

		$this->M_lapSpp_sppi->data_spp($cmb_devisi, $lap_cmb_bagian, $tglAwal, $tglAkhir);

		$list = $this->M_lapSpp_sppi->get_datatables();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $hasil) {
			$no++;
			$noref = "'" . $hasil->noreftxt . "'";
			$noref = str_replace("/", ".", $noref);
			$tgl = date_create($hasil->tglppo);

			$row   = array();

			$row[] =  $no . ".";
			$row[] = date_format($tgl, 'd/m/Y');
			$row[] = $hasil->namadept;
			$row[] = $hasil->noreftxt;
			$row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printClick(' . $noref . ')"></button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_lapSpp_sppi->count_all(),
			"recordsFiltered" => $this->M_lapSpp_sppi->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	public function tampilkan_spp_sppa()
	{
		$cmb_devisi = $this->input->post('cmb_devisi');
		// $cmb_devisi = '06';
		$lap_cmb_bagian = $this->input->post('lap_cmb_bagian');

		$txt_periode = str_replace('/', '-', $this->input->post('tglAwalSPP'));
		$txt_periode1 = str_replace('/', '-', $this->input->post('tglAkhirSPP'));

		$tglAwal = date_format(date_create($txt_periode), "Y/m/d");
		$tglAkhir = date_format(date_create($txt_periode1), "Y/m/d");

		$this->M_lapSpp_sppa->data_spp($cmb_devisi, $lap_cmb_bagian, $tglAwal, $tglAkhir);

		$list = $this->M_lapSpp_sppa->get_datatables();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $hasil) {
			$no++;
			$noref = "'" . $hasil->noreftxt . "'";
			$noref = str_replace("/", ".", $noref);
			$tgl = date_create($hasil->tglppo);

			$row   = array();

			$row[] =  $no . ".";
			$row[] = date_format($tgl, 'd/m/Y');
			$row[] = $hasil->namadept;
			$row[] = $hasil->noreftxt;
			$row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printClick(' . $noref . ')"></button>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_lapSpp_sppa->count_all(),
			"recordsFiltered" => $this->M_lapSpp_sppa->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}


	public function index()
	{
		echo "Hello mau kemana ";
	}

	function cari_devisi()
	{
		$lokasi = $this->session->userdata('status_lokasi');
		if ($lokasi == 'SITE') {
			$query = "SELECT PT, kodetxt FROM tb_devisi WHERE kodetxt IN ('06', '07') ORDER BY kodetxt ASC";
		} else if ($lokasi == 'HO') {
			$query = "SELECT PT, kodetxt FROM tb_devisi ORDER BY kodetxt ASC";
		} else {
			$query = "SELECT PT, kodetxt FROM tb_devisi WHERE PT LIKE '%$lokasi%' ORDER BY kodetxt ASC";
		}

		$data = $this->db_logistik_pt->query($query)->result();
		echo json_encode($data);
	}


	public function print_lap_po_register()
	{
		// ini_set('max_execution_time', '300');
		ini_set("pcre.backtrack_limit", "50000000");
		$lokasi = $this->uri->segment(3);
		$tanggal1 = "'" . $this->uri->segment(6) . "-" . $this->uri->segment(5) . "-" . $this->uri->segment(4) . "'";
		$tanggal2 = "'" . $this->uri->segment(9) . "/" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "'";
		$tahun = $this->uri->segment(9);
		switch ($this->uri->segment(8)) {
			case '01':
				$bulan = "Januari";
				break;
			case '02':
				$bulan = "Februari";
				break;
			case '03':
				$bulan = "Maret";
				break;
			case '04':
				$bulan = "April";
				break;
			case '05':
				$bulan = "Mei";
				break;
			case '06':
				$bulan = "Juni";
				break;
			case '07':
				$bulan = "Juli";
				break;
			case '08':
				$bulan = "Agustus";
				break;
			case '09':
				$bulan = "September";
				break;
			case '10':
				$bulan = "Oktober";
				break;
			case '11':
				$bulan = "November";
				break;
			case '12':
				$bulan = "Desember";
				break;
			default:
				$bulan = "";
				break;
		}
		switch ($lokasi) {
			case '01':
				$lokasi = "AND lokasi = 'HO'";
				$lokasi1 = "HO";
				break;
			case '02':
				$lokasi = "AND lokasi = 'RO'";
				$lokasi1 = "RO";
				break;
			case '03':
				$lokasi = "AND lokasi = 'PKS'";
				$lokasi1 = "PKS";
				break;
			case '07':
			case '06':
				$lokasi = "AND lokasi = 'SITE'";
				$lokasi1 = "SITE";
				break;
			default:
				$lokasi = "";
				$lokasi1 = "";
				break;
		}
		// $data['lokasi']= $this->uri->segment(3);
		$query = "SELECT * FROM po WHERE batal = '0' $lokasi AND tglpo BETWEEN $tanggal1 AND $tanggal2";
		$data['po'] = $this->db_logistik_pt->query($query)->result();
		$data['periode'] = $bulan . " " . $tahun;

		$data['lokasi1'] = $lokasi1;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => 'A4',
			'margin_top' => '15',
			'orientation' => 'P'
		]);
		// $mpdf->SetHTMLHeader('<h3>' . $this->session->userdata('pt') . '</h3><h6>JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>');
		$html = $this->load->view('lapPo/vw_lap_po_print_register', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		// var_dump($query);
	}

	function listPOCetakan()
	{
		$data = $this->M_laporan->get_list_po_cetakan();
		echo json_encode($data);
	}

	public function lapBarang()
	{
		$data = [
			'title' => 'Data Laporan Barang'
		];

		$this->template->load('template', 'barang/v_lap_barang', $data);
	}

	public function barang()
	{
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'setAutoTopMargin' => 'stretch',
			'orientation' => 'P'
		]);

		$query_grp = "SELECT DISTINCT grp FROM  kodebar ORDER BY grp ASC LIMIT 100";
		$data['data_grp'] = $this->db_logistik->query($query_grp)->result();

		$query = "SELECT id, kodebartxt, nabar, nopart, satuan FROM kodebar ORDER BY nabar ASC LIMIT 100";
		$data['data_barang'] = $this->db_logistik->query($query)->result();

		// var_dump(json_decode($this->list_barang()));exit();
		// $data['data_barang'] = json_decode($this->list_barang());


		$mpdf->SetHTMLHeader('<h4 align="center">MASTER KODE BARANG</h4>');
		$mpdf->SetHTMLFooter('<h5 align="left">{DATE j-m-Y H:i:s} - ' . $this->input->ip_address() . ' - ' . $this->platform->agent() . '</h5> <h5 align="right">Halaman {PAGENO} dari {nb}</h5>');

		$html = $this->load->view('barang/vw_lap_barang_print', $data, true);
		// $html = $this->load->view('V_lap_barang/vw_lap_barang_print',null,TRUE);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function cari_bagian()
	{
		$query = "SELECT kode, nama FROM dept ORDER BY kode ASC";
		$data = $this->db_logistik_pt->query($query)->result();
		echo json_encode($data);
	}



	function print_lap_po_cetakan()
	{
		$noreftxt = str_replace('.', '/', $this->uri->segment(3));
		$no_refppo = str_replace('.', '/', $this->uri->segment(4));
		$kode_supply = $this->uri->segment(5);
		$lokasi = $this->session->userdata('status_lokasi');
		$query = "SELECT * FROM po WHERE noreftxt = '" . $noreftxt . "' AND no_refppo = '" . $no_refppo . "'";
		$query2 = "SELECT * FROM pt WHERE PT LIKE '%$lokasi%'";
		$query3 = "SELECT * FROM supplier WHERE kode = '" . $kode_supply . "'";
		$query4 = "SELECT * FROM item_po WHERE noref = '" . $noreftxt . "' AND refppo = '" . $no_refppo . "'";
		$data['po'] = $this->db_logistik_pt->query($query)->row();
		$data['pt'] = $this->db_logistik_pt->query($query2)->row();
		$data['supply'] = $this->db_logistik->query($query3)->row();
		$data['item_po'] = $this->db_logistik_pt->query($query4)->result();
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);
		$html = $this->load->view('lapPo/vw_lap_po_print_cetakan', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_po_lokal_r()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = "'" . $this->uri->segment(6) . "-" . $this->uri->segment(5) . "-" . $this->uri->segment(4) . "'";
		$tanggal2 = "'" . $this->uri->segment(9) . "/" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "'";
		$tahun = $this->uri->segment(9);
		switch ($this->uri->segment(8)) {
			case '01':
				$bulan = "Januari";
				break;
			case '02':
				$bulan = "Februari";
				break;
			case '03':
				$bulan = "Maret";
				break;
			case '04':
				$bulan = "April";
				break;
			case '05':
				$bulan = "Mei";
				break;
			case '06':
				$bulan = "Juni";
				break;
			case '07':
				$bulan = "Juli";
				break;
			case '08':
				$bulan = "Agustus";
				break;
			case '09':
				$bulan = "September";
				break;
			case '10':
				$bulan = "Oktober";
				break;
			case '11':
				$bulan = "November";
				break;
			case '12':
				$bulan = "Desember";
				break;
			default:
				$bulan = "";
				break;
		}
		switch ($lokasi) {
			case '01':
				$lokasi = "AND lokasi = 'HO'";
				$lokasi1 = "HO";
				break;
			case '02':
				$lokasi = "AND lokasi = 'RO'";
				$lokasi1 = "RO";
				break;
			case '03':
				$lokasi = "AND lokasi = 'PKS'";
				$lokasi1 = "PKS";
				break;
			case '07':
			case '06':
				$lokasi = "AND lokasi = 'SITE'";
				$lokasi1 = "ESTATE";
				break;
			default:
				$lokasi = "";
				$lokasi1 = "";
				break;
		}
		$query = "SELECT * FROM po WHERE batal = '0' $lokasi AND tglpo BETWEEN $tanggal1 AND $tanggal2 AND no_refppo LIKE '%SPPI%'";
		$data['po'] = $this->db_logistik_pt->query($query)->result();
		$data['periode'] = $bulan . " " . $tahun;
		$data['lokasi1'] = $lokasi1;
		$data['lokasi'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);
		$html = $this->load->view('lapPo/vw_lap_po_print_lr', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_po_cash()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = "'" . $this->uri->segment(6) . "-" . $this->uri->segment(5) . "-" . $this->uri->segment(4) . "'";
		$tanggal2 = "'" . $this->uri->segment(9) . "/" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "'";
		$tahun = $this->uri->segment(9);
		switch ($this->uri->segment(8)) {
			case '01':
				$bulan = "Januari";
				break;
			case '02':
				$bulan = "Februari";
				break;
			case '03':
				$bulan = "Maret";
				break;
			case '04':
				$bulan = "April";
				break;
			case '05':
				$bulan = "Mei";
				break;
			case '06':
				$bulan = "Juni";
				break;
			case '07':
				$bulan = "Juli";
				break;
			case '08':
				$bulan = "Agustus";
				break;
			case '09':
				$bulan = "September";
				break;
			case '10':
				$bulan = "Oktober";
				break;
			case '11':
				$bulan = "November";
				break;
			case '12':
				$bulan = "Desember";
				break;
			default:
				$bulan = "";
				break;
		}
		switch ($lokasi) {
			case '01':
				$lokasi = "AND lokasi = 'HO'";
				$lokasi1 = "HO";
				break;
			case '02':
				$lokasi = "AND lokasi = 'RO'";
				$lokasi1 = "RO";
				break;
			case '03':
				$lokasi = "AND lokasi = 'PKS'";
				$lokasi1 = "PKS";
				break;
			case '07':
			case '06':
				$lokasi = "AND lokasi = 'SITE'";
				$lokasi1 = "SITE";
				break;
			default:
				$lokasi = "";
				$lokasi1 = "";
				break;
		}
		$query = "SELECT * FROM po WHERE batal = '0' $lokasi AND tglpo BETWEEN $tanggal1 AND $tanggal2 AND bayar = 'CASH'";
		$data['po'] = $this->db_logistik_pt->query($query)->result();
		$data['periode'] = $bulan . " " . $tahun;
		$data['lokasi1'] = $lokasi1;
		$data['lokasi'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);
		$html = $this->load->view('lapPo/vw_lap_po_print_cs', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_po_lokal_t()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = "'" . $this->uri->segment(6) . "-" . $this->uri->segment(5) . "-" . $this->uri->segment(4) . "'";
		$tanggal2 = "'" . $this->uri->segment(9) . "/" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "'";
		$tahun = $this->uri->segment(9);
		switch ($this->uri->segment(8)) {
			case '01':
				$bulan = "Januari";
				break;
			case '02':
				$bulan = "Februari";
				break;
			case '03':
				$bulan = "Maret";
				break;
			case '04':
				$bulan = "April";
				break;
			case '05':
				$bulan = "Mei";
				break;
			case '06':
				$bulan = "Juni";
				break;
			case '07':
				$bulan = "Juli";
				break;
			case '08':
				$bulan = "Agustus";
				break;
			case '09':
				$bulan = "September";
				break;
			case '10':
				$bulan = "Oktober";
				break;
			case '11':
				$bulan = "November";
				break;
			case '12':
				$bulan = "Desember";
				break;
			default:
				$bulan = "";
				break;
		}
		switch ($lokasi) {
			case '01':
				$lokasi = "AND lokasi = 'HO'";
				$lokasi1 = "HO";
				break;
			case '02':
				$lokasi = "AND lokasi = 'RO'";
				$lokasi1 = "RO";
				break;
			case '03':
				$lokasi = "AND lokasi = 'PKS'";
				$lokasi1 = "PKS";
				break;
			case '07':
			case '06':
				$lokasi = "AND lokasi = 'SITE'";
				$lokasi1 = "ESTATE";
				break;
			default:
				$lokasi = "";
				$lokasi1 = "";
				break;
		}
		$query = "SELECT * FROM item_po WHERE batal = '0' $lokasi AND tglpo BETWEEN $tanggal1 AND $tanggal2 AND refppo LIKE '%SPPI%'";
		$data['item_po'] = $this->db_logistik_pt->query($query)->result();
		$data['periode'] = $bulan . " " . $tahun;
		$data['lokasi1'] = $lokasi1;
		$data['lokasi'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapPo/vw_lap_po_print_lt', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_pp_register()
	{
		$lokasi = $this->uri->segment(3);
		switch ($lokasi) {
			case '01':
				// $lokasi = "AND lokasi = 'HO'";
				$lokasi1 = "HO";
				break;
			case '02':
				// $lokasi = "AND lokasi = 'RO'";
				$lokasi1 = "RO";
				break;
			case '03':
				// $lokasi = "AND lokasi = 'PKS'";
				$lokasi1 = "PKS";
				break;
			case '06':
				$lokasi1 = "ESTATE1";
				break;
			case '07':
				// $lokasi = "AND lokasi = 'SITE'";
				$lokasi1 = "ESTATE2";
				break;
			default:
				// $lokasi = "";
				$lokasi1 = "";
				break;
		}


		$tanggal1 = "'" . $this->uri->segment(6) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(4) . "'";
		$tanggal2 = "'" . $this->uri->segment(9) . "/" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "'";
		$query = "SELECT * FROM pp WHERE batal = '0' AND kodept = '$lokasi' AND tglpp BETWEEN $tanggal1 AND $tanggal2 ";
		$data['pp'] = $this->db_logistik_pt->query($query)->result();
		$tanggal1 = str_replace("/", "-", ($tanggal1));
		$tanggal1 = str_replace("'", "", ($tanggal1));
		$tanggal1 = date_format(date_create($tanggal1), 'd/m/Y');
		$tanggal2 = str_replace("/", "-", ($tanggal2));
		$tanggal2 = str_replace("'", "", ($tanggal2));
		$tanggal2 = date_format(date_create($tanggal2), 'd/m/Y');
		$data['periode'] = str_replace("'", " ", ($tanggal1 . ' - ' . $tanggal2));
		$data['lokasi'] = $lokasi1;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapPP/vw_lap_pp_r', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_pp_cetakan()
	{
		$nopp = $this->uri->segment(3);
		$ref_po = str_replace(".", "/", $this->uri->segment(4));
		$kode_supply = $this->uri->segment(5);
		$query = "SELECT * FROM pp WHERE nopp='$nopp' AND ref_po = '$ref_po' AND kode_supply= '$kode_supply'";
		$data['pp'] = $this->db_logistik_pt->query($query)->row();
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapPP/vw_lap_pp_c', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function listPPCetakan()
	{
		$data = $this->M_laporan->get_list_pp_cetakan();
		echo json_encode($data);
	}

	function print_lap_lpb_register()
	{
		ini_set("pcre.backtrack_limit", "50000000");
		$lokasi = $this->uri->segment(3);
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);
		$query = "SELECT a.ttg, b.tglinput, a.nopo, a.nama_supply, b.nabar, b.satuan, b.qty, b.kodebar, b.ket FROM stokmasuk a INNER JOIN masukitem b USING (ttg) WHERE b.tgl BETWEEN '$tanggal1' AND '$tanggal2' AND kdpt = '$lokasi'";
		$data['item_lpb'] = $this->db_logistik_pt->query($query)->result();
		$tanggal1 = date_format(date_create($tanggal1), 'd/m/Y');
		$tanggal2 = date_format(date_create($tanggal2), 'd/m/Y');
		$data['periode'] = $tanggal1 . ' - ' . $tanggal2;
		$data['lokasi'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_register', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function listLapLPBSlip()
	{
		$data = $this->M_laporan->get_list_lap_lpb_slip();
		echo json_encode($data);
	}

	function print_lap_lpb_po_asset()
	{
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);
		$query = "SELECT a.*, b.nama_supply FROM masukitem a, stokmasuk b WHERE a.refpo = b.refpo AND a.noref = b.noref AND a.tgl BETWEEN '$tanggal1' AND '$tanggal2' AND a.kdpt = '$lokasi' AND a.ASSET = '1'";
		$data['per_pol'] = $this->db_logistik_pt->query($query)->result();
		$data['tgl1'] = $tanggal1;
		$data['tgl2'] = $tanggal2;
		$data['lokasi'] = $lokasi;
		$data['lokasi1'] = $lok;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_po_asset', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_lpb_mutasi()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$query = "SELECT a.*, b.nama_supply FROM masukitem a, stokmasuk b WHERE a.refpo = b.refpo AND a.noref = b.noref AND a.tgl BETWEEN '$tanggal1' AND '$tanggal2' AND a.kdpt = '$lokasi' AND b.mutasi = '1'";
		$data['mutasi'] = $this->db_logistik_pt->query($query)->result();
		$data['tgl1'] = $tanggal1;
		$data['tgl2'] = $tanggal2;
		$data['lokasi'] = $lokasi;
		$data['lokasi1'] = $lok;
		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_mutasi', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function cekcetak()
	{
		ini_set("pcre.backtrack_limit", "50000000");
		$noref = str_replace('.', '/', $this->input->post('noref'));
		$refpo = str_replace('.', '/', $this->input->post('refpo'));
		$query = "SELECT cetak FROM stokmasuk WHERE noref = '$noref' AND refpo = '$refpo'";
		$lpb = $this->db_logistik_pt->query($query)->row();
		// var_dump($lpb->cetak,'tes');
		if ($lpb->cetak == '0') {
			$query_cetak = "UPDATE stokmasuk SET cetak = '1' WHERE noref = '$noref' AND refpo = '$refpo'";
			$lpb_cetak = $this->db_logistik_pt->query($query_cetak);
			if ($lpb_cetak) {
				$data = [
					'status' => 'true',
					'cetak' => '1'
				];
				echo json_encode($data);
			}
		} else if ($lpb->cetak == '1') {
			$query_cetak = "UPDATE stokmasuk SET cetak = '2' WHERE noref = '$noref' AND refpo = '$refpo'";
			$lpb_cetak = $this->db_logistik_pt->query($query_cetak);
			if ($lpb_cetak) {
				$data = [
					'status' => 'true',
					'cetak' => '2'
				];
				echo json_encode($data);
			}
		} else {
			$data = [
				'status' => 'false',
				'cetak' => '2'
			];
			echo json_encode($data);
		}
	}


	function print_lap_lpb_per_brg_lpb()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);
		$query = "SELECT DISTINCT kodebar, nabar, satuan FROM masukitem WHERE tgl BETWEEN '" . $tanggal1 . "' AND '" . $tanggal2 . "' AND kdpt = '" . $lokasi . "' AND batal = '0'";
		$data['brg'] = $this->db_logistik_pt->query($query)->result();
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$data['periode'] = (str_replace('-', '/', $tanggal1)) . '-' . (str_replace('-', '/', $tanggal2));
		$data['tanggal1'] = $tanggal1;
		$data['tanggal2'] = $tanggal2;
		$data['lokasi'] = $lok;
		$data['lokasi1'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_per_brg_lpb', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_lpb_per_tgl_lpb()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);
		$query = "SELECT DISTINCT tgl FROM masukitem WHERE tgl BETWEEN '" . $tanggal1 . "' AND '" . $tanggal2 . "' AND kdpt = '" . $lokasi . "' AND batal = '0'";
		$data['tgl'] = $this->db_logistik_pt->query($query)->result();
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$data['periode'] = (str_replace('-', '/', $tanggal1)) . '-' . (str_replace('-', '/', $tanggal2));
		$data['tanggal1'] = $tanggal1;
		$data['tanggal2'] = $tanggal2;
		$data['lokasi'] = $lok;
		$data['lokasi1'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_per_tgl_lpb', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function listLapLPBPO()
	{
		$data = $this->M_laporan->get_list_lap_lpb_po();
		echo json_encode($data);
	}


	function print_lap_lpb_slip_lpb()
	{
		$noref = str_replace('.', '/', $this->uri->segment(3));
		$refpo = str_replace('.', '/', $this->uri->segment(4));
		// $dept = str_replace('.', ' ', $this->uri->segment(5));
		// $dept = str_replace('-', '&', $this->uri->segment(5));
		$query = "SELECT a.*, b.* FROM stokmasuk a, po b WHERE a.refpo = b.noreftxt AND a.noref = '$noref' AND a.refpo = '$refpo'";
		$data['lpb'] = $this->db_logistik_pt->query($query)->row();
		$query1 = "SELECT * FROM masukitem WHERE noref = '$noref' AND refpo = '$refpo'";
		$data['lpb_item'] = $this->db_logistik_pt->query($query1)->result();
		// $data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_slip_lpb', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_lpb_regis_retur()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$query = "SELECT a.tgl,a.norefretur, b.no_ba, b.devisi, a.kodebar, a.nabar, a.satuan, a.qty FROM ret_skbitem a LEFT JOIN retskb b ON a.norefretur=b.norefretur WHERE a.tgl BETWEEN '$tanggal1' AND '$tanggal2' AND  b.kode_dev='$lokasi'";
		$data['r_retur'] = $this->db_logistik_pt->query($query)->result();
		$data['tgl1'] = $tanggal1;
		$data['tgl2'] = $tanggal2;
		$data['lokasi'] = $lokasi;
		$data['lokasi1'] = $lok;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_regis_retur', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function listLapLPBSlipR()
	{

		$cmb_devisi = $this->input->post('cmb_devisi3');
		// $cmb_devisi = '06';

		$txt_periode = str_replace('/', '-', $this->input->post('txt_periode12'));
		$txt_periode1 = str_replace('/', '-', $this->input->post('txt_periode13'));

		$tglAwal = date_format(date_create($txt_periode), "Y/m/d");
		$tglAkhir = date_format(date_create($txt_periode1), "Y/m/d");
		$this->Retur_m->getdata($cmb_devisi, $tglAwal, $tglAkhir);

		$list = $this->Retur_m->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$ref = $field->norefretur;
			$noref = str_replace('/', '.', $ref);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = date("Y-m-d", strtotime($field->tgl));
			$row[] = $field->norefretur;
			$row[] = $field->bag;
			$row[] = $field->keterangan;
			$row[] = '<a href="' . site_url('Laporan/cetakRETUR/' . $noref . '/' . $field->id) . '" target="_blank" class="btn btn-danger btn-xs fa fa-print" id="a_print_lpb"></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Retur_m->count_all(),
			"recordsFiltered" => $this->Retur_m->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}


	function cetakRETUR()
	{
		$ref = $this->uri->segment('3');
		$noretur = str_replace('.', '/', $ref);
		$id = $this->uri->segment('4');

		// $data['no_lpb'] = $no_lpb;
		// $data['id'] = $id;
		$data['retskb'] = $this->db_logistik_pt->get_where('retskb', array('id' => $id, 'norefretur' => $noretur))->row();
		$data['ret_skbitem'] = $this->db_logistik_pt->get_where('ret_skbitem', array('norefretur' => $noretur, 'norefretur' => $data['retskb']->norefretur))->result();

		$data['urut'] = $this->Retur_m->urut_cetak($data['retskb']->norefretur);

		$norefretur = $data['retskb']->norefretur;
		$this->qrcode($noretur, $id, $norefretur);

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'setAutoTopMargin' => 'stretch',
			'orientation' => 'P'
		]);



		// $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
		$mpdf->SetHTMLHeader('
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td rowspan="5" align="center" style="font-size:14px;font-weight:bold;">' . $data['retskb']->devisi . '</td>
                                </tr>
                                <!--tr>
                                    <td align="center" rowspan="5">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
                                    </td>
                                </tr-->
                            </table>
                            <hr style="width:100%;margin-top:7px;">
                            ');
		// $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

		$html = $this->load->view('lapLPB/v_cetakPrint', $data, true);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_lpb_per_po_lpb()
	{
		$noref = str_replace('.', '/', $this->uri->segment(3));
		$refpo = str_replace('.', '/', $this->uri->segment(4));
		$data['tgl1'] = $this->uri->segment(5);
		$data['tgl2'] = $this->uri->segment(6);
		// $data['lokasi1'] = "Tes";
		$query = "SELECT * FROM stokmasuk WHERE noref = '$noref' AND refpo = '$refpo'";
		$data['st_msk'] = $this->db_logistik_pt->query($query)->row();
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_per_po_lpb', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_lpb_slip_retur()
	{
		$lokasi = $this->uri->segment(3);
		$noref = $this->uri->segment(4);
		$noref = str_replace("-", " ", $noref);
		$noref = str_replace(":", "/", $noref);
		$refpo = $this->uri->segment(5);
		$refpo = str_replace(".", "/", $refpo);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		// $query = "SELECT a.*, b.nama_supply FROM masukitem a, stokmasuk b WHERE a.refpo = b.refpo AND a.noref = b.noref AND a.tgl BETWEEN '$tanggal1' AND '$tanggal2' AND a.kdpt = '$lokasi' AND a.refpo LIKE '%MUTASI%'";
		$query = "SELECT * FROM stokmasuk WHERE kode = '$lokasi' AND refpo ='$refpo' AND noref ='$noref'";
		$data['retur'] = $this->db_logistik_pt->query($query)->row();
		$data['lokasi'] = $lokasi;
		$data['lokasi1'] = $lok;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'P'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_retur', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_lpb_po_lokal_lpb()
	{
		$lokasi = $this->uri->segment(3);
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);
		$query = "SELECT a.*, b.nama_supply FROM masukitem a, stokmasuk b WHERE a.refpo = b.refpo AND a.noref = b.noref AND a.tgl BETWEEN '$tanggal1' AND '$tanggal2' AND a.kdpt = '$lokasi' AND a.refpo LIKE '%PO-Lokal%'";
		$data['per_po'] = $this->db_logistik_pt->query($query)->result();
		$data['tgl1'] = $tanggal1;
		$data['tgl2'] = $tanggal2;
		$data['lokasi'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapLPB/vw_lap_lpb_print_po_lokal_lpb', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_spp_po_semua()
	{

		$tanggal1 = "'" . $this->uri->segment(5) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(3) . "'";
		$tanggal2 = "'" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "/" . $this->uri->segment(6) . "'";

		// $tanggal1 = str_replace("/", "-", ($tanggal1));
		// $tanggal1 = str_replace("'", "", ($tanggal1));
		// $tanggal1 = date_format(date_create($tanggal1), 'd/m/Y');
		// $tanggal2 = str_replace("/", "-", ($tanggal2));
		// $tanggal2 = str_replace("'", "", ($tanggal2));
		// $tanggal2 = date_format(date_create($tanggal2), 'd/m/Y');
		$lokuser = $this->session->userdata('status_lokasi');
		$query = "SELECT * FROM item_ppo WHERE tglppo BETWEEN $tanggal1 AND $tanggal2 AND LOKASI='$lokuser' ";
		$data['ppo'] = $this->db_logistik_pt->query($query)->result();

		$data['periode'] = str_replace("'", " ", ($tanggal1 . ' - ' . $tanggal2));
		$data['lokasi'] = $lokuser;
		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_spp_po_print_semua', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_spp_po_sdhpo()
	{

		$tanggal1 = "'" . $this->uri->segment(5) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(3) . "'";
		$tanggal2 = "'" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "/" . $this->uri->segment(6) . "'";

		// $tanggal1 = str_replace("/", "-", ($tanggal1));
		// $tanggal1 = str_replace("'", "", ($tanggal1));
		// $tanggal1 = date_format(date_create($tanggal1), 'd/m/Y');
		// $tanggal2 = str_replace("/", "-", ($tanggal2));
		// $tanggal2 = str_replace("'", "", ($tanggal2));
		// $tanggal2 = date_format(date_create($tanggal2), 'd/m/Y');
		$lokuser = $this->session->userdata('status_lokasi');

		$jmlSpp = $this->db_logistik_pt->query("SELECT COUNT(id) AS jmlh FROM ppo WHERE status2='1' AND lokasi='$lokuser' AND tglppo BETWEEN $tanggal1 AND $tanggal2")->row();
		$jmlItem = $this->db_logistik_pt->query("SELECT COUNT(id) AS jmlh FROM item_po WHERE lokasi='$lokuser' AND tglppo BETWEEN $tanggal1 AND $tanggal2")->row();
		$jmlQTYSpp = $this->db_logistik_pt->query("SELECT SUM(qty) AS qty FROM item_po WHERE lokasi='$lokuser' AND tglppo BETWEEN $tanggal1 AND $tanggal2")->row();
		$jmlQTYPO = $this->db_logistik_pt->query("SELECT SUM(qty) AS qty FROM item_po WHERE lokasi='$lokuser' AND tglppo BETWEEN $tanggal1 AND $tanggal2")->row();
		$query = "SELECT * FROM ppo WHERE po='1' AND LOKASI='$lokuser' AND tglppo BETWEEN $tanggal1 AND $tanggal2";
		$data['ppo'] = $this->db_logistik_pt->query($query)->result();

		$data['periode'] = str_replace("'", " ", ($tanggal1 . ' - ' . $tanggal2));
		$data['jumlahspp'] = $jmlSpp;
		$data['jumlahItem'] = $jmlItem;
		$data['jmlQTYSpp'] = $jmlQTYSpp;
		$data['jmlQTYPO'] = $jmlQTYPO;
		$data['lokasi'] = $lokuser;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_spp_po_print_sdhpo', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_spp_po_blmpo()
	{
		$tanggal1 = "'" . $this->uri->segment(5) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(3) . "'";
		$tanggal2 = "'" . $this->uri->segment(8) . "/" . $this->uri->segment(7) . "/" . $this->uri->segment(6) . "'";

		// $tanggal1 = str_replace("/", "-", ($tanggal1));
		// $tanggal1 = str_replace("'", "", ($tanggal1));
		// $tanggal1 = date_format(date_create($tanggal1), 'd/m/Y');
		// $tanggal2 = str_replace("/", "-", ($tanggal2));
		// $tanggal2 = str_replace("'", "", ($tanggal2));
		// $tanggal2 = date_format(date_create($tanggal2), 'd/m/Y');
		$lokuser = $this->session->userdata('status_lokasi');
		$query = "SELECT * FROM ppo WHERE po=0 AND tglppo BETWEEN $tanggal1 AND $tanggal2 AND LOKASI='$lokuser' ";
		$data['ppo'] = $this->db_logistik_pt->query($query)->result();

		$jmlQTYSpp = $this->db_logistik_pt->query("SELECT SUM(qty) AS qty FROM item_ppo WHERE po=0 AND tglppo BETWEEN $tanggal1 AND $tanggal2 AND LOKASI='$lokuser'")->row();
		$jumlah = $this->db_logistik_pt->query("SELECT COUNT(id) AS jmlh FROM ppo WHERE po=0 AND tglppo BETWEEN $tanggal1 AND $tanggal2 AND LOKASI='$lokuser'")->row();
		$jmlbrg = $this->db_logistik_pt->query("SELECT COUNT(id) AS jmlh FROM item_ppo WHERE po=0 AND tglppo BETWEEN $tanggal1 AND $tanggal2 AND LOKASI='$lokuser'")->row();

		$data['jmlQTYSpp'] = $jmlQTYSpp;
		$data['jumlah'] = $jumlah;
		$data['jmlbrg'] = $jmlbrg;
		$data['periode'] = str_replace("'", " ", ($tanggal1 . ' - ' . $tanggal2));
		$data['lokasi'] = $lokuser;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_spp_po_print_blmpo', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}



	function print_lap_bkb_register_bkb()
	{
		ini_set("pcre.backtrack_limit", "5000000");
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}

		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);

		$bagian = $this->uri->segment(10);
		if ($bagian == "HRD.-.UMUM") $bagian = "UMUM.-.HRD";
		$bagian = str_replace('-', '&', $bagian);
		$bagian = str_replace('.', ' ', $bagian);
		if ($bagian == 'Semua') {
			$query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.periode BETWEEN '$tanggal1' AND '$tanggal2' AND a.batal = '0' AND a.kode_dev='$lokasi' ORDER BY a.periode ASC";
		} else {
			$query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.periode BETWEEN '$tanggal1' AND '$tanggal2' AND a.batal = '0' AND a.kode_dev='$lokasi' AND b.bag = '$bagian' ORDER BY a.periode ASC";
		}

		$data['bkb'] = $this->db_logistik_pt->query($query)->result();
		$data['tgl1'] = $tanggal1;
		$data['tgl2'] = $tanggal2;
		$data['lokasi'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_register', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function listLapSlipBKB()
	{
		$data = $this->M_laporan->get_list_lap_slip_bkb();
		echo json_encode($data);
	}

	function print_lap_bkb_slip_bkb()
	{
		ini_set("pcre.backtrack_limit", "5000000");
		// $NO_REF = $this->uri->segment(3);
		// $NO_REF = str_replace('.', '/', $this->uri->segment(3));
		$skb = str_replace('.', '/', $this->uri->segment(4));
		$tgl1 = str_replace('-', '/', $this->uri->segment(6));
		$tgl2 = str_replace('-', '/', $this->uri->segment(7));
		$bag = $this->uri->segment(5);
		$id = $this->uri->segment(8);
		$bag = str_replace('-', '&', $bag);
		$bag = str_replace('.', ' ', $bag);
		// $query = "SELECT * FROM stockkeluar WHERE NO_REF = '$NO_REF' AND skb='$skb' ";
		// $data['slip_bkb'] = $this->db_logistik_pt->query($query)->row();
		$data['stockkeluar'] = $this->db_logistik_pt->get_where('stockkeluar', array('id' => $id, 'SKBTXT' => $skb))->row();
		$data['keluarbrgitem'] = $this->db_logistik_pt->get_where('keluarbrgitem', array('SKBTXT' => $skb, 'NO_REF' => $data['stockkeluar']->NO_REF))->result();

		$data['bag'] =  $this->uri->segment(5);
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;

		$data['no_bkb'] = $skb;
		$data['id'] = $id;

		$data['urut'] = $this->M_laporan->urut_cetak($data['stockkeluar']->NO_REF);

		$noref = $data['stockkeluar']->NO_REF;
		$this->qrcode($skb, $id, $noref);

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'setAutoTopMargin' => 'stretch',
			'orientation' => 'P'
		]);

		$lokasibuatbkb = substr($noref, 0, 3);
		switch ($lokasibuatbkb) {
			case 'PST': // HO
				$lokasibkb = "HO";
				break;
			case 'ROM': // RO
				$lokasibkb = "RO";
				break;
			case 'FAC': // PKS
				$lokasibkb = "PKS";
				break;
			case 'EST': // SITE
				$lokasibkb = "SITE";
				break;
			default:
				break;
		}

		// $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
		$mpdf->SetHTMLHeader('
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td rowspan="2" width="15%" height="10px"><!--img width="10%" height="60px" style="padding-left:8px" src="././assets/img/msal.jpg"--></td>
                                    <td align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari (' . $lokasibkb . ')</td>
                                </tr>
                                <!--tr>
                                    <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
                                    </td>
                                </tr-->
                            </table>
                            <hr style="width:100%;margin:0px;">
                            ');
		// $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

		$html = $this->load->view('lapBKb/v_print', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function qrcode($no_bkb, $id, $noref)
	{
		$this->load->library('ciqrcode');
		// header("Content-Type: image/png");

		$config['cacheable']    = false; //boolean, the default is true
		$config['cachedir']     = './assets/'; //string, the default is application/cache/
		$config['errorlog']     = './assets/'; //string, the default is application/logs/
		$config['imagedir']     = './assets/qrcode/bkb/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
		$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name = $id . '_' . $no_bkb . '.png'; //buat name dari qr code

		// $params['data'] = site_url('bkb/cetak/'.$no_bkb.'/'.$id); //data yang akan di jadikan QR CODE
		$params['data'] = $noref; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
	}


	function print_lap_bkb_per_brg()
	{
		ini_set("pcre.backtrack_limit", "5000000");
		$lokasi = $this->uri->segment(3);
		$tanggal1 = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);

		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$bagian = $this->uri->segment(10);
		if ($bagian == "HRD.-.UMUM") $bagian = "UMUM.-.HRD";
		$bagian = str_replace('-', '&', $bagian);
		$bagian = str_replace('.', ' ', $bagian);

		if ($bagian == 'Semua') {
			$query = "SELECT DISTINCT a.kodebar, a.nabar, a.satuan, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND  a.periode BETWEEN '$tanggal1' AND '$tanggal2' AND a.batal = '0' AND a.kode_dev = '$lokasi'";
		} else {
			$query = "SELECT DISTINCT a.kodebar, a.nabar, a.satuan, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND  a.periode BETWEEN '$tanggal1' AND '$tanggal2' AND a.batal = '0' AND a.kode_dev = '$lokasi' AND b.bag ='" . $bagian . "'";
		}

		$data['bkb_brg'] = $this->db_logistik_pt->query($query)->result();
		$data['tgl1'] = $tanggal1;
		$data['tgl2'] = $tanggal2;
		$data['lokasi'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBKb/vw_lap_bkb_print_per_brg', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_per_tgl()
	{
		ini_set("pcre.backtrack_limit", "50000000");
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tgl1 = str_replace('.', '-', $this->uri->segment(4));
		$tgl2 = str_replace('.', '-', $this->uri->segment(5));

		$tgl14 = date_format(date_create($tgl1), 'Y-m-d');
		$tgl15 = date_format(date_create($tgl2), 'Y-m-d');
		$bag = $this->uri->segment(6);

		if ($bag == 'Semua') {
		} else {
			// $q_bag = "AND b.bag = '$bag'";
			// $query = "SELECT DISTINCT tgl FROM keluarbrgitem WHERE tgl BETWEEN '$tgl14' AND '$tgl15' AND kode_dev ='$lokasi' AND batal = '0' AND b.bag = '$bag'";
		}


		$query = "SELECT DISTINCT tgl FROM keluarbrgitem WHERE tgl BETWEEN '$tgl14' AND '$tgl15' AND kode_dev ='$lokasi' AND batal = '0'";

		$data['p_tgl'] = $this->db_logistik_pt->query($query)->result();
		$data['lokasi'] = $lokasi;
		$data['tgl1'] = str_replace('.', '/', $this->uri->segment(4));
		$data['tgl2'] = str_replace('.', '/', $this->uri->segment(5));
		$data['bag'] = $bag;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBKb/vw_lap_bkb_print_per_tgl', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_bkb_per_bgn_rinci_tgl()
	{
		set_time_limit(0);
		ini_set('memory_limit', '20000M');
		ini_set("pcre.backtrack_limit", "50000000");
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);
		if ($bagian == 'Semua') {
			$q_bag = '';
		} else {
			$q_bag = "AND bag = '$bagian'";
		}
		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev='$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}
		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['lokasi'] = $lokasi;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $dev;
		$data['devisi'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);


		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBKb/vw_lap_bkb_print_per_bgn_rinci_tgl', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_per_bgn_grp_brg()
	{
		set_time_limit(0);
		ini_set('memory_limit', '200000M');
		ini_set('pcre.backtrack_limit', '50000000');
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);

		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev = '$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0' ";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}
		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();

		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['lokasi'] = $lokasi;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $dev;
		$data['devisi'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBKb/vw_lap_bkb_print_per_bgn_grp_brg', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_per_kerja()
	{
		$lokasi = $this->uri->segment(3);
		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);
		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			// $query = "SELECT DISTINCT(afd) FROM keluarbrgitem WHERE kode_dev='$lokasi' AND periode BETWEEN '$p1' AND '$p2' AND  AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev='$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['lokasi'] = $lokasi;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $dev;
		$data['devisi'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_per_kerja', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_mutasi()
	{
		ini_set("pcre.backtrack_limit", "50000000");
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$tgl1 = str_replace('.', '-', $tanggal1);
		$tgl2 = str_replace('.', '-', $tanggal2);
		$tgl1 = date_format(date_create($tgl1), 'Y-m-d');
		$tgl2 = date_format(date_create($tgl2), 'Y-m-d');
		// $bagian = $this->uri->segment(6);
		// if($bagian == 'HRD.-.UMUM')$bagian="UMUM.-.HRD";
		// $bagian = str_replace('.',' ',$bagian);
		// $bagian = str_replace('-','&',$bagian);
		// if($bagian == 'Semua'){
		// 	$q_dev = '';
		// }else{
		// 	$q_dev = "AND b.bag = '$bagian'";
		// }
		// $query = "SELECT * FROM keluarbrgitem  WHERE ketsub LIKE 'PT%' AND pt LIKE '%$lok%' AND periode BETWEEN '$tgl1' AND '$tgl2'";
		$query = "SELECT k.tgl, k.NO_REF, k.skb, k.kodebar, k.nabar, k.satuan, k.qty, s.pt_mutasi FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$tgl1' AND '$tgl2' AND s.mutasi='1'";

		$data['bmut'] = $this->db_logistik_pt->query($query)->result();
		$data['lokasi1'] = $lokasi;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_mutasi', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_per_bgn_grp_brg_n()
	{
		set_time_limit(0);
		ini_set('memory_limit', '200000M');
		ini_set('pcre.backtrack_limit', '50000000');
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);
		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			// $query = "SELECT DISTINCT(afd) FROM keluarbrgitem WHERE kode_dev='$lokasi' AND periode BETWEEN '$p1' AND '$p2' AND  AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev='$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}

		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['lokasi'] = $lokasi;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_per_bgn_grp_brg_n', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_bkb_per_kerja1()
	{
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);

		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			// $query = "SELECT DISTINCT(afd) FROM keluarbrgitem WHERE kode_dev='$lokasi' AND periode BETWEEN '$p1' AND '$p2' AND  AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev='$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}

		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['lokasi'] = $lokasi;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_per_kerja1', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_summary_rsh()
	{
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);

		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			// $query = "SELECT DISTINCT(afd) FROM keluarbrgitem WHERE kode_dev='$lokasi' AND periode BETWEEN '$p1' AND '$p2' AND  AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev='$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}

		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();
		$data['lokasi'] = $lokasi;
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_summary_rsh', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_sum_blok_ub()
	{
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);

		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			// $query = "SELECT DISTINCT(afd) FROM keluarbrgitem WHERE kode_dev='$lokasi' AND periode BETWEEN '$p1' AND '$p2' AND  AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev='$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}

		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();
		$data['lokasi'] = $lokasi;
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_sum_blok_ub', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_bkb_sum_blok_pk()
	{
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$lok = 'HO';
		} else if ($lokasi == '02') {
			$lok = 'RO';
		} else if ($lokasi == '03') {
			$lok = 'PKS';
		} else if ($lokasi == '06') {
			$lok = 'ESTATE1';
		} else if ($lokasi == '07') {
			$lok = 'ESTATE2';
		}
		$tanggal1 = $this->uri->segment(4);
		$tanggal2 = $this->uri->segment(5);
		$p1 = date_format(date_create(str_replace('.', '-', $tanggal1)), 'Y-m-d');
		$p2 = date_format(date_create(str_replace('.', '-', $tanggal2)), 'Y-m-d');
		$bagian = $this->uri->segment(6);
		if ($bagian == 'HRD.-.UMUM') $bagian = 'UMUM.-.HRD';
		$bagian = str_replace('.', ' ', $bagian);
		$bagian = str_replace('-', '&', $bagian);

		if ($bagian == "TANAMAN" || $bagian == "TANAMAN UMUM") {
			$query = "SELECT DISTINCT(k.afd) as afd FROM keluarbrgitem k LEFT JOIN stockkeluar s ON k.NO_REF=s.NO_REF WHERE k.kode_dev='$lokasi' AND k.periode BETWEEN '$p1' AND '$p2' AND s.bag='$bagian' AND k.batal = '0'";
			// $query = "SELECT DISTINCT(afd) FROM keluarbrgitem WHERE kode_dev='$lokasi' AND periode BETWEEN '$p1' AND '$p2' AND  AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		} else {
			$query = "SELECT DISTINCT(bag) FROM stockkeluar WHERE kode_dev='$lokasi' AND periode1 BETWEEN '$p1' AND '$p2' AND bag = '$bagian' AND batal = '0'";
			$data['bt'] = $this->db_logistik_pt->query($query)->result();
		}

		$isi = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$lokasi'")->row();
		$data['lokasi'] = $lokasi;
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$data['pt'] = $lok;
		$data['bagian'] = $bagian;
		$dev = $this->uri->segment(7);
		$dev = str_replace('._', '(', $dev);
		$dev = str_replace('_.', ')', $dev);
		$dev = str_replace('-', ' ', $dev);
		$data['dev'] = $isi->PT;
		$data['periode'] = str_replace('.', '/', $tanggal1) . ' - ' . str_replace('.', '/', $tanggal2);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapBkb/vw_lap_bkb_print_sum_blok_pk', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_rsh_rinci()
	{
		ini_set('pcre.backtrack_limit', '50000000');
		$lokasi = $this->uri->segment(3);
		if ($lokasi == '01') {
			$posisi = 'HO';
		} else if ($lokasi == '02') {
			$posisi = 'RO';
		} else if ($lokasi == '03') {
			$posisi = 'PKS';
		} else if ($lokasi == '06') {
			$posisi = 'ESTATE1';
		} else if ($lokasi == '07') {
			$posisi = 'ESTATE2';
		}
		$bag = $this->uri->segment(4);
		$bagian = str_replace('%20', ' ', $bag);
		if ($bagian == 'Semua') {
			$q_bag = "";
		} else {
			$q_bag = "AND a.grp = '$bagian'";
		}
		$kode_stok = $this->uri->segment(5);
		$txtperiode = $this->session->userdata('ym_periode');
		$periode = $this->session->userdata('Ymd_periode');
		$d_periode = date("j", strtotime($this->session->userdata('Ymd_periode')));
		if ($d_periode >= 26) {
			$p1 = date_format(date_create($periode), 'Y-m-') . '26';
			$periode = date('Y-m-d', strtotime($periode . " +1 month"));
			$p2 = date_format(date_create($periode), 'Y-m-') . '25';
		} else {
			$periode = date('Y-m-d', strtotime($periode));
			$p1 = date('Y-m-d', strtotime($periode . " -1 month"));
			$p1 = date_format(date_create($p1), 'Y-m-') . '26';
			$p2 = date_format(date_create($periode), 'Y-m-') . '25';
		}
		$periode = date_format(date_create($periode), 'M Y');

		if ($bagian == 'Semua') {
			if ($kode_stok == '') {
				$query = "SELECT DISTINCT a.kodebar, a.nabar FROM masukitem a, keluarbrgitem b WHERE a.kodebar = b.kodebar AND b.batal = '0' AND a.kode_dev = '$lokasi' AND a.tgl BETWEEN '$p1' AND '$p2'";
			} else {
				$query = "SELECT DISTINCT b.kodebar, b.nabar FROM masukitem a, keluarbrgitem b WHERE a.kodebar = b.kodebar AND b.batal = '0' AND b.kodebar='$kode_stok' AND a.kode_dev = '$lokasi' AND a.tgl BETWEEN '$p1' AND '$p2'";
			}
		} else {
			if ($kode_stok == '') {
				$query = "SELECT DISTINCT b.kodebar, b.nabar FROM masukitem a, keluarbrgitem b WHERE a.kodebar = b.kodebar AND b.batal = '0' AND a.kode_dev = '$lokasi' AND a.grp='$bagian' AND a.tgl BETWEEN '$p1' AND '$p2'";
			} else {
				$query = "SELECT DISTINCT b.kodebar, b.nabar FROM masukitem a, keluarbrgitem b WHERE a.kodebar = b.kodebar AND b.batal = '0' AND b.kodebar='$kode_stok' AND a.kode_dev = '$lokasi' AND a.grp='$bagian' AND a.tgl BETWEEN '$p1' AND '$p2'";
			}
		}

		// if ($kode_stok == '') {
		// 	$query = "SELECT DISTINCT b.kodebar, b.nabar FROM masukitem a, keluarbrgitem b WHERE a.kodebar = b.kodebar AND b.batal = '0' AND a.kode_dev = '$lokasi' $q_bag AND a.tgl BETWEEN '$p1' AND '$p2'";
		// } else {
		// 	$query = "SELECT DISTINCT b.kodebar, b.nabar FROM masukitem a, keluarbrgitem b WHERE a.kodebar = b.kodebar AND b.batal = '0' AND b.kodebar='$kode_stok' AND a.kode_dev = '$lokasi' $q_bag AND a.tgl BETWEEN '$p1' AND '$p2'";
		// }
		$data['kode_stock'] = $this->db_logistik_pt->query($query)->result();
		$data['lokasi'] = $lokasi;
		$data['posisi'] = $posisi;
		$data['periode'] = $periode;
		$data['txtperiode'] = $txtperiode;
		$data['bagian'] = $bagian;
		$data['p1'] = $p1;
		$data['p2'] = $p2;
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('lapRSH/vw_lap_bkb_print_rsh_rinci', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function list_group_brg()
	{
		$query = "SELECT DISTINCT(grp) FROM kodebar ";

		$data = $this->db_logistik->query($query)->result();
		echo json_encode($data);
	}

	function print_lap_po_lpb_semua()
	{
		$devisi = $this->uri->segment(3);
		// $noref = $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9);

		$tanggalAwal = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggalAkhir = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);

		$query = "SELECT nopo, noreftxt, no_refppo, tglpo, tgl_refppo, ket, kode_supply, nama_supply, user, lokasi, bayar FROM po WHERE tglpo BETWEEN '$tanggalAwal' AND '$tanggalAkhir' AND status_lpb = 1";
		$data['po'] = $this->db_logistik_pt->query($query)->result();

		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_po_lpb_print_semua', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}



	function print_lap_po_lpb_bybrg()
	{

		$devisi = $this->uri->segment(3);
		$noref = $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9);

		$tanggalAwal = $this->uri->segment(12) . '-' . $this->uri->segment(11) . '-' . $this->uri->segment(10);
		$tanggalAkhir = $this->uri->segment(15) . '-' . $this->uri->segment(14) . '-' . $this->uri->segment(13);

		$namadev = $this->db_logistik_pt->query("SELECT devisi FROM po WHERE kode_dev='$devisi'")->row();

		$ambil = $this->M_laporan->bybarang($devisi, $noref, $tanggalAwal, $tanggalAkhir);

		$data['po'] = $ambil;
		$data['devisi'] = $namadev->devisi;



		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_po_lpb_print_bybrg', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();


		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_po_lpb_bysup()
	{
		$devisi = $this->uri->segment(3);
		$noref = $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9);

		$tanggalAwal = $this->uri->segment(12) . '-' . $this->uri->segment(11) . '-' . $this->uri->segment(10);
		$tanggalAkhir = $this->uri->segment(15) . '-' . $this->uri->segment(14) . '-' . $this->uri->segment(13);

		$ambil = $this->M_laporan->bysup($devisi, $noref, $tanggalAwal, $tanggalAkhir);

		$data['sup'] = $ambil;

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_po_lpb_print_bysup', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_po_lpb_blm_lpb_po()
	{
		$devisi = $this->uri->segment(3);
		// $noref = $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9);

		$tanggalAwal = $this->uri->segment(6) . '-' . $this->uri->segment(5) . '-' . $this->uri->segment(4);
		$tanggalAkhir = $this->uri->segment(9) . '-' . $this->uri->segment(8) . '-' . $this->uri->segment(7);

		$ambil = $this->M_laporan->po_blm_lpb($devisi, $tanggalAwal, $tanggalAkhir);

		$data['belum'] = $ambil;

		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_po_lpb_print_blm_lpb_po', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	function print_lap_po_lpb_po_cash_sh()
	{
		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_po_lpb_print_po_cash_sh', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_po_lpb_po_cash_blm_lpb()
	{
		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [190, 236],
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_po_lpb_print_po_cash_blm_lpb', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	function print_lap_po_lpb_po_gab()
	{
		$data['lokasi1'] = "Tes";
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => 'A4',
			'margin_top' => '15',
			'orientation' => 'L'
		]);

		$html = $this->load->view('analisa/vw_lap_po_lpb_print_po_gab', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
}

/* End of file Laporan.php */
