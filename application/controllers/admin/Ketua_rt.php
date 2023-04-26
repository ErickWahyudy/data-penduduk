<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Ketua_rt extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
    $this->load->model('m_rt');
	}

  //rt
  public function index($value='')
  {
    $kode_tahun = date('Y');
    $view = array('judul'   =>'Data Ketua RT',
              'data'        =>$this->m_rt->view(),);
     $this->load->view('admin/rt/form',$view);
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
  
   //mengambil id rt urut terakhir
   private function id_rt_urut($value='')
   {
    $this->m_rt->id_urut();
    $query    = $this->db->get();
    $data     = $query->row_array();
    $id       = $data['id_rt'];
    $urut     = substr($id, 1, 3);
    $tambah   = (int) $urut + 1;
    $karakter = $this->acak_id(12);
    
    if (strlen($tambah) == 1){
    $newID = "RT"."00".$tambah.$karakter;
       }else if (strlen($tambah) == 2){
       $newID = "RT"."0".$tambah.$karakter;
          }else (strlen($tambah) == 3){
          $newID = "RT".$tambah.$karakter
            };
     return $newID;
   }

    
   public function add($value='') {    
    if (isset($_POST['kirim'])) {
      $this->load->library('form_validation');
      $rules = array(
          array(
              'field' => 'nama_rt',
              'label' => 'Nama RT',
              'rules' => 'required'
          ),
          array(
              'field' => 'no_rt',
              'label' => 'No RT',
              'rules' => 'required'
          ),
          array(
              'field' => 'alamat',
              'label' => 'Alamat',
              'rules' => 'required'
          ),
          array(
              'field' => 'password',
              'label' => 'Password'
          ),
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
          $this->session->set_flashdata('pesan', '<script>
              swal({
                  text: "Data tidak boleh kosong",
                  type: "error",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
              });
          </script>');
          redirect('admin/ketua_rt');
      }
      else


      //cek nomor hp sudah pernah terdaftar
      $proses_cek=$this->db->get_where('tb_rt',array('no_hp'=>$this->input->post('no_hp')))->num_rows();
      if ($proses_cek > 0) {
          $this->session->set_flashdata('pesan', '<script>
              swal({
                  text: "Nomor HP sudah pernah digunakan mendaftar, silakan menggunakan nomor HP yang lain",
                  type: "error",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
              });
          </script>');
          redirect('admin/ketua_rt');
      }
      else
      //cek alamat sudah pernah terdaftar
      $proses_cek=$this->db->get_where('tb_rt',array('alamat'=>$this->input->post('alamat')))->num_rows();
      if ($proses_cek > 0) {
          $this->session->set_flashdata('pesan', '<script>
              swal({
                  text: "Alamat sudah terdaftar",
                  type: "error",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
              });
          </script>');
          redirect('admin/ketua_rt');
      }
      else

      $SQLinsert=array(
          'id_rt'             =>$this->id_rt_urut(),
          'no_rt'             =>$this->input->post('no_rt'),
          'nama_rt'           =>$this->input->post('nama_rt'),
          'alamat'            =>$this->input->post('alamat'),
          'no_hp'             =>$this->input->post('no_hp'),
          'email'             =>$this->input->post('email'),
          'password'          =>md5($this->input->post('password'))
          );
  
          if ($this->m_rt->add($SQLinsert)) {
  
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
      redirect(base_url('admin/ketua_rt'));
     }
    }
  
}
      
      public function edit($id='') {
      if(isset($_POST['kirim'])){
        $SQLupdate=array(
          'no_rt'             =>$this->input->post('no_rt'),
          'nama_rt'              =>$this->input->post('nama_rt'),
          'alamat'            =>$this->input->post('alamat'),
          'no_hp'             =>$this->input->post('no_hp'),
          'email'             =>$this->input->post('email')

        );
        $cek=$this->m_rt->update($id,$SQLupdate);
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
       redirect(base_url('admin/ketua_rt'));
        }
      }
    }

    public function ganti_password($id='') {
        if (isset($_POST['kirim'])) {
            $SQLinsert=array(
                'password'    =>md5($this->input->post('password'))
        );
        $cek=$this->m_rt->update($id,$SQLinsert);
        if($cek){
            $pesan='<script>
                swal({
                    title: "Berhasil Ganti Password",
                    text: "",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
            </script>';
             $this->session->set_flashdata('pesan',$pesan);
          redirect(base_url('admin/ketua_rt'));
        }
      }
    }
  
    
    public function hapus($id='')
  {

    $cek=$this->m_rt->delete($id);
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
	 	redirect(base_url('admin/ketua_rt'));
	 }else{
     	$pesan='<script>
              swal({
                  title: "Gagal Hapus Data",
                  text: "",
                  type: "error",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	$this->session->set_flashdata('pesan',$pesan);
     	redirect(base_url('admin/ketua_rt'));
     }
    }
	
}
?>