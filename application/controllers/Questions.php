<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('question_model');
        $this->load->model('choice_model');
        $this->load->model('vote_model');
    }

    public function index()
    {
        $data['title'] = 'Questions';
        $data['questions'] = $this->question_model->get_questions();

        $this->load->view('templates/header');
        $this->load->view('questions/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($question_id)
    {
        // $slug = $id; //get questions by their id/slug
        // $question_id = $id; //get question's choices for the id/question id(in choices)

        $data['title'] = ucfirst('details');
        $data['question'] = $this->question_model->get_questions($question_id);
        $data['choices'] = $this->question_model->get_questions_choices($question_id);
        // if user is admin or not
        if( $this->session->userdata('is_logged_in') && $this->session->userdata('is_admin_user') ){
          $data['is_admin'] = 1;
          $user_id = $this->session->userdata('user_id');
          $data['voted_user'] = $this->vote_model->get_user_voted($question_id, $user_id, $data['is_admin']);
        } elseif($this->session->userdata('is_logged_in') && (!$this->session->userdata('is_admin_user'))){
          $data['is_admin'] = 0;
          $user_id = $this->session->userdata('user_id');
          $data['voted_user'] = $this->vote_model->get_user_voted($question_id, $user_id, $data['is_admin']);
        } else{
          $data['voted_user'] = null;
          $data['is_admin'] = null;
        }

        //check if logged in get the logged user
    /*    if($this->session->userdata('is_logged_in')){
            $user_id = $this->session->userdata('user_id');
            $data['voted_user'] = $this->vote_model->get_user_voted($question_id, $user_id);
            // echo $data['voted_user']->user_id;
        }else{
            $data['voted_user'] = null;
        } */
        // echo print_r($data['question']);
        // echo '<br>'.print_r($data['choices']);

        $this->load->view('templates/header');
        $this->load->view('questions/detail', $data);
        $this->load->view('templates/footer');

    }

    public function votes($choice_id, $question_id, $is_admin){

        if($this->session->userdata('is_logged_in') == FALSE){
            redirect('users/login');
            die();
        }
        // if($this->session->userdata('is_admin_user') == FALSE){
        //     redirect('questions');
        //     die();
        // }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('choice', 'Choice', 'required');
        $this->form_validation->set_rules('vote', 'Vote', 'required');

        // learn about form validation run() function
        if($this->form_validation->run() === FALSE){
            //echo 'from error';//this works too if someone access it directly through url
            redirect('questions');
        }else{
            // $choice_id = $this->input->post('choice');
            $choice_id = $choice_id;
            // get the loggedin user id
            $user_id = $this->session->userdata('user_id');
            $vote = $this->input->post('vote');

            $this->question_model->add_votes($choice_id, $vote);
            $this->vote_model->add($question_id, $user_id, $is_admin);
            redirect('questions/detail/' .$question_id);
            // echo print_r($data['voted_user']);
        }
        // echo 'choice: ' .$choice_id;
        // echo "<br>";
        // echo 'votes: ' .$choice_vote;

    }

    public function create_question(){

        if($this->session->userdata('is_logged_in') == FALSE){
            redirect('users/login');
            die();
        }
        if($this->session->userdata('is_admin_user') == FALSE){
            redirect('questions');
            die();
        }

        $this->load->library('form_validation');
        // create questions
        // echo 'create questions';
        $data['title'] = ucfirst('create questions');
        $data['choices'] = $this->question_model->get_choices();

        $this->form_validation->set_rules('question', 'Question', 'required');
        $this->form_validation->set_rules('choice', 'Choice', 'required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header');
            $this->load->view('questions/create_question', $data);
            $this->load->view('templates/footer');
        } else{
            $question_text = $this->input->post('question');
            $choice_id = $this->input->post('choice');
            // $this->question_model->add_question($question, $choice_id)
            $this->question_model->add_question($question_text, $choice_id);
            redirect('questions');
            die();
        }

    }

    public function create_choice(){

        if($this->session->userdata('is_logged_in') == FALSE){
            redirect('users/login');
            die();
        }

        if($this->session->userdata('is_admin_user') == FALSE){
            redirect('questions');
            die();
        }

        $this->load->library('form_validation');

        $data['title'] = 'Create Choice';

        $this->form_validation->set_rules('choice', 'Choice', 'required');
        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header');
            $this->load->view('questions/create_choice', $data);
            $this->load->view('templates/footer');
        }else{
            $choice_text = $this->input->post('choice');
            $this->choice_model->add_choice($choice_text);
            redirect('questions/create_question');
            die();
        }

    }

    public function edit_question($question_id){


        if($this->session->userdata('is_logged_in') == FALSE){
            redirect('users/login');
            die();
        }

        if($this->session->userdata('is_admin_user') == FALSE){
            redirect('questions');
            die();
        }

        $data['title'] = 'Edit Question';
        $data['question'] = $this->question_model->get_questions($question_id);
        $data['choices'] = $this->question_model->get_choices();

        $this->load->view('templates/header');
        $this->load->view('questions/update', $data);
        $this->load->view('templates/footer');
    }
    //update question
    public function update($question_id){

        if($this->session->userdata('is_logged_in') == FALSE){
            redirect('users/login');
            die();
        }

        if($this->session->userdata('is_admin_user') == FALSE){
            redirect('questions');
            die();
        }


        $this->load->library('form_validation');

        $this->form_validation->set_rules('question', 'Question', 'required');
        $this->form_validation->set_rules('choice', 'Choice', 'required');

        if($this->form_validation->run() === FALSE){
            $this->edit_question($question_id);
        }else{
            $question_id = $question_id;
            $choice_id = $this->input->post('choice');
            $question_text = $this->input->post('question');

            $this->question_model->update_question($question_id, $choice_id, $question_text);
            //$this->detail($question_id); //redirect to detail page
            redirect('questions/detail/' .$question_id);
        }
    }

    public function delete_choice($choice_id, $question_id){

        if($this->session->userdata('is_logged_in') == FALSE){
            redirect('users/login');
            die();
        }

        if($this->session->userdata('is_admin_user') == FALSE){
            redirect('questions');
            die();
        }

        // echo "$question_id";
        $this->choice_model->delete_choice($choice_id);
        redirect('questions/detail/' .$question_id);
    }

    public function delete($question_id){

        if($this->session->userdata('is_logged_in') == FALSE){
            redirect('users/login');
            die();
        }
        if($this->session->userdata('is_admin_user') == FALSE){
            redirect('questions');
            die();
        }

        $this->question_model->delete_question($question_id);
        redirect('questions');
    }

    public function result(){
        $data['title'] = 'Result';
        $data['choice'] = $this->choice_model->get_result();
        if($data['choice']){
            $question_id = $data['choice'][0]['question_id'];
            $data['question'] = $this->question_model->get_questions($question_id);

            $this->load->view('templates/header');
            $this->load->view('questions/result', $data);
            $this->load->view('templates/footer');
        } else {
            $data['error'] = 'No Result exists at the moment';

            $this->load->view('templates/header');
            $this->load->view('questions/error', $data);
            $this->load->view('templates/footer');
        }
        // echo print_r($data['question']);
        // echo "<br>";
        // echo print_r($data['choice']);
    }


}
