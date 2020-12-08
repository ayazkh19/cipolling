<?php 

class Users extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function register(){
		$data['title'] = 'Sign up';

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/register', $data);
			$this->load->view('templates/footer');
		}else{
			$enc_password = md5($this->input->post('password'));
			
			$this->user_model->register_user($enc_password);

			$this->session->set_flashdata('user_registered', 'You are now register');
			redirect('users/login');
		}

	}

	public function login(){
		$data['title'] = 'Login';

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('users/login', $data);
			$this->load->view('templates/footer');
		}else{
			// preparing data and searching through database for a match
			$enc_password = md5($this->input->post('password'));
			$username = $this->input->post('username');

			$user_id = $this->user_model->login_user($enc_password, $username);
			
			if($user_id){
				// create session data here
				// die('SUCCESS');
				$user_data = array(
					'user_id' => $user_id,
					'username' => $username,
					'is_admin_user' => false,
					'is_logged_in' => true
				);
				$this->session->set_userdata($user_data);

				$this->session->set_flashdata('logged_in', 'You are now Logged in');
				redirect('questions');
			}else{
				// invalid credentials
				// die('FAILUR');
				$this->session->set_flashdata('logged_in_fail', 'Cant login try again with valid credintials');
				redirect('users/login');
			}
		}
	}

	public function logout(){

		if( $this->session->userdata('user_id') && $this->session->userdata('is_admin_user') ){
			redirect('admins/dashboad');
			die();
		}

		if($this->session->userdata('user_id') == FALSE && $this->session->userdata('is_logged_in') == FALSE && $this->session->userdata('username') == FALSE){
			$this->session->set_flashdata('already_logged_out', 'you are already logged out please login again!');
			redirect('users/login');
		} else{
			// destroying session data
			$this->session->unset_userdata('is_logged_in');
			$this->session->unset_userdata('is_admin_user');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_id');

			$this->session->set_flashdata('logged_out', 'Your are now logged out');
			redirect('users/login');
		}
	}

	public function profile($user_id){

		if(($this->session->userdata('is_logged_in') == true) && ($this->session->userdata('user_id') == $user_id)){
			$data['title'] = 'Profile Info';
			$data['user'] = $this->user_model->user_profile($user_id);

			$this->load->view('templates/header');
			$this->load->view('users/profile', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('questions');
		}
	}


}