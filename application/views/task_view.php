<html>
	<head>
		<title>Task</title>
	</head>
	<body>
		<?php
			foreach ($task as $row ) {
				echo $row['task']."<br/>";
			}
		?>
	<form method="POST" action="<?php echo base_url('index.php/task/simpan');?>">
		<label>Task</label>
		<input type="text" name="task" maxlength="50" size="25">
		<button type="submit">Simpan</button>
	</form>
	</body>
</html>
