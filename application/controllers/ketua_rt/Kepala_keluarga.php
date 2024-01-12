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
	 if($this->session->userdata('ketua_rt') != TRUE){
     redirect(base_url(''));
     exit;
	};
    $this->load->model('m_kk');
    $this->load->model('m_anggota');
	}

  //kk
  public function index($id='')
  {
    $view = array('judul'   =>'Data Kepala Keluarga RT '.$this->session->userdata('no_rt'),
              'data'        =>$this->m_kk->view_id_kk($id),
            );
     $this->load->view('ketua_rt/kepala_keluarga/form',$view);
  }

  private function datetime()
   {
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    return $date;
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
        redirect(base_url('ketua_rt/kepala_keluarga'));
    }    
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
            redirect(base_url('ketua_rt/kepala_keluarga'));
        }
      else

      $id_maps = $this->acak_id(20);

      $SQLinsert=array(
          'id_kk'             =>$this->id_kk_urut(),
          'no_kk'             =>$this->input->post('no_kk'),
          'nama_kk'           =>$this->input->post('nama_kk'),
          'alamat'            =>$this->input->post('alamat'),
          'no_hp'             =>$this->input->post('no_hp'),
          'id_rt'             =>$this->input->post('id_rt'),
          'id_maps'           =>$id_maps,
          'tgl_update'        =>$this->datetime(),
          );

          $cek=$this->m_kk->add($SQLinsert);

       $SQLinsert2=array(
            'id_maps'             =>$id_maps,
        );
        $cek=$this->m_kk->add_maps($SQLinsert2);

        if($cek) {
  
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
      redirect(base_url('ketua_rt/kepala_keluarga'));
     }
    }
}

public function detail($id='')
  {
  $data=$this->m_kk->view_id($id)->row_array();
  
  if (empty($data['id_kk'])) {
    $pesan='<script>
                    swal({
                        title: "Gagal Lihat Data Karena Belum Update ID Maps",
                        text: "Silakan Klik Generate ID Maps",
                        type: "error",
                        showCancelButton: true,
                        confirmButtonColor: "#3CB371",
                        confirmButtonText: "Generate ID Maps",
                        cancelButtonText: "Kembali",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }).then(function(result) {
                        if (result.value) {
                            window.location.href="'.base_url('ketua_rt/kepala_keluarga/generate_id_maps/'.$id).'";
                        }
                    });
            </script>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('ketua_rt/kepala_keluarga'));
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
    'id_maps'           =>$data['id_maps'],
    'latitude'          =>$data['latitude'],
    'longitude'         =>$data['longitude'],
    'rt'                =>$this->db->get('tb_rt')->result_array(),
    'level'             =>$data['level'],
    'data'              =>$this->m_kk->view_anggota($id),
  );

    $this->load->view('ketua_rt/kepala_keluarga/form_detail',$x);
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
    'tgl_update'        =>$this->datetime(),
    );

  $cek=$this->m_kk->update($id,$SQLupdate);
  if($cek){
    	$pesan='<script>
              swal({
                  title: "Berhasil Perbarui Data ' .$this->input->post('nama_kk').'",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	$this->session->set_flashdata('pesan',$pesan);
  	 	redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$id));
  }else{
   echo "QUERY SQL ERROR";
  
       }
      }else{
      	$this->load->view('ketua_rt/kepala_keluarga/form_detail',$x);
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
private function upload_bukti_kk()
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
            redirect(base_url('ketua_rt/kepala_keluarga'));
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
        redirect(base_url('ketua_rt/kepala_keluarga'));
    }
}

//API upload foto ke database dan folder
public function api_uploadKK($id='', $SQLupdate='')
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
      'message' => 'Tidak Ada File Yang Diupload',
    ];
    } else {
    $SQLupdate = [
        'foto_kk'     => $this->upload_bukti_kk(),
        'tgl_update'  => $this->datetime(),
    ];
    if ($this->m_kk->update($id, $SQLupdate)) {
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
      
public function hapus($id='')
  {

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
	 	redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$id));
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
        redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$id));
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
    redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$id));
        }
    }

        //MAPS
        public function generate_id_maps($id='')
        {
            $id_maps = $this->acak_id(20);
    
            $SQLinsert2=array(
                'id_maps'             =>$id_maps,
            );
            $cek=$this->m_kk->add_maps($SQLinsert2);
    
            $SQLupdate=array(
                'id_maps'             =>$id_maps,
                'tgl_update'          =>$this->datetime(),
            );
            $cek=$this->m_kk->update($id,$SQLupdate);
            if($cek){
                $pesan='<script>
                      swal({
                          title: "Berhasil Generate ID Maps",
                          text: "",
                          type: "success",
                          showConfirmButton: true,
                          confirmButtonText: "OKEE"
                          });
                  </script>';
                $this->session->set_flashdata('pesan',$pesan);
                redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$id));
            }
        }
            
    
        public function edit_maps($id='')
        {
            $data=$this->m_kk->view_id_maps($id)->row_array();
            if (empty($data['id_kk'])) {
            $pesan='<script>
                        swal({
                            title: "Gagal Edit Data",
                            text: "ID KK Tidak Ditemukan",
                            type: "error",
                            showConfirmButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "OK",
                            closeOnConfirm: false
                        },
                        function(){
                            window.location.href="'.base_url('ketua_rt/kepala_keluarga').'";
                        });
                    </script>';
            $this->session->set_flashdata('pesan',$pesan);
            redirect(base_url('ketua_rt/kepala_keluarga'));
            }
    
            $x = array(
            'judul'           =>'Edit Lokasi Kepala Keluarga',
            'id_kk'           =>$data['id_kk'],
            'id_maps'         =>$data['id_maps'],
            'nama_kk'         =>$data['nama_kk'],
            'alamat'          =>$data['alamat'],
            'latitude'        =>$data['latitude'],
            'longitude'       =>$data['longitude']
            );
    
            $this->load->view('ketua_rt/kepala_keluarga/edit_maps',$x);
        }
    
        //API api_edit_map
        public function api_edit_maps($id='')
        {
            $data=$this->m_kk->view_id_maps($id)->row_array();
            $x = array(
            'judul'           =>'Edit Lokasi Kepala Keluarga',
            'id_kk'           =>$data['id_kk'],
            'id_maps'         =>$data['id_maps'],
            'nama_kk'         =>$data['nama_kk'],
            'alamat'          =>$data['alamat'],
            'latitude'        =>$data['latitude'],
            'longitude'       =>$data['longitude']
            );
    
            $rules = array(
            array(
                'field' => 'latitude',
                'label' => 'latitude',
                'rules' => 'required'
            ),
            array(
                'field' => 'longitude',
                'label' => 'longitude',
                'rules' => 'required'
            )
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'message' => 'Tidak ada data'
            ];
            } else {
            $SQLupdate = [
                'latitude'    => $this->input->post('latitude'),
                'longitude'   => $this->input->post('longitude')
            ];
            
            $SQLupdate2 = [
                'tgl_update'  => $this->datetime()
            ];
    
            $cek=$this->m_kk->update($id,$SQLupdate2);
            $cek=$this->m_kk->update_maps($id=$data['id_maps'],$SQLupdate);
            if($cek){
                $response = [
                'status' => true,
                'message' => 'Berhasil mengubah data'
                ];
            }
            }
            
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
        }

  	
}