<?php
	$dbc = mysqli_connect('127.0.0.1', 'root', '201916ab', 'elvis_store') or die('database connect error');

	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$email = $_POST['email'];

	$query = "insert into email_list(first_name, last_name, email) values('$first_name', '$last_name', '$email')";

	mysqli_query($dbc, $query) or die('insert query error');
	echo 'Customer added';
	mysqli_close($dbc);
?>