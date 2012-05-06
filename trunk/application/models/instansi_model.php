<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instansi_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->CI = get_instance();
	}
		
	function grid_instansi()
	{
		$this->db->select('*');
		$this->db->from('instansi');
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('instansi');
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
		
	function add($instansi)
	{
		$this->db->insert('instansi', $instansi);
	}
			
	function update($instansi_id, $instansi)
	{
		$this->db->where('instansi.INSTANSI_ID', $instansi_id);
		$this->db->update('instansi', $instansi);
	}
		
	function delete($instansi_id)
	{
		$this->db->where('instansi.INSTANSI_ID', $instansi_id);
		$this->db->delete('instansi');
	}
	
	function get_all_instansi_aktif()
	{
		$this->db->select('*');
		$this->db->from('instansi');
		$this->db->where('instansi.STATUS_INSTANSI', 1);
		$result = $this->db->get();
		return $result;
	}
	
	function get_all_instansi()
	{
		$this->db->select('*');
		$this->db->from('instansi');
		$result = $this->db->get();
		return $result;
	}
	
	function get_instansi($instansi_id)
	{
		$this->db->select('*');
		$this->db->from('instansi');
		$this->db->where('instansi.INSTANSI_ID', $instansi_id);
		$result = $this->db->get();
		return $result;
	}
		
	function cek_instansi($instansi)
	{
		$this->db->select('*');
		$this->db->from('instansi');
		$this->db->where('NAMA_INSTANSI', $instansi);
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
	
	function cek_instansi2($instansi_id)
	{
		$this->db->select('*');
		$this->db->from('instansi');
		$this->db->where('INSTANSI_ID', $instansi_id);
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
	
	function cek_instansi_baru($nama_instansi, $instansi_id)
	{	
		$this->db->select('*');
		$this->db->from('instansi');
		$this->db->where('NAMA_INSTANSI', $nama_instansi);			
		$this->db->where('INSTANSI_ID <>',$instansi_id);
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
	
	public function cek_referensi($INSTANSI_ID)
	{	
		$this->db->select('INSTANSI_ID');
		$this->db->from('surat_masuk');
		$this->db->where('INSTANSI_ID', $INSTANSI_ID);
		if($this->db->get()->num_rows())
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
	
	function get_last_instansi_id()
	{
		$this->db->select_max('INSTANSI_ID');
		$query = $this->db->get('instansi');
		return $query;
	}
	
}
