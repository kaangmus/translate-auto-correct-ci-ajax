<?php 

class M_latihan extends CI_Model{

	//ADMIN

public function insert_data($result = array())
{
	$total_array = count($result); 
	if($total_array != 0){
	$this->db->insert_batch('multiple_data', $result);
	}
}

	public function insert_ajax($table,$data){
		$this->db->insert($table,$data);
	}


}


