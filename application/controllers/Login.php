<?php
/*halaman login utama 

author by Ismarianto Putra TEch Programer */

class Login extends CI_controller
{
	
	function __construct()
	{
	parent::__construct();	
  $this->load->helper('url');
  // needed ???
  $this->load->database();
  $this->load->library('session');
  
	$this->load->model('Login_m');
	
	}

   public function index()
   {
   	if(isset($_POST['login'])){
      
      $email=$this->input->post('email');
      $nama=$this->input->post('email');
      $no_hp=$this->input->post('email');
      $password=$this->input->post('password');
     
     //cek data login
     $admin     = $this->Login_m->Admin($email,md5($password));
     $operator  = $this->Login_m->Operator($nama,$email,md5($password));
     $ketua_rt  = $this->Login_m->Ketua_RT($nama,$no_hp,$email,md5($password));
     
     if($admin->num_rows() > 0 ){
        $DataAdmin=$admin->row_array();
        $sessionAdmin = array(
            'admin'    => TRUE,
        	  'id_admin' => $DataAdmin['id_admin'],
            'email'    => $DataAdmin['email'],
            'password' => $DataAdmin['password'],
            'nama'     => $DataAdmin['nama'],
            'level'    => $DataAdmin['level'] 
          );        
     $this->session->set_userdata($sessionAdmin);
     $this->session->set_flashdata('pesan','<div class="btn btn-primary">Anda Berhasil Login .....</div>');
     redirect(base_url('admin/home'));

     }elseif($operator->num_rows() > 0){
        $DataOperator=$operator->row_array();
        $sessionOperator = array(
            'operator'      => TRUE,
            'id_admin'      => $DataOperator['id_admin'],
            'nama'          => $DataOperator['nama'],
            'email'         => $DataOperator['email'],
            'password'      => $DataOperator['password'],
            'level'         => 'operator',
              );
      $this->session->set_userdata($sessionOperator);
      $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
      redirect(base_url('operator/role'));
      
     }elseif($ketua_rt->num_rows() > 0){
        $DataKetuaRT=$ketua_rt->row_array();
        $sessionKetuaRT = array(
            'ketua_rt'      => TRUE,
            'id_rt'         => $DataKetuaRT['id_rt'],
            'no_rt'         => $DataKetuaRT['no_rt'],
            'nama'          => $DataKetuaRT['nama'],
            'no_hp'         => $DataKetuaRT['no_hp'],
            'password'      => $DataKetuaRT['password'],
            'level'         => 'ketua_rt',
              );       
    
     $this->session->set_userdata($sessionKetuaRT);
     $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
     redirect(base_url('ketua_rt/home'));

     }else{
          $pesan='<script>
                  swal({
                      title: "Username / Password Salah Atau Akun Anda Tidak Aktif",
                      type: "error",
                      showConfirmButton: true,
                      confirmButtonText: "OKEE"
                      });
                </script>';
        $this->session->set_flashdata('pesan', $pesan);
       redirect(base_url('login'));

     }
}else{ 
  $x = array(
  	          'judul' =>'Login Aplikasi');
  $this->load->view('login',$x);

}

   }

}
?>