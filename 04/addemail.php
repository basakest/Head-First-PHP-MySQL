<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8" />
	  <title>Make Me Elvis - Add Email</title>
	  <link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
	  <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
	  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
	  <p>Enter your first name, last name, and email to be added to the <strong>Make Me Elvis</strong> mailing list.</p>
<?php
	if (isset($_POST['submit'])) {
		$dbc = mysqli_connect('127.0.0.1', 'root', '201916ab', 'elvis_store') or die('database connect error');

		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$email = $_POST['email'];

		$query = "insert into email_list(first_name, last_name, email) values('$first_name', '$last_name', '$email')";

		mysqli_query($dbc, $query) or die('insert query error');
		echo 'Customer added';
		mysqli_close($dbc);
	}
	
?>
<form method="post" action="addemail.php">
    <label for="firstname">First name:</label>
    <input type="text" id="firstname" name="firstname" /><br />
    <label for="lastname">Last name:</label>
    <input type="text" id="lastname" name="lastname" /><br />
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" /><br />
    <input type="submit" name="submit" value="submit" />
  </form>
</body>
</html>