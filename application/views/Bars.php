<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id='header'>
	<?php 
		//determine if the user is logged in or net, and echos the result.
		if($this->session->has_userdata('user')) {
			echo '<span id="name">Logged in as '.strtolower($this->session->userdata('user')).'</span>';
		} else {
			echo '<span id="name">Not logged in!</span>';
		}
	?>	
	Blooog	
</div>

<div id='sidebar'>
<ul>
	<?php
		//if the user is logged in adds to the view the relevant links
		if($this->session->has_userdata('user')) {
			echo '<li><a class = "menuItem" href="'.base_url("/user/logout").'">Logout</a></li>';
			echo '<li><a class = "menuItem" href="'.base_url("/message").'">Post</a></li>';
			echo '<li><a class = "menuItem" href="'.base_url("/user/view/".$this->session->userdata('user')).'">MyMessages</a></li>';
			echo '<li><a class = "menuItem" href="'.base_url("/user/feed/".$this->session->userdata('user')).'">Feed</a></li>';
				
				//check if should add a Follow link depending on the user we are currently viewing
			if(!($this->session->userdata('follow')) && ($this->session->userdata('viewing') != $this->session->userdata('user'))) {
				echo '<li><a class = "menuItem" href="'.base_url("/user/follow/".$this->session->userdata('viewing')).'">Follow</a></li>';
			}
		} else {
			//if not logged in, adds one link to the login page
			echo '<li><a class = "menuItem" href="'.base_url().'">Blooog</a></li>';
			echo '<li><a class = "menuItem" href="'.base_url("/user/signUp/").'">SignUp</a></li>';
		}			
	?>
	<li><a class = "menuItem" href="<?php echo base_url("/search");?>">Search</a></li>
</ul>	
</div>