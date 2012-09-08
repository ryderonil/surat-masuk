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
		$this->load->model('sms_model');
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
		if($kode_role == 1) $colModel['TGL_TERIMA'] = array('Tanggal Terima',100,TRUE,'center',1);
		$colModel['NOMOR'] = array('Nomor',150,TRUE,'center',1);
		$colModel['PERIHAL'] = array('Perihal',200,TRUE,'center',1);
		if($kode_role == 1) 
		{
			$colModel['SIFAT'] = array('Sifat',90,FALSE,'center',0);
			$colModel['kirim_ke_pejabat'] = array('Kirim',90,FALSE,'center',0);
		}
		if($kode_role == 2 || $kode_role == 3 || $kode_role == 4 || $kode_role == 5 || $kode_role == 6 || $kode_role == 7) $colModel['disposisi'] = array('Disposisi',60,FALSE,'center',0);
		if($kode_role == 1 || $kode_role == 2 || $kode_role == 3 || $kode_role == 4 || $kode_role == 5 || $kode_role == 6 || $kode_role == 7 || $kode_role == 8)
		{
			$colModel['status'] = array('Status',90,FALSE,'center',0);
		}
		$colModel['komentar'] = array('Komentar',60,FALSE,'center',0);
		$colModel['detail'] = array('Detail',40,FALSE,'center',0);
		if($kode_role == 1) $colModel['ubah'] = array('Ubah',30,FALSE,'center',0);
			
		//setting konfigurasi pada bottom tool bar flexigrid
		$gridParams = array(
							'width' => 'auto',
							'height' => 500,
							'rp' => 15,
							'rpOptions' => '[15,30,50,100]',
							'pagestat' => 'Menampilkan : {from} ke {to} dari {total} data.',
							'blockOpacity' => 0,
							'title' => 'Daftar Surat Masuk',
							'showTableToggleBtn' => false
							);
							
		//menambah tombol pada flexigrid top toolbar
		if($kode_role == 1) 
		{
			$buttons[] = array('Tambah','add','spt_js');
			$buttons[] = array('Hapus','delete','spt_js');
			$buttons[] = array('separator');
			$buttons[] = array('Pilih Semua','add','spt_js');
			$buttons[] = array('separator');
			$buttons[] = array('Hapus Pilihan','delete','spt_js');
			$buttons[] = array('separator');
		}
		else
		{
			$buttons = null;
		}
		
		// mengambil data dari file controler ajax pada method grid_user	
		$url = site_url()."/surat_masuk/grid_data_surat_masuk";
		$grid_js = build_grid_js('user',$url,$colModel,'ID','asc',$gridParams,$buttons,true);
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
	
	public function grid_surat_disposisi()
	{
		$kode_role = $this->session->userdata('kode_role');
		$colModel['no'] = array('No',20,TRUE,'center',0);
		$colModel['NOMOR'] = array('Nomor',150,TRUE,'center',1);
		$colModel['PERIHAL'] = array('Perihal',200,TRUE,'center',1);
		if($kode_role!=8)
		{
			$colModel['disposisi'] = array('Disposisi',60,FALSE,'center',0);
			$colModel['status'] = array('Status',90,FALSE,'center',0);
		}
		//$colModel['komentar'] = array('Komentar',60,FALSE,'center',0);
		//$colModel['detail_disposisi'] = array('Detail Disposisi',80,FALSE,'center',0);
		$colModel['detail'] = array('Detail Surat',80,FALSE,'center',0);
			
		//setting konfigurasi pada bottom tool bar flexigrid
		$gridParams = array(
							'width' => 'auto',
							'height' => 500,
							'rp' => 15,
							'rpOptions' => '[15,30,50,100]',
							'pagestat' => 'Menampilkan : {from} ke {to} dari {total} data.',
							'blockOpacity' => 0,
							'title' => 'Daftar Surat Masuk Disposisi',
							'showTableToggleBtn' => false
							);
							
		//menambah tombol pada flexigrid top toolbar
		// mengambil data dari file controler ajax pada method grid_user	
		$url = site_url()."/surat_masuk/grid_data_surat_masuk_disposisi";
		$grid_js = build_grid_js('user',$url,$colModel,'ID','asc',$gridParams,null,true);
		$data['js_grid'] = $grid_js;
		//$data['added_js'] variabel untuk membungkus javascript yang dipakai pada tombol yang ada di toolbar atas
		$data['content'] = $this->load->view('grid',$data,true);
		$this->load->view('main',$data);
	}
	
	function grid_data_surat_masuk() 
	{
		$kode_role = $this->session->userdata('kode_role');
		$dinas_id = $this->user_model->get_user($this->session->userdata('iduser'))->row()->DINAS_ID;
		$valid_fields = array('SURAT_MASUK_ID','NOMOR','PERIHAL','TGL_TERIMA');
		$this->flexigrid->validate_post('surat_masuk.SURAT_MASUK_ID','asc',$valid_fields);
		if($kode_role != 8)
		{
			$records = $this->surat_masuk_model->grid_surat_masuk($kode_role);	
		}
		else
		{
			$records = $this->surat_masuk_model->grid_surat_masuk2($this->session->userdata('dinas_id'));	
		}
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($row->SIFAT == 1)
				{
					$sifat = 'Reguler';
					$size = $this->surat_masuk_model->count_penerima_surat($row->SURAT_MASUK_ID);
					if($size > 0)
					{
						$kirim = '<a href='.base_url().'index.php/surat_masuk/kirim_ke_pejabat/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/email-send.png\'></a>';
					}
					else
					{
						$kirim = '<img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'>';
					}
				}
				else
				{
					$sifat = 'Rahasia';
					$kirim = '-';
				}
				
				if($this->surat_masuk_model->cek_apa_sudah_didisposisi($row->SURAT_MASUK_ID,$this->session->userdata('iduser')))
				{
					$disposisi = '<a href='.base_url().'index.php/surat_masuk/disposisi2/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/disposisi.png\'></a>';								
				}
				else
				{
					$disposisi = '<a href='.base_url().'index.php/surat_masuk/disposisi/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/disposisi.png\'></a>';										
				}
				$no = $no+1;
				if($kode_role == 1)
				{
					$record_items[] = array(
											$row->SURAT_MASUK_ID,
											$no,
											$row->TGL_TERIMA,
											$row->NOMOR,
											$row->PERIHAL,									
											$sifat,
											$kirim,
											'<a href='.base_url().'index.php/surat_masuk/status1/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/status.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/komentar/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/comment.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/detail/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/39.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/ubah/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/application--pencil.png\'></a>'
										);
				}
				else if($kode_role == 2 || $kode_role == 3 || $kode_role == 4 || $kode_role == 5 || $kode_role == 6 || $kode_role == 7)
				{
					$record_items[] = array(
											$row->SURAT_MASUK_ID,
											$no,
											$row->NOMOR,
											$row->PERIHAL,	
											$disposisi,								
											'<a href='.base_url().'index.php/surat_masuk/status2/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/status.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/komentar/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/comment.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/detail/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/39.png\'></a>',
										);
				}
		}
		if(isset($record_items))
			$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		else
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function grid_data_surat_masuk_disposisi() 
	{
		$kode_role = $this->session->userdata('kode_role');
		$dinas_id = $this->user_model->get_user($this->session->userdata('iduser'))->row()->DINAS_ID;
		$valid_fields = array('SURAT_MASUK_ID','NOMOR','PERIHAL');
		$this->flexigrid->validate_post('surat_masuk.SURAT_MASUK_ID','asc',$valid_fields);
		if($kode_role != 8)
		{
			$records = $this->surat_masuk_model->grid_surat_masuk_disposisi($kode_role);							
		}
		else
		{
			$records = $this->surat_masuk_model->grid_surat_masuk_disposisi($this->session->userdata('dinas_id'));
		}
		$this->output->set_header($this->config->item('json_header'));
			
		$no = 0;
		foreach ($records['records']->result() as $row){
				if($this->surat_masuk_model->cek_apa_sudah_didisposisi($row->SURAT_MASUK_ID,$this->session->userdata('iduser')))
				{
					$disposisi = '<a href='.base_url().'index.php/surat_masuk/disposisi2_gdd/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/disposisi.png\'></a>';								
				}
				else
				{
					$disposisi = '<a href='.base_url().'index.php/surat_masuk/disposisi_gdd/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/disposisi.png\'></a>';										
				}
				$no = $no+1;
				if($kode_role != 8)
				{
					$record_items[] = array(
											$row->SURAT_MASUK_ID,
											$no,
											$row->NOMOR,
											$row->PERIHAL,									
											$disposisi,
											'<a href='.base_url().'index.php/surat_masuk/status2_gdd/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/status.png\'></a>',
											//'<a href='.base_url().'index.php/surat_masuk/komentar/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/comment.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/detail_surat_masuk_dan_disposisi/'.$row->SURAT_MASUK_ID.'/'.$row->DISPOSISI_ID.'><img border=\'0\' src=\''.base_url().'images/icon/doc.png\'></a>',
										);
				}
				else
				{
					$record_items[] = array(
											$row->SURAT_MASUK_ID,
											$no,
											$row->NOMOR,
											$row->PERIHAL,									
											//'<a href='.base_url().'index.php/surat_masuk/komentar/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/comment.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/disposisi3/'.$row->SURAT_MASUK_ID.'/'.$row->DISPOSISI_ID.'><img border=\'0\' src=\''.base_url().'images/icon/doc.png\'></a>',
											'<a href='.base_url().'index.php/surat_masuk/detail/'.$row->SURAT_MASUK_ID.'><img border=\'0\' src=\''.base_url().'images/icon/39.png\'></a>'
										);
				}
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
			$this->form_validation->set_rules('bln_terima', 'Bulan Terima', 'required');
			$this->form_validation->set_rules('thn_terima', 'Tahun Terima', 'required');
			$this->form_validation->set_rules('nomor', 'Nomor Surat', 'required'.$cek_nomor);
			$this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
			$this->form_validation->set_rules('pejabat', 'Kepada', 'callback_cek_dropdown');
			$this->form_validation->set_rules('tgl_surat', 'Tanggal Surat', 'required');
			$this->form_validation->set_rules('bln_surat', 'Bulan Surat', 'required');
			$this->form_validation->set_rules('thn_surat', 'Tahun Surat', 'required');
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
		$date = explode("-",date("Y-m-j"));
		$tgl = $date[2];
		$bln = $date[1];
		$thn = $date[0];
		$result1 = $this->instansi_model->get_all_instansi_aktif();
		$result2 = $this->jenis_surat_model->get_all_jenis_surat_aktif();
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
		$dinas = array(
						'2' => 'Asisten I',
						'3' => 'Asisten II',
						'4' => 'Asisten III',
						'5' => 'Sekretaris',
						'6' => 'Wakil Bupati',
						'7' => 'Bupati'
				);
		$result3 = $this->dinas_model->get_all_dinas_disposisi();
		foreach($result3->result() as $row)
		{
			$dinas[$row->DINAS_ID] = $row->NAMA_DINAS;
		}
		$data['pejabat'] = $dinas;
		$data['tgl'] = $tgl;
		$data['bln'] = $bln;
		$data['thn'] = $thn;
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
	
	function a()
	{
		$date = explode("-",date("Y-m-j"));
		$tgl = $date[2];
		$bln = $date[1];
		$thn = $date[0];
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
						'TGL_SURAT' 		 				 => $tanggal_surat,
						'LAMPIRAN' 		 					 => $this->input->post('lampiran'),
						'CATATAN_TERIMA_SURAT_MASUK' 		 => $this->input->post('catatan'),
						'DATE_CREATED' 		 				 => date("Y-m-j G:i:s")
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
			
			foreach($this->input->post('pejabat') as $items)
			{
				$tujuan_surat = array(
									'SURAT_MASUK_ID' => $surat_masuk_id,
									'TUJUAN' => $items,
									'STATUS_KIRIM' => 0
								);
				$this->surat_masuk_model->add8($tujuan_surat);
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
									'2' => 'Asisten I',
									'3' => 'Asisten II',
									'4' => 'Asisten III',
									'5' => 'Sekretaris',
									'6' => 'Wakil Bupati',
									'7' => 'Bupati',
									'8' => 'Dinas'
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
	
	function cek_file($value)
	{
		if(isset($_FILES['userfile']) && !empty($_FILES['userfile']['name']))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('cek_file', 'Kolom %s harus dipilih!!');
			return FALSE;			
		}
	}
	
	function cek_skpd($value)
	{
		if(count($value) == 0)
		{
			$this->form_validation->set_message('cek_skpd', 'Kolom %s harus dipilih!!');
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
		$get_message = $this->sms_model->get_template_kirim($this->session->userdata('dinas_id'))->row();
		$message = $get_message->TEMPLATE_SMS;
		$date = explode("-",date("Y-m-j"));
		$tgl = $date[2];
		$bln = $date[1];
		$thn = $date[0];
		$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result2 = $this->dinas_model->get_all_dinas_disposisi();
		
		if($this->session->userdata('kode_role') == 5 || $this->session->userdata('kode_role') == 6 || $this->session->userdata('kode_role') == 7)
		{
			$dinas[2] = 'Asisten I';
			$dinas[3] = 'Asisten II';
			$dinas[4] = 'Asisten III';
		}
		if($this->session->userdata('kode_role') == 6 || $this->session->userdata('kode_role') == 7) $dinas[5] = 'Sekretaris';
		if($this->session->userdata('kode_role') == 7) $dinas[6] = 'Wakil Bupati';
		foreach($result2->result() as $row)
		{
			$dinas[$row->DINAS_ID] = $row->NAMA_DINAS;
		}
		$data['skpd'] = $dinas;
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['nomor'] = $result1->NOMOR;
		$data['teks_sms'] = $message;
		$data['tgl'] = $tgl;
		$data['bln'] = $bln;
		$data['thn'] = $thn;
		$data['content'] = $this->load->view('form_disposisi',$data,true);
		$this->load->view('main',$data);
	}
	
	function disposisi_gdd($surat_masuk_id)
	{
		$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result2 = $this->dinas_model->get_all_dinas_disposisi();
		
		if($this->session->userdata('kode_role') == 5 || $this->session->userdata('kode_role') == 6 || $this->session->userdata('kode_role') == 7)
		{
			$dinas[2] = 'Asisten I';
			$dinas[3] = 'Asisten II';
			$dinas[4] = 'Asisten III';
		}
		if($this->session->userdata('kode_role') == 6 || $this->session->userdata('kode_role') == 7) $dinas[5] = 'Sekretaris';
		if($this->session->userdata('kode_role') == 7) $dinas[6] = 'Wakil Bupati';
		foreach($result2->result() as $row)
		{
			$dinas[$row->DINAS_ID] = $row->NAMA_DINAS;
		}
		$data['skpd'] = $dinas;
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['nomor'] = $result1->NOMOR;
		$data['content'] = $this->load->view('form_disposisi2',$data,true);
		$this->load->view('main',$data);
	}
	
	function urgensi()
	{
		$urgensi = array(
					'1' => 'Biasa',
					'2' => 'Mendesak'
					);
		return $urgensi;
	}
	
	function disposisi2($surat_masuk_id)
	{
		$urgensi = $this->urgensi();
		$user_id = $this->session->userdata('iduser');
		$result = $this->surat_masuk_model->get_disposisi($surat_masuk_id,$user_id)->row();
		$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result2 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id, $surat_masuk_id)->result();
		$result3 = $this->surat_masuk_model->get_all_komentar_disposisi($user_id, $surat_masuk_id)->result();
		$data['tgl_disposisi'] = date("d-m-Y", strtotime($result->TANGGAL_DISPOSISI));
		$data['nomor'] = $result1->NOMOR;
		$data['penerima'] = $result2;
		$data['urgensi'] = $urgensi[$result->URGENSI];
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['catatan_disposisi'] = $result->CATATAN_DISPOSISI;
		$data['disposisi_id'] = $result->DISPOSISI_ID;
		$data['file_disposisi_surat_masuk'] = $result->FILE_DISPOSISI;
		$data['komentar_disposisi'] = $result3;
		$data['content'] = $this->load->view('detail_disposisi',$data,true);
		$this->load->view('main',$data);
	}
	
	function disposisi2_gdd($surat_masuk_id)
	{
		$urgensi = $this->urgensi();
		$user_id = $this->session->userdata('iduser');
		$result = $this->surat_masuk_model->get_disposisi($surat_masuk_id,$user_id)->row();
		$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result2 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id, $surat_masuk_id)->result();
		$result3 = $this->surat_masuk_model->get_all_komentar_disposisi($user_id, $surat_masuk_id)->result();
		$data['tgl_disposisi'] = date("d-m-Y", strtotime($result->TANGGAL_DISPOSISI));
		$data['nomor'] = $result1->NOMOR;
		$data['penerima'] = $result2;
		$data['urgensi'] = $urgensi[$result->URGENSI];
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['catatan_disposisi'] = $result->CATATAN_DISPOSISI;
		$data['disposisi_id'] = $result->DISPOSISI_ID;
		$data['file_disposisi_surat_masuk'] = $result->FILE_DISPOSISI;
		$data['komentar_disposisi'] = $result3;
		$data['content'] = $this->load->view('detail_disposisi3',$data,true);
		$this->load->view('main',$data);
	}
	
	function disposisi3($surat_masuk_id,$disposisi_id)
	{
		$urgensi = $this->urgensi();
		//$user_id = $this->session->userdata('iduser');
		$result = $this->surat_masuk_model->get_disposisi2($disposisi_id)->row();
		$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result2 = $this->surat_masuk_model->get_all_penerima_disposisi2($disposisi_id)->result();
		$result3 = $this->surat_masuk_model->get_all_komentar_disposisi2($disposisi_id)->result();
		$data['tgl_disposisi'] = date("d-m-Y", strtotime($result->TANGGAL_DISPOSISI));
		$data['nomor'] = $result1->NOMOR;
		$data['penerima'] = $result2;
		$data['urgensi'] = $urgensi[$result->URGENSI];
		$data['disposisi_dari'] = $result->NAMA_DINAS;
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['catatan_disposisi'] = $result->CATATAN_DISPOSISI;
		$data['disposisi_id'] = $result->DISPOSISI_ID;
		$data['file_disposisi_surat_masuk'] = $result->FILE_DISPOSISI;
		$data['komentar_disposisi'] = $result3;
		$data['content'] = $this->load->view('detail_disposisi2',$data,true);
		$this->load->view('main',$data);
	}
	
	function d2_process()
	{
		if($this->session->userdata('kode_role') == 8)
		{
			$dinas_id = $this->session->userdata('dinas_id');
		}
		else
		{
			$dinas_id = $this->session->userdata('kode_role');
		}
		$data = array(
					'DISPOSISI_ID' => $this->input->post('disposisi_id'),
					'DINAS_ID' => $dinas_id,
					'TGL_KOMENTAR' => date("Y-m-j G:i:s"),
					'KOMENTAR_DISPOSISI' => $this->input->post('komentar_disposisi') 		
				);
		$this->surat_masuk_model->add7($data);
		redirect('surat_masuk/disposisi2/'.$this->input->post('surat_masuk_id'));
	}
	
	function d3_process()
	{
		if($this->session->userdata('kode_role') == 8)
		{
			$dinas_id = $this->session->userdata('dinas_id');
		}
		else
		{
			$dinas_id = $this->session->userdata('kode_role');
		}
		$data = array(
					'DISPOSISI_ID' => $this->input->post('disposisi_id'),
					'DINAS_ID' => $dinas_id,
					'TGL_KOMENTAR' => date("Y-m-j G:i:s"),
					'KOMENTAR_DISPOSISI' => $this->input->post('komentar_disposisi') 		
				);
		$this->surat_masuk_model->add7($data);
		redirect('surat_masuk/detail_surat_masuk_dan_disposisi/'.$this->input->post('surat_masuk_id').'/'.$this->input->post('disposisi_id'));
	}
	
	function disposisi_process($surat_masuk_id)
	{
		$date = date('Y-m-d H:i:s');
		$message = 'Terdapat surat disposisi dari Bupati';
		$this->form_validation->set_rules('teks_sms', 'Teks SMS', 'required');
		$this->form_validation->set_rules('tgl_disposisi', 'Tanggal Disposisi', 'required');
		$this->form_validation->set_rules('bln_disposisi', 'Bulan Disposisi', 'required');
		$this->form_validation->set_rules('thn_disposisi', 'Tahun Disposisi', 'required');
		$this->form_validation->set_rules('urgensi', 'Urgensi', 'callback_cek_dropdown');
		$this->form_validation->set_rules('skpd', 'Penerima', 'callback_cek_skpd');
		$this->form_validation->set_rules('catatan_disposisi', 'Catatan Disposisi', 'required');
		$this->form_validation->set_rules('userfile', 'File Disposisi', 'callback_cek_file');
		$surat = $this->upload_surat('userfile');
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		if($this->form_validation->run())
		{
			$data_disposisi_surat_masuk = array(
												'SURAT_MASUK_ID'    => $surat_masuk_id,
												'TANGGAL_DISPOSISI' => date("Y-m-j"),
												'CATATAN_DISPOSISI' => $this->input->post('catatan_disposisi'),
												'FILE_DISPOSISI'  	=> $surat[1],
												'URGENSI'  			=> $this->input->post('urgensi'),
												'USER_ID'  			=> $this->session->userdata('iduser')
											);
			$this->surat_masuk_model->add3($data_disposisi_surat_masuk);
			$disposisi_id = $this->surat_masuk_model->get_max_disposisi_id()->row()->DISPOSISI_ID;
			foreach($this->input->post('skpd') as $items)
			{
				$result = $this->user_model->get_user_by_dinas_id($items);
				$no_hp = $result->row()->NO_HP;
				$this->surat_masuk_model->sendMessage($no_hp,$date,$this->input->post('teks_sms'));
				
				$data_detail_disposisi = array(
												'PENERIMA'    => $items,
												'DISPOSISI_ID' => $disposisi_id											
											);
				$this->surat_masuk_model->add6($data_detail_disposisi);
			}
			if($this->input->post('type') == 1)
			{
				redirect('surat_masuk');
			}
			else
			{
				redirect('surat_masuk/grid_surat_disposisi');
			}
			
		}
		else
		{
			$this->disposisi($surat_masuk_id);
		}
		
		/*
		$data_surat_masuk = array('DISPOSISI'=> 1);
		$data_disposisi_surat_masuk = array(
											'SURAT_MASUK_ID'    => $surat_masuk_id,
											'DINAS_ID' 			=> $this->input->post('dinas'),
											'CATATAN_DISPOSISI' => $this->input->post('catatan'),
											'USER_ID'  			=> $this->session->userdata('iduser')
										);
		$this->form_validation->set_rules('dinas', 'Dinas', 'callback_cek_dropdown');					
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		if($this->form_validation->run())
		{
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
		else
		{
			$this->disposisi($surat_masuk_id);
		}
		*/
		//print_r($this->input->post('skpd'));
	}
	
	function kirim_ke_pejabat($surat_masuk_id)
	{
		//$data_surat_masuk = array('KIRIM' => $this->input->post('penerima'));
		$this->form_validation->set_rules('penerima', 'Penerima', 'callback_cek_dropdown');
		$this->form_validation->set_rules('teks_sms', 'Teks SMS', 'required');
		$this->form_validation->set_error_delimiters('<p class="error_message">', '</p>');
		$this->form_validation->set_message('required', 'Kolom %s harus diisi !!');
		$get_message = $this->sms_model->get_template_kirim($this->session->userdata('dinas_id'))->row();
		$message = $get_message->TEMPLATE_SMS;
		if($this->form_validation->run())
		{
			/*
			if($this->input->post('penerima') > 7)
			{
				$result = $this->user_model->get_user_by_dinas_id($this->input->post('penerima'));
			}
			else
			{
				$result = $this->user_model->get_user_by_role($this->input->post('penerima'));
			}
			*/
			//echo count($result->result());
			$date = date('Y-m-d H:i:s');
			
			/*
			if(count($result->result()) > 0)
			{
				foreach($result->result() as $row)
				{
					$no_hp = $row->NO_HP;
					$this->surat_masuk_model->sendMessage($no_hp,$date,$message);
				}
			}
			*/
			$this->surat_masuk_model->update($surat_masuk_id, array('TGL_KIRIM' => $date));
			foreach($this->input->post('penerima') as $items)
			{
				$result = $this->user_model->get_user_by_dinas_id($items);
				$this->surat_masuk_model->update4($surat_masuk_id, $items, array('STATUS_KIRIM' => 1));
				$no_hp = $result->row()->NO_HP;
				$this->surat_masuk_model->sendMessage($no_hp,$date,$this->input->post('teks_sms'));
			}
			redirect('surat_masuk');
		}
		else
		{
			$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
			//$result2 = $this->dinas_model->get_all_dinas_disposisi();
			$result2 = $this->surat_masuk_model->get_penerima_surat($surat_masuk_id);
			$size = $this->surat_masuk_model->count_penerima_surat($surat_masuk_id);
			if(count($result2->result()) > 0)
			{
				foreach($result2->result() as $row)
				{
					$dinas[$row->TUJUAN] = $row->NAMA_DINAS;
				}
			}
			$data['penerima'] = $dinas;
			$data['nomor'] = $result1->NOMOR;
			$data['size'] = $size;
			$data['teks_sms'] = $message;
			$data['content'] = $this->load->view('form_kirim_surat_masuk',$data,true);
			$this->load->view('main',$data);
		}
	}
	
	function komentar($surat_masuk_id)
	{	
		$result = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		if($this->session->userdata('kode_role') == 8)
		{
			$result2 = $this->surat_masuk_model->get_komentar($this->session->userdata('dinas_id'),$surat_masuk_id);
		}
		else
		{
			$result2 = $this->surat_masuk_model->get_komentar($this->session->userdata('kode_role'),$surat_masuk_id);
		}
		
		if($result2->num_rows())
		{
			$komentar = $result2->row()->KOMENTAR;
			if($result2->row()->KOMENTAR != '')
			{
				$val_button = 'Perbarui';
			}
			else
			{
				$val_button = 'Tambah';
			}	
		}
		else
		{
			$komentar = '-';
			$val_button = 'Tambah';
		}
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['nomor'] = $result->NOMOR;
		$data['komentar'] = $komentar;
		$data['val_button'] = $val_button;
		$data['content'] = $this->load->view('form_komentar',$data,true);
		$this->load->view('main',$data);
	}
	
	function komentar_proses($surat_masuk_id)
	{
		if($this->session->userdata('kode_role') == 8)
		{
			$result2 = $this->surat_masuk_model->get_komentar($this->session->userdata('dinas_id'),$surat_masuk_id);
			$komentator = $this->session->userdata('dinas_id');
		}
		else
		{
			$result2 = $this->surat_masuk_model->get_komentar($this->session->userdata('kode_role'),$surat_masuk_id);
			$komentator = $this->session->userdata('kode_role');
		}
		
		if($result2->num_rows())
		{
			$data = array(
						'KOMENTAR' => $this->input->post('komentar') 
					);
			$this->surat_masuk_model->update3($surat_masuk_id, $komentator, $data);
		}
		else
		{
			$data = array(
						'SURAT_MASUK_ID' => $surat_masuk_id,
						'KOMENTATOR' => $komentator,
						'KOMENTAR' => $this->input->post('komentar') 
					);
			$this->surat_masuk_model->add5($data);
		}
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
	
	function download2($surat_masuk_id,$user_id)
	{
		// gett the file from DB
		$record = $this->surat_masuk_model->get_disposisi($surat_masuk_id,$user_id);
		if($record->num_rows() > 0 )
		{
			$nama_paket = $record->row()->FILE_DISPOSISI;
			if (is_file('./uploads/surat/'.$nama_paket)){
				$data = file_get_contents('./uploads/surat/'.$nama_paket);			
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
		$penerima = $this->surat_masuk_model->get_penerima_surat2($surat_masuk_id);
		$komentar = $this->surat_masuk_model->get_all_komentar($surat_masuk_id)->result();
		$kode_role = $this->session->userdata('kode_role');
		$dinas_id = $this->session->userdata('dinas_id');
		if($kode_role != 1)
		{
			if($kode_role > 7)
			{
				if($this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $dinas_id))
				{
					$data = array(
								'SURAT_MASUK_ID' => $surat_masuk_id, 
								'PENERIMA' => $dinas_id
								);
					$this->surat_masuk_model->add4($data);
				}
			}
			else
			{
				if($this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $kode_role))
				{
					$data = array(
								'SURAT_MASUK_ID' => $surat_masuk_id, 
								'PENERIMA' => $kode_role
								);
					$this->surat_masuk_model->add4($data);
				}
			}
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
		
		
		$data['penerima'] = $penerima->result();
		$data['lampiran'] = $result3->LAMPIRAN;
		$data['catatan'] = $result3->CATATAN_TERIMA_SURAT_MASUK;
		$data['file_surat_masuk'] = $result4;
		$data['komentar'] = $komentar;
		$data['content'] = $this->load->view('detail_surat_masuk',$data,true);
		$this->load->view('main',$data);
	}
	
	function detail_surat_masuk_dan_disposisi($surat_masuk_id,$disposisi_id)
	{
		$urgensi = $this->urgensi();
		//$user_id = $this->session->userdata('iduser');
		$result = $this->surat_masuk_model->get_disposisi2($disposisi_id)->row();
		$result1 = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row();
		$result2 = $this->surat_masuk_model->get_all_penerima_disposisi2($disposisi_id)->result();
		$result3 = $this->surat_masuk_model->get_all_komentar_disposisi2($disposisi_id)->result();
		$data['tgl_disposisi'] = date("d-m-Y", strtotime($result->TANGGAL_DISPOSISI));
		$data['nomor'] = $result1->NOMOR;
		$data['penerima'] = $result2;
		$data['urgensi'] = $urgensi[$result->URGENSI];
		$data['disposisi_dari'] = $result->NAMA_DINAS;
		$data['surat_masuk_id'] = $surat_masuk_id;
		$data['catatan_disposisi'] = $result->CATATAN_DISPOSISI;
		$data['disposisi_id'] = $result->DISPOSISI_ID;
		$data['file_disposisi_surat_masuk'] = $result->FILE_DISPOSISI;
		$data['komentar_disposisi'] = $result3;
		
		$penerima = $this->surat_masuk_model->get_penerima_surat2($surat_masuk_id);
		$komentar = $this->surat_masuk_model->get_all_komentar($surat_masuk_id)->result();
		$kode_role = $this->session->userdata('kode_role');
		$dinas_id = $this->session->userdata('dinas_id');
		if($kode_role != 1)
		{
			if($kode_role > 7)
			{
				if($this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $dinas_id))
				{
					$data = array(
								'SURAT_MASUK_ID' => $surat_masuk_id, 
								'PENERIMA' => $dinas_id
								);
					$this->surat_masuk_model->add4($data);
				}
			}
			else
			{
				if($this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $kode_role))
				{
					$data = array(
								'SURAT_MASUK_ID' => $surat_masuk_id, 
								'PENERIMA' => $kode_role
								);
					$this->surat_masuk_model->add4($data);
				}
			}
		}
		
		$results3 = $this->surat_masuk_model->get_surat_masuk_by_id2($surat_masuk_id)->row();
		$results4 = $this->surat_masuk_model->get_file_surat_masuk_by_id($surat_masuk_id)->result();
		$results5 = '';
		if($this->surat_masuk_model->cek_surat_masuk_id($surat_masuk_id))
		{
			$results5 = $this->surat_masuk_model->get_catatan_disposisi($surat_masuk_id);
		}
		$temp1 = explode('-', $results3->TGL_TERIMA);
		$temp2 = explode('-', $results3->TGL_SURAT);
		$data['sifat'] = $results3->SIFAT;
		$data['nomor'] = $results3->NOMOR;
		$data['tgl_terima'] = $temp1[2].'-'.$temp1[1].'-'.$temp1[0];
		if($results3->TGL_SURAT != null)
		{
			$data['tgl_surat'] = $temp2[2].'-'.$temp2[1].'-'.$temp2[0];
		}
		$data['jenis_surat'] = $results3->NAMA_JENIS_SURAT;
		$data['dari'] = $results3->NAMA_INSTANSI;
		$data['perihal'] = $results3->PERIHAL;
		
		
		$data['penerima'] = $penerima->result();
		$data['lampiran'] = $results3->LAMPIRAN;
		$data['catatan'] = $results3->CATATAN_TERIMA_SURAT_MASUK;
		$data['file_surat_masuk'] = $results4;
		$data['komentar'] = $komentar;
		$data['content'] = $this->load->view('detail_surat_masuk_join_disposisi',$data,true);
		$this->load->view('main',$data);
	}
	
	function status1($surat_masuk_id)
	{
		$kode_role = $this->session->userdata('kode_role');
		$dinas_id = $this->surat_masuk_model->get_surat_masuk_by_id($surat_masuk_id)->row()->KIRIM;
		$data['penerima'] = $this->dinas_model->get_dinas_by_id($dinas_id)->row()->NAMA_DINAS;
		if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $dinas_id))
		{
			$data['status_terima'] = '<p class="success_message">Surat Sudah Diperiksa</p>';
			$data['success_sign'] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
		}
		else
		{
			$data['status_terima'] = '<p class="error_message">Surat Belum Diperiksa</p>';
		}	
		$data['content'] = $this->load->view('status_kirim',$data,true);
		$this->load->view('main',$data);
	}
	
	function status2($surat_masuk_id)
	{
		$user_id = $this->session->userdata('iduser');
		$result = $this->surat_masuk_model->get_disposisi($surat_masuk_id,$user_id)->row();
		$result2 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id, $surat_masuk_id)->result();
		$data_penerima_disposisi = array();
		$data_penerima_disposisi_a1 = array();
		$data_penerima_disposisi_a2 = array();
		$data_penerima_disposisi_a3 = array();
		$data_penerima_disposisi_s = array();
		$data_penerima_disposisi_w = array();
		$status_terima = array();
		$status_terima_a1 = array();
		$status_terima_a2 = array();
		$status_terima_a3 = array();
		$status_terima_s = array();
		$status_terima_w = array();
		$success_sign = array();
		$success_sign_a1 = array();
		$success_sign_a2 = array();
		$success_sign_a3 = array();
		$success_sign_s = array();
		$success_sign_w = array();
		$i = 0;
		$j = 0;
		foreach($result2 as $row_penerima_disposisi)
		{
			$data_penerima_disposisi[$i] = $row_penerima_disposisi->NAMA_DINAS;
			if($row_penerima_disposisi->PENERIMA == 2)
			{
				$user_id_a1 = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_a1 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_a1,$surat_masuk_id)->result();
				foreach($result_a1 as $terima_dr_a1)
				{
					$data_penerima_disposisi_a1[$j] = $terima_dr_a1->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_a1->PENERIMA))
					{
						$status_terima_a1[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_a1[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_a1[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_a1[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 3)
			{
				$user_id_a2 = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_a2 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_a2,$surat_masuk_id)->result();
				foreach($result_a2 as $terima_dr_a2)
				{
					$data_penerima_disposisi_a2[$j] = $terima_dr_a2->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_a2->PENERIMA))
					{
						$status_terima_a2[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_a2[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_a2[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_a2[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 4)
			{
				$user_id_a3 = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_a3 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_a3,$surat_masuk_id)->result();
				foreach($result_a3 as $terima_dr_a3)
				{
					$data_penerima_disposisi_a3[$j] = $terima_dr_a3->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_a3->PENERIMA))
					{
						$status_terima_a3[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_a3[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_a3[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_a3[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 5)
			{
				$user_id_s = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_s = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_s,$surat_masuk_id)->result();
				foreach($result_s as $terima_dr_s)
				{
					$data_penerima_disposisi_s[$j] = $terima_dr_s->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_s->PENERIMA))
					{
						$status_terima_s[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_s[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_s[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_s[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 6)
			{
				$user_id_w = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_w = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_w,$surat_masuk_id)->result();
				foreach($result_w as $terima_dr_w)
				{
					$data_penerima_disposisi_w[$j] = $terima_dr_w->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_w->PENERIMA))
					{
						$status_terima_w[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_w[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_w[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_w[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			
			if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $row_penerima_disposisi->PENERIMA))
			{
				$status_terima[$i] = '<p class="success_message">Surat Sudah Diperiksa</p>';
				$success_sign[$i] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
			}
			else
			{
				$status_terima[$i] = '<p class="error_message">Surat Belum Diperiksa</p>';
				$success_sign[$i] = '';
			}
			$i++;
		}
		$data['data_penerima_disposisi'] = $data_penerima_disposisi;
		$data['data_penerima_disposisi_a1'] = $data_penerima_disposisi_a1;
		$data['data_penerima_disposisi_a2'] = $data_penerima_disposisi_a2;
		$data['data_penerima_disposisi_a3'] = $data_penerima_disposisi_a3;
		$data['data_penerima_disposisi_s'] = $data_penerima_disposisi_s;
		$data['data_penerima_disposisi_w'] = $data_penerima_disposisi_w;
		$data['status_terima'] = $status_terima;
		$data['status_terima_a1'] = $status_terima_a1;
		$data['status_terima_a2'] = $status_terima_a2;
		$data['status_terima_a3'] = $status_terima_a3;
		$data['status_terima_s'] = $status_terima_s;
		$data['status_terima_w'] = $status_terima_w;
		$data['success_sign'] = $success_sign;
		$data['success_sign_a1'] = $success_sign_a1;
		$data['success_sign_a2'] = $success_sign_a2;
		$data['success_sign_a3'] = $success_sign_a3;
		$data['success_sign_s'] = $success_sign_s;
		$data['success_sign_w'] = $success_sign_w;
		
		if($this->session->userdata('kode_role') == 2 || $this->session->userdata('kode_role') == 3 || $this->session->userdata('kode_role') == 4)
		{
			$data['content'] = $this->load->view('status_disposisi_asisten',$data,true);
		}
		else if($this->session->userdata('kode_role') == 5)
		{
			$data['content'] = $this->load->view('status_disposisi_sekretaris',$data,true);
		}
		else if($this->session->userdata('kode_role') == 6)
		{
			$data['content'] = $this->load->view('status_disposisi_wabup',$data,true);
		}
		else if($this->session->userdata('kode_role') == 7)
		{
			$data['content'] = $this->load->view('status_disposisi_bupati',$data,true);
		}
		$this->load->view('main',$data);
	}
	
	function status2_gdd($surat_masuk_id)
	{
		$user_id = $this->session->userdata('iduser');
		$result = $this->surat_masuk_model->get_disposisi($surat_masuk_id,$user_id)->row();
		$result2 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id, $surat_masuk_id)->result();
		$data_penerima_disposisi = array();
		$data_penerima_disposisi = array();
		$data_penerima_disposisi_a1 = array();
		$data_penerima_disposisi_a2 = array();
		$data_penerima_disposisi_a3 = array();
		$data_penerima_disposisi_s = array();
		$data_penerima_disposisi_w = array();
		$status_terima = array();
		$status_terima_a1 = array();
		$status_terima_a2 = array();
		$status_terima_a3 = array();
		$status_terima_s = array();
		$status_terima_w = array();
		$success_sign = array();
		$success_sign_a1 = array();
		$success_sign_a2 = array();
		$success_sign_a3 = array();
		$success_sign_s = array();
		$success_sign_w = array();
		$i = 0;
		$j = 0;
		foreach($result2 as $row_penerima_disposisi)
		{
			$data_penerima_disposisi[$i] = $row_penerima_disposisi->NAMA_DINAS;
			if($row_penerima_disposisi->PENERIMA == 2)
			{
				$user_id_a1 = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_a1 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_a1,$surat_masuk_id)->result();
				foreach($result_a1 as $terima_dr_a1)
				{
					$data_penerima_disposisi_a1[$j] = $terima_dr_a1->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_a1->PENERIMA))
					{
						$status_terima_a1[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_a1[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_a1[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_a1[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 3)
			{
				$user_id_a2 = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_a2 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_a2,$surat_masuk_id)->result();
				foreach($result_a2 as $terima_dr_a2)
				{
					$data_penerima_disposisi_a2[$j] = $terima_dr_a2->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_a2->PENERIMA))
					{
						$status_terima_a2[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_a2[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_a2[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_a2[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 4)
			{
				$user_id_a3 = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_a3 = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_a3,$surat_masuk_id)->result();
				foreach($result_a3 as $terima_dr_a3)
				{
					$data_penerima_disposisi_a3[$j] = $terima_dr_a3->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_a3->PENERIMA))
					{
						$status_terima_a3[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_a3[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_a3[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_a3[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 5)
			{
				$user_id_s = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_s = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_s,$surat_masuk_id)->result();
				foreach($result_s as $terima_dr_s)
				{
					$data_penerima_disposisi_s[$j] = $terima_dr_s->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_s->PENERIMA))
					{
						$status_terima_s[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_s[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_s[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_s[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if($row_penerima_disposisi->PENERIMA == 6)
			{
				$user_id_w = $this->user_model->get_user_by_dinas_id($row_penerima_disposisi->PENERIMA)->row()->USER_ID;
				$result_w = $this->surat_masuk_model->get_all_penerima_disposisi($user_id_w,$surat_masuk_id)->result();
				foreach($result_w as $terima_dr_w)
				{
					$data_penerima_disposisi_w[$j] = $terima_dr_w->NAMA_DINAS;
					if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $terima_dr_w->PENERIMA))
					{
						$status_terima_w[$j] = '<p class="success_message">Surat Sudah Diperiksa</p>';
						$success_sign_w[$j] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
					}
					else
					{
						$status_terima_w[$j] = '<p class="error_message">Surat Belum Diperiksa</p>';
						$success_sign_w[$j] = '';
					}
					$j++;
				}
				$j = 0;
			}
			if(!$this->surat_masuk_model->cek_status_terima_surat($surat_masuk_id, $row_penerima_disposisi->PENERIMA))
			{
				$status_terima[$i] = '<p class="success_message">Surat Sudah Diperiksa</p>';
				$success_sign[$i] = '<td><img border=\'0\' src=\''.base_url().'images/flexigrid/1.png\'></td>';
			}
			else
			{
				$status_terima[$i] = '<p class="error_message">Surat Belum Diperiksa</p>';
				$success_sign[$i] = '';
			}
			$i++;
		}
		$data['data_penerima_disposisi'] = $data_penerima_disposisi;
		$data['data_penerima_disposisi_a1'] = $data_penerima_disposisi_a1;
		$data['data_penerima_disposisi_a2'] = $data_penerima_disposisi_a2;
		$data['data_penerima_disposisi_a3'] = $data_penerima_disposisi_a3;
		$data['data_penerima_disposisi_s'] = $data_penerima_disposisi_s;
		$data['data_penerima_disposisi_w'] = $data_penerima_disposisi_w;
		$data['status_terima'] = $status_terima;
		$data['status_terima_a1'] = $status_terima_a1;
		$data['status_terima_a2'] = $status_terima_a2;
		$data['status_terima_a3'] = $status_terima_a3;
		$data['status_terima_s'] = $status_terima_s;
		$data['status_terima_w'] = $status_terima_w;
		$data['success_sign'] = $success_sign;
		$data['success_sign_a1'] = $success_sign_a1;
		$data['success_sign_a2'] = $success_sign_a2;
		$data['success_sign_a3'] = $success_sign_a3;
		$data['success_sign_s'] = $success_sign_s;
		$data['success_sign_w'] = $success_sign_w;
		
		if($this->session->userdata('kode_role') == 2 || $this->session->userdata('kode_role') == 3 || $this->session->userdata('kode_role') == 4)
		{
			$data['content'] = $this->load->view('status_disposisi_asisten2',$data,true);
		}
		else if($this->session->userdata('kode_role') == 5)
		{
			$data['content'] = $this->load->view('status_disposisi_sekretaris2',$data,true);
		}
		else if($this->session->userdata('kode_role') == 6)
		{
			$data['content'] = $this->load->view('status_disposisi_wabup2',$data,true);
		}
		else if($this->session->userdata('kode_role') == 7)
		{
			$data['content'] = $this->load->view('status_disposisi_bupati2',$data,true);
		}
		$this->load->view('main',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
