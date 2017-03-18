<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
	/*
	*	Redirects to Post view, if the user is logged in.
	*/
	public function index() {		
		if($this->session->has_userdata('user')) {
			$this->load->view("Post");
		} else {
			$this->load->view("Login");
		}
	}
	
	/*
	*	Take the input from the post and add it to the Messages table in the database.
	*	Load the view with the new messages in it.
	*/
	public function doPost() {
		$this->load->model('Messages_model');
		
		//take the input
		$text = $this->input->post('text');
		
		//check if correct input is entered
		if(!isset($text) || trim($text) == '') {
			$GLOBALS['PostError'] = "Please enter some text!";
			$this->index();
		} else {
			$poster = $this->session->userdata('user');
			
			//add to the database
			$this->Messages_model->insertMessage($poster, $text);
			
			//loads the view with the new messages
			$this->load->model('Messages_model');
			$data['result'] = $this->Messages_model->getMessagesByPoster($this->session->userdata('user'));
			$this->load->view('ViewMessages', $data);
		}
	}
}  
?>