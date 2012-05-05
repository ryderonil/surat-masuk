<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');	
		$this->load->helper('flexigrid');
		$this->load->helper('download');
		$this->load->model('surat_masuk_model');
		$this->load->model('instansi_model');
		$this->load->model('jenis_surat_model');
		$this->load->model('dinas_model');
		$this->load->model('user_model');
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
		$kode_role = $this->session->userdata('kode_role');
		$colModel['no'] = array('No',20,TRUE,'center',0);
		$colModel['TGL_TERIMA'] = array('Tanggal Terima',100,TRUE,'center',1);
		$colModel['NOMOR'] = array('Nomor',100,TRUE,'center',1);
		$colModel['PERIHAL'] = array('Perihal',200,TRUE,'center',1);
		if($kode_role == 1) $colModel['kirim_ke_sekretaris'] = array('Kirim ke Sekretaris',90,FALSE,'center',0);
		if($kode_role == 2 || $kode_role == 3) $colModel['kirim_ke_bupati'] = array('Kirim ke Bupati',70,FALSE,'center',0);
		if($kode_role == 2 || $kode_role == 3 || $kode_role == 4 || $kode_role == 5 ) $colModel['disposisi'] = array('Disposisi',60,FALSE,'center',0);
		if($kode_role == 1) $colModel['status_terima_sekretaris'] = array('Status Periksa Sekretaris',150,FALSE,'center',0);
		if($kode_role == 2 || $kode_role == 3) $colModel['status_terima_bupati'] = array('Status Periksa Bupati',150,FALSE,'center',0);
		if($kode_role == 2 || $kode_role == 3 || $kode_role == 4 || $kode_role == 5)
		{
			$colModel['status_terima_dinas'] = array('Status Periksa Dinas',150,FALSE,'center',0);
		}
		if($kode_role == 6)
		{
			$colModel['disposisi_ke'] = array('Disposisi ke Dinas',250,FALSE,'center',0);
			$colModel['komentar'] = array('Komentar',60,FALSE,'center',0);
		}
		$colModel['detail'] = array('Detail',40,FALSE,'center',0);
		if($kode_role == 1) $colModel['ubah'] = array('Ubah',30,FALSE,'center',0);
			
		//setting konfigurasi pada bottom tool bar flexigrid
		$gridParams = array(
							'width' => 'auto',
							'height' => 330,
							'rp' => 15,
							'rpOptions' => '[15,30,50,100]',
							'pagestat' => 'Menampilkan : {from} ke {to} dari {total} data.',
							'blockOpacity' => 0,
							'title' => 'Daftar Surat Masuk',
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
		$url = site_url()."/surat_masuk/grid_data_surat_masuk";
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
				location.href= '".base_url()."index.php/surat_masuk/add';    
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
							   url: '".site_url('/surat_masuk/delete')."',
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
	
	function grid_data_surat_masuk() 
	{
		$kode_role = $this->session->userdata('kode_role');
		$valid_fields = array('SURAT_MASUK_ID','NOMOR','PERIHAL','TGL_TERIMA');
		$this->flexigrid->validate_post('surat_masuk.SURAT_MASUK_ID','asc',$valid_fields);
		if($kode_role == 6)
			$records = $this->surat_masuk_model->grid_surat_masuk_dinas();	
		else
			$records = $this->surat_masuk_model->grid_surat_masuk($kode_role);	
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($row->DISPOSISI == 0)
				{
					$disposisi = '<a href='.base_url().'index.php/surat_masuk/disposisi/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/disposisi.png\'></a>';
				}
				else if($row->DISPOSISI == 1)
				{
					$disposisi = '<img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'>';
				}
				
				switch($row->KIRIM_SEKRETARIS)
				{
					case 0:
						$kirim1 = '<a href='.base_url().'index.php/surat_masuk/kirim_ke_sekretaris/'.$row->SURAT_MASUK_ID.' onclick="return confirm(\'Anda yakin ingin mengirim?\')"><img border=\'0\' src=\''.base_url().'images/icon/email-send.png\'></a>'; 
						break;
					case 1:
						$kirim1 = '<img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'>';
						break;
				}
				
				switch($row->KIRIM_BUPATI)
				{
					case 0:
						$kirim2 = '<a href='.base_url().'index.php/surat_masuk/kirim_ke_bupati/'.$row->SURAT_MASUK_ID.' onclick="return confirm(\'Anda yakin ingin mengirim?\')"><img border=\'0\' src=\''.base_url().'images/icon/email-send.png\'></a>'; 
						break;
					case 1:
						$kirim2 = '<img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'>';
						break;
				}
				
				if($row->STATUS_TERIMA_SEKRETARIS == 1)
				{
					$status_terima_sekretaris = 'Sudah Diperiksa Sekretaris';
				}
				else if($row->STATUS_TERIMA_SEKRETARIS == 0 && $row->KIRIM_SEKRETARIS == 1)
				{
					$status_terima_sekretaris = 'Belum Diperiksa Sekretaris';
				}
				else
				{
					$status_terima_sekretaris = '-';
				}
				
				if($row->STATUS_TERIMA_BUPATI == 1)
				{
					$status_terima_bupati = 'Sudah Diperiksa Bupati';
				}
				else if($row->STATUS_TERIMA_BUPATI == 0 && $row->KIRIM_BUPATI == 1)
				{
					$status_terima_bupati = 'Belum Diperiksa Bupati';
				}
				else
				{
					$status_terima_bupati = '-';
				}
				
				if($row->STATUS_TERIMA_DINAS == 1)
				{
					$status_terima_dinas = 'Sudah Diperiksa Dinas';
				}
				else if($row->STATUS_TERIMA_DINAS == 0 && $row->DISPOSISI == 1)
				{
					$status_terima_dinas = 'Belum Diperiksa Dinas';
				}
				else
				{
					$status_terima_dinas = '-';
				}
				
				$no = $no+1;
				if($kode_role == 1)
				$record_items[] = array(
										$row->SURAT_MASUK_ID,
										$no,
										$row->TGL_TERIMA,
										$row->NOMOR,
										$row->PERIHAL,
								//'<a href='.base_url().'index.php/surat_masuk/status/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/status.png\'></a>',
										$kirim1,
										$status_terima_sekretaris,
										'<a href='.base_url().'index.php/surat_masuk/detail/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/39.png\'></a>',
										'<a href='.base_url().'index.php/surat_masuk/ubah/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/application--pencil.png\'></a>'
									);
								
				if($kode_role == 2 || $kode_role == 3)
				$record_items[] = array(
										$row->SURAT_MASUK_ID,
										$no,
										$row->TGL_TERIMA,
										$row->NOMOR,
										$row->PERIHAL,
										//'<a href='.base_url().'index.php/surat_masuk/status/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/status.png\'></a>',
										$kirim2,
										
										$disposisi,
										$status_terima_bupati,
										$status_terima_dinas,
										'<a href='.base_url().'index.php/surat_masuk/detail/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/39.png\'></a>'
								);
								
				if($kode_role == 4 || $kode_role == 5)
				$record_items[] = array(
										$row->SURAT_MASUK_ID,
										$no,
										$row->TGL_TERIMA,
										$row->NOMOR,
										$row->PERIHAL,
										//'<a href='.base_url().'index.php/surat_masuk/status/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/status.png\'></a>',
										$disposisi,
										$status_terima_dinas,
										'<a href='.base_url().'index.php/surat_masuk/detail/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/39.png\'></a>'
									);
								
				if($kode_role == 6)
				$record_items[] = array(
										$row->SURAT_MASUK_ID,
										$no,
										$row->TGL_TERIMA,
										$row->NOMOR,
										$row->PERIHAL,
										$row->NAMA_DINAS,
										'<a href='.base_url().'index.php/surat_masuk/komentar/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/comment.png\'></a>',
										'<a href='.base_url().'index.php/surat_masuk/detail/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/39.png\'></a>'
								);
		}
		
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function cek_validasi($sifat,$edit,$surat_masuk_id)
	{	
		if($edit)
		{
			$cek_nomor = '|callback_cek_nomor_baru['.$surat_masuk_id.']';
		}
		else
		{
			$cek_nomor = '|callback_cek_nomor';			
		}
		
		if($sifat == '1')
		{
			$this->form_validation->set_rules('tgl_terima', 'Tanggal Terima', 'required');
			$this->form_validation->set_rules('nomor', 'Nomor Surat', 'required'.$cek_nomor);
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
		
		if($this->cek_validasi($sifat,false,null))
		{
			if(!$this->jenis_surat_model->cek_jenis_surat2($data['JENIS_SURAT_ID']) || !$this->instansi_model->cek_instansi2($data['INSTANSI_ID']))
			{
				$data_jenis_surat = array(
										'NAMA_JENIS_SURAT' => $data['JENIS_SURAT_ID'],
										'STATUS_JENIS_SURAT' => 1
									);
				$data_instansi = array(
										'NAMA_INSTANSI' => $data['INSTANSI_ID'],
										'STATUS_INSTANSI' => 1 
									);
				$this->jenis_surat_model->add($data_jenis_surat);
				$this->instansi_model->add($data_instansi);
				$data['JENIS_SURAT_ID'] = $this->jenis_surat_model->get_last_jenis_surat_id()->row()->JENIS_SURAT_ID;
				$data['INSTANSI_ID'] = $this->instansi_model->get_last_instansi_id()->row()->INSTANSI_ID;
			}
			$this->surat_masuk_model->add($data);
			$surat_masuk_id = $this->surat_masuk_model->get_max_surat_masuk_id()->row()->SURAT_MASUK_ID;
			for($i=0;$i<count($files_available);$i++)
			{
				//$field_name = 'userfile'.$i;
				$field_name = $files_available[$i];
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
			//echo 'sukses';
			redirect('surat_masuk');
		}
		else
		{
			$this->add();
		}
	}
	
	public function ubah($surat_masuk_id)
	{
		$sifat = $this->input->post('sifat');
		$result1 = $this->instansi_model->get_all_instansi();
		$result2 = $this->jenis_surat_model->get_all_jenis_surat();
		$result3 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result4 = $this->surat_masuk_model->get_file_surat_masuk_by_id($surat_masuk_id)->result();
		$tgl_terima = $this->input->post('tgl_terima');
		$bln_terima = $this->input->post('bln_terima');
		$thn_terima = $this->input->post('thn_terima');
		$tanggal_terima = $thn_terima.'-'.$bln_terima.'-'.$tgl_terima;
		$tgl_surat = $this->input->post('tgl_surat');
		$bln_surat = $this->input->post('bln_surat');
		$thn_surat = $this->input->post('thn_surat');
		$tanggal_surat = $thn_surat.'-'.$bln_surat.'-'.$tgl_surat;
		$files_available = array();
		//$files_max = $this->surat_masuk_model->count_file_surat_masuk($surat_masuk_id);
		foreach ( $result4 as $row )
		{
			if(isset($_FILES['userfile_'.$row->FILE_SURAT_MASUK_ID]) && !empty($_FILES['userfile_'.$row->FILE_SURAT_MASUK_ID]['name']))
			{
				array_push($files_available,'userfile_'.$row->FILE_SURAT_MASUK_ID);
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
						'DATE_EDITED' 		 				 => date("Y-m-j G:i:s")
					);
		}
		else if($sifat == 2)
		{
			$data = array(
						'SIFAT'					 			 => $this->input->post('sifat'),
						'TGL_TERIMA' 		 				 => $tanggal_terima,
						'JENIS_SURAT_ID' 	 				 => $this->input->post('jenis_surat'),
						'INSTANSI_ID' 		 				 => $this->input->post('instansi'),
						'PERIHAL' 		 	 				 => $this->input->post('perihal'),
						'KEPADA' 		    			     => null,
						'TGL_SURAT' 		 				 => null,
						'LAMPIRAN' 		 					 => null,
						'CATATAN_TERIMA_SURAT_MASUK' 		 => null,
						'DATE_EDITED' 		 				 => date("Y-m-j G:i:s")
					);
		}
		if($this->cek_validasi($sifat,true,$surat_masuk_id))
		{
			if(count($files_available) >  0)
			{
				for($i=0;$i<count($files_available);$i++)
				{
					//$field_name = 'userfile'.$i;
					$field_name = $files_available[$i];
					$file_surat_masuk_id = explode('_',$field_name);
					$surat[$i] = $this->upload_surat($field_name);
					if($surat[$i] != "")
					{
						$data_file = array(
											'PATH_FILE' 		=> $surat[$i][0],
											'NAMA_FILE' 		=> $surat[$i][1]
						);
						$this->surat_masuk_model->update2($file_surat_masuk_id[1],$data_file);
					}
				}
			}
			
			if(!$this->jenis_surat_model->cek_jenis_surat2($data['JENIS_SURAT_ID']) || !$this->instansi_model->cek_instansi2($data['INSTANSI_ID']))
			{
				$data_jenis_surat = array(
										'NAMA_JENIS_SURAT' => $data['JENIS_SURAT_ID'],
										'STATUS_JENIS_SURAT' => 1
									);
				$data_instansi = array(
										'NAMA_INSTANSI' => $data['INSTANSI_ID'],
										'STATUS_INSTANSI' => 1 
									);
				$this->jenis_surat_model->add($data_jenis_surat);
				$this->instansi_model->add($data_instansi);
				$data['JENIS_SURAT_ID'] = $this->jenis_surat_model->get_last_jenis_surat_id()->row()->JENIS_SURAT_ID;
				$data['INSTANSI_ID'] = $this->instansi_model->get_last_instansi_id()->row()->INSTANSI_ID;
			}
			
			$this->surat_masuk_model->update($surat_masuk_id, $data);
			redirect('surat_masuk');
		}
		else
		{
			
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
			$temp1 = explode('-', $result3->TGL_TERIMA);
			$data['sifat'] = $result3->SIFAT;
			$data['nomor'] = $result3->NOMOR;
			$data['tgl_terima'] = $temp1[2];
			$data['bln_terima'] = $temp1[1];
			$data['thn_terima'] = $temp1[0];
			$data['jenis_surat_dipilih'] = $result3->JENIS_SURAT_ID;
			$data['instansi_dipilih'] = $result3->INSTANSI_ID;
			$data['perihal'] = $result3->PERIHAL;
			$data['pejabat_dipilih'] = $result3->KEPADA;
			if($result3->TGL_SURAT != null)
			{
				$temp2 = explode('-',$result3->TGL_SURAT);
				$data['tgl_surat'] = $temp1[2];
				$data['bln_surat'] = $temp1[1];
				$data['thn_surat'] = $temp1[0];
			}
			$data['lampiran'] = $result3->LAMPIRAN;
			$data['catatan'] = $result3->CATATAN_TERIMA_SURAT_MASUK;
			$data['file_surat_masuk'] = $result4;
			$data['pejabat'] = array(
										'0' => '-- Pilih Pejabat --',
										'1' => 'Asisten',
										'2' => 'Sekretaris',
										'3' => 'Wakil Bupati',
										'4' => 'Bupati',
										'5' => 'Dinas'
								);
			
			$data['content'] = $this->load->view('form_ubah_surat_masuk',$data,true);
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
	
	function cek_nomor_baru($value, $surat_masuk_id)
	{
		if($this->surat_masuk_model->cek_nomor_baru($value, $surat_masuk_id))
		{
			$this->form_validation->set_message('cek_nomor_baru', 'Nomor Surat Sudah Ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function disposisi($surat_masuk_id)
	{
		$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result2 = $this->dinas_model->get_all_dinas();
		//$dinas[0] = '-- Pilih Dinas --';
		foreach($result2->result() as $row)
		{
			$dinas[$row->DINAS_ID] = $row->NAMA_DINAS;
		}
		$data['dinas'] = $dinas;
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['nomor'] = $result1->NOMOR;
		$data['content'] = $this->load->view('form_disposisi',$data,true);
		$this->load->view('main',$data);
	}
	
	function disposisi_process($surat_masuk_id)
	{
		
		
		$data_surat_masuk = array('DISPOSISI'=> 1);
		$data_disposisi_surat_masuk = array(
											'SURAT_MASUK_ID'    => $surat_masuk_id,
											'DINAS_ID' 			=> $this->input->post('dinas'),
											'CATATAN_DISPOSISI' => $this->input->post('catatan'),
											'USER_ID'  			=> $this->session->userdata('iduser')
										);
		
		
		if(!$this->dinas_model->cek_dinas2($data_disposisi_surat_masuk['DINAS_ID']))
		{
			$data_dinas = array(
									'NAMA_DINAS' => $data_disposisi_surat_masuk['DINAS_ID'],
									'STATUS_DINAS' => 1
								);
			$this->dinas_model->add($data_dinas);
			$data_disposisi_surat_masuk['DINAS_ID'] = $this->dinas_model->get_last_dinas_id()->row()->DINAS_ID;
		}
		$nama_dinas = $this->dinas_model->get_dinas($data_disposisi_surat_masuk['DINAS_ID'])->row()->NAMA_DINAS;
		$dinas = $this->user_model->get_user_by_role(6)->result();
		
		$date = date('Y-m-d H:i:s');
		$message_dinas = 'ini pesan untuk dinas '.$nama_dinas;
		
		foreach($dinas as $row_dinas)
		{
			$no_dinas = $row_dinas->NO_HP;
			$this->surat_masuk_model->sendMessage($no_dinas,$date,$message_dinas);
		}
		
		$this->surat_masuk_model->update($surat_masuk_id, $data_surat_masuk);
		$this->surat_masuk_model->add3($data_disposisi_surat_masuk);
		redirect('surat_masuk');
	}
	
	function kirim_ke_sekretaris($surat_masuk_id)
	{
		$asisten = $this->user_model->get_user_by_role(2)->result();
		$sekretaris = $this->user_model->get_user_by_role(3)->result();
		$date = date('Y-m-d H:i:s');
		$message_asisten = 'ini untuk asisten';
		$message_sekretaris = 'ini untuk sekretaris';
		
		foreach($asisten as $row_asisten)
		{
			$no_asisten = $row_asisten->NO_HP;
			$this->surat_masuk_model->sendMessage($no_asisten,$date,$message_asisten);
		}
		
		foreach($sekretaris as $row_sekretaris)
		{
			$no_sekretaris = $row_sekretaris->NO_HP;
			$this->surat_masuk_model->sendMessage($no_sekretaris,$date,$message_sekretaris);
		}
		
		$data_surat_masuk = array('KIRIM_SEKRETARIS'=> 1);
		$this->surat_masuk_model->update($surat_masuk_id, $data_surat_masuk);
		redirect('surat_masuk');
	}
	
	function kirim_ke_bupati($surat_masuk_id)
	{
		$wabup = $this->user_model->get_user_by_role(4)->result();
		$bupati = $this->user_model->get_user_by_role(5)->result();
		$date = date('Y-m-d H:i:s');
		$message_wabup = 'ini untuk wakil bupati';
		$message_bupati = 'ini untuk bupati';
		
		foreach($wabup as $row_wabup)
		{
			$no_wabup = $row_wabup->NO_HP;
			$this->surat_masuk_model->sendMessage($no_wabup,$date,$message_wabup);
		}
		
		foreach($bupati as $row_bupati)
		{
			$no_bupati = $row_bupati->NO_HP;
			$this->surat_masuk_model->sendMessage($no_bupati,$date,$message_bupati);
		}
		
		$data_surat_masuk = array('KIRIM_BUPATI'=> 1);
		$this->surat_masuk_model->update($surat_masuk_id, $data_surat_masuk);
		redirect('surat_masuk');
	}
	
	function komentar($surat_masuk_id)
	{	
		$result = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['nomor'] = $result->NOMOR;
		$data['komentar'] = $result->KOMENTAR;
		$data['content'] = $this->load->view('form_komentar',$data,true);
		$this->load->view('main',$data);
	}
	
	function komentar_proses($surat_masuk_id)
	{
		$data_surat_masuk = array('KOMENTAR'=> $this->input->post('komentar'));
		$this->surat_masuk_model->update($surat_masuk_id, $data_surat_masuk);
		redirect('surat_masuk');
	}
	
	// fungsi untuk download file yg ter-upload
	function download($file_surat_masuk_id)
	{
		// gett the file from DB
		$record = $this->surat_masuk_model->get_file_surat_masuk_by_id2($file_surat_masuk_id);
		if($record->num_rows() > 0 )
		{
			$nama_paket = $record->row()->PATH_FILE;
			if (is_file('./'.$nama_paket)){
				$data = file_get_contents('./'.$nama_paket);			
				force_download($nama_paket, $data); 
			}
		}
		else
		{
			echo 'tidak ada file yang ditemukan';
		}
	}// end of download
	
	function detail($surat_masuk_id)
	{
		$kode_role = $this->session->userdata('kode_role');
		if($kode_role == 2 || $kode_role == 3)
		{
			$this->surat_masuk_model->update($surat_masuk_id,array('STATUS_TERIMA_SEKRETARIS'=> 1));
		}
		else if($kode_role == 4 || $kode_role == 5)
		{
			$this->surat_masuk_model->update($surat_masuk_id, array('STATUS_TERIMA_BUPATI'=> 1));
		}
		else if($kode_role == 6)
		{
			$this->surat_masuk_model->update($surat_masuk_id, array('STATUS_TERIMA_DINAS'=> 1));
		}
		$result3 = $this->surat_masuk_model->get_surat_masuk_by_id2($surat_masuk_id)->row();
		$result4 = $this->surat_masuk_model->get_file_surat_masuk_by_id($surat_masuk_id)->result();
		$result5 = '';
		if($this->surat_masuk_model->cek_surat_masuk_id($surat_masuk_id))
		{
			$result5 = $this->surat_masuk_model->get_catatan_disposisi($surat_masuk_id);
		}
		$temp1 = explode('-', $result3->TGL_TERIMA);
		$temp2 = explode('-', $result3->TGL_SURAT);
		$data['sifat'] = $result3->SIFAT;
		$data['nomor'] = $result3->NOMOR;
		$data['tgl_terima'] = $temp1[2].'-'.$temp1[1].'-'.$temp1[0];
		if($result3->TGL_SURAT != null)
		{
			$data['tgl_surat'] = $temp2[2].'-'.$temp2[1].'-'.$temp2[0];
		}
		$data['jenis_surat'] = $result3->NAMA_JENIS_SURAT;
		$data['dari'] = $result3->NAMA_INSTANSI;
		$data['perihal'] = $result3->PERIHAL;
		$data['pejabat'] = array(
									'0' => '-- Pilih Pejabat --',
									'1' => 'Asisten',
									'2' => 'Sekretaris',
									'3' => 'Wakil Bupati',
									'4' => 'Bupati',
									'5' => 'Dinas'
							);
		$kepada = '';
		switch($result3->KEPADA)
		{
			case 1:
				$kepada = 'Asisten';
				break;
			case 2:
				$kepada = 'Sekretaris';
				break;
			case 3:
				$kepada = 'Wakil Bupati';
				break;
			case 4:
				$kepada = 'Bupati';
				break;
			case 5:
				$kepada = 'Dinas';
				break;
		}
		$data['kepada'] = $kepada;
		$data['catatan_disposisi'] = $result5;
		$data['lampiran'] = $result3->LAMPIRAN;
		$data['catatan'] = $result3->CATATAN_TERIMA_SURAT_MASUK;
		$data['komentar'] = $result3->KOMENTAR;
		$data['file_surat_masuk'] = $result4;
		$data['content'] = $this->load->view('detail_surat_masuk',$data,true);
		$this->load->view('main',$data);
	}
	
	function status($surat_masuk_id)
	{
		if($this->surat_masuk_model->cek_surat_masuk_id($surat_masuk_id))
		{
			$result4 = $this->surat_masuk_model->get_nama_dinas($surat_masuk_id)->row();
			$data['nama_dinas'] = $result4->NAMA_DINAS;
		}
		$result3 = $this->surat_masuk_model->get_surat_masuk_by_id2($surat_masuk_id)->row();
		$data['kirim_sekretaris'] = $result3->KIRIM_SEKRETARIS;
		$data['kirim_bupati'] = $result3->KIRIM_BUPATI;
		$data['status_disposisi'] = $result3->DISPOSISI;
		$data['status_terima_dinas'] = $result3->STATUS_TERIMA_DINAS;
		$data['status_terima_sekretaris'] = $result3->STATUS_TERIMA_SEKRETARIS;
		$data['status_terima_bupati'] = $result3->STATUS_TERIMA_BUPATI;
		
		$data['surat_masuk_id'] = $surat_masuk_id;
		
		$data['content'] = $this->load->view('status_surat_masuk',$data,true);
		$this->load->view('main',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
