<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cari_Penduduk extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // needed ???
        $this->load->database();
        $this->load->library('form_validation');

        $this->load->model('m_penduduk');
    }  
        
    public function index()
    {
     $view = array('judul'  =>'Cari Data Penduduk');
     if (isset($_POST['cari'])) {
        $rules = array(
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama harus diisi',
                ),
            ),
            array(
                'field' => 'tgl_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Tanggal Lahir harus diisi',
                ),
            ),
            array(
                'field' => 'nama_ibu',
                'label' => 'Nama Ibu',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama Ibu harus diisi',
                ),
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('other/penduduk',$view);
        } else {
            $nama      = $this->input->post('nama');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $nama_ibu  = $this->input->post('nama_ibu');
            
            $view = array(
                'judul'    =>'Data Penduduk',
                'data'     => $this->m_penduduk->get_by_nama($nama,$tgl_lahir,$nama_ibu),
                'nama'     => $nama,
                'tgl_lahir'=> $tgl_lahir,
                'nama_ibu' => $nama_ibu,
                'depan'    => TRUE,
            );
            $this->load->view('other/penduduk',$view);
        }
        } else {
            
            $view = array('judul'  =>'Cari Data Penduduk',
                            'depan'  => FALSE,
                        );
            $this->load->view('other/penduduk',$view);     
        }            
        
  
    }
}