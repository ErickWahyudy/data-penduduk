<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
   $this->load->helper('url');
   // needed ???
   $this->load->database();
   $this->load->library('session');
    $this->load->library('spreadsheet'); // Load librari spreadsheetnya
    $this->load->dbutil(); // Load Database Utility Library
    $this->load->helper('file'); // Load File Helper
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
    redirect(base_url(''));
     exit;
	};
   $this->load->model('m_admin'); 
    $this->load->model('m_kk');
}

public function exportExcel()
{
    $data = $this->m_kk->view(); // Ambil data kepala keluarga dari model

    // Buat objek Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set judul kolom
    $sheet->setCellValue('A1', 'No KK');
    $sheet->setCellValue('B1', 'Nama Kepala Keluarga');
    $sheet->setCellValue('C1', 'Alamat');
    $sheet->setCellValue('D1', 'Nomor HP');

    // Isi data ke dalam sheet
    $row = 2;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $row, $item['no_kk']);
        $sheet->setCellValue('B' . $row, $item['nama_kk']);
        $sheet->setCellValue('C' . $row, $item['alamat']);
        $sheet->setCellValue('D' . $row, $item['no_hp']);
        $row++;
    }

    // Simpan ke dalam file
    $filename = 'data_kepala_keluarga.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);

    // Set header untuk mengunduh file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Tampilkan isi file
    $writer->save('php://output');
}


}