<?php 

class Model_Admin extends CI_Model{

	
	//ADMIN

	public function tambah_motor($table,$data){
		$this->db->insert($table,$data);
	}

	public function add_service($table,$data){
		$this->db->insert($table,$data);
	}
public function insert_pelanggan($table,$data){
		$this->db->insert($table,$data);
	}
	public function view_kendaraan(){
		return $this->db->get('kendaraan');
	}

	public function view_service(){
		return $this->db->get('data_transaksi');
	}

	public	function hapus_kendaraan($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

      function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("pelanggan");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }

	public function search_pelanggan($email){
		$this->db->like('email', $email , 'both');
		$this->db->order_by('email', 'ASC');
		$this->db->limit(10);
		return $this->db->get('pelanggan')->result();
	}

	function edit_kendaraan($table,$where){		
	return $this->db->get_where($table,$where);
	}
	function detail_transaksi($table,$where){		
	return $this->db->get_where($table,$where);
	}

	public function detail_transaksi2($table,$where)
	{
		$this->db->where('id_transaksi',$where);
		$query=$this->db->get($table);
		return $query->result_array();
	}

	public function update_kendaraan($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function cek_email($email){
		$this->db->where('email',$email);
		$query=$this->db->get('pelanggan');
		 if($query->num_rows() > 0){
		 	return TRUE;
		 } else {
		 	return FALSE;
		 }
	}


	function get_layanan_service($where){		
	$hasil=$this->db->query("SELECT nama_service, harga FROM layanan_service  WHERE  id_motor='$where'");
		return $hasil->result();
	}






	// MAHASISWA
	public function insert_mhs($table,$data){
		$this->db->insert($table,$data);
	}

	public function view_mhs(){
		$status = 'aktif';
		return $this->db->get_where('mahasiswa',array('status' => $status));
	}

	public function view_alumni(){
		$status = 'alumni';
		return $this->db->get_where('mahasiswa',array('status' => $status));
	}

	public function view_nonaktif(){
		$status = 'non_aktif';
		return $this->db->get_where('mahasiswa',array('status' => $status));
	}

	public	function hapus_mhs($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

	function edit_mhs($table,$where){		
	return $this->db->get_where($table,$where);
	}

	function update_mhs($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

 	//Presensi
 	public function view_tahun(){
 		$this->db->select('tahun_masuk');
 		$this->db->group_by('tahun_masuk'); 
 		$this->db->from('mahasiswa');
 		return $this->db->get();
	}
 	
 	public function list_mahasiswa($tahun)
 	{
 		// $this->db->select('tahun_masuk');
 		// $this->db->from('mahasiswa');
 		// $this->db->where($tahun);
 		// return $this->db->get();
 	$SQL ="SELECT * FROM `mahasiswa` WHERE `tahun_masuk` = $tahun";
 	return $this->db->query($SQL);
	}
 	
	public function insert_presensi($result = array())
{
	$total_array = count($result); 
	if($total_array != 0){
	$this->db->insert_batch('presensi', $result);
	}
}


	//DOSEN

	public function insert_dosen($table,$data){
		$this->db->insert($table,$data);
	}

	public function view_dosen(){
		return $this->db->get('dosen');
	}

	public	function hapus_dosen($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

	function edit_dosen($table,$where){		
	return $this->db->get_where($table,$where);
	}

	function update_dosen($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


	// JURUSAN

	public function view_jurusan(){
		return $this->db->get('jurusan');
	}

	public function insert_jurusan($table,$data){
		$this->db->insert($table,$data);
	}

	public	function hapus_jurusan($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

	function edit_jurusan($table,$where){		
	return $this->db->get_where($table,$where);
	}

	function update_jurusan($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


	//FAKULTAS
	public function view_fakultas(){
		return $this->db->get('fakultas');
	}

	public	function hapus_fakultass($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}


	public function insert_fakultas($table,$data){
		$this->db->insert($table,$data);
	}

	function edit_fakultas($table,$where){		
	return $this->db->get_where($table,$where);
	}

	function update_fakultas($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


	//JADWAL

	public function view_jadwal(){
		return $this->db->get('jadwal');
	}

	public function insert_jadwal($table,$data){
		$this->db->insert($table,$data);
	}


	public	function hapus_jadwall($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}
	
	function edit_jadwall($table,$where){		
	return $this->db->get_where($table,$where);
	}

	function update_jadwall($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function get_jadwal($id){
		$hasil=$this->db->query("SELECT id_jadwal, nama_matkul, hari, pukul FROM jadwal, matakuliah WHERE jadwal.id_matkul=matakuliah.id_matkul AND jadwal.id_semester='$id'");
		return $hasil->result();
	}

	function get_detailjadwal($id){
		$hasil=$this->db->query("SELECT id_jadwal, id_matkul, id_semester FROM jadwal  WHERE  id_jadwal='$id'");
		return $hasil->result();
	}

	function view_presensi_all($id){
		$hasil=$this->db->query("SELECT id_presensi, nama_mhs, nama_matkul, H1,H2,H3,H4,H5,H6,H7,H8,H9,H10, semester, tahun_ajaran FROM presensi, semester, matakuliah, mahasiswa  WHERE  presensi.id_matkul=matakuliah.id_matkul AND presensi.id_mahasiswa=mahasiswa.id_mahasiswa AND presensi.id_semester=semester.id_semester  AND presensi.id_jadwal='$id'");
		return $hasil->result();
	}

	//AKSES NILAI
	public function view_aksesnilai(){
		return $this->db->get('akses_nilai');
	}

	public function insert_aksesnilai($table,$data){
		$this->db->insert($table,$data);
	}


	//MATKUL
	public function view_matkul(){
		return $this->db->get('matakuliah');
	}

	public	function hapus_matkul($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}


	public function insert_matkul($table,$data){
		$this->db->insert($table,$data);
	}

	function edit_matkul($table,$where){		
	return $this->db->get_where($table,$where);
	}

	function update_matkul($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


	//SEMESTER
	public function view_semester(){
		return $this->db->get('semester');
	}

	function edit_semester($table,$where){		
	return $this->db->get_where($table,$where);
	}


	public	function hapus_semester($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

	function update_semester($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


	//RUANGAN

	public function view_ruangan(){
		return $this->db->get('ruangan');
	}

	public function insert_ruangan($table,$data){
		$this->db->insert($table,$data);
	}

public	function hapus_ruangan($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

	function edit_ruangan($table,$where){		
	return $this->db->get_where($table,$where);
	}

	function update_ruangan($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


}