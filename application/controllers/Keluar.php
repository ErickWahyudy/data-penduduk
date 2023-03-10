<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Keluar extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
   $this->load->helper('url');
   // needed ???
   $this->load->database();
   $this->load->library('session');

  
}

public function index($value='')
{

$this->session->sess_destroy();
echo "<script>alert('Anda Telah Keluar Dari Halaman Pelanggan')</script>";;
redirect(base_url(''));
}

	
}