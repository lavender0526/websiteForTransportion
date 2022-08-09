<?php

$router->register('getproduct','product','getproduct');
$router->register('newproduct','product','newproduct');
$router->register('getcheck','check','getcheck');
$router->register('getcheckrecord','check','getcheckrecord');
$router->register('newcheck','check','newcheck');
$router->register('removeproduct','product','removeproduct');
$router->register('updateproduct','product','updateproduct');
$router->register('getexiststock','existstock','getexiststock');
$router->register('newexiststock','existstock','newexiststock');
$router->register('removeexiststock','existstock','removeexiststock');
$router->register('updateexiststock','existstock','updateexiststock');
$router->register('getsupplier','supplier','getsupplier');
$router->register('newsupplier','supplier','newsupplier');
$router->register('removesupplier','supplier','removesupplier');
$router->register('updatesupplier','supplier','updatesupplier');
$router->register('getorder', 'order', 'getorder');
$router->register('removeorder', 'order', 'removeorder');
$router->register('getorderlist', 'order', 'getorderlist');
$router->register('neworder', 'order', 'neworder');
$router->register('newitem', 'order', 'newitem');



?>
