<?php 

class User_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
	}

	public function register_user($enc_password){
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => $enc_password
		);
		$this->db->insert('users', $data);
	}

	public function login_user($enc_password, $username){
		$this->db->where('username', $username);
		$this->db->where('password', $enc_password);
		$query = $this->db->get('users');
		// return $query = $this->db->get('users')->num_rows();
		if($query->num_rows() === 1){
			return $query->row(0)->id;
		} else{
			return false;
		}
	}

	public function user_profile($user_id){
		$this->db->where('id', $user_id);
		$query = $this->db->get('users');
		if($query->num_rows() > 0){
			return $query->row(0);
		}else{
			return false;
		}
	}

}