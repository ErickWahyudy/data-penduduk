<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Kepala_keluarga extends CI_controller
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
    $this->load->model('m_kk');
    $this->load->model('m_anggota');
	}

  //kk
  public function index($value='')
  {
    $kode_tahun = date('Y');
    $view = array('judul'   =>'Data Kepala Keluarga',
              'data'        =>$this->m_kk->view(),
            );
     $this->load->view('admin/kepala_keluarga/form',$view);
  }

  private function datetime()
   {
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    return $date;
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

  public function generate_token($id='')
  {
    $token = $this->acak_id(20);

    $SQLupdate=array(
        'uuid'             =>$token,
    );

    $cek=$this->m_kk->update($id,$SQLupdate);
    if($cek){
        $pesan='<script>
              swal({
                  title: "Berhasil Perbarui Token",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
        $this->session->set_flashdata('pesan',$pesan);
        redirect(base_url('admin/kepala_keluarga'));
    }    
}
  
   //mengambil id kk urut terakhir
   private function id_kk_urut($value='')
   {
    $this->m_kk->id_urut();
    $query    = $this->db->get();
    $data     = $query->row_array();
    $id       = $data['id_kk'];
    $urut     = substr($id, 1, 3);
    $tambah   = (int) $urut + 1;
    $karakter = $this->acak_id(12);
    
    if (strlen($tambah) == 1){
    $newID = "K"."00".$tambah.$karakter;
       }else if (strlen($tambah) == 2){
       $newID = "K"."0".$tambah.$karakter;
          }else (strlen($tambah) == 3){
          $newID = "K".$tambah.$karakter
            };
     return $newID;
   }

    
   public function add($value='') {    
    if (isset($_POST['kirim'])) {
        $rules = array(
            array(
                'field' => 'no_kk',
                'label' => 'Nomor KK',
                'rules' => 'required|numeric|is_unique[tb_kk.no_kk]',
                'errors' => array(
                    'required' => 'Nomor KK tidak boleh kosong',
                    'numeric' => 'Nomor KK harus berupa angka',
                    'is_unique' => 'Nomor KK sudah terdaftar',
                ),
            ),
            array(
                'field' => 'nama_kk',
                'label' => 'Nama Kepala Keluarga',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama Kepala Keluarga tidak boleh kosong',
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
                    title: "'.form_error('no_kk').form_error('nama_kk').form_error('alamat').form_error('no_hp').form_error('password').'",
                    text: "",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
            </script>';
            $this->session->set_flashdata('pesan',$pesan);
            redirect(base_url('admin/kepala_keluarga'));
        }
      else

      $SQLinsert=array(
          'id_kk'             =>$this->id_kk_urut(),
          'no_kk'             =>$this->input->post('no_kk'),
          'nama_kk'           =>$this->input->post('nama_kk'),
          'alamat'            =>$this->input->post('alamat'),
          'no_hp'             =>$this->input->post('no_hp'),
          'id_rt'             =>$this->input->post('id_rt'),
          'tgl_update'        =>$this->datetime(),
          );
  
          if ($this->m_kk->add($SQLinsert)) {
  
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
      redirect(base_url('admin/kepala_keluarga'));
     }
    }
}

public function detail($id='')
  {
  $data=$this->m_kk->view_id($id)->row_array();
  
  if (empty($data['id_kk'])) {
    $pesan='<script>
              swal({
                  title: "Gagal Lihat Data",
                  text: "ID Kepala Keluarga Tidak Ditemukan",
                  type: "error",
                  showConfirmButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: false
              },
              function(){
                  window.location.href="'.base_url('admin/kepala_keluarga').'";
              });
            </script>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/kepala_keluarga'));
  }

  $x = array(
    'aksi'              =>'detail',
    'judul'             =>'Data Keluarga',
    'id_kk'             =>$data['id_kk'],
    'no_kk'             =>$data['no_kk'],
    'nama_kk'           =>$data['nama_kk'],
    'alamat'            =>$data['alamat'],
    'no_hp'             =>$data['no_hp'],
    'foto_kk'           =>$data['foto_kk'],
    'id_rt'             =>$data['id_rt'],
    'rt'                =>$this->db->get('tb_rt')->result_array(),
    'ukk'               =>$this->db->get('tb_kk')->result_array(),
    'level'             =>$data['level'],
    'data'              =>$this->m_kk->view_anggota($id),
  );

    $this->load->view('admin/kepala_keluarga/form_detail',$x);
}


public function edit($id='')
{
$data=$this->m_kk->view_id($id)->row_array();
    
 if (isset($_POST['kirim'])) {     

    $SQLupdate=array(
    'no_kk'             =>$this->input->post('no_kk'),
    'nama_kk'           =>$this->input->post('nama_kk'),
    'alamat'            =>$this->input->post('alamat'),
    'no_hp'             =>$this->input->post('no_hp'),
    'id_rt'             =>$this->input->post('id_rt'),
    'tgl_update'        =>$this->datetime(),
    );

  $cek=$this->m_kk->update($id,$SQLupdate);
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
  	 	redirect(base_url('admin/kepala_keluarga/detail/'.$id));
  }else{
   echo "QUERY SQL ERROR";
  
       }
      }else{
      	$this->load->view('admin/kepala_keluarga/form_detail',$x);
      }
    }

//mengompres ukuran gambar
private function compress($source, $destination, $quality) 
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);
    imagejpeg($image, $destination, $quality);
    return $destination;
}

//menyimpan gambar foto_kk ke dalam folder
//upload file ke server
private function upload_bukti_kk($value='')
{
    $ekstensi_diperbolehkan = array('png','jpg','jpeg','pdf','doc', 'docx');
    $nama = $_FILES['foto_kk']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto_kk']['size'];
    $file_tmp = $_FILES['foto_kk']['tmp_name'];
    $folderPath = "./themes/foto_kk/";
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 10044070){      
            $fileName = $this->input->post('nama_kk').'_'.uniqid() . '.' . $ekstensi;
            $file = $folderPath . $fileName;
            move_uploaded_file($file_tmp, $file);
            $this->compress($file, $file, 40);
            return $fileName;
        }else{
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Gagal",
                    text: "Ukuran File Terlalu Besar",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: true,,
                    confirmButtonText: "OKEE"
                });
            </script>');
            redirect('promo');
        }
    }else{
        $this->session->set_flashdata('pesan', '<script>
            swal({
                title: "Gagal",
                text: "Ekstensi File Tidak Diperbolehkan",
                type: "error",
                timer: 2000,
                showConfirmButton: true,,
                confirmButtonText: "OKEE"
            });
        </script>');
        redirect('promo');
    }
}
    
