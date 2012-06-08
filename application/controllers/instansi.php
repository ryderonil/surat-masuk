<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instansi extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('instansi_model');
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
		$colModel['NAMA_INSTANSI'] = array('Nama Instansi',200,TRUE,'center',1);
		$colModel['ALAMAT_INSTANSI'] = array('Alamat Instansi',200,TRUE,'center',1);
		$colModel['STATUS_INSTANSI'] = array('Status',50,TRUE,'center',1);
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
							'title' => 'Master Instansi',
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
		$url = site_url()."/instansi/grid_data_instansi";
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
				location.href= '".base_url()."index.php/instansi/add';    
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
							   url: '".site_url('/instansi/delete')."',
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
	
	function grid_data_instansi() 
	{
		$valid_fields = array('INSTANSI_ID','NAMA_INSTANSI','ALAMAT_INSTANSI','STATUS_INSTANSI');
		$this->flexigrid->validate_post('INSTANSI_ID','asc',$valid_fields);
		$records = $this->instansi_model->grid_instansi();	
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($row->STATUS_INSTANSI == 1)
				{
					$status_instansi = 'Aktif';					
				}
				else
				{
					$status_instansi = 'Tidak Aktif';
				}
			
				$no = $no+1;
				$record_items[] = array(
										$row->INSTANSI_ID,
										$no,
										$row->NAMA_INSTANSI,
										$row->ALAMAT_INSTANSI,
										$status_instansi,
								'<a href='.base_url().'index.php/instansi/edit/'.$row->INSTANSI_ID.'><img border=\'0\' src=\''.base_url().'images/icon/edit.png\'></a>'
								//'<a href='.base_url().'index.php/manajemen_pengguna/delete/'.$row->USER_ID.' onclick="return confirm(\'Are you sure you want to delete?\')"><img border=\'0\' src=\''.base_url().'images/flexigrid/2.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi($edit,$instansi_id)
	{	
		if($edit)
		{
			$callback_instansi = '|callback_cek_instansi_baru['.$instansi_id.']';
		}
		else
		{
			$callback_instansi = '|callback_cek_instansi';
		}
		$this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required'.$callback_instansi);
		
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$data['content'] = $this->load->view('master/form_tambah_instansi',null,true);
		$this->load->view('main',$data);
	}
	
	public function add_process()
	{
		$data = array(
						'NAMA_INSTANSI' => $this->input->post('nama_instansi'),
						'ALAMAT_INSTANSI' => $this->input->post('alamat_instansi'),
						'STATUS_INSTANSI' => '1'
					);
		if($this->cek_validasi(false,null))
		{
			$this->instansi_model->add($data);
			redirect('instansi');
		}
		else
		{
			$this->add();
			//redirect('manajemen_pengguna/add');
		}
	}
	
	public function edit($instansi_id)
	{
		$data = array(
						'NAMA_INSTANSI' => $this->input->post('nama_instansi'),
						'ALAMAT_INSTANSI' => $this->input->post('alamat_instansi'),
						'STATUS_INSTANSI' => $this->input->post('status_instansi')
					);
		if($this->cek_validasi(true,$instansi_id))
		{
			$this->instansi_model->update($instansi_id, $data);
			redirect('instansi');
		}
		else
		{
			$result = $this->instansi_model->get_instansi($instansi_id)->row();
			
			$data['nama_instansi'] = $result->NAMA_INSTANSI;
			$data['status_instansi'] = $result->STATUS_INSTANSI;
			
			$data['content'] = $this->load->view('master/form_edit_instansi',$data,true);
			$this->load->view('main',$data);
		}
	}
	
	public function delete()
	{
		$instansi_id_post_array = explode(",",$this->input->post('items'));
		$msg='';
		
		foreach ($instansi_id_post_array as $id_instansi)
		{	
			if(!$this->instansi_model->cek_referensi($id_instansi))
			{
				$msg ='Proses hapus gagal. Kumpulan yang anda pilih direferensi oleh tabel lain';	
			}
			else if(isset($id_instansi) && $id_instansi != '')
			{
				//$this->log_model->log('HAPUS data KUMPULAN dengan id = '.$id_golongan,$this->session->userdata('id_user'));
				$this->instansi_model->delete($id_instansi);
				$msg ='Kumpulan yang anda pilih berhasil dihapus';
			}
		}	
		$this->output->set_header($this->config->item('ajax_header'));
		$this->output->set_output($msg);
	}
	
	function cek_instansi($value)
	{
		if($this->instansi_model->cek_instansi($value))
		{
			$this->form_validation->set_message('cek_instansi', 'Instansi Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function cek_instansi_baru($value, $instansi_id)
	{
		if($this->instansi_model->cek_instansi_baru($value, $instansi_id))
		{
			$this->form_validation->set_message('cek_instansi_baru', 'Instansi Sudah Ada');
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
