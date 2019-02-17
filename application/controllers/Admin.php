<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct(){
    parent::__construct();    
    $this->load->model('model_admin');
    $this->load->helper('url');
          $this->load->library('Pdf');
    $this->load->helper('form');
 
  }

public function contoh()
    {
      $this->load->view('contoh');
    }
  public function cetak_produk($id_transaksi)
    {
      $where=$id_transaksi;
  $data['detail_transaksi'] = $this->model_admin->detail_transaksi2('data_transaksi',$where);
      $this->load->view('admin/transaksi_pdf',$data);
  }

	public function index()
	{
    $page['active'] = "view_admin";
    $this->load->view('sidebar');
    $this->load->view('header');
    $data['kendaraan']=$this->model_admin->view_kendaraan()->result();
    // $this->load->view('sidebar',$page);
    $this->load->view('admin/table_kendaraan',$data);
    $this->load->view('footer');
	}

    public function data_transaksi()
  {
    $page['active'] = "view_admin";
    $this->load->view('sidebar');
    $this->load->view('header');
    $data['daftar_service']=$this->model_admin->view_service()->result();
    // $this->load->view('sidebar',$page);
    $this->load->view('admin/table_service',$data);
    $this->load->view('footer');
  }
  
  public function get_autocomplete(){
    if (isset($_GET['term'])) {
        $result = $this->model_admin->search_pelanggan($_GET['term']);
        if (count($result) > 0) {
        foreach ($result as $row)
          $arr_result[] = array(
          'label' => $row->email,
        );
          echo json_encode($arr_result);
        }
    }
  }

  function search(){
    $email=$this->input->get('email');
    $data['data']=$this->model_admin->search_pelanggan($email);
    $page['active'] = "view_admin";
    $this->load->view('sidebar');
    $this->load->view('header');
    $data['kendaraan']=$this->model_admin->view_kendaraan()->result();
    $this->load->view('admin/form_service',$data);

  }

  public function pelanggan()
  {
    $page['active'] = "view_admin";
    $this->load->view('sidebar');
    $this->load->view('header');
    // $this->load->view('sidebar',$page);
    $this->load->view('admin/tambah_pelanggan');
    // $this->load->view('footer');
  }




  public function select()
  {

    $this->load->view('select2');
  }


  public function form_kendaraan()
  {
    // $this->load->view('sidebar',$page);
    $page['active'] = "dashboard";
    $this->load->view('header');
    $this->load->view('sidebar');
        // $this->load->view('sidebar',$page);

    $this->load->view('admin/form_jenis_kendaraan');
    $this->load->view('footer');
    
  }
  public function pelanggan_baru()
  {
    $data['title']="Tambah Pelanggan Baru";
    $page['active'] = "dashboard";
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('admin/pelanggan_baru',$data);
    $this->load->view('footer');
    
  }
  public function pelanggan_lama()
  {

    $page['active'] = "dashboard";
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('admin/pelanggan_lama');
    $this->load->view('footer');
    
  }




function email_availibility()  
      {  
           $data["title"] = "Codeigniter Tutorial - Check Email availibility using Ajax";  
           $this->load->view("email_availibility", $data);  
      }  
      function check_email_avalibility()  
      {  
           if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  
           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("model_admin");  
                if($this->model_admin->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';  
                }  
           }  
      }

public function add_kendaraan()
  {
    $this->load->helper(array('form','url'));       
      $this->load->library('form_validation');
      $this->load->library('session');
            
      $this->form_validation->set_rules('nama_motor','Nama Motor','required'); 
      $this->form_validation->set_rules('jenis_motor','Jenis Motor','required');  
      $this->form_validation->set_rules('nama_mesin','Nama Mesin','required');           
       
        if ($this->form_validation->run()==TRUE){     
            $data= array(         
                'nama_motor' => $this->input->post('nama_motor', TRUE),
                'jenis_motor' => $this->input->post('jenis_motor', TRUE),
                'nama_mesin' => $this->input->post('nama_mesin', TRUE),
              );
                $this->model_admin->tambah_motor('kendaraan',$data);
                // redirect('admin/view_admin');
        }
       
        else {      
              echo validation_errors(); 
        }
  }

public function add_service()
  {
    $this->load->helper(array('form','url'));       
      $this->load->library('form_validation');
               
       
   
            $data= array(         
                'nama_pelanggan' => $this->input->post('nama_pelanggan', TRUE),
                'email_pelanggan' => $this->input->post('email_pelanggan', TRUE),
                'nomor_plat' => $this->input->post('nomor_plat', TRUE),
                'id_motor' => $this->input->post('id_motor', TRUE),
                'tanggal_service' => date("Y/m/d"),
                'daftar_service' => $this->input->post('daftar_service', TRUE),
                'total_biaya' => $this->input->post('total_biaya', TRUE),
              );
                $this->model_admin->add_service('data_transaksi',$data);
                redirect('index.php/admin/data_transaksi');
                // redirect('admin/view_admin');     
  }


  function insert_pelanggan(){

    $data = array(
     'nama_pelanggan'   => $this->input->post('nama_pelanggan'),
       'email'          => $this->input->post('email')
    );


    $data=$this->model_admin->insert_pelanggan('pelanggan',$data);
    echo json_encode($data);
  }

