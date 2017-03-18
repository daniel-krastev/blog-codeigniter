<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	
	//	Load the search view 
	public function index() {
		$this->load->view("Search");
	}
	
	//Execute the search
	public function doSearch() {
		$this->load->model('Messages_model');
		$string = $this->input->get('search');
		
		//Check if the input string is correct.
		if(!isset($string) || trim($string) == '') {
			$GLOBALS['SearchError'] = "Please enter a search term.";
			$this->load->view("Search");
		} else {
			$data['result'] = $this->Messages_model->searchMessages($string);
			
			//Check if there are results.
			if($data['result']->num_rows() == 0) {
				$GLOBALS['NoResult'] = 'Nothing found';
				$this->load->view("Search");
			} else {
				
				//Loads the view with the search results.
				$this->load->view('ViewMessages', $data);
			}
		}				
	}
}  
?>