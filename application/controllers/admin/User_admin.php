<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User_admin extends CI_controller
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
	 $this->load->model('m_admin');
	}

//user_admin
public function index($value='')
{
 $view = array('judul'  =>'Data Admin',
                'data'      =>$this->m_admin->view(),);
  $this->load->view('admin/user/user_admin',$view);
}

private function acak_id($panjang)
{
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter{$pos};
    }
    return $string;
}
  
   //mengambil id admin urut terakhir
   private function id_admin_urut($value='')
   {
    $this->m_admin->id_urut();
    $query    = $this->db->get();
    $data     = $query->row_array();
    $id       = $data['id_admin'];
    $urut     = substr($id, 1, 3);
    $tambah   = (int) $urut + 1;
    $karakter = $this->acak_id(12);
    
    if (strlen($tambah) == 1){
    $newID = "A"."00".$tambah.$karakter;
       }else if (strlen($tambah) == 2){
       $newID = "A"."0".$tambah.$karakter;
          }else (strlen($tambah) == 3){
          $newID = "A".$tambah.$karakter
            };
     return $newID;
   }

    public function tambah($value='') {
      if (isset($_POST['kirim'])) {
                
    $SQLinsert=array(
    'id_admin'            =>$this->id_admin_urut(),
    'nama'                =>$this->input->post('nama'),
    'email'               =>$this->input->post('email'),
    'password'            =>md5($this->input->post('password')),
    'level'               =>$this->input->post('level'),
    );

    $cek=$this->m_admin->add($SQLinsert);
    if($cek){
      $pesan='<script>
                  swal({
                      title: "Berhasil Menambahkan Data",
                      text: "",
                      type: "success",
                      showConfirmButton: true,
                      confirmButtonText: "OKEE"
                      });
              </script>';
          $this->session->set_flashdata('pesan',$pesan);
        redirect(base_url('admin/user_admin'));
        }
      }
    }

    
  public function edit($id='') {	
    if(isset($_POST['kirim'])){
      $SQLupdate=array(
      	'nama'                      =>$this->input->post('nama'),
        'email'                     =>$this->input->post('email'),
        'password'                  =>md5($this->input->post('password')),
        'level'                     =>$this->input->post('level'),
      );
      $cek=$this->m_admin->update($id,$SQLupdate);
      if($cek){
       $pesan='<script>
              swal({
                  title: "Berhasil Edit Data",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	$this->session->set_flashdata('pesan',$pesan);
	 	redirect(base_url('admin/user_admin'));
      }
    }
	}

	
	public function hapus($id='')
	{
    $cek=$this->m_admin->delete($id);
	 if ($cek) {
	 	$pesan='<script>
              swal({
                  title: "Berhasil Hapus Data",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	$this->session->set_flashdata('pesan',$pesan);
	 	redirect(base_url('admin/user_admin'));
	 }
	}

public function keluar($value='')
{

$this->session->sess_destroy();
echo "<script>alert('Anda Telah Keluar Dari Halaman Administrator')</script>";;
redirect(base_url(''));
}

	
}
?>