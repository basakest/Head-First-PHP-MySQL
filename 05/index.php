<!DOCTYPE html >
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Guitar Wars - High Scores</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - High Scores</h2>
  <p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
  <hr />

<?php
  require_once('./appvars.php');
  require_once('./connectvars.php');
  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('mysql connect error');

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM guitarwars order by score desc, date asc";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML 
  echo '<table>';
  $i = 0;
  while ($row = mysqli_fetch_array($data)) { 
    // Display the score data
    if ($i == 0) {
      echo '<tr><td class="topscoreheader" colspan="2">Top Score:' . $row['score'] . '<td><tr/>';
      $i++;
    }
    echo '<><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
      echo '<td><img src="'. GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image" class="image" /></td></tr>';
    } else {
      echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif" alt="Unverified score" class="image" /></td></tr>';
    }
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
</html>
