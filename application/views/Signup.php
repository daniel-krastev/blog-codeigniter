<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Blooog: Messages</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/stylesheets/myStyle.css");?>">
		<script src="<?php echo base_url("assets/jQ/jquery-3.1.1.min.js");?>"></script>
		<script>
			$(document).ready(function() {
				var x_timer;    
				$("#username").keyup(function (e){
					clearTimeout(x_timer);
					var user_name = $(this).val();
					x_timer = setTimeout(function(){
						check_username_ajax(user_name);
					}, 1000);
				}); 

				function check_username_ajax(username){
					$("#user-result").html('<img src="ajax-loader.gif" />');
					$.post('<?php echo base_url("user/userValid");?>', {'username':username}, function(data) {
					  if(data['result'] === 1) {
						  alert("present");
					  } else {
						  alert("notPresent");
					  }					 
					});
				}
			});
		</script>
	</head>
	<body>
		<!--the php function will load the side bar and the header-->
		<?php $this->load->view('Bars'); ?>
		<div id = "signup">
			<form action="<?php echo base_url("/user/dosignup");?>" method="post">
				<br>
				<input type="text" id="username" name="username" placeholder = "Username">
				<br>
				<input type="password" name="psw" placeholder = "Password">
				<br>
				<input type="text" name="psw" placeholder = "E-mail">
				<br><br>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>