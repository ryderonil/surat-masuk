<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jenis_surat_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->CI = get_instance();
	}
		
	function grid_jenis_surat()
	{
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
		
	function add($jenis_surat)
	{
		$this->db->insert('jenis_surat', $jenis_surat);
	}
	
	function addtes($jenis_surat)
	{
		$this->db->insert('te', $jenis_surat);
	}
			
	function update($jenis_surat_id, $jenis_surat)
	{
		$this->db->where('jenis_surat.JENIS_SURAT_ID', $jenis_surat_id);
		$this->db->update('jenis_surat', $jenis_surat);
	}
		
	function delete($jenis_surat_id)
	{
		$this->db->where('jenis_surat.JENIS_SURAT_ID', $jenis_surat_id);
		$this->db->delete('jenis_surat');
	}
	
	function get_all_jenis_surat_aktif()
	{
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$this->db->where('jenis_surat.STATUS_JENIS_SURAT', 1);
		$result = $this->db->get();
		return $result;
	}
	
	function get_all_jenis_surat()
	{
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$result = $this->db->get();
		return $result;
	}
		
	function get_jenis_surat($jenis_surat_id)
	{
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$this->db->where('jenis_surat.JENIS_SURAT_ID', $jenis_surat_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_last_jenis_surat_id()
	{
		$this->db->select_max('JENIS_SURAT_ID');
		$query = $this->db->get('jenis_surat');
		return $query;
	}
		
	function cek_jenis_surat($jenis_surat)
	{
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$this->db->where('NAMA_JENIS_SURAT', $jenis_surat);
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
	
	function cek_jenis_surat2($jenis_surat_id)
	{
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$this->db->where('JENIS_SURAT_ID', $jenis_surat_id);
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
	
	function cek_jenis_surat_baru($nama_jenis_surat, $jenis_surat_id)
	{	
		$this->db->select('*');
		$this->db->from('jenis_surat');
		$this->db->where('NAMA_JENIS_SURAT', $nama_jenis_surat);			
		$this->db->where('JENIS_SURAT_ID <>',$jenis_surat_id);
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
	
	public function cek_referensi($jenis_surat_id)
	{	
		$this->db->select('JENIS_SURAT_ID');
		$this->db->from('surat_masuk');
		$this->db->where('JENIS_SURAT_ID', $jenis_surat_id);
		if($this->db->get()->num_rows())
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
	
}
