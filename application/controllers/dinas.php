<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dinas extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('dinas_model');
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
		$colModel['NAMA_DINAS'] = array('Nama Dinas',200,TRUE,'center',1);
		$colModel['SINGKATAN'] = array('Singkatan',150,TRUE,'center',1);
		$colModel['STATUS_DINAS'] = array('Status',50,TRUE,'center',1);
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
							'title' => 'Master Dinas',
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
		$url = site_url()."/dinas/grid_data_dinas";
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
				location.href= '".base_url()."index.php/dinas/add';    
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
							   url: '".site_url('/dinas/delete')."',
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
	
	function grid_data_dinas() 
	{
		$valid_fields = array('DINAS_ID','NAMA_DINAS','SINGKATAN','STATUS_DINAS');
		$this->flexigrid->validate_post('DINAS_ID','asc',$valid_fields);
		$records = $this->dinas_model->grid_dinas();	
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($row->STATUS_DINAS == 1)
				{
					$status_dinas = 'Aktif';					
				}
				else
				{
					$status_dinas = 'Tidak Aktif';
				}
			
				$no = $no+1;
				$record_items[] = array(
										$row->DINAS_ID,
										$no,
										$row->NAMA_DINAS,
										$row->SINGKATAN,
										$status_dinas,
								'<a href='.base_url().'index.php/dinas/edit/'.$row->DINAS_ID.'><img border=\'0\' src=\''.base_url().'images/icon/edit.png\'></a>'
								//'<a href='.base_url().'index.php/manajemen_pengguna/delete/'.$row->USER_ID.' onclick="return confirm(\'Are you sure you want to delete?\')"><img border=\'0\' src=\''.base_url().'images/flexigrid/2.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi($edit,$dinas_id)
	{	
		if($edit)
		{
			$callback_dinas = '|callback_cek_dinas_baru['.$dinas_id.']';
		}
		else
		{
			$callback_dinas = '|callback_cek_dinas';
		}
		$this->form_validation->set_rules('singkatan', 'Singkatan', 'required');
		$this->form_validation->set_rules('nama_dinas', 'Nama Dinas', 'required'.$callback_dinas);
		
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$data['content'] = $this->load->view('master/form_tambah_dinas',null,true);
		$this->load->view('main',$data);
	}
	
	public function add_process()
	{
		$data = array(
						'NAMA_DINAS' => $this->input->post('nama_dinas'),
						'SINGKATAN' => $this->input->post('singkatan'),
						'STATUS_DINAS' => '1'
					);
		if($this->cek_validasi(false,null))
		{
			$this->dinas_model->add($data);
			redirect('dinas');
		}
		else
		{
			$this->add();
			//redirect('manajemen_pengguna/add');
		}
	}
	
	public function edit($dinas_id)
	{
		$data = array(
						'NAMA_DINAS' => $this->input->post('nama_dinas'),
						'SINGKATAN' => $this->input->post('singkatan'),
						'STATUS_DINAS' => $this->input->post('status_dinas')
					);
		if($this->cek_validasi(true,$dinas_id))
		{
			$this->user_model->update($dinas_id, $data);
			redirect('dinas');
		}
		else
		{
			$result = $this->dinas_model->get_dinas($dinas_id)->row();
			
			$data['singkatan'] = $hasil->SINGKATAN;
			$data['nama_dinas'] = $result->NAMA_DINAS;
			$data['status_dinas'] = $result->STATUS_DINAS;
			
			$data['content'] = $this->load->view('master/form_edit_dinas',$data,true);
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
		$dinas_id_post_array = explode(",",$this->input->post('items'));
		$msg='';
		
		foreach ($dinas_id_post_array as $id_dinas)
		{	
			if(!$this->dinas_model->cek_referensi($id_dinas))
			{
				$msg ='Proses hapus gagal. Kumpulan yang anda pilih direferensi oleh tabel lain';	
			}
			else if(isset($id_dinas) && $id_dinas != '')
			{
				//$this->log_model->log('HAPUS data KUMPULAN dengan id = '.$id_golongan,$this->session->userdata('id_user'));
				$this->dinas_model->delete($id_dinas);
				$msg ='Kumpulan yang anda pilih berhasil dihapus';
			}
		}	
		$this->output->set_header($this->config->item('ajax_header'));
		$this->output->set_output($msg);
	}
	
	function cek_dinas($value)
	{
		if($this->dinas_model->cek_dinas($value))
		{
			$this->form_validation->set_message('cek_dinas', 'Dinas Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function cek_dinas_baru($value, $dinas_id)
	{
		if($this->dinas_model->cek_dinas_baru($value, $dinas_id))
		{
			$this->form_validation->set_message('cek_dinas_baru', 'Dinas Sudah Ada');
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