public function to_pdf()
  {
    $where=1;
    $data['detail_transaksi'] = $this->model_admin->detail_transaksi('data_transaksi',$where)->result();
    
    ob_start();
    $content = $this->load->view('admin/transaksi_pdf',$data);
    $content = ob_get_clean();    
    $this->load->library('html2pdf');
    try
    {
      $html2pdf = new HTML2PDF('L', 'A4', 'fr');
      $html2pdf->pdf->SetDisplayMode('fullpage');
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output('print.pdf');
    }
    catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
    }
    
  }

  public function view_kendaraan()
  {
    $page['active'] = "view_admin";
    $data['admin']=$this->model_admin->view_admin()->result();
    $this->load->view('header');
    $this->load->view('sidebar',$page);
    $this->load->view('admin/view_admin',$data);
    $this->load->view('footer');
  }

public function hapus_kendaraan($id_motor){
    $where = array('id_motor' => $id_motor);
    $this->model_admin->hapus_kendaraan($where,'kendaraan');
    redirect('index.php/admin');
  }

  function edit_kendaraan($id_motor){
    $page['active'] = "form_mhs";
    $where = array('id_motor' => $id_motor);
    $data['field_kendaraan'] = $this->model_admin->edit_kendaraan('kendaraan',$where)->result();
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('admin/edit_kendaraan',$data);
    $this->load->view('footer');
  }


  function detail_transaksi($id_transaksi){
    $page['active'] = "form_mhs";
    $where = array('id_transaksi' => $id_transaksi);
    $data['detail_transaksi'] = $this->model_admin->detail_transaksi('data_transaksi',$where)->result();
    $this->load->view('header');
    $this->load->view('sidebar');
    $this->load->view('admin/detail_transaksi',$data);
    $this->load->view('footer');
  }


public function update_kendaraan()
  {
    $this->load->helper(array('form','url'));       
      $this->load->library('form_validation');
      $this->load->library('session');
      
      $this->form_validation->set_rules('id_motor','Id Motor','required'); 
      $this->form_validation->set_rules('nama_motor','Nama Motor','required'); 
      $this->form_validation->set_rules('jenis_motor','Jenis Motor','required');  
      $this->form_validation->set_rules('nama_mesin','Nama Mesin','required');           
        
     // $this->form_validation->set_rules('photo_profil','','');
      
       
        if ($this->form_validation->run()==TRUE){
     
            $data= array(  
                'id_motor' => $this->input->post('id_motor',TRUE),      
                'nama_motor' => $this->input->post('nama_motor', TRUE),
                'jenis_motor' => $this->input->post('jenis_motor', TRUE),
                'nama_mesin' => $this->input->post('nama_mesin', TRUE),
              );

          $where = array(
            'id_motor' => $this->input->post('id_motor', TRUE)
          );

          $this->model_admin->update_kendaraan($where,$data,'kendaraan');
    redirect('index.php/admin');
        }
       
        else {      
              echo validation_errors(); 
        }
  }

  public function form_service()
  {
    // $this->load->view('sidebar',$page);
    $page['active'] = "dashboard";
    $this->load->view('header');
    $this->load->view('sidebar');
        // $this->load->view('sidebar',$page);

    $this->load->view('admin/form_jenis_service');
    $this->load->view('footer');
    
  }

  public function form_tambah_service()
  {
    // $this->load->view('sidebar',$page);
    $page['active'] = "dashboard";
    $this->load->view('header');
    $this->load->view('sidebar');

        // $this->load->view('sidebar',$page);
    $data['kendaraan']=$this->model_admin->view_kendaraan()->result();

    $this->load->view('admin/form_tambah_service',$data);
    $this->load->view('footer');
    
  }

  public function form_tambah_service1()
  {
    // $this->load->view('sidebar',$page);
    $page['active'] = "dashboard";
    $this->load->view('header');
    $this->load->view('sidebar');

        // $this->load->view('sidebar',$page);
    $data['kendaraan']=$this->model_admin->view_kendaraan()->result();

    $this->load->view('admin/form_tambah_service1',$data);
    $this->load->view('footer');
    
  }


  public function get_layanan_service(){
    $where=$this->input->post('id');
    $data=$this->model_admin->get_layanan_service($where);
    echo json_encode($data);
  }




}
