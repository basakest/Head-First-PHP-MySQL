<!DOCTYPE htmls>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  	<?php
  		$dbc = mysqli_connect('127.0.0.1', 'root', '201916ab', 'elvis_store') or die('database connect error');
  		if (isset($_POST['submit'])) {
  			$todelete = $_POST['todelete'];
  			foreach ($todelete as $id) {
			  	$query = "delete from email_list where id = $id";
			  	$result = mysqli_query($dbc, $query) or die('delete query fail');
			}
			echo 'Customer(s) removed.<br />';
		}

		$query = 'select * from email_list';
	  	$result = mysqli_query($dbc, $query) or die('select query fail');
	  	while ($row = mysqli_fetch_array($result)) {
	  		//echo $row['first_name'] . ' ' . $row['last_name'] . ' ' . $row['email'] . ' ';
	  		echo "$row[first_name] $row[last_name] $row[email]";
	  		echo "<input type='checkbox' value= $row[id] name='todelete[]'><br />";
	  	}
	  	echo "<input type='submit' value='submit' name='submit'>";
	  	mysqli_close($dbc);
  	?>
  </form>
</body>
</html>