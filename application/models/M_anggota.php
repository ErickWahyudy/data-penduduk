<?php 

/**
* 
*/
class M_anggota extends CI_model
{

private $table = 'tb_anggota';


//mengambil id anggota urut terakhir
public function id_urut($value='')
{ 
  $this->db->select_max('id_anggota');
  $this->db->from ($this->table);
}

public function add($SQLinsert){
  return $this -> db -> insert($this->table, $SQLinsert);
}

public function update($id='',$SQLupdate){
  $this->db->where('id_anggota', $id);
  return $this->db-> update($this->table, $SQLupdate);
}

public function delete($id=''){
  $this->db->where('id_anggota', $id);
  return $this->db-> delete($this->table);
}

}