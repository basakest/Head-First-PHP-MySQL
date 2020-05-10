<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>admin page</title>
    </head>
    <body>
        <?php
            require_once('./appvars.php');
            require_once('./connectvars.php');

            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('mysql connect error');

            $query = 'select * from guitarwars order by score desc, date asc';
            $result = mysqli_query($dbc, $query);
            //var_dump($result);
            //exit();

            echo '<table>';
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['score'] . '</td>';
                echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">Remove</a></td></tr>';
            }
            echo '</table>';
            mysqli_close($dbc);
        ?>
    </body>

</html>