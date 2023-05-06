<?php 
/*model design by Ismarianto Putra Tech Programing
 * http://minangopensource.blogspot.com 
 *
 *
*/
class login_m extends CI_model
{
	
 public function admin($email='',$password='')
 {
  return $this->db->query("SELECT * from tb_admin where email='$email' AND password='$password' limit 1");
 }

 public function ketua_rt($nama='', $no_hp='', $email='', $password='')
 {
  return $this->db->query("SELECT * from tb_rt where (nama_rt='$nama' OR no_hp='$no_hp' OR email='$email') AND password='$password' limit 1");
 }


}