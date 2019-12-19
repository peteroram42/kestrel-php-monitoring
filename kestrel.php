<?php

require_once("systemdata.php");
require_once("kestrel-funcs.php");

$sd = new SystemData;

// can use $sd->update() whenever needed to refresh data
// $sd->update();

echo json_encode($sd);

?>