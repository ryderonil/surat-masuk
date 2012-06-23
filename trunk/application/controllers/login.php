<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
		$this->load->model('user_model');
    }
	
	function index(){
		//$data['content'] = $this->load->view('login','',TRUE);
		if($this->session->userdata('kode_role'))
		{
			redirect('home');
		}
		else
		{
			$this->load->view('login');
		}
	}
	
	function login_ulang()
	{
		echo "<script> alert('Maaf, Anda tidak punya hak untuk mengakses halaman ini. Silakan login terlebih dahulu !!');</script>";	
		$this->index();
	}
	
	function cek_login()
	{
		$this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean|callback_cek_info_login|callback_validate_login');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_message('required', 'Field %s harus diisi');
		
		//cek apakah username dan password sudah diisikan dengan benar
		if ($this->form_validation->run())
		{
			//redirect ('home'); //true gak bisa tapi false kok bisa ??/ //	
			$arr = array("result" => "true");		
		}//end validation
		else
		{
			//$this->index();
			$arr = array("result" => "false");
		}
		echo json_encode($arr);
	}
	
	function cek_info_login($username)
	{
		$user = $this->user_model->cek_username($username);
		
		if (!$user) {
			$this->form_validation->set_message('cek_info_login', 'Invalid Login');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function validate_login()
	{
		$username = $this->input->post('user', TRUE);
		$password = md5($this->input->post('password',TRUE));
		if($username && $password)
		{
			$result = $this->user_model->login($username, $password);
			if($result->num_rows() > 0)
			{
				foreach($result->result() as $row){
					$sess_array = array(
									'username' => $row->USERNAME,
									'login' => TRUE,
									'iduser' => $row->USER_ID,
									'kode_role' => $row->ROLE,
									'dinas_id' => $row->DINAS_ID
									);
					$this->session->set_userdata($sess_array);
				}
				return TRUE;
			}
			//$this->form_validation->set_message('validate_login', 'Invalid username or password');
			return FALSE;
		}
		return FALSE;
	}

	//Memproses logout
	function logout()
	{
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		redirect('login');
	}
}
