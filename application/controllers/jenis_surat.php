<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_surat extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('jenis_surat_model');
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
		$colModel['NAMA_JENIS_SURAT'] = array('Jenis Surat',200,TRUE,'center',1);
		$colModel['STATUS_JENIS_SURAT'] = array('Status',50,TRUE,'center',1);
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
							'title' => 'Master Jenis Surat',
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
		$url = site_url()."/jenis_surat/grid_data_jenis_surat";
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
				location.href= '".base_url()."index.php/jenis_surat/add';    
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
							   url: '".site_url('/jenis_surat/delete')."',
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
	
	function grid_data_jenis_surat() 
	{
		$valid_fields = array('JENIS_SURAT_ID','NAMA_JENIS_SURAT','STATUS_JENIS_SURAT');
		$this->flexigrid->validate_post('JENIS_SURAT_ID','asc',$valid_fields);
		$records = $this->jenis_surat_model->grid_jenis_surat();	
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($row->STATUS_JENIS_SURAT == 1)
				{
					$status_jenis_surat = 'Aktif';					
				}
				else
				{
					$status_jenis_surat = 'Tidak Aktif';
				}
			
				$no = $no+1;
				$record_items[] = array(
										$row->JENIS_SURAT_ID,
										$no,
										$row->NAMA_JENIS_SURAT,
										$status_jenis_surat,
								'<a href='.base_url().'index.php/jenis_surat/edit/'.$row->JENIS_SURAT_ID.'><img border=\'0\' src=\''.base_url().'images/icon/edit.png\'></a>'
								//'<a href='.base_url().'index.php/manajemen_pengguna/delete/'.$row->USER_ID.' onclick="return confirm(\'Are you sure you want to delete?\')"><img border=\'0\' src=\''.base_url().'images/flexigrid/2.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi($edit,$jenis_surat_id)
	{	
		if($edit)
		{
			$callback_jenis_surat = '|callback_cek_jenis_surat_baru['.$jenis_surat_id.']';
		}
		else
		{
			$callback_jenis_surat = '|callback_cek_jenis_surat';
		}
		$this->form_validation->set_rules('jenis_surat', 'Nama Jenis Surat', 'required'.$callback_jenis_surat);
		
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$data['content'] = $this->load->view('master/form_tambah_jenis_surat',null,true);
		$this->load->view('main',$data);
	}
	
	public function add_process()
	{
		$data = array(
						'NAMA_JENIS_SURAT' => $this->input->post('jenis_surat'),
						'STATUS_JENIS_SURAT' => '1'
					);
		if($this->cek_validasi(false,null))
		{
			$this->jenis_surat_model->add($data);
			redirect('jenis_surat');
		}
		else
		{
			$this->add();
			//redirect('manajemen_pengguna/add');
		}
	}
	
	public function edit($jenis_surat_id)
	{
		$data = array(
						'NAMA_JENIS_SURAT' => $this->input->post('jenis_surat'),
						'STATUS_JENIS_SURAT' => $this->input->post('status_jenis_surat')
					);
		if($this->cek_validasi(true,$jenis_surat_id))
		{
			$this->jenis_surat_model->update($jenis_surat_id, $data);
			redirect('jenis_surat');
		}
		else
		{
			$result = $this->jenis_surat_model->get_jenis_surat($jenis_surat_id)->row();
			
			$data['jenis_surat'] = $result->NAMA_JENIS_SURAT;
			$data['status_jenis_surat'] = $result->STATUS_SURAT;
			
			$data['content'] = $this->load->view('master/form_edit_jenis_surat',$data,true);
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
		$jenis_surat_id_post_array = explode(",",$this->input->post('items'));
		$msg='';
		
		foreach ($jenis_surat_id_post_array as $id_jenis_surat)
		{	
			if(!$this->jenis_surat_model->cek_referensi($id_jenis_surat))
			{
				$msg ='Proses hapus gagal. Kumpulan yang anda pilih direferensi oleh tabel lain';	
			}
			else if(isset($id_jenis_surat) && $id_jenis_surat != '')
			{
				//$this->log_model->log('HAPUS data KUMPULAN dengan id = '.$id_golongan,$this->session->userdata('id_user'));
				$this->jenis_surat_model->delete($id_jenis_surat);
				$msg ='Kumpulan yang anda pilih berhasil dihapus';
			}
		}	
		$this->output->set_header($this->config->item('ajax_header'));
		$this->output->set_output($msg);
	}
	
	function cek_jenis_surat($value)
	{
		if($this->jenis_surat_model->cek_jenis_surat($value))
		{
			$this->form_validation->set_message('cek_jenis_surat', 'Jenis Surat Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function cek_jenis_surat_baru($value, $jenis_surat_id)
	{
		if($this->jenis_surat_model->cek_jenis_surat_baru($value, $jenis_surat_id))
		{
			$this->form_validation->set_message('cek_jenis_surat_baru', 'Jenis Surat Sudah Ada');
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
