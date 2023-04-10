<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('M_admin');
	 $this->load->model('M_count');
	}

	public function index()
	{
    $kode_tahun = date('Y');
	 $view = array(
        'judul'             =>'Halaman Administrator',
        'count_rt'          => $this->M_count->count_rt(),
        'count_kk'          => $this->M_count->count_kk(),
        'count_anggota'     => $this->M_count->count_anggota_laki()+$this->M_count->count_anggota_perempuan(),
		'count_kk_laki'     => $this->M_count->count_anggota_laki(),
		'count_kk_perempuan'=> $this->M_count->count_anggota_perempuan(),
     );
	 $this->load->view('admin/home',$view);
	}

	
}
?>