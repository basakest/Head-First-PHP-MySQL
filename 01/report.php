<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Aliens Abducted Me - Report an  Abduction</title>
	</head>
	<body>
		<h2>Aliens Abducted Me - Report an Abduction</h2>
		<?php
			$name = $_POST['firstname'] . ' ' . $_POST['lastname'];
			$how_many = $_POST['howmany'];
			$what_they_did = $_POST['whattheydid'];
			$other = $_POST['other'];
			$when_it_happened = $_POST['whenithappened'];
			$how_long = $_POST['howlong'];
			$aline_description = $_POST['aliendescription'];
			$fang_spotted = $_POST['fangspotted'];
			$email = $_POST['email'];

			$to = 'ab1652759879@gmail.com';
			$subject = 'Aliens Abducted Me - Abduction Report';
			$msg = "$name was abducted $when_it_happened and was gone for $how_long.\n".
				"Number of aliens: $how_many\n".
				"Alien description: $aline_description\n".
				"Fang spotted: $fang_spotted\n".
				"Other comments: $other";
			mail($to, $subject, $msg, 'From:' . $email);

			echo 'Thanks for submiting the form.<br />';
			echo 'You were abducted ' . $when_it_happened;
			echo ' and were gone for ' . $how_long . '<br />';
			echo 'Number of aliens: ' . $how_many . '<br />';
			echo 'Describe them: ' . $aline_description . '<br />';
			echo 'The aliens did this: ' . $what_they_did . '<br />';
			echo 'Was Fang there? ' . $fang_spotted . '<br />';
			echo 'Other comments: ' . $other . '<br />';
			echo 'Your email address is ' . $email;
		?>
	</body>
</html>