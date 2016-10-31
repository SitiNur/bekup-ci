<html>
	<head>
		<title>Task</title>
			<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
			<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js/"></script>
			<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
			
			<style type="text/css">
				body{
					padding-top:70px;
				}
			</style>
	<body>
		
	<form method="POST" action="<?php echo base_url('index.php/task/simpan');?>">
		<label>Task</label>
		<input type="text" name="task" maxlength="50" size="25">
		<button type="submit">Simpan</button>
	</form>
	<?php
			foreach ($task as $row ) {
				echo $row['task']."<br/>";
			}
		?>
	</body>
</html>
