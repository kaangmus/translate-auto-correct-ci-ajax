<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamus extends CI_Controller {

  public function __construct(){
    parent::__construct();    
    $this->load->model('model_admin');
    $this->load->helper('url');
          $this->load->library('Pdf');
    $this->load->helper('form');
 
  }

  public function index()
  {
    // $this->load->view('sidebar',$page);
    $page['active'] = "dashboard";
    $this->load->view('header');
    $this->load->view('sidebar');
        // $this->load->view('sidebar',$page);

    $this->load->view('admin/form_jenis_kendaraan');
    $this->load->view('footer');
    
  }


  public function terjemahkan(){
    // $input='abdi';
    $input=$this->input->post('words');

    $this->db->select('arti');
    $this->db->from('kamus_in');
    $this->db->like('kata',$input);
    $this->db->limit(1);
    $query=$this->db->get();

    if($query->num_rows()==1){
      echo json_encode($query->row());
    }else {
        return false;
    }
    
    }

  

  public function sphell(){
   
  // input misspelled word
  $input = $this->input->post('words');
    // $input = 'carrrot';

  // array of words to check against
  $words  = array('makan','minum','sekolah','mobil','rumah','kampus','nonton',
                  'makanan','jalan','kucing','punya','gratis','kereta','buku','dosen'
                  );
  $shortest = -1;
  foreach ($words as $word) {
      $lev = levenshtein($input, $word);
      if ($lev == 0) {
          $closest = $word;
          $shortest = 0;
          break;
      }
      if ($lev <= $shortest || $shortest < 0) {
          $closest  = $word;
          $shortest = $lev;
      }
  }
  if (!$shortest == 0) {
   echo json_encode($closest); 

  } 
  
  }








}
