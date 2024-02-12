<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Role extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      
	 // error_reporting(0);
	 if($this->session->userdata('operator') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('M_admin');
	 $this->load->model('M_rt');
	}

	public function index()
	{
	 $view = array(
        'judul'               =>'Pilih Role',
        'data'                => $this->M_rt->view()->result_array(),
     );
	 $this->load->view('operator/role',$view);
	}

	public function masuk()
	{
	 $id_rt = $this->input->post('id_rt');
	 $ketua_rt = $this->M_rt->view_id($id_rt);
	 $DataKetuaRT=$ketua_rt->row_array();

	 $sessionKetuaRT = array(
			'ketua_rt'      => TRUE,
			'id_rt'         => $DataKetuaRT['id_rt'],
			'no_rt'         => $DataKetuaRT['no_rt'],
			'nama'          => $DataKetuaRT['nama'],
			'no_hp'         => $DataKetuaRT['no_hp'],
			'level'         => 'ketua_rt',
			  );
	 $this->session->set_userdata($sessionKetuaRT);
	 redirect(base_url('ketua_rt/home'));
	}
	
}