<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	//Load a view with the messsages from e certain user
	public function view($name) {
		
		//Get the messages of this user.
		$this->load->model('Messages_model');
		$data['result'] = $this->Messages_model->getMessagesByPoster($name);
		$this->load->model('Users_model');
		
		//Check whether a user is currently logged in.
		if($this->session->has_userdata('user')) {
			$this->session->set_userdata('viewing', $name);
			
			//Check if the logged in user is "allowed" to follow the viewed user.
			if($this->Users_model->isFollowing($this->session->userdata('user'), $name)) {
				$this->session->set_userdata('follow', true);
			} else {
				$this->session->set_userdata('follow', false);
			}			
		}
		$this->load->view('ViewMessages', $data);
	}
	
	// Redirects to login page.
	public function login() {
		$this->logOut();
	}
	
	// Do the actual login.
	public function doLogin() {
		
		//Take the input and ask the database if the user is registered.
		$this->load->model('Users_model');
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		if(!isset($user) || trim($user) == '' || !isset($pass) || trim($pass) == '') {
			$this->session->set_userdata('Empty', 'Empty field or space characters only!');
			$this->login();
		} else if(preg_match('/[^\x20-\x7f]/', $pass) || preg_match('/[^\x20-\x7f]/', $user)) {
			$this->session->set_userdata('Empty', 'Illegal characters');
			$this->login();
		} else {
			
			$result = $this->Users_model->checkLogin($user, $pass);
			
			//Check the result
			if($result) {
				
				//Set session variables.
				$this->session->set_userdata('user', $user);
				$this->session->set_userdata('viewing', $user);
				$this->view($user);
			} else {
				
				//Use a session variable to inform for wrong credentials.
				$this->session->set_userdata('LoginError', 'Username and/or password incorrect!');
				$this->login();
			}
		}
	}
	
	//Logs the user out
	public function logOut() {
		
		//Unset the session variables.
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('follow');
		$this->session->unset_userdata('viewing');
		$this->session->sess_destroy();
		$this->load->view('Login');
	}
	
	//Loads the feed of the given user.
	public function feed($name) {
			$this->load->model('Messages_model');
			$data['result'] = $this->Messages_model->getFollowedMessages($name);
			$this->session->set_userdata('follow', true);
			$this->load->view('ViewMessages', $data);
	}
	
	//Start following a given user.
	public function follow($followed) {
		$this->load->model('Users_model');
		$this->Users_model->follow($followed);
		$this->feed($this->session->userdata('user'));
	}
	
	//Forwards to the signup view.
	public function signUp() {
		$this->load->view('SignUp');
	}
	
	
	public function userValid() {
		$user = $this->input->post('username');
		$this->load->model('Users_model');
		$data['result'] = $this->Users_model->checkUsername($user);
		echo $data;
	}
}  
?>