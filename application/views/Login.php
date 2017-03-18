<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Blooog Login</title>	
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/stylesheets/myStyle.css");?>">
	</head>
	<body>
		<!--the php function will load the side bar and the header-->
		<?php $this->load->view('Bars'); ?>
		<div id = "login">			
			<form action="<?php echo base_url("/user/dologin");?>" method="post">
				<input type="text" name="username" size="20" placeholder="Username">
				<input type="password" name="password" size="20" placeholder="Password">
				<input class="button" type="submit" name="logout" value="Login">
			</form>	
			<?php
			//check if the page is reloaded after entering wrong pass or user.
				if($this->session->has_userdata('LoginError')) { 
					echo $this->session->userdata('LoginError');
					$this->session->unset_userdata('LoginError');
				}
			//check if the page is reloaded after entering an empty field.
				if($this->session->has_userdata('Empty')) { 
					echo $this->session->userdata('Empty');
					$this->session->unset_userdata('Empty');
				}
			?>
		</div>	
	</body>
</html>