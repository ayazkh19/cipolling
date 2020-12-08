<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Choice_model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function add_choice($choice_text){
        $data = array(
            'choice_text' => $choice_text
        );
        $this->db->insert('choices', $data);
    }

    public function delete_choice($choice_id){
    	$this->db->where('id', $choice_id);
    	$this->db->delete('choices');
    }

    public function get_result(){
        $this->db->select_max('votes');
        $query = $this->db->get('choices');
        $votes = $query->result_array()[0]['votes'];

        $this->db->where('votes', $votes);
        $query = $this->db->get('choices');
        return $query->result_array();
    }

}