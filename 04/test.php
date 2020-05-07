<?php
	$a; // $a will be null
	var_dump($a); // null 
	echo '<br />';
	$a = null;
	var_dump(isset($a));
	echo '<br />';
	$a = false;
	var_dump(isset($a));
	echo '<br />';
	$a = 0;
	var_dump(isset($a));
	echo '<br />';
	$a = '';
	var_dump(isset($a));
	echo '<br />';
?>


