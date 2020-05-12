<?php
    require_once('./authorize.php');
    require_once('./appvars.php');
    require_once('./connectvars.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Guitar Wars - Approve a High Score</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
    </head>
    <body>
        <h2>Guitar Wars - Approve a High Score</h2>
        <?php
        //var_dump($_GET);
            if (isset($_GET['name']) && isset($_GET['id']) & isset($_GET['score']) & isset($_GET['screenshot']) & isset($_GET['date'])) {
                // form
                //var_dump($_GET);
                echo '<strong>Name: </strong>' . $_GET['name'] . '<br />';
                echo '<strong>Date: </strong>' . $_GET['date'] . '<br />';
                echo '<strong>Score: </strong>' . $_GET['score'] . '<br />';
                echo '<img alt="the img of user" src=' . GW_UPLOADPATH . $_GET['screenshot'] . '>' . '<br />';
                echo '<form method="post" action=' . $_SERVER['PHP_SELF'] . '>';
                echo '<input type="radio" name="confirm" value="Yes" /> Yes';
                echo '<input type="radio" name="confirm" value="No" /> No' . '<br />';
                echo '<input type="submit" value="submit" name="submit">';
                echo '<input type="hidden" name="id" value=' . $_GET['id'] . ' />';
                echo '<input type="hidden" name="score" value=' . $_GET['score'] . ' />';
                echo '<input type="hidden" name="name" value=' . $_GET['name'] . ' />';
                echo '</form>';
            } else {
                //echo '<p class="error">no data is submitted by get</p>';
            }

            if (isset($_POST['submit'])) {
                //var_dump($_POST['confirm']);
                if (isset($_POST['confirm']) == 'Yes') {
                    $id = $_POST['id'];
                    $score = $_POST['score'];
                    $name = $_POST['name'];
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('mysql connect error');
                    $query = "update guitarwars set approved = 1 where id = '$id'";
                    mysqli_query($dbc, $query);
                    mysqli_close($dbc);
                    echo '<p>The high score of ' . $score . ' for ' . $name . ' was successfully approved';
                    echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
                } else {
                    echo '<p class="error">Sorry, there was a problem approving the high score</p>';
                }
            }
            
        ?>
    </body>
</html>