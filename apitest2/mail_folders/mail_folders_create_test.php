<?php

$array = array(

);

$data=json_encode($array, JSON_FORCE_OBJECT);
$encoded = htmlentities($data);

echo '
<form mehtod="POST" action="mail_folders_create.php">

<input type="" name="" value="'.$encoded.'">
<input type="submit" name="submit" value="go!" />

</form>';
?>