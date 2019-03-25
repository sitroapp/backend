<?php

$array = array(
    "title" => "Kokous",
    "description" => "...",
    "start" => 1551391200,
   "end" => 1553983200,
    "user" => 1

);

$data=json_encode($array, JSON_FORCE_OBJECT); 
$encoded = htmlentities($data);

echo '
<form method="POST" action="calendar_create.php">

<input type="hidden" name="array" value="'.$encoded.'">
<input type="submit" name="submit" value="go!" />

</form>';

?>