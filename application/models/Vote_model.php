<?php

class Vote_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function add($question_id, $user_id, $is_admin=0){

		$data = array(
			'question_id' => $question_id,
			'is_admin' => $is_admin,
			'user_id' => $user_id
		);

		$this->db->insert('user_votes', $data);
	}

	public function get_user_voted($question_id, $user_id, $is_admin){
		$this->db->where('question_id', $question_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('is_admin', $is_admin);
		$query = $this->db->get('user_votes');

		if($query->num_rows() === 1){
			return $query->row(0);
		}else{
			return false;
		}
	}
}
