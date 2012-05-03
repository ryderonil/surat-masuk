<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dinas_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->CI = get_instance();
	}
		
	function grid_dinas()
	{
		$this->db->select('*');
		$this->db->from('dinas');
		//$this->db->join('jabatan','jabatan.JABATAN_ID = user.JABATAN_ID');
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('dinas');
		//$this->db->join('jabatan','jabatan.JABATAN_ID = user.JABATAN_ID');
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
		
	function add($dinas)
	{
		$this->db->insert('dinas', $dinas);
	}
			
	function update($dinas_id, $dinas)
	{
		$this->db->where('dinas.DINAS_ID', $dinas_id);
		$this->db->update('dinas', $dinas);
	}
		
	function delete($dinas_id)
	{
		$this->db->where('dinas.DINAS_ID', $dinas_id);
		$this->db->delete('dinas');
	}
		
	function get_dinas($dinas_id)
	{
		$this->db->select('*');
		$this->db->from('dinas');
		//$this->db->join('jabatan', 'jabatan.JABATAN_ID = user.JABATAN_ID');
		$this->db->where('dinas.DINAS_ID', $dinas_id);
		$result = $this->db->get();
		return $result;
	}
	
	function get_all_dinas()
	{
		$this->db->select('*');
		$this->db->from('dinas');
		$result = $this->db->get();
		return $result;
	}

	function get_last_dinas_id()
	{
		$this->db->select_max('DINAS_ID');
		$query = $this->db->get('dinas');
		return $query;
	}
		
	function cek_dinas($dinas)
	{
		$this->db->select('*');
		$this->db->from('dinas');
		$this->db->where('NAMA_DINAS', $dinas);
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
	
	function cek_dinas2($dinas_id)
	{
		$this->db->select('*');
		$this->db->from('dinas');
		$this->db->where('DINAS_ID', $dinas_id);
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
	
	function cek_dinas_baru($dinas, $dinas_id)
	{	
		$this->db->select('*');
		$this->db->from('dinas');
		$this->db->where('NAMA_DINAS', $dinas);			
		$this->db->where('DINAS_ID <>',$dinas_id);
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
	
	public function cek_referensi($DINAS_ID)
	{	
		$this->db->select('DINAS_ID');
		$this->db->from('disposisi_surat_masuk');
		$this->db->where('DINAS_ID', $DINAS_ID);
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
