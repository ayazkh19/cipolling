<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function view($page='home'){
        if(! file_exists(APPPATH.'views/pages/' .$page. '.php')){
            show_404();
        }
        $data['title'] = ucfirst($page);

        if($page === 'home'){
            $this->load->model('question_model');
            $data['latest_questions'] = $this->question_model->get_questions();
        }

        $this->load->view('templates/header');
        $this->load->view('pages/' .$page, $data);
        $this->load->view('templates/footer');
    }
}