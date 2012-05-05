<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manajemen_pengguna extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('user_model');
		$this->load->model('jabatan_model');
		$this->cek_session();
	}
	
	function cek_session()
	{	
		$kode_role = $this->session->userdata('kode_role');
		if($kode_role == '' || $kode_role != 1)
		{
			redirect('login/login_ulang');
		}
	}
	
	public function index()
	{
		$this->grid();
	}
	
	public function grid()
	{
		$colModel['no'] = array('No',20,TRUE,'center',0);
		$colModel['NAMA'] = array('Nama',200,TRUE,'center',1);
		$colModel['USERNAME'] = array('Username',150,TRUE,'center',1);
		$colModel['JABATAN'] = array('Jabatan',100,TRUE,'center',1);
		$colModel['EMAIL'] = array('Email',150,TRUE,'center',1);
		$colModel['NO_HP'] = array('No HP',120,TRUE,'center',1);
		$colModel['ROLE'] = array('Role',100,TRUE,'center',1);
		$colModel['STATUS_USER'] = array('Status',50,TRUE,'center',1);
		$colModel['ubah'] = array('Ubah',30,FALSE,'center',0);
		//$colModel['hapus'] = array('Hapus',30,FALSE,'center',0);
			
		//setting konfigurasi pada bottom tool bar flexigrid
		$gridParams = array(
							'width' => 'auto',
							'height' => 330,
							'rp' => 15,
							'rpOptions' => '[15,30,50,100]',
							'pagestat' => 'Menampilkan : {from} ke {to} dari {total} data.',
							'blockOpacity' => 0,
							'title' => 'Manajemen Pengguna',
							'showTableToggleBtn' => false
							);
							
		//menambah tombol pada flexigrid top toolbar
		$buttons[] = array('Tambah','add','spt_js');
		$buttons[] = array('Hapus','delete','spt_js');
		$buttons[] = array('separator');
		$buttons[] = array('Pilih Semua','add','spt_js');
		$buttons[] = array('separator');
		$buttons[] = array('Hapus Pilihan','delete','spt_js');
		$buttons[] = array('separator');
		
				
		// mengambil data dari file controler ajax pada method grid_user		
		$url = site_url()."/manajemen_pengguna/grid_data_pengguna";
		$grid_js = build_grid_js('user',$url,$colModel,'ID','asc',$gridParams,$buttons);
		$data['js_grid'] = $grid_js;
		$data['added_js'] = 
		"<script type='text/javascript'>
		function spt_js(com,grid){
			if (com=='Pilih Semua')
			{
				$('.bDiv tbody tr',grid).addClass('trSelected');
			}
			if (com=='Tambah'){
				location.href= '".base_url()."index.php/manajemen_pengguna/add';    
			}
			if (com=='Hapus Pilihan')
			{
				$('.bDiv tbody tr',grid).removeClass('trSelected');
			}
			if (com=='Hapus')
				{
				   if($('.trSelected',grid).length>0){
					   if(confirm('Anda yakin ingin menghapus ' + $('.trSelected',grid).length + ' buah data?')){
							var items = $('.trSelected',grid);
							var itemlist ='';
							for(i=0;i<items.length;i++){
								itemlist+= items[i].id.substr(3)+',';
							}
							$.ajax({
							   type: 'POST',
							   url: '".site_url('/manajemen_pengguna/delete')."',
							   data: 'items='+itemlist,
							   success: function(data){
								$('#user').flexReload();
								alert(data);
							   }
							});
						}
					} else {
						return false;
					} 
				}        
		} </script>";
			
		//$data['added_js'] variabel untuk membungkus javascript yang dipakai pada tombol yang ada di toolbar atas
		$data['content'] = $this->load->view('grid',$data,true);
		$this->load->view('main',$data);
	}
	
	function grid_data_pengguna() 
	{
		$valid_fields = array('USER_ID','JABATAN_ID','NAMA','USERNAME','PASSWORD','EMAIL','NO_HP','STATUS_USER','ROLE');
		$this->flexigrid->validate_post('USER_ID','asc',$valid_fields);
		$records = $this->user_model->grid_user();
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($row->STATUS_USER == 1)
				{
					$status_user = 'Aktif';					
				}
				else
				{
					$status_user = 'Tidak Aktif';
				}
				
				if($row->ROLE == 1)
				{
					$role = 'Administrator';
				}
				else if($row->ROLE == 2)
				{
					$role = 'Asisten';
				}
				else if($row->ROLE == 3)
				{
					$role = 'Sekretaris';
				}
				else if($row->ROLE == 4)
				{
					$role = 'Wakil Bupati';
				}
				else if($row->ROLE == 5)
				{
					$role = 'Bupati';
				}
				else
				{
					$role = 'Dinas';
				}
				$no = $no+1;
				$record_items[] = array(
										$row->USER_ID,
										$no,
										$row->NAMA,
										$row->USERNAME,
										$row->NAMA_JABATAN,
										$row->EMAIL,
										$row->NO_HP,
										$role,
										$status_user,
								'<a href='.base_url().'index.php/manajemen_pengguna/edit/'.$row->USER_ID.'><img border=\'0\' src=\''.base_url().'images/icon/edit.png\'></a>'
								//'<a href='.base_url().'index.php/manajemen_pengguna/delete/'.$row->USER_ID.' onclick="return confirm(\'Are you sure you want to delete?\')"><img border=\'0\' src=\''.base_url().'images/flexigrid/2.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi($edit,$user_id)
	{	
		if($edit)
		{
			$callback_username = '|callback_cek_username_baru['.$user_id.']';
			$password = '';
			$konfirmasi_password = '';
		}
		else
		{
			$callback_username = '|callback_cek_username';
			$password = 'required';
			$konfirmasi_password = '|required';
		}
		$this->form_validation->set_rules('nama', 'Nama User', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required'.$callback_username);
		$this->form_validation->set_rules('grup', 'Grup Pengguna', 'callback_cek_dropdown');
		//$this->form_validation->set_rules('jabatan', 'Jabatan', 'callback_cek_dropdown');
		$this->form_validation->set_rules('email', 'Alamat Email', 'required|valid_email');
		$this->form_validation->set_rules('handphone', 'No HP', 'required|numeric');
		$this->form_validation->set_rules('password', 'Password', $password);
		$this->form_validation->set_rules('ulangi_password', 'Konfirmasi Password', 'callback_cek_password_ulang'.$konfirmasi_password);
		
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		$this->form_validation->set_message('matches', 'Kolom %s tidak sesuai dengan isian password !!');
		$this->form_validation->set_message('valid_email', 'Masukkan alamat email sesuai format');
		$this->form_validation->set_message('numeric', 'Masukkan hanya angka');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$jabatan = $this->jabatan_model->get_all_jabatan();
		//$hasil[0] = '-- Pilih Jabatan --';
		foreach($jabatan->result() as $row){
			$hasil[$row->JABATAN_ID] = $row->NAMA_JABATAN;
		}
		$data['jabatan'] = $hasil;
		$data['content'] = $this->load->view('user/form_tambah_pengguna',$data,true);
		$this->load->view('main',$data);
	}
	
	public function add_process()
	{
		$data = array(
						'NAMA' => $this->input->post('nama'),
						'USERNAME' => $this->input->post('username'),
						'ROLE' => $this->input->post('grup'),
						'JABATAN_ID' => $this->input->post('jabatan'),
						'EMAIL' => $this->input->post('email'),
						'NO_HP' => $this->input->post('handphone'),
						'PASSWORD' => md5($this->input->post('password')),
						'STATUS_USER' => '1'
					);
		if($this->cek_validasi(false,null))
		{
			if(!$this->jabatan_model->cek_jabatan2($data['JABATAN_ID']))
			{
				$data_jabatan = array(
										'NAMA_JABATAN' => $data['JABATAN_ID'],
										'STATUS_JABATAN' => 1
									);
				$this->jabatan_model->add($data_jabatan);
				$data['JABATAN_ID'] = $this->jabatan_model->get_last_jabatan_id()->row()->JABATAN_ID;
			}
			$this->user_model->add($data);
			redirect('manajemen_pengguna');
		}
		else
		{
			$this->add();
			//redirect('manajemen_pengguna/add');
		}
	}
	
	public function edit($userid)
	{
		$password = $this->user_model->get_user($userid)->row()->PASSWORD;
		if($this->input->post('password')!='') $password = md5($this->input->post('password'));
		$data = array(
						'NAMA' => $this->input->post('nama'),
						'USERNAME' => $this->input->post('username'),
						'ROLE' => $this->input->post('grup'),
						'JABATAN_ID' => $this->input->post('jabatan'),
						'EMAIL' => $this->input->post('email'),
						'NO_HP' => $this->input->post('handphone'),
						'PASSWORD' => $password,
						'STATUS_USER' => $this->input->post('status_user')
					);
		if($this->cek_validasi(true,$userid))
		{
			if(!$this->jabatan_model->cek_jabatan2($data['JABATAN_ID']))
			{
				$data_jabatan = array(
										'NAMA_JABATAN' => $data['JABATAN_ID'],
										'STATUS_JABATAN' => 1
									);
				$this->jabatan_model->add($data_jabatan);
				$data['JABATAN_ID'] = $this->jabatan_model->get_last_jabatan_id()->row()->JABATAN_ID;
			}
			$this->user_model->update($userid, $data);
			redirect('manajemen_pengguna');
		}
		else
		{
			$result = $this->user_model->get_user($userid)->row();
			$jabatan = $this->jabatan_model->get_all_jabatan();
			$hasil[0] = '-- Pilih Jabatan --';
			foreach($jabatan->result() as $row){
				$hasil[$row->JABATAN_ID] = $row->NAMA_JABATAN;
			}
			$data['jabatan'] = $hasil;
			$data['nama'] = $result->NAMA;
			$data['username'] = $result->USERNAME;
			$data['grup_dipilih'] = $result->ROLE;
			$data['jabatan_dipilih'] = $result->JABATAN_ID;
			$data['email'] = $result->EMAIL;
			$data['handphone'] = $result->NO_HP;
			$data['status_user'] = $result->STATUS_USER;
			
			$data['content'] = $this->load->view('user/form_edit_pengguna',$data,true);
			$this->load->view('main',$data);
		}
	}
	
	public function delete_1($userid)
	{
		$this->user_model->delete($userid);
		redirect('master_pengguna');
	}
	
	public function delete()
	{
		$pengguna_id_post_array = explode(",",$this->input->post('items'));
		$msg='';
		
		foreach ($pengguna_id_post_array as $id_pengguna)
		{	
			if(!$this->user_model->cek_referensi($id_pengguna))
			{
				$msg ='Proses hapus gagal. Kumpulan yang anda pilih direferensi oleh tabel lain';	
			}
			else if(isset($id_pengguna) && $id_pengguna != '')
			{
				//$this->log_model->log('HAPUS data KUMPULAN dengan id = '.$id_golongan,$this->session->userdata('id_user'));
				$this->user_model->delete($id_pengguna);
				$msg ='Kumpulan yang anda pilih berhasil dihapus';
			}
		}	
		$this->output->set_header($this->config->item('ajax_header'));
		$this->output->set_output($msg);
	}
	
	function cek_dropdown($value)
	{
		if($value == 0)
		{
			$this->form_validation->set_message('cek_dropdown', 'Kolom %s harus dipilih!!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function cek_username($value)
	{
		if($this->user_model->cek_username($value))
		{
			$this->form_validation->set_message('cek_username', 'Username Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function cek_username_baru($value, $user_id)
	{
		if($this->user_model->cek_username_baru($value, $user_id))
		{
			$this->form_validation->set_message('cek_username_baru', 'Username Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function cek_password_ulang($value){
		if($value != $this->input->post('password')){
			$this->form_validation->set_message('cek_password_ulang', 'Kolom %s harus sama!!');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
