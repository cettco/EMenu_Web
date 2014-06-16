<?php
require_once ( "base.php" ) ;
require_once ( "push.php" ) ;
$a = test_setTag('1-1');
$b = test_pushMessage_android('1-1');
echo $a;
echo $b;

