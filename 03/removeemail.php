<?php
	$dbc = mysqli_connect('127.0.0.1', 'root', '201916ab', 'elvis_store') or die('database connect error');
	$email = $_POST['email'];
	$query = "delete from email_list where email = '$email'";
	$result = mysqli_query($dbc, $query) or die('delete query erroe');
	var_dump($result);
	echo 'Customer removed: ' . $email;
	mysqli_close($dbc);
?>