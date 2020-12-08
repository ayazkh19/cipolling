<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model
{
    
    public function __construct()
    {
        $this->load->database();
    }

    public function get_questions($question_id = FALSE, $order_by = 'DESC')
    {
        if ($question_id === FALSE)
        {
            $this->db->order_by('created_at', $order_by);
            $query = $this->db->get('questions');
            return $query->result_array();
        }
        $query = $this->db->get_where('questions', array('id'=> $question_id));
        return $query->row_array();
    }

    public function get_questions_choices($question_id)
    {
        $this->db->order_by('votes', 'DESC');
        $query = $this->db->get_where('choices', array('question_id' => $question_id));
        if($query->result_array()>0)
        {
            return $query->result_array();
        }
        return false;
    }

    public function add_votes($choice_id, $votes)
    {
        $votes = $votes + 1;
        $data = array(
            'votes' => $votes,
        );
        $this->db->where('id', $choice_id);
        $this->db->update('choices', $data);
    }

    public function get_choices()
    {
        $this->db->order_by('votes', 'DESC');
        $query = $this->db->get('choices');
        return $query->result_array();
    }

    public function add_question($question_text, $choice_id)
    {
        $this->db->select_max('id');
        $query = $this->db->get('questions');
        
        $id = $query->result_array('id')[0]['id'];//getting the (id variable) field from result array
        $id = $id +1;
        $data = array(
            'slug' => $id,
            'question_text' => $question_text
        );
        $this->db->insert('questions', $data);

        // adding/updating choice to newly inserted question
        $this->db->select_max('id'); //getting the latest id
        $query = $this->db->get('questions');
        $id = $query->result_array('id')[0]['id'];

        $data = array(
            'question_id' => $id
        );
        $this->db->where('id', $choice_id);
        $this->db->update('choices', $data);
    }

    public function update_question($question_id, $choice_id, $question_text){
        $data = array(
            'question_text' => $question_text,
        );
        $this->db->where('id', $question_id);
        $this->db->update('questions', $data);

        $data = array(
            'question_id' => $question_id, 
        );
        $this->db->where('id', $choice_id);
        $this->db->update('choices', $data);

    }

    public function delete_question($question_id){
        $this->db->where('id', $question_id);
        $this->db->delete('questions');
    }

}