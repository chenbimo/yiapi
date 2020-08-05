<?php

$str = '<div class="ddd">chensuiyi陈随易</div>';
$str2 = '&lt;div class=&quot;ddd&quot;&gt;chensuiyi陈随易&lt;/div&gt;';
$res = addslashes($str);
$res1 = htmlspecialchars($str, ENT_NOQUOTES);
$res2 = htmlspecialchars_decode($res1);
echo $res1;
echo '<br/>';
echo $res2;
