<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Excel extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      $this->load->library('PHPExcel');
      
	 // error_reporting(0);
	 if($this->session->userdata('ketua_rt') != TRUE){
     redirect(base_url(''));
     exit;
	};
    $this->load->model('m_kk');
    $this->load->model('m_anggota');
	}

    // Generate Excel template for KK
    public function generate_template_KK() {
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator("".$this->session->userdata('nama_rt')."")
                                    ->setLastModifiedBy("".$this->session->userdata('nama_rt')."")
                                    ->setTitle("Template KK")
                                    ->setSubject("Template KK")
                                    ->setDescription("Template Excel for data import")
                                    ->setKeywords("excel template")
                                    ->setCategory("Template");

        // Add data to the Excel file
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValueExplicit('A1', 'Nomor KK', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('B1', 'Nama Kepala Keluarga', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('C1', 'Nomor HP', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('D1', 'Alamat', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('A2', '3502116705130004', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('B2', 'Kassandra', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('C2', '6281234567890', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('D2', 'Jl. Raya No. 123', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('A3', '3502116705130005', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('B3', 'Kassandra', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('C3', '6281234567890', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('D3', 'Jl. Raya No. 123', PHPExcel_Cell_DataType::TYPE_STRING);



        // Set column width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        // Set header style
        $headerStyleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($headerStyleArray);

        // Set active sheet index to the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Set filename and mime type
        $filename = 'template_excel_KK.xlsx';
        $mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: ' . $mime_type);
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        exit;
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

   public function import_excel_KK() {
    // Load form validation library
    $this->load->library('form_validation');

    // Set validation rules for each field
    $rules = array(
        array(
            'field' => 'excel_file',
            'label' => 'Excel File',
            'rules' => 'callback_validate_excel_KK',
            'errors' => array(
                'validate_excel_KK' => 'The {field} must be a valid Excel file (XLSX or XLS).',
            ),
        ),
    );
    $this->form_validation->set_rules($rules);

    // Run form validation
    if ($this->form_validation->run() == FALSE) {
        // If validation fails, redirect back with error messages
        $pesan = '<script>
            swal({
                title: "'.form_error('excel_file').'",
                text: "",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
        </script>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('ketua_rt/kepala_keluarga'));
    } else {
        // If validation succeeds, continue with data processing
        // Code to handle file import goes here
        
        // For example:
        $this->process_excel_data_KK();
    }
}

// Callback function to validate Excel file
public function validate_excel_KK($str) {
    // Check if file is uploaded
    if (!empty($_FILES['excel_file']['name'])) {
        // Check file extension
        $allowed_extensions = array('xlsx', 'xls');
        $ext = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed_extensions)) {
            $this->form_validation->set_message('validate_excel_KK', 'The {field} must be a valid Excel file (XLSX or XLS).');
            return FALSE;
        }
    } else {
        $this->form_validation->set_message('validate_excel_KK', 'Please choose an Excel file to upload.');
        return FALSE;
    }

    return TRUE;
}

public function process_excel_data_KK()
{
    // Load Excel file
    $excelFile = $_FILES['excel_file']['tmp_name'];

    // Load Excel Reader
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load($excelFile);
    $worksheet = $objPHPExcel->getActiveSheet();

    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    
    // Run form validation before processing data
    $validation_result = $this->form_validation->run();

    // Check if form validation passed
    if ($validation_result) {
    // Loop through each row of the worksheet
    for ($row = 2; $row <= $highestRow; $row++) {
        // Get cell values
        $no_kk      = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
        $nama_kk    = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $no_hp      = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $alamat     = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $id_rt      = $this->session->userdata('id_rt');

        //awal kata dijadikan huruf besar
        $nama_kk = mb_convert_case($nama_kk, MB_CASE_TITLE, "UTF-8");
        $alamat = mb_convert_case($alamat, MB_CASE_TITLE, "UTF-8");

        // Check if no_kk is not empty
        if (!empty($no_kk)) {
            // Check if no_kk is already registered
            if ($this->is_no_kk_registered($no_kk)) {
                // If no_kk is already registered, set error message and continue to next row
                $pesan = '<script>
                    swal({
                        title: "Nomor KK '.$no_kk.' sudah terdaftar",
                        text: "",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                </script>';
                $this->session->set_flashdata('pesan', $pesan);
                continue; // Skip to next row
            }
        } else {
            // If no_kk is empty, set error message and continue to next row
            $pesan = '<script>
                swal({
                    title: "Nomor KK tidak boleh kosong",
                    text: "",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
            </script>';
            $this->session->set_flashdata('pesan', $pesan);
            continue; // Skip to next row
        }

        // Insert into database
        $SQLinsert = array(
            'id_kk' => $this->id_kk_urut(),
            'no_kk' => $no_kk,
            'nama_kk' => $nama_kk,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'id_rt' => $id_rt,
            'tgl_update' => $this->datetime(),
        );

        $cek = $this->m_kk->add($SQLinsert);
    }

    if ($cek) {
        $pesan = '<script>
                    swal({
                        title: "Berhasil Mengimpor Data",
                        text: "",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OK"
                    });
                </script>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('ketua_rt/kepala_keluarga'));
    } else {
        $pesan = '<script>
                    swal({
                        title: "Gagal Mengimpor Data",
                        text: "",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OK"
                    });
                </script>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('ketua_rt/kepala_keluarga'));
     }
    }
}

    private function is_no_kk_registered($no_kk) {
        // Query database to check if no_kk is already registered
        $query = $this->db->get_where('tb_kk', array('no_kk' => $no_kk));
        return $query->num_rows() > 0;
    }

    //mengambil id anggota urut terakhir
    private function id_anggota_urut($value='')
    {
    $this->m_anggota->id_urut();
    $query    = $this->db->get();
    $data     = $query->row_array();
    $id       = $data['id_anggota'];
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

    public function generate_template_anggota($id) {
        // Load PHPExcel library
        $this->load->library('PHPExcel');

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator($this->session->userdata('nama_rt'))
                                        ->setLastModifiedBy($this->session->userdata('nama_rt'))
                                        ->setTitle("Template Anggota Keluarga")
                                        ->setSubject("Template Anggota Keluarga")
                                        ->setDescription("Template Excel for data import")
                                        ->setKeywords("excel template")
                                        ->setCategory("Template");

        // Add data to the Excel file foreach data from database tb_kk
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValueExplicit('A1', 'No KK', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('B1', 'Nama KK', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('C1', 'NIK', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('D1', 'Nama', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('E1', 'Jenis Kelamin', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('F1', 'Tempat Lahir', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('G1', 'Tanggal Lahir', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('H1', 'Agama', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('I1', 'Pendidikan', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('J1', 'Pekerjaan', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('K1', 'Status Perkawinan', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('L1', 'Status Hubungan', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('M1', 'Kewarganegaraan', PHPExcel_Cell_DataType::TYPE_STRING);

        // Data pekerjaan
        $pekerjaanOptions = array(
            'Belum/Tidak Bekerja','Pelajar/Mahasiswa','Mengurus Rumah Tangga','Pensiunan','Pegawai Negeri Sipil','Tentara Nasional Indonesia','Kepolisian RI','Perdagangan',
            'Petani/Pekebun','Peternak','Nelayan/Perikanan','Industri','Konstruksi','Transportasi','Karyawan Swasta','Karyawan BUMN','Karyawan BUMD','Karyawan Honorer',
            'Buruh Harian Lepas','Buruh Tani/Perkebunan','Buruh Nelayan/Perikanan','Buruh Peternakan','Pembantu Rumah Tangga','Tukang Cukur','Tukang Listrik',
            'Tukang Batu','Tukang Kayu','Tukang Sol Sepatu','Tukang Las/Pandai Besi','Tukang Jahit','Tukang Gigi','Penata Rambut','Penata Rias','Penata Busana',
            'Mekanik','Seniman','Tabib','Paraji','Perancang Busana','Penterjemah','Imam Masjid','Pendeta','Pastur','Wartawan','Ustadz/Mubaligh','Juru Masak',
            'Promotor Acara','Anggota DPR-RI','Anggota DPD','Anggota BPK','Presiden','Wakil Presiden','Anggota Mahkamah Konstitusi','Anggota Kabinet/Kementerian','Duta Besar',
            'Gubernur','Wakil Gubernur','Bupati','Wakil Bupati','Walikota','Wakil Walikota','Anggota DPRD Propinsi','Anggota DPRD Kabupaten/Kota','Dosen',
            'Guru','Pilot','Pengacara','Notaris','Arsitek','Akuntan','Konsultan','Dokter','Bidan','Perawat','Apoteker','Psikiater/Psikolog','Penyiar Televisi',
            'Penyiar Radio','Pelaut','Peneliti','Sopir','Pialang','Paranormal','Pedagang','Perangkat Desa','Kepala Desa',
            'Biarawati','Wiraswasta','Lainnya'
        );

        if ($id != '') {

            // Get data from model
            $data = $this->db->get_where('tb_kk', array('id_rt' => $id))->result_array();
            
            // Check if data exists
            if ($data) {
                $i = 2;
                foreach ($data as $row) {
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValueExplicit('A'.$i, $row['no_kk'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('B'.$i, $row['nama_kk'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('E'.$i, 'Laki-laki / Perempuan', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('F'.$i, 'Ponorogo', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('G'.$i, 'Islam', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I'.$i, 'SD / SMP / SMA', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J'.$i, 'Pelajar / Mahasiswa', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('K'.$i, 'Belum Kawin', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('L'.$i, 'Kepala Keluarga', PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('M'.$i, 'WNI', PHPExcel_Cell_DataType::TYPE_STRING);

                    // Set date format for "Tanggal Lahir" column
                    $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);

                    
                    $i++;
                }
                
            } else {
                echo "Data not found";
                exit;
            }
        }

        // Set column width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

        // Set header style
        $headerStyleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($headerStyleArray);

        // Set active sheet index to the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Set filename and mime type
        $filename = 'template_excel_anggota.xlsx';
        $mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: ' . $mime_type);
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        exit;
    }

    public function import_excel_anggota() {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules for each field
        $rules = array(
            array(
                'field' => 'excel_file',
                'label' => 'Excel File',
                'rules' => 'callback_validate_excel_anggota',
                'errors' => array(
                    'validate_excel_anggota' => 'The {field} must be a valid Excel file (XLSX or XLS).',
                ),
            ),
        );
        $this->form_validation->set_rules($rules);

        // Run form validation
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, redirect back with error messages
            $pesan = '<script>
                swal({
                    title: "'.form_error('excel_file').'",
                    text: "",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
            </script>';
            $this->session->set_flashdata('pesan', $pesan);
            redirect(base_url('ketua_rt/kepala_keluarga'));
        } else {
            // If validation succeeds, continue with data processing
            // Code to handle file import goes here
            
            // For example:
            $this->process_excel_data_anggota();
        }
    }

    // Callback function to validate Excel file
    public function validate_excel_anggota($str) {
        // Check if file is uploaded
        if (!empty($_FILES['excel_file']['name'])) {
            // Check file extension
            $allowed_extensions = array('xlsx', 'xls');
            $ext = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed_extensions)) {
                $this->form_validation->set_message('validate_excel_anggota', 'The {field} must be a valid Excel file (XLSX or XLS).');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('validate_excel_anggota', 'Please choose an Excel file to upload.');
            return FALSE;
        }

        return TRUE;
    }

    public function process_excel_data_anggota()
    {
        // Load Excel file
        $excelFile = $_FILES['excel_file']['tmp_name'];

        // Load Excel Reader
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($excelFile);
        $worksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        
      // Run form validation before processing data
      $validation_result = $this->form_validation->run();

      // Check if form validation passed
      if ($validation_result) {
        // Loop through each row of the worksheet
       for ($row = 2; $row <= $highestRow; $row++) {
            // Get cell values
            $no_kk      = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
             // Menemukan id_kk berdasarkan no_kk
            $id_kk = $this->db->get_where('tb_kk', array('no_kk' => $no_kk))->row_array()['id_kk'];

            $nik       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $nama      = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $jenis_kelamin = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $tempat_lahir = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $tanggal_lahir = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $agama = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            $pendidikan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            $pekerjaan = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
            $status_perkawinan = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
            $status_hubungan = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
            $kewarganegaraan = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

            $id_rt = $this->session->userdata('id_rt');
            $nama = mb_convert_case($nama, MB_CASE_TITLE, "UTF-8");
            $tempat_lahir = mb_convert_case($tempat_lahir, MB_CASE_TITLE, "UTF-8");
            //format tanggal lahir ke format Y-m-d
            $tgl_lahir = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($tanggal_lahir));

             // Check if NIK is not empty
             if (!empty($nik)) {
                // Check if NIK is already registered
                if ($this->is_nik_registered($nik)) {
                    // If NIK is already registered, set error message and continue to next row
                    $pesan = '<script>
                        swal({
                            title: "NIK '.$nik.' sudah terdaftar",
                            text: "",
                            type: "error",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE"
                            });
                    </script>';
                    $this->session->set_flashdata('pesan', $pesan);
                    continue; // Skip to next row
                }
            } else {
                // If NIK is empty, set error message and continue to next row
                $pesan = '<script>
                    swal({
                        title: "NIK tidak boleh kosong",
                        text: "",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                </script>';
                $this->session->set_flashdata('pesan', $pesan);
                continue; // Skip to next row
            }
        
            // Insert into database
            $SQLinsert = array(
                'id_anggota' => $this->id_anggota_urut(),
                'id_rt' => $id_rt,
                'id_kk' => $id_kk,
                'nik' => $nik,
                'nama' => $nama,
                'jenis_kelamin' => $jenis_kelamin,
                'tempat_lahir' => $tempat_lahir,
                'tgl_lahir' => $tgl_lahir,
                'agama' => $agama,
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'perkawinan' => $status_perkawinan,
                'hubungan' => $status_hubungan,
                'kewarganegaraan' => $kewarganegaraan,
            );

            $cek = $this->m_anggota->add($SQLinsert);

            $SQLUpdate1=array(
                'tgl_update'             =>$this->datetime(),
            );
            $cek=$this->m_kk->update($id_kk,$SQLUpdate1);

            if ($cek == $success_count++) {
                $pesan = '<script>
                            swal({
                                title: "Berhasil Mengimpor Data",
                                text: "",
                                type: "success",
                                showConfirmButton: true,
                                confirmButtonText: "OK"
                            });
                        </script>';
                $this->session->set_flashdata('pesan', $pesan);
                } else {
                $pesan = '<script>
                            swal({
                                title: "Gagal Mengimpor Data",
                                text: "",
                                type: "error",
                                showConfirmButton: true,
                                confirmButtonText: "OK"
                            });
                        </script>';
                $this->session->set_flashdata('pesan', $pesan);
            } 
        }
        
        redirect(base_url('ketua_rt/kepala_keluarga'));
    }
       
    }

    // Function to check if NIK is already registered
    private function is_nik_registered($nik) {
        // Query database to check if NIK is already registered
        $query = $this->db->get_where('tb_anggota', array('nik' => $nik));
        return $query->num_rows() > 0;
    }


    public function export_excel_all()
    {
        // Load PHPExcel library
        $this->load->library('PHPExcel');

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator($this->session->userdata('nama_rt'))
                                    ->setLastModifiedBy($this->session->userdata('nama_rt'))
                                    ->setTitle("Data Kepala Keluarga")
                                    ->setSubject("Data Kepala Keluarga")
                                    ->setDescription("Data Kepala Keluarga")
                                    ->setKeywords("excel template")
                                    ->setCategory("Data");

        // Add data to the Excel file
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValueExplicit('A1', 'No KK', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('B1', 'Nama KK', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('C1', 'No HP', PHPExcel_Cell_DataType::TYPE_STRING)
        ->setCellValueExplicit('D1', 'Alamat', PHPExcel_Cell_DataType::TYPE_STRING);

        // Get data from model
        $data = $this->db->get_where('tb_kk', array('id_rt' => $this->session->userdata('id_rt')))->result_array();

        // Check if data exists
        if ($data) {
            $i = 2;
            foreach ($data as $row) {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueExplicit('A'.$i, $row['no_kk'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('B'.$i, $row['nama_kk'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('C'.$i, $row['no_hp'], PHPExcel_Cell_DataType::TYPE_STRING)
                ->setCellValueExplicit('D'.$i, $row['alamat'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
            }
        } else {
            echo "Data not found";
            exit;
        }

        // Set column width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        // Set header style
        $headerStyleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($headerStyleArray);

        // Set active sheet index to the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Set filename and mime type
        $filename = 'data_kepala_keluarga.xlsx';
        $mime_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: ' . $mime_type);
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        exit;
    }
    
    



  	
}