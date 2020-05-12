<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Guitar Wars - Add Your High Score</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - Add Your High Score</h2>

<?php
  require_once('./appvars.php');
  require_once('./connectvars.php');
  if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('mysql connect error');
    $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $score = mysqli_real_escape_string($dbc, trim($_POST['score']));
    $screenshot = mysqli_real_escape_string($dbc, trim(time() . $_FILES['screenshot']['name']));
    $screenshot_type = $_FILES['screenshot']['type'];
    $screenshot_size = $_FILES['screenshot']['size'];
    //var_dump($screenshot_type);
    //exit();

    if (!empty($name) && !empty($screenshot) && is_numeric($score)) {
      if (($screenshot_type == 'image/pjpeg' || $screenshot_type == 'image/gif' || $screenshot_type == 'image/jpeg' || $screenshot_type == 'image/png') && ($screenshot_size > 0) && ($screenshot_size < GW_MAXFILESIZE)) {
        if ($_FILES['screenshot']['error'] == 0) {
          $target = GW_UPLOADPATH . $screenshot;
          if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
            

            // Write the data to the database
            $query = "INSERT INTO guitarwars(date, name, score, screenshot) VALUES (NOW(), '$name', '$score', '$screenshot')";
            mysqli_query($dbc, $query);

            // Confirm success with the user
            echo '<p>Thanks for adding your new high score!</p>';
            echo '<p><strong>Name:</strong> ' . $name . '<br />';
            echo '<strong>Score:</strong> ' . $score . '</p>';
            echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

            // Clear the score data to clear the form
            $name = "";
            $score = "";

            mysqli_close($dbc);
          }
        }
      } else {
        echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file .</p>';
      }
      @unlink($_FILES['screenshot']['tmp_name']);
    }
    else {
      echo '<p class="error">Please enter all of the information to add your high score.</p>';
    }
  }
?>

  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Score:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" /><br />
    <input type="file" id="screenshot" name="screenshot" />
    <hr />
    <input type="submit" value="Add" name="submit" />
  </form>
</body> 
</html>
