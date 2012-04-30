<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->CI = get_instance();
	}
		
	function grid_jabatan()
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
		
	function add($jabatan)
	{
		$this->db->insert('jabatan', $jabatan);
	}
			
	function update($jabatan_id, $jabatan)
	{
		$this->db->where('jabatan.JABATAN_ID', $jabatan_id);
		$this->db->update('jabatan', $jabatan);
	}
		
	function delete($jabatan_id)
	{
		$this->db->where('jabatan.JABATAN_ID', $jabatan_id);
		$this->db->delete('jabatan');
	}
		
	function get_jabatan($jabatan_id)
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->db->where('jabatan.JABATAN_ID', $jabatan_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_all_jabatan()
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		$result = $this->db->get();
		return $result;
	}
		
	function cek_jabatan($jabatan)
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->db->where('NAMA_JABATAN', $jabatan);
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
	
	function cek_jabatan_baru($nama_jabatan, $jabatan_id)
	{	
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->db->where('NAMA_JABATAN', $nama_jabatan);			
		$this->db->where('JABATAN_ID <>',$jabatan_id);
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
	
	public function cek_referensi($JABATAN_ID)
	{	
		$this->db->select('JABATAN_ID');
		$this->db->from('user');
		$this->db->where('JABATAN_ID', $JABATAN_ID);
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
