<?php

class Admins extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function login(){
		// kickout if login as other user
		if($this->session->userdata('is_logged_in') && ($this->session->userdata('is_admin_user') == FALSE)){
			redirect('questions');
			die();
		}
		// if login as admin and trying to access here
		if($this->session->userdata('is_logged_in') && ($this->session->userdata('is_admin_user') == true)){
			redirect('admins/dashboard');
			die();
		}

		$data['title'] = 'Admin-login';
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header');
			$this->load->view('admins/login', $data);
			$this->load->view('templates/footer');
		}else{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			//$password = $this->input->post('password');
			$user = $this->admin_model->admin_login($username, $password);

			if($user != null){
				// we did recieve a user object
				$user_data = array(
					'user_id' => $user->id,
					'username' => $user->username,
					'is_admin_user' => true,
					'is_logged_in' => true
				);
				$this->session->set_userdata($user_data);
				$this->session->set_flashdata('logged_in_admin', 'You are now Logged in as admin');
				redirect('admins/dashboard');
			}else{
				echo "invalid credentials";
				die();
			}
		}
	}

	public function dashboard(){
		// check if only user is logged in
		if($this->session->userdata('is_admin_user') && $this->session->userdata('is_logged_in')){
			// dashboard logic here
			$data['title'] = 'Dashboard';

			$data['users'] = $this->admin_model->get_users();

			// echo print_r($data['users']);

			$this->load->view('templates/header');
			$this->load->view('admins/dashboard', $data);
			$this->load->view('templates/footer');
		}else{
			redirect('questions');
		}
	}

	public function delete_user($user_id){
		if(($this->session->userdata('is_admin_user') == true) && ($this->session->userdata('is_logged_in') == true)){

			$this->admin_model->delete_user($user_id);

		}else{
			redirect('questions');
		}
	}

	public function profile($user_id){

		if(($this->session->userdata('is_admin_user') == true) && ($this->session->userdata('is_logged_in') == true) && ($this->session->userdata('user_id') == $user_id)){
			$data['title'] = 'Profile Info';
			$data['user'] = $this->admin_model->profile($user_id);

			$this->load->view('templates/header');
			$this->load->view('admins/profile', $data);
			$this->load->view('templates/footer');

		}else{
			redirect('questions');
		}
	}

	public function edit_profile($user_id){

		$call_by_edit_profile = false; //only for dynamice flash msg in logout ftn

		if(($this->session->userdata('is_admin_user') == true) && ($this->session->userdata('is_logged_in') == true) && ($this->session->userdata('user_id') == $user_id)){

			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->profile($user_id);
			}else{
				$this->admin_model->edit_profile($user_id);
				$call_by_edit_profile = true;
				$this->logout($call_by_edit_profile);
			}
		}else{
			redirect('questions');
		}
	}

	public function logout($call_by_edit_profile = FALSE){
		// if login but not admin
		if($this->session->userdata('is_logged_in') && ($this->session->userdata('is_admin_user') == FALSE)){
			redirect('questions');
			die();
		}
		// if logout already
		if(	$this->session->userdata('user_id') == FALSE && $this->session->userdata('is_admin_user') == FALSE && $this->session->userdata('is_logged_in') == FALSE && $this->session->userdata('username') == FALSE ){
			$this->session->set_flashdata('already_logged_out', 'you are already logged out please login again!');
			redirect('questions');
			echo $this->session->userdata('username');
			die();
		} else{
			// logout
			// destroying session data
			$this->session->unset_userdata('is_logged_in');
			$this->session->unset_userdata('is_admin_user');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_id');

			if($call_by_edit_profile){
				$this->session->set_flashdata('edit_profile', 'Info Updated Successfully');
			} else{
				$this->session->set_flashdata('logged_out', 'Your are now logged out');
			}

			redirect('admins/login');
		}
	}

}
