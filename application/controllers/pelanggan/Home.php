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
	 if($this->session->userdata('pelanggan') != TRUE){
    redirect(base_url(''));
     exit;
	};
   $this->load->model('m_pelanggan');
   $this->load->model('m_paket');
   $this->load->model('m_tagihan');
   $this->load->model('m_tagihan_lain');
   $this->load->model('m_informasi');

    
}

	public function index($id='')
  {

    $data=$this->m_tagihan->home_tagihan($id)->row_array();
	 $view = array(
        'judul'           =>'Halaman Member KassandraWiFi',
        'count_plg'       => $this->db->get('tb_pelanggan')->num_rows(),
        'count_paket'     => $this->db->get('tb_paket')->num_rows(),
        'count_tagihanBL' => $this->m_tagihan->count_tagihanBL()->num_rows(),
        'count_tagihanBL_lain' => $this->m_tagihan_lain->count_tagihanBL_lain()->num_rows(),

        'id_tagihan'          =>$data['id_tagihan'],
        'id_pelanggan'        =>$data['id_pelanggan'],
        'id_paket'            =>$data['id_paket'],
        'paket'               =>$data['paket'],
        'nama'                =>$data['nama'],
        'bulan'               =>$data['bulan'],
        'tahun'               =>$data['tahun'],
        'status'              =>$data['status'],
        'tgl_bayar'           =>$data['tgl_bayar'],
        'tagihan'             =>$data['tagihan'],

        'informasi'           =>$this->m_informasi->view(),
        );
	 $this->load->view('pelanggan/home',$view);
	}

	
}