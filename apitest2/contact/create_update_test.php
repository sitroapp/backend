<?php

$array = array(
    "title" => "Kokous 2",
    "description" => "...",
    "start" => 1551391200,
   "end" => 1553983200,
    "user" => 1,
    "id" => 2
);

$data=json_encode($array, JSON_FORCE_OBJECT); 
$encoded = htmlentities($data);

echo '
<form method="POST" action="create_update.php">

<input type="hidden" name="array" value="'.$encoded.'">
<input type="submit" name="submit" value="go!" />

</form>';

?>