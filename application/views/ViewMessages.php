<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Blooog: Messages</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/stylesheets/myStyle.css");?>">
	</head>
	<body>
		<!--the php function will load the side bar and the header-->
		<?php $this->load->view('Bars'); ?>
		<div id="ms">
		  	<?php
				//print the result of the query as into a table
				if(!is_int($result)) {
					if ($result->num_rows() > 0) {
						foreach ($result->result_array() as $row) {
							echo '<table><tr><td colspan = "2"><span class = "txt">'.$row['text'].'</span></td></tr><tr><td><a href="'.base_url("/user/view/".
							$row['user_username']).'" class = "li">'.$row['user_username'].'</a></td><td><span class = "date">'
							.$row['posted_at'].'</span></td></tr></table>';
						} 
					}
				}
			?>		  
		</div>
	</body>
</html>