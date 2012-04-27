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
		
	function add($user)
	{
		$this->db->insert('jabatan', $user);
	}
			
	function update($userid, $user)
	{
		$this->db->where('jabatan.USERID', $userid);
		$this->db->update('jabatan', $user);
	}
		
	function delete($userid)
	{
		$this->db->where('jabatan.USERID', $userid);
		$this->db->delete('jabatan');
	}
		
	function get_jabatan()
	{
		$this->db->select('*');
		$this->db->from('jabatan');
		$result = $this->db->get();
		return $result;
	}
}
