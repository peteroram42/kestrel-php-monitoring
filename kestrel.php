<?php

require_once("systemdata.php");
require_once("kestrel-funcs.php");

use oram\kestrel\SystemData as SysData;

$sd = new SysData;

// can use $sd->update() whenever needed to refresh data
// $sd->update();

echo json_encode($sd);

?>