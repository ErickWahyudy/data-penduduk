<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Data_lain extends CI_controller
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
	 if($this->session->userdata('ketua_rt') != TRUE){
     redirect(base_url(''));
     exit;
	};
    $this->load->model('m_data_lain');
    $this->load->model('m_rt');
	}

  //kk
  public function index($id='')
  {
    $kode_tahun = date('Y');
    $view = array('judul'   =>'Data Lainnya RT '.$this->session->userdata('no_rt'),
              'data'        =>$this->m_data_lain->view_id_data_lain($id),
            );
     $this->load->view('ketua_rt/data_lain/form',$view);
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
  
   //mengambil id_data_lain urut terakhir
   private function id_data_lain_urut($value='')
   {
    $this->m_data_lain->id_urut();
    $query    = $this->db->get();
    $data     = $query->row_array();
    $id       = $data['id_data_lain'];
    $urut     = substr($id, 1, 3);
    $tambah   = (int) $urut + 1;
    $karakter = $this->acak_id(12);
    
    if (strlen($tambah) == 1){
    $newID = "D"."00".$tambah.$karakter;
       }else if (strlen($tambah) == 2){
       $newID = "D"."0".$tambah.$karakter;
          }else (strlen($tambah) == 3){
          $newID = "D".$tambah.$karakter
            };
     return $newID;
   }

    
   public function add($value='') {    
    if (isset($_POST['kirim'])) {
        $rules = array(
            array(
                'field' => 'nik',
                'label' => 'Nomor NIK',
                'rules' => 'required|numeric|is_unique[tb_data_lain.nik]',
                'errors' => array(
                    'required' => 'Nomor NIK tidak boleh kosong',
                    'numeric' => 'Nomor NIK harus berupa angka',
                    'is_unique' => 'Nomor NIK sudah terdaftar',
                ),
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama tidak boleh kosong',
                ),
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Alamat tidak boleh kosong',
                ),
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            $pesan='<script>
                swal({
                    title: "'.form_error('nik').form_error('nama').form_error('alamat').'",
                    text: "",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
            </script>';
            $this->session->set_flashdata('pesan',$pesan);
            redirect(base_url('ketua_rt/data_lain'));
        }
      else

      $nama = $this->input->post('nama');
      $nama = mb_convert_case($nama, MB_CASE_TITLE, "UTF-8");

      $alamat = $this->input->post('alamat');
      $alamat = mb_convert_case($alamat, MB_CASE_TITLE, "UTF-8");

      $keterangan = $this->input->post('keterangan');
      $keterangan = mb_convert_case($keterangan, MB_CASE_TITLE, "UTF-8");

      $SQLinsert=array(
          'id_data_lain'      =>$this->id_data_lain_urut(),
          'nama'              =>$nama,
          'nik'               =>$this->input->post('nik'),
          'jenis_kelamin'     =>$this->input->post('jenis_kelamin'),
          'alamat'            =>$alamat,
          'tanggal'           =>$this->input->post('tanggal'),
          'keterangan'        =>$keterangan,
          'id_rt'             =>$this->session->userdata('id_rt'),
          );
  
          if ($this->m_data_lain->add($SQLinsert)) {
  
     $pesan='<script>
                swal({
                    title: "Berhasil Menambahkan Data '.$this->input->post('nama').'",
                    text: "",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
            </script>';
         $this->session->set_flashdata('pesan',$pesan);
      redirect(base_url('ketua_rt/data_lain'));
     }
    }
}


public function edit($id='')
{
$data=$this->m_data_lain->view_id($id)->row_array();
    
 if (isset($_POST['kirim'])) {     

    $SQLupdate=array(
    'nama'              =>$this->input->post('nama'),
    'nik'               =>$this->input->post('nik'),
    'jenis_kelamin'     =>$this->input->post('jenis_kelamin'),
    'alamat'            =>$this->input->post('alamat'),
    'tanggal'           =>$this->input->post('tanggal'),
    'keterangan'        =>$this->input->post('keterangan'),
    'id_rt'             =>$this->session->userdata('id_rt'),

    );

  $cek=$this->m_data_lain->update($id,$SQLupdate);
  if($cek){
    	$pesan='<script>
              swal({
                  title: "Berhasil Edit Data '.$this->input->post('nama').'",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	$this->session->set_flashdata('pesan',$pesan);
  	 	redirect(base_url('ketua_rt/data_lain'));
  }else{
   echo "QUERY SQL ERROR";
  
       }
      }else{
      	$this->load->view('ketua_rt/data_lain/form',$x);
      }
    }


      
    public function hapus($id='')
    {
  
      $cek=$this->m_data_lain->delete($id);
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
           redirect(base_url('ketua_rt/data_lain'));
       }
       else{
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
          redirect(base_url('ketua_rt/data_lain'));
       }
    }
        

  	
}
?>