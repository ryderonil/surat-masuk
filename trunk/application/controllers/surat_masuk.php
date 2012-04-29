<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->model('surat_masuk_model');
		$this->load->model('instansi_model');
		$this->load->model('jenis_surat_model');
		$this->cek_session();
	}
	
	function cek_session()
	{	
		$kode_role = $this->session->userdata('kode_role');
		if($kode_role == '')
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
	
	function cek_validasi($sifat)
	{	
		if($sifat == '1')
		{
			$this->form_validation->set_rules('tgl_terima', 'Tanggal Terima', 'required');
			$this->form_validation->set_rules('nomor', 'Nomor Surat', 'required|callback_cek_nomor');
			$this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
			$this->form_validation->set_rules('pejabat', 'Kepada', 'callback_cek_dropdown');
			$this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'required');
			$this->form_validation->set_rules('lampiran', 'Lampiran Surat', 'required');
		}
		else if($sifat == '2')
		{
			$this->form_validation->set_rules('tgl_terima', 'Tanggal Terima', 'required');
			$this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
		}
		
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		return $this->form_validation->run();
	}
	
	public function add()
	{
		$result1 = $this->instansi_model->get_all_instansi();
		$result2 = $this->jenis_surat_model->get_all_jenis_surat();
		foreach($result1->result() as $row1)
		{
			$instansi[$row1->INSTANSI_ID] = $row1->NAMA_INSTANSI;
		}
		$data['instansi'] = $instansi;
		foreach($result2->result() as $row2)
		{
			$jenis_surat[$row2->JENIS_SURAT_ID] = $row2->NAMA_JENIS_SURAT;
		}
		$data['jenis_surat'] = $jenis_surat;
		$data['pejabat'] = array(
									'0' => '-- Pilih Pejabat --',
									'1' => 'Asisten',
									'2' => 'Sekretaris',
									'3' => 'Wakil Bupati',
									'4' => 'Bupati',
									'5' => 'Dinas'
							);
		$data['content'] = $this->load->view('form_catat_surat_masuk',$data,true);
		$this->load->view('main',$data);
	}
	
	public function tes()
	{
		$result2 = $this->jenis_surat_model->get_all_jenis_surat();
		foreach($result2->result() as $row2)
		{
			$jenis_surat[$row2->JENIS_SURAT_ID] = $row2->NAMA_JENIS_SURAT;
		}
		$data['jenis_surat'] = $jenis_surat;
		$data['content'] = $this->load->view('tes',$data,true);
		$this->load->view('main',$data);
	}
	
	public function tes_process()
	{
		$data = array(
						'NAMA_JENIS_SURAT' => $this->input->post('jenis_surat')
					);
		
		$this->jenis_surat_model->addtes($data);
		redirect('jenis_surat');
	}
	
	public function add_process()
	{
		$temp_nomor = rand();
		while($this->surat_masuk_model->cek_nomor($temp_nomor))
		{
			$temp_nomor = rand();
		}
		if($this->input->post('perlakuan') == 1)
		{
			$kirim = 1;
		}
		else if($this->input->post('perlakuan') == 2)
		{
			$kirim = 2;
		}
		else
		{
			$kirim = 0;
		}
		$sifat = $this->input->post('sifat');
		$tgl_terima = $this->input->post('tgl_terima');
		$bln_terima = $this->input->post('bln_terima');
		$thn_terima = $this->input->post('thn_terima');
		$tanggal_terima = $thn_terima.'-'.$bln_terima.'-'.$tgl_terima;
		$tgl_surat = $this->input->post('tgl_surat');
		$bln_surat = $this->input->post('bln_surat');
		$thn_surat = $this->input->post('thn_surat');
		$tanggal_surat = $thn_surat.'-'.$bln_surat.'-'.$tgl_surat;
		$files_available = array();
		$files_max = 10;
		for ( $i=0; $i<$files_max; $i++ )
		{
			if(isset($_FILES['userfile'.$i]) && !empty($_FILES['userfile'.$i]['name']))
			{
				array_push($files_available,'userfile'.$i);
			}
		}
		if($sifat == 1)
		{
			$data = array(
						'SIFAT' 							 => $this->input->post('sifat'),
						'NOMOR'							     => $this->input->post('nomor'),
						'TGL_TERIMA' 		 				 => $tanggal_terima,
						'JENIS_SURAT_ID'	 				 => $this->input->post('jenis_surat'),
						'INSTANSI_ID' 		 				 => $this->input->post('instansi'),
						'PERIHAL' 			 				 => $this->input->post('perihal'),
						'KEPADA' 		    			     => $this->input->post('pejabat'),
						'TGL_SURAT' 		 				 => $tanggal_surat,
						'LAMPIRAN' 		 					 => $this->input->post('lampiran'),
						'CATATAN_TERIMA_SURAT_MASUK' 		 => $this->input->post('catatan'),
						'DATE_CREATED' 		 				 => date("Y-m-j G:i:s"),
						'KIRIM' 		 				 	 => $kirim
					);
		}
		else if($sifat == 2)
		{
			$data = array(
						'SIFAT' 			 => $this->input->post('sifat'),
						'NOMOR' 			 => $temp_nomor,
						'TGL_TERIMA' 		 => $tanggal_terima,
						'JENIS_SURAT_ID' 	 => $this->input->post('jenis_surat'),
						'INSTANSI_ID' 		 => $this->input->post('instansi'),
						'PERIHAL' 		 	 => $this->input->post('perihal'),
						'DATE_CREATED' 		 => date("Y-m-j G:i:s")
					);
		}
		
		if($this->cek_validasi($sifat))
		{
			$this->surat_masuk_model->add($data);
			$surat_masuk_id = $this->surat_masuk_model->get_max_surat_masuk_id()->row()->SURAT_MASUK_ID;
			for($i=0;$i<count($files_available);$i++)
			{
				$field_name = 'userfile'.$i;
				$surat[$i] = $this->upload_surat($field_name);
				if($surat[$i] != "")
				{
					$data_file = array(
										'SURAT_MASUK_ID' 	=> $surat_masuk_id,
										'PATH_FILE' 		=> $surat[$i][0],
										'NAMA_FILE' 		=> $surat[$i][1]
					);
					$this->surat_masuk_model->add2($data_file);
				}
			}
			echo 'sukses';
			//redirect('surat_masuk');
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
	
	function upload_surat($field_name)
	{	
		$config['upload_path'] = "uploads/surat";
		$config['allowed_types'] ='doc|docx|pdf|txt';
		
		$this->load->library('upload', $config);		
		$files = $this->upload->do_upload($field_name);	
				
		$out = '';		
		if (  ! $files ){
			$out .= array('error' => $this->upload->display_errors());
			return "";
		}	
		else{
			$data = $this->upload->data($field_name);
			$file_name = $data['file_name'];
			$path[0] = 'uploads/surat/'.$file_name;
			$path[1] = $file_name;
			return $path;
		}
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
	
	function cek_nomor($value)
	{
		if($this->surat_masuk_model->cek_nomor($value))
		{
			$this->form_validation->set_message('cek_nomor', 'Nomor Surat Sudah Ada');
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
