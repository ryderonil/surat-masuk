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
	
	function login($user, $pass)
	{
	    $this->db->select('*');
		$this->db->from('user');
		$this->db->where('USERNAME', $user);
		$this->db->where('PASSWORD', $pass);
		$resilt = $this->db->get();
		return $resilt;
	}
	
	function cek_password($userid, $pass_lama)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('PASSWORD', $pass_lama);
		$this->db->where('USERID', $userid);
		$result = $this->db->get();
		return $result;
	}
	
	function ubah_pass($userid, $pass)
	{
		$this->db->where('user.USERID', $userid);
		$this->db->update('user.PASSWORD', $pass);
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
	
	function count_file_surat_masuk($surat_masuk_id)
	{				
		$this->db->where('SURAT_MASUK_ID', $surat_masuk_id);
		$this->db->from('file_surat_masuk');
		return $this->db->count_all_results();
	}
}
