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
	//  if($this->session->userdata('penduduk') != TRUE){
    //  redirect(base_url(''));
    //  exit;
	// };
    $this->load->model('m_penduduk');
    $this->load->model('m_anggota');
	}

  //kk
  public function index($id='')
  {
    $view = array('judul'   =>'Data Kepala Keluarga',
              'data'        =>$this->m_penduduk->view_id_kk($id),
            );
     $this->load->view('penduduk/kepala_keluarga/form',$view);
  }

  private function datetime()
   {
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    return $date;
   }

public function detail($token='')
  {
  $data=$this->m_penduduk->view_id($token)->row_array();
  
  if (empty($data['uuid'])) {
    $pesan='<script>
              swal({
                  title: "Gagal Lihat Data",
                  text: "Tidak bisa melihat data karena token salah atau sudah kadaluarsa",
                  type: "error",
                  showConfirmButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: false
              },
              function(){
                  window.location.href="'.base_url('login').'";
              });
            </script>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('login'));
  }

  $x = array(
    'aksi'              =>'detail',
    'judul'             =>'Data Keluarga',
    'token'             =>$data['uuid'],
    'id_kk'             =>$data['id_kk'],
    'no_kk'             =>$data['no_kk'],
    'nama_kk'           =>$data['nama_kk'],
    'alamat'            =>$data['alamat'],
    'no_hp'             =>$data['no_hp'],
    'foto_kk'           =>$data['foto_kk'],
    'id_rt'             =>$data['id_rt'],
    'id_maps'           =>$data['id_maps'],
    'latitude'          =>$data['latitude'],
    'longitude'         =>$data['longitude'],
    'rt'                =>$this->db->get('tb_rt')->result_array(),
    'level'             =>$data['level'],
    'data'              =>$this->m_penduduk->view_anggota($id = $data['id_kk']),
  );

    $this->load->view('penduduk/kepala_keluarga/form_detail',$x);
}


public function edit($token='')
{
$data=$this->m_penduduk->view_id($token)->row_array();
    
 if (isset($_POST['kirim'])) {     

    $SQLupdate=array(
    'no_kk'             =>$this->input->post('no_kk'),
    'nama_kk'           =>$this->input->post('nama_kk'),
    'alamat'            =>$this->input->post('alamat'),
    'no_hp'             =>$this->input->post('no_hp'),
    'tgl_update'        =>$this->datetime(),

    );

  $cek=$this->m_penduduk->update($token,$SQLupdate);
  if($cek){
    	$pesan='<script>
              swal({
                  title: "Berhasil Perbarui Data ' .$this->input->post('nama_kk'). '",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	$this->session->set_flashdata('pesan',$pesan);
  	 	redirect(base_url('penduduk/kepala_keluarga/detail/'.$token));
  }else{
   echo "QUERY SQL ERROR";
  
       }
      }else{
      	$this->load->view('penduduk/kepala_keluarga/form_detail',$x);
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
private function upload_bukti_kk($token='')
{
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG');
    $nama = $_FILES['foto_kk']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto_kk']['size'];
    $folderPath = "./themes/foto_kk/";

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 10044070) {      
            // Menggunakan data hasil crop yang disimpan di elemen dengan id 'cropped_image'
            $cropped_image_data = $_POST['cropped_image'];

            // Mendapatkan nama file tanpa ekstensi
            $nama_file = pathinfo($nama, PATHINFO_FILENAME);

            // Ekstensi file
            $ext = pathinfo($nama, PATHINFO_EXTENSION);

            //menyimpan gambar ke database
            $fileName = $this->input->post('nama_kk'). '_' . uniqid() . '.' . $ext;
            // Konversi data hasil crop menjadi file gambar
            $cropped_image = $folderPath . $fileName;
            file_put_contents($cropped_image, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_image_data)));
            $this->compress($cropped_image, $cropped_image, 40);

            return $fileName;
        } else {
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Gagal",
                    text: "Ukuran File Terlalu Besar",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                });
            </script>');
            redirect('penduduk/kepala_keluarga/detail/'.$token);
        }
    } else {
        $this->session->set_flashdata('pesan', '<script>
            swal({
                title: "Gagal",
                text: "Ekstensi File Tidak Diperbolehkan",
                type: "error",
                timer: 2000,
                showConfirmButton: true,
                confirmButtonText: "OKEE"
            });
        </script>');
        redirect('penduduk/kepala_keluarga/detail/'.$token);
    }
}
    
//API upload foto ke database dan folder
public function api_uploadKK($token='')
{
    $rules = array(
        array(
          'field' => 'cropped_image',
          'label' => 'Foto KK',
          'rules' => 'required',
        ),
        );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
        $data = [
          'status'  => 'error',
          'message' => validation_errors(),
        ];
    } else {
        $SQLupdate = [
        'foto_kk'    =>$this->upload_bukti_kk(),
        'tgl_update' =>$this->datetime(),
        ];
        if ($this->m_penduduk->update($token,$SQLupdate)) {
            $data = [
            'status'  => 'success',
            'message' => 'Berhasil Upload File',
            ];
        } else {
            $data = [
            'status'  => 'error',
            'message' => 'Gagal Upload File',
            ];
        }
    }
    $this->output
    ->set_content_type('application/json')
    ->set_output(json_encode($data));
}
  	
}

?>