<?php 
	$errors = "";
	// connect to the database
	$db = mysqli_connect('localhost','root','','todo');
	if (isset($_POST['submit'])) {
		$task = $_POST['task'];
		if(empty($task)) { $errors = "You must fill in the task";	}//if the textbox is empty 
		else{ mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')"); header('location: todo.php'); }
	// delete tasks
	if (isset($_GET['del_task'])) {	$id = $_GET['del_task']; 
	mysqli_query($db,"DELETE FROM tasks WHERE id=$id"); header('location: todo.php'); }
	$tasks = mysqli_query($db, "SELECT * from tasks");
?>

<!DOCTYPE html>
<html><head>
	<title>To-Do App</title>
	<script src="https://use.fontawesome.com/123649052c.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header><h2>To-Do List Application with PHP and MySQL</h2></header>
	<form method="POST" action="todo.php">
		<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
		<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" class="task_btn" name="submit">Add Task</button> </form>
	<table><thead><tr><th></th><th>Task</th><th>Action</th></tr></thead>
		<tbody>
			<?php
				while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td class="task"><?php echo $row['task']; ?></td>
					<td class="delete">
						<a href="todo.php?del_task=<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
			<?php } ?>			
		</tbody>
	</table></body>
</html>