public function upload_fotoKK($id='')
{
if(isset($_POST['kirim'])){
    $SQLupdate=array(
      'foto_kk'               =>$this->upload_bukti_kk(),
      'tgl_update'            =>$this->datetime(),
    );
    $cek=$this->m_kk->update($id,$SQLupdate);
    if($cek){
     $pesan='<script>
            swal({
                title: "Berhasil Upload Foto KK",
                text: "",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
        </script>';
     $this->session->set_flashdata('pesan',$pesan);
   redirect(base_url('admin/kepala_keluarga/detail/'.$id));
    }
  }
}
      
public function hapus($id='')
    {
      //hapus file di folder berdasarkan id
      $data=$this->m_kk->view_id($id)->row_array();
      $file=$data['foto_kk'];
      unlink('./themes/foto_kk/'.$file);
      //hapus data di database
      $cek=$this->m_kk->delete($id);
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
       redirect(base_url('admin/kepala_keluarga'));
     }
    }

    public function hapusimage($id='')
    {
      //hapus file di folder berdasarkan id
      $data=$this->m_kk->view_id($id)->row_array();
      $file=$data['foto_kk'];
      unlink('./themes/foto_kk/'.$file);
      //hapus data di database
      $SQLupdate=array(
      'foto_kk'               =>'',
    );
    $cek=$this->m_kk->update($id,$SQLupdate);
    if($cek){
     $pesan='<script>
            swal({
                title: "Berhasil Hapus Foto KK",
                text: "",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
        </script>';
     $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/kepala_keluarga/detail/'.$id));
        }
    }
        

  	
}
?>