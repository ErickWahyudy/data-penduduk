<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Tagihan extends CI_controller
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
    
}

public function index($id='')
  {
   $x = array('judul' =>'Data Tagihan',
              'aksi'  =>'tagihan',
              'data'  =>$this->m_tagihan->tagihan($id),);
   $this->load->view('pelanggan/tagihan',$x);
  }

  
  public function bayar($id='')
        {
        $data=$this->m_tagihan->view_id($id)->row_array();
        $x = array('judul'                =>'Bayar Tagihan' ,
                    'aksi'                =>'bayar_tagihan',
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
                  );	
          if(isset($_POST['kirim'])){

            if($cek){
             
            }else{
             echo "ERROR input Data";
            }
          }else{
           $this->load->view('pelanggan/tagihan',$x);
          }
      }

      public function merchant($id='')
      {
      $data=$this->m_tagihan->view_id($id)->row_array();
      $x = array('judul'                =>'merchant KassandraWiFi' ,
                  'aksi'                =>'merchant',
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
                );	
        if(isset($_POST['kirim'])){
         
          if($cek){
           
          }else{
           echo "ERROR input Data";
          }
        }else{
          $this->load->view('pelanggan/tagihan',$x);
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
    
    //mengambil id konfirmasi urut terakhir
    private function id_urut_konfirmasi($value='')
    {
    $this->m_tagihan->id_urut_konfirmasi();
    $query   = $this->db->get();
    $data    = $query->row_array();
    $id      = $data['id_konfirmasi'];
    $urut    = substr($id, 1, 3);
    $tambah  = (int) $urut + 1;
    $karakter= $this->acak_id(5);
    
    if (strlen($tambah) == 1){
    $newID = "K"."00".$tambah.$karakter;
        }else if (strlen($tambah) == 2){
        $newID = "K"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "K".$tambah.$karakter
            };
        return $newID;
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
    
     //menyimpan gambar bukti_bayar ke dalam folder
            //upload file ke server
            private function upload_bukti_bayar($value='')
            {
                $ekstensi_diperbolehkan = array('png','jpg','jpeg');
                $nama = $_FILES['bukti_bayar']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['bukti_bayar']['size'];
                $file_tmp = $_FILES['bukti_bayar']['tmp_name'];
                $folderPath = "./themes/bukti_bayar/";
                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                    if($ukuran < 10044070){      
                        $fileName = $this->input->post('nama').'_'.$nama . '.' . $ekstensi;
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
                        redirect('pelanggan/bayar/'.$id);
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
                    redirect('pelanggan/bayar/'.$id);
                }
            }
        
public function konfirmasi_bayar($id='')
      {
      $data=$this->m_tagihan->view_id($id)->row_array();
      $x = array('judul'                =>'Konfirmasi Pembayaran' ,
                  'aksi'                =>'konfirmasi_byr',
                  'id_tagihan'          =>$data['id_tagihan'],
                  'tagihan'             =>$data['tagihan'],
                  'nama'                =>$data['nama'],
                  'status'              =>$data['status'],
                  
                );	
        if(isset($_POST['kirim'])){
          //cek sudah upload bukti bayar atau belum
          $proses_cek = $this->db->get_where('tb_tagihan_konfirmasi', array('bukti_bayar' => $this->upload_bukti_bayar()))->num_rows();
          if($proses_cek > 0){
            $pesan='<script>
              swal({
                  title: "Anda Sudah Upload Bukti Bayar, Silahkan Tunggu Konfirmasi Dari Admin",
                  text: "",
                  // selain error, ada info, warning, success
                  type: "info",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	    $this->session->set_flashdata('pesan',$pesan);
            redirect('pelanggan/bayar/'.$id);

          }
          else
          $SQLinsert=array(
            'id_konfirmasi'       =>$this->id_urut_konfirmasi(),
            'id_pelanggan'        =>$data['id_pelanggan'],
            'id_tagihan'          =>$data['id_tagihan'],
            'bukti_bayar'         =>$this->upload_bukti_bayar(),
            'tgl_konfirmasi'      =>date('Y-m-d'),
            );
            
            $cek=$this->m_tagihan->add_konfirmasi_byr($SQLinsert);
          if($cek){
            $pesan='<script>
              swal({
                  title: "Berhasil Mengirim Konfirmasi Pembayaran",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	    $this->session->set_flashdata('pesan',$pesan);
         redirect(base_url('pelanggan/bayar/'.$data['id_tagihan']));
          }else{
           echo "ERROR input Data";
          }
        }else{
         $this->load->view('pelanggan/tagihan',$x);
        }
      }
      	
}