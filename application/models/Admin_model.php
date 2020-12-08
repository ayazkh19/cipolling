<?php 

class Admin_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function admin_login($username, $password){
		
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('admin_users');

		if($query->num_rows() === 1){
			return $query->row(0);
		}else{
			return null;
		}
	}

	public function get_users(){
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function delete_user($user_id){
		$this->db->where('id', $user_id);
		$this->db->delete('users');

		
	}

	public function profile($user_id){
		$this->db->where('id', $user_id);
		$query = $this->db->get('admin_users');
		if($query->num_rows() > 0){
			return $query->row(0);
		}else{
			return false;
		}
	}

	public function edit_profile($user_id){
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
		);

		$this->db->where('id', $user_id);
		$this->db->update('admin_users', $data);
	}

}