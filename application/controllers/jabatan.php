<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('jabatan_model');
		//$this->cek_session();
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
		$colModel['NAMA_JABATAN'] = array('Nama Jabatan',200,TRUE,'center',1);
		$colModel['STATUS_JABATAN'] = array('Status',50,TRUE,'center',1);
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
							'title' => 'Master Jabatan',
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
		$url = site_url()."/jabatan/grid_data_jabatan";
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
				location.href= '".base_url()."index.php/jabatan/add';    
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
							   url: '".site_url('/jabatan/delete')."',
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
	
	function grid_data_jabatan() 
	{
		$valid_fields = array('JABATAN_ID','NAMA_JABATAN','STATUS_JABATAN');
		$this->flexigrid->validate_post('JABATAN_ID','asc',$valid_fields);
		$records = $this->jabatan_model->grid_jabatan();	
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($row->STATUS_JABATAN == 1)
				{
					$status_jabatan = 'Aktif';					
				}
				else
				{
					$status_jabatan = 'Tidak Aktif';
				}
			
				$no = $no+1;
				$record_items[] = array(
										$row->JABATAN_ID,
										$no,
										$row->NAMA_JABATAN,
										$status_jabatan,
								'<a href='.base_url().'index.php/jabatan/edit/'.$row->JABATAN_ID.'><img border=\'0\' src=\''.base_url().'images/icon/edit.png\'></a>'
								//'<a href='.base_url().'index.php/manajemen_pengguna/delete/'.$row->USER_ID.' onclick="return confirm(\'Are you sure you want to delete?\')"><img border=\'0\' src=\''.base_url().'images/flexigrid/2.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi($edit,$jabatan_id)
	{	
		if($edit)
		{
			$callback_jabatan = '|callback_cek_jabatan_baru['.$jabatan_id.']';
		}
		else
		{
			$callback_jabatan = '|callback_cek_jabatan';
		}
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required'.$callback_jabatan);
		
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$data['content'] = $this->load->view('master/form_tambah_jabatan',null,true);
		$this->load->view('main',$data);
	}
	
	public function add_process()
	{
		$data = array(
						'NAMA_JABATAN' => $this->input->post('nama_jabatan'),
						'STATUS_JABATAN' => '1'
					);
		if($this->cek_validasi(false,null))
		{
			$this->jabatan_model->add($data);
			redirect('jabatan');
		}
		else
		{
			$this->add();
			//redirect('manajemen_pengguna/add');
		}
	}
	
	public function edit($jabatan_id)
	{
		$data = array(
						'NAMA_JABATAN' => $this->input->post('nama_jabatan'),
						'STATUS_JABATAN' => $this->input->post('status_jabatan')
					);
		if($this->cek_validasi(true,$jabatan_id))
		{
			$this->jabatan_model->update($jabatan_id, $data);
			redirect('jabatan');
		}
		else
		{
			$result = $this->jabatan_model->get_jabatan($jabatan_id)->row();
			
			$data['nama_jabatan'] = $result->NAMA_JABATAN;
			$data['status_jabatan'] = $result->STATUS_JABATAN;
			
			$data['content'] = $this->load->view('master/form_edit_jabatan',$data,true);
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
		$jabatan_id_post_array = explode(",",$this->input->post('items'));
		$msg='';
		
		foreach ($jabatan_id_post_array as $id_jabatan)
		{	
			if(!$this->jabatan_model->cek_referensi($id_jabatan))
			{
				$msg ='Proses hapus gagal. Kumpulan yang anda pilih direferensi oleh tabel lain';	
			}
			else if(isset($id_jabatan) && $id_jabatan != '')
			{
				//$this->log_model->log('HAPUS data KUMPULAN dengan id = '.$id_golongan,$this->session->userdata('id_user'));
				$this->jabatan_model->delete($id_jabatan);
				$msg ='Kumpulan yang anda pilih berhasil dihapus';
			}
		}	
		$this->output->set_header($this->config->item('ajax_header'));
		$this->output->set_output($msg);
	}
	
	function cek_jabatan($value)
	{
		if($this->jabatan_model->cek_jabatan($value))
		{
			$this->form_validation->set_message('cek_jabatan', 'Jabatan Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function cek_jabatan_baru($value, $jabatan_id)
	{
		if($this->jabatan_model->cek_jabatan_baru($value, $jabatan_id))
		{
			$this->form_validation->set_message('cek_jabatan_baru', 'Jabatan Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
