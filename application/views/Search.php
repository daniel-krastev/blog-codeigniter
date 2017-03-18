<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Blooog: Search</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/stylesheets/myStyle.css");?>">
	</head>
	<body>
		<!--the php function will load the side bar and the header-->
		<?php $this->load->view('Bars'); ?>
		<div id = "search">
				<form action="<?php echo base_url("/search/dosearch");?>" method="get">
					<input type="text" name="search" placeholder="Search...">
					<input type="submit" value="Search">
				</form>
				<?php
					//check if the page is reloaded after entering space symbols only
					if(isset($GLOBALS['SearchError'])) { 
						echo $GLOBALS['SearchError'];
						unset($GLOBALS['SearchError']); 
					}
					//check if the page is reloaded after a search with a zero found results have been made
					if(isset($GLOBALS['NoResult'])) { 
						echo $GLOBALS['NoResult'];
						unset($GLOBALS['NoResult']); 
					} 
				?>
		</div>
	</body>
</html>