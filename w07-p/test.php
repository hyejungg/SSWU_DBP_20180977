<?php
    $foo = [3,2,4,1];
    echo count($foo);
    echo "<br><br>";

    array_push($foo, '5');
    var_dump($foo);
    echo "<br><br>";

    $bar = array(9,7,6,8);
    $list = array_merge($foo, $bar);
    var_dump($list);
    echo "<br><br>";

    sort($list);
    var_dump($list);
    echo "<br><br>";

    $alist = array('first'=>10, 'second'=>20);
    var_dump($alist);    
    echo "<br><br>";
    foreach($alist as $key => $value){
        echo "key: {$key} value: {$value}<br />";
    }
    

?>