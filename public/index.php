<?php

declare(strict_types=1);
require './init.php';
$Class = $_REQUEST['c'];
$Method = $_REQUEST['m'];

echo $Class::$Method();
