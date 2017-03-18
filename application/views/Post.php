<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Blooog: Post</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/stylesheets/myStyle.css");?>">
	</head>
	<body>
		<!--the php function will load the side bar and the header-->
		<?php $this->load->view('Bars'); ?>
		<div id = "post">
			<form action="<?php echo base_url('/message/dopost');?>" method="POST">			
				<label>Type your message here:</label><br>
				<textarea name="text" rows="6" cols="50"></textarea><br>
				<input type="submit" value="Post Message">
			</form>
			<?php
					//check if the page is reloaded after entering space symbols only
					if(isset($GLOBALS['PostError'])) { 
						echo $GLOBALS['PostError'];
						unset($GLOBALS['PostError']); 
					}
			?>
		</div>
	</body>
</html>