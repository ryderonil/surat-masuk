<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->CI = get_instance();
	}
		
	function grid_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('jabatan','jabatan.JABATAN_ID = user.JABATAN_ID');
		$this->CI->flexigrid->build_query();		
		$return['records'] = $this->db->get();
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('jabatan','jabatan.JABATAN_ID = user.JABATAN_ID');
		$this->CI->flexigrid->build_query(FALSE);
		$return['record_count'] = $this->db->count_all_results();
		return $return;		
	}
		
	function add($user)
	{
		$this->db->insert('user', $user);
	}
			
	function update($userid, $user)
	{
		$this->db->where('user.USER_ID', $userid);
		$this->db->update('user', $user);
	}
		
	function delete($userid)
	{
		$this->db->where('user.USER_ID', $userid);
		$this->db->delete('user');
	}
		
	function get_user($userid)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('jabatan', 'jabatan.JABATAN_ID = user.JABATAN_ID');
		$this->db->where('user.USER_ID', $userid);
		$result = $this->db->get();
		return $result;
	}
		
	function cek_username($username)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('USERNAME', $username);
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
	
	function cek_username_baru($username, $user_id)
	{	
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('USERNAME', $username);			
		$this->db->where('USER_ID <>',$user_id);
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
	
}
