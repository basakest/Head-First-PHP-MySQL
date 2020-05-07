<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Make Me Elvis - Send Email</title>
		<link rel="stylesheet" type="text/css" href="./style.css" />
	</head>
	<body>
		<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
	    <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
	    <p><strong>Private:</strong> For Elmer's use ONLY<br />
	  Write and send an email to mailing list members.</p>
<?php
	if (isset($_POST['submit'])) {

		$from = '1652759879@qq.com';
		$subject = $_POST['subject'];
		$text = $_POST['elvismail'];
		$output_form = false;

		if (empty($subject) && empty($text)) {
			echo 'You forgot the email subject and body text.<br />';
			$output_form = true;
		}

		if (empty($subject) && (!empty(($text)))) {
			echo 'You forgot the email subject.<br />';
			$output_form = true;
		}

		if ((!empty($subject)) && empty($text)) {
			echo 'You forgot the email body text.<br />';
			$output_form = true;
		}

		if ((!empty($subject)) && (!empty($text))) {
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
		}
	} else {
		$output_form = true;
	}
	

	if ($output_form) {
?>
		
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
			<label for="subject">Subject of email:</label><br />
		    <input id="subject" name="subject" type="text" size="30" value="<?php $subject; ?>" /><br />
		    <label for="elvismail">Body of email:</label><br />
		    <textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php $text; ?></textarea><br />
		    <input type="submit" name="submit" value="Submit" />
		</form>
	
	
	
<?php
	}
?>
	</body>
</html>