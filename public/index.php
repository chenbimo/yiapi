<?php

declare(strict_types=1);


require './init.php';
$Class = $_REQUEST['c'];
$Method = $_REQUEST['m'];
$Api = new $Class($Class);
$Result = $Api->$Method();
echo json_encode($Result);
