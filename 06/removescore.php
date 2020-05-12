<?PHP
    require_once('./authorize.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Guitar Wars - Remove a High Score</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
    </head>
    <body>
        <h2>Guitar Wars - Remove a High Score</h2>
        <?php
            require_once('appvars.php');
            require_once('connectvars.php');
            if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])) {
                // Grab the score data from the GET
                $id = $_GET['id'];
                $date = $_GET['date'];
                $name = $_GET['name'];
                $score = $_GET['score'];
                $screenshot = $_GET['screenshot'];
            } else if (isset($_POST['id'])  && isset($_POST['name']) && isset($_POST['score']) && isset($_POST['screenshot']) ){
                // Grab the score data from POST
                $id = $_POST['id'];
                $name = $_POST['name'];
                $score = $_POST['score'];
                $screenshot = $_POST['screenshot'];
            } else {
                echo '<p class="error">Sorry, no high score was specified for removal.</p>';
            }

            if (isset($_POST['submit'])) {
                
                if ($_POST['confirm'] == 'Yes') {
                    //var_dump(GW_UPLOADPATH . $screenshot);
                    //exit;
                    @unlink(GW_UPLOADPATH . $screenshot);
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('mysql connect error');
                    $query = "delete from guitarwars where id = $id limit 1";
                    //var_dump($query);
                    mysqli_query($dbc, $query);
                    mysqli_close($dbc);

                    echo '<p>The high score of ' . $score . ' for ' . $name . ' was successfully removed.</p>';
                } else {
                    echo '<p class="error">The high score was not removed.</p>';
                }
            } else if (isset($id) && isset($name) && isset($date) && isset($screenshot)) {
                echo '<p>Are you sure you want to delete the following high score?</p>';
                echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Date: </strong>' . $date . '<br /><strong>Score: </strong>' . $score . '</p>';
                echo '<form action="removescore.php" method="post">';
                echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
                echo '<input type="radio" name="confirm" value="No" /> No <br />';
                echo '<input type="submit" value="submit" name="submit" />';

                echo '<input type="hidden" name="id" value="' . $id . '" />';
                echo '<input type="hidden" name="name" value="' . $name . '" />';
                echo '<input type="hidden" name="score" value="' . $score . '" />';
                echo '<input type="hidden" name="screenshot" value="' . $screenshot . '" />';
                echo '</form>';
            }
            echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
        ?>
    </body>
</html>