<?php
	$from = '1652759879@qq.com';
	$subject = $_POST['subject'];
	$text = $_POST['elvismail'];

	$dbc = mysqli_connect('127.0.0.1', 'root', '201916ab', 'elvis_store') or die('databace connect error');
	$query = 'select * from email_list';
	$result = mysqli_query($dbc, $query) or die('select query error');
	//var_dump($result);
	
	while($row = mysqli_fetch_array($result)) {
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];

		$msg = "Dear $first_name $last_name,\n $text";
		$to = $row['email'];
		mail($to, $subject, $msg, 'From' . $from);
		echo 'Email sent to: '. $to . '<br />';
	}

	mysqli_close($dbc);
?>