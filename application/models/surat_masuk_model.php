<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_masuk_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->CI = get_instance();
	}
		
	function grid_surat_masuk()
	{
		$this->db->select('*');
		$this->db->from('surat_masuk');
		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('surat_masuk');
		
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
	
	function grid_surat_masuk2($dinas_id)
	{
		$this->db->select('*');
		$this->db->from('tujuan_surat');
		$this->db->join('surat_masuk','surat_masuk.surat_masuk_id = tujuan_surat.tujuan');
		$this->db->where('tujuan',$dinas_id);
		
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('tujuan_surat');
		$this->db->join('surat_masuk','surat_masuk.surat_masuk_id = tujuan_surat.tujuan');
		$this->db->where('tujuan',$dinas_id);
		
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
	
	function grid_surat_masuk_disposisi($id)
	{
		//$sql = 'SELECT * FROM detail_disposisi JOIN disposisi_surat_masuk ON disposisi_surat_masuk.disposisi_id = detail_disposisi.disposisi_id JOIN surat_masuk ON surat_masuk.surat_masuk_id = disposisi_surat_masuk.surat_masuk_id WHERE detail_disposisi.penerima = ?';
		$this->db->select('*');
		$this->db->from('detail_disposisi');
		$this->db->join('disposisi_surat_masuk', 'disposisi_surat_masuk.disposisi_id = detail_disposisi.disposisi_id');
		$this->db->join('surat_masuk', 'surat_masuk.surat_masuk_id = disposisi_surat_masuk.surat_masuk_id');
		$this->db->where('detail_disposisi.penerima', $id);
		//$result = $this->db->query($sql, array($id));
		$this->CI->flexigrid->build_query();		
		$return['records'] =$this->db->get();
		
		//$sql2 = 'SELECT COUNT(*) FROM detail_disposisi JOIN disposisi_surat_masuk ON disposisi_surat_masuk.disposisi_id = detail_disposisi.disposisi_id JOIN surat_masuk ON surat_masuk.surat_masuk_id = disposisi_surat_masuk.surat_masuk_id WHERE detail_disposisi.penerima = ?';
		//$result2 = $this->db->query($sql2, array($id));
		$this->db->select('*');
		$this->db->from('detail_disposisi');
		$this->db->join('disposisi_surat_masuk', 'disposisi_surat_masuk.disposisi_id = detail_disposisi.disposisi_id');
		$this->db->join('surat_masuk', 'surat_masuk.surat_masuk_id = disposisi_surat_masuk.surat_masuk_id');
		$this->db->where('detail_disposisi.penerima', $id);
		
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
	
	function add($surat_masuk)
	{
		$this->db->insert('surat_masuk', $surat_masuk);
	}
	
	function add2($file_surat_masuk)
	{
		$this->db->insert('file_surat_masuk', $file_surat_masuk);
	}
	
	function add3($disposisi_surat_masuk)
	{
		$this->db->insert('disposisi_surat_masuk', $disposisi_surat_masuk);
	}
	
	function add4($status_terima)
	{
		$this->db->insert('log_terima_surat', $status_terima);
	}
	
	function add5($komentar)
	{
		$this->db->insert('komentar_surat', $komentar);
	}
	
	function add6($data_detail_disposisi)
	{
		$this->db->insert('detail_disposisi', $data_detail_disposisi);
	}
	
	function add7($komentar_disposisi)
	{
		$this->db->insert('komentar_disposisi', $komentar_disposisi);
	}
	
	function add8($tujuan_surat)
	{
		$this->db->insert('tujuan_surat', $tujuan_surat);
	}
			
	function update($surat_masuk_id, $surat_masuk)
	{
		$this->db->where('surat_masuk.SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->update('surat_masuk', $surat_masuk);
	}
	
	function update2($file_surat_masuk_id, $file_surat_masuk)
	{
		$this->db->where('file_surat_masuk.FILE_SURAT_MASUK_ID', $file_surat_masuk_id);
		$this->db->update('file_surat_masuk', $file_surat_masuk);
	}
	
	function update3($surat_masuk_id, $komentator, $komentar)
	{
		$this->db->where('komentar_surat.SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->where('komentar_surat.KOMENTATOR', $komentator);
		$this->db->update('komentar_surat', $komentar);
	}
	
	function update4($surat_masuk_id,$penerima,$data)
	{
		$this->db->where('tujuan_surat.SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->where('tujuan_surat.TUJUAN', $penerima);
		$this->db->update('tujuan_surat', $data);
	}
		
	function delete($userid)
	{
		$this->db->where('user.USER_ID', $userid);
		$this->db->delete('user');
	}
		
	function get_surat_masuk_by_id($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('surat_masuk');
		$this->db->where('surat_masuk.SURAT_MASUK_ID', $surat_masuk_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_surat_masuk_by_id2($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('surat_masuk');
		$this->db->join('jenis_surat','jenis_surat.JENIS_SURAT_ID = surat_masuk.JENIS_SURAT_ID');
		$this->db->join('instansi','instansi.INSTANSI_ID = surat_masuk.INSTANSI_ID');
		//$this->db->join('disposisi_surat_masuk','disposisi_surat_masuk.SURAT_MASUK_ID = surat_masuk.SURAT_MASUK_ID');
		$this->db->where('surat_masuk.SURAT_MASUK_ID', $surat_masuk_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_file_surat_masuk_by_id($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('file_surat_masuk');
		$this->db->where('file_surat_masuk.SURAT_MASUK_ID', $surat_masuk_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_file_surat_masuk_by_id2($file_surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('file_surat_masuk');
		$this->db->where('file_surat_masuk.FILE_SURAT_MASUK_ID', $file_surat_masuk_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_max_surat_masuk_id()
	{
		$this->db->select_max('SURAT_MASUK_ID');
		$query = $this->db->get('surat_masuk');
		return $query;
	}
	
	function get_max_disposisi_id()
	{
		$this->db->select_max('DISPOSISI_ID');
		$query = $this->db->get('disposisi_surat_masuk');
		return $query;
	}
	
	function get_catatan_disposisi($surat_masuk_id)
	{
		$this->db->select('CATATAN_DISPOSISI');
		$this->db->from('disposisi_surat_masuk');
		$this->db->where('disposisi_surat_masuk.SURAT_MASUK_ID', $surat_masuk_id);
		$result = $this->db->get()->row()->CATATAN_DISPOSISI;
		return $result;
	}
	
	function get_disposisi($surat_masuk_id,$user_id)
	{
		$this->db->select('*');
		$this->db->from('disposisi_surat_masuk');
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->where('USER_ID', $user_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_disposisi2($disposisi_id)
	{
		$this->db->select('*');
		$this->db->from('disposisi_surat_masuk');
		$this->db->join('user','user.USER_ID = disposisi_surat_masuk.USER_ID');
		$this->db->join('dinas','dinas.DINAS_ID = user.DINAS_ID');
		$this->db->where('DISPOSISI_ID', $disposisi_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_komentar($komentator, $surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('komentar_surat');
		$this->db->where('komentar_surat.SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->where('komentar_surat.KOMENTATOR', $komentator);
		$result = $this->db->get();
		return $result;
	}
	
	function get_all_komentar($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('komentar_surat');
		$this->db->join('dinas','dinas.DINAS_ID = komentar_surat.KOMENTATOR');
		$this->db->where('komentar_surat.SURAT_MASUK_ID', $surat_masuk_id);
		
		$result = $this->db->get();
		return $result;
	}
	
	function get_nama_dinas($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('disposisi_surat_masuk');
		$this->db->join('dinas', 'disposisi_surat_masuk.DINAS_ID = dinas.DINAS_ID');
		$this->db->where('disposisi_surat_masuk.SURAT_MASUK_ID', $surat_masuk_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_all_komentar_disposisi($user_id, $surat_masuk_id)
	{
		$sql = 'SELECT * FROM komentar_disposisi JOIN dinas ON dinas.dinas_id = komentar_disposisi.dinas_id JOIN disposisi_surat_masuk ON disposisi_surat_masuk.disposisi_id = komentar_disposisi.disposisi_id WHERE disposisi_surat_masuk.surat_masuk_id = ? AND disposisi_surat_masuk.user_id =  ?';
		$result = $this->db->query($sql, array($surat_masuk_id, $user_id));
		return $result;
	}
	
	function get_all_komentar_disposisi2($disposisi_id)
	{
		$sql = 'SELECT * FROM komentar_disposisi JOIN dinas ON dinas.dinas_id = komentar_disposisi.dinas_id JOIN disposisi_surat_masuk ON disposisi_surat_masuk.disposisi_id = komentar_disposisi.disposisi_id WHERE disposisi_surat_masuk.disposisi_id = ?';
		$result = $this->db->query($sql, array($disposisi_id));
		return $result;
	}
	
	function get_all_penerima_disposisi($user_id, $surat_masuk_id)
	{
		$sql = 'SELECT * FROM detail_disposisi JOIN dinas ON dinas.dinas_id = detail_disposisi.penerima JOIN disposisi_surat_masuk ON disposisi_surat_masuk.disposisi_id = detail_disposisi.disposisi_id WHERE disposisi_surat_masuk.surat_masuk_id = ? AND disposisi_surat_masuk.user_id = ?';
		$result = $this->db->query($sql, array($surat_masuk_id, $user_id));
		return $result;
	}
	
	function get_all_penerima_disposisi2($disposisi_id)
	{
		$sql = 'SELECT * FROM detail_disposisi JOIN dinas ON dinas.dinas_id = detail_disposisi.penerima JOIN disposisi_surat_masuk ON disposisi_surat_masuk.disposisi_id = detail_disposisi.disposisi_id WHERE disposisi_surat_masuk.disposisi_id = ?';
		$result = $this->db->query($sql, array($disposisi_id));
		return $result;
	}
	
	function get_penerima_surat($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('tujuan_surat');
		$this->db->join('dinas','dinas.dinas_id = tujuan_surat.tujuan');
		$this->db->where('surat_masuk_id',$surat_masuk_id);
		$this->db->where('status_kirim',0);
		return $this->db->get();
	}
	
	function get_penerima_surat2($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('tujuan_surat');
		$this->db->join('dinas','dinas.dinas_id = tujuan_surat.tujuan');
		$this->db->where('surat_masuk_id',$surat_masuk_id);
		return $this->db->get();
	}
		
	function cek_surat_masuk_id($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('disposisi_surat_masuk');
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		$result = $this->db->get();
		if ($result->num_rows())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function cek_apa_sudah_didisposisi($surat_masuk_id,$user_id)
	{
		$this->db->select('*');
		$this->db->from('disposisi_surat_masuk');
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->where('USER_ID', $user_id);
		$result = $this->db->get();
		if ($result->num_rows())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function cek_apa_sudah_dikirim($surat_masuk_id)
	{
		$this->db->select('*');
		$this->db->from('disposisi_surat_masuk');
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->where('USER_ID', $user_id);
		$result = $this->db->get();
		if ($result->num_rows())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	
	function cek_nomor($nomor)
	{
		$this->db->select('*');
		$this->db->from('surat_masuk');
		$this->db->where('NOMOR', $nomor);
		$result = $this->db->get();
		if ($result->num_rows())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function cek_nomor_baru($nomor, $surat_masuk_id)
	{	
		$this->db->select('*');
		$this->db->from('surat_masuk');
		$this->db->where('NOMOR', $nomor);			
		$this->db->where('SURAT_MASUK_ID <>',$surat_masuk_id);
		//$query = $this->db->query('select * from login WHERE username =  "'.$username.'" and kode_user <> '.$kode_user);
		$query = $this->db->get();
		if ($query->num_rows())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function cek_referensi($USER_ID)
	{	
		$this->db->select('USER_ID');
		$this->db->from('log');
		$this->db->where('USER_ID', $USER_ID);
		if($this->db->get()->num_rows())
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
	
	public function cek_status_terima_surat($surat_masuk_id,$id)
	{	
		$this->db->select('*');
		$this->db->from('log_terima_surat');
		$this->db->where('PENERIMA', $id);
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		if($this->db->get()->num_rows())
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
	
	function count_penerima_surat($surat_masuk_id)
	{				
		$this->db->where('STATUS_KIRIM', 0);
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->from('tujuan_surat');
		return $this->db->count_all_results();
	}
	
	function count_file_surat_masuk($surat_masuk_id)
	{				
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->from('file_surat_masuk');
		return $this->db->count_all_results();
	}
	
	function sendMessage($dest, $date, $message) {
		$data = array (
				'InsertIntoDB' => date('Y-m-d H:i:s'),
				'SendingDateTime' => $date,
				'DestinationNumber' => $dest,
				'Coding' => 'Default_No_Compression',
				'TextDecoded' => $message,
				'CreatorId' => ' ',
					);
		$this->db->insert('outbox',$data);		
	}
}
