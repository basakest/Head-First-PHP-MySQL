<?php
    
        var_dump($_POST);
        
            var_dump($_GET);
        
    
     

?>
<form method="get" action="<?php echo $_SERVER['PHP_SELF']?>">
    Name: <input type="text" name="name"> <br />
    <input type="hidden" name="id" value="3">
    <input type="submit" value="submit" name="submit">
</form>