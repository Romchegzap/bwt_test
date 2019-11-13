<?php
function dumper($a){
    echo '<br/>';
    if (is_array($a)){
        foreach ($a as $i => $k){
            echo "$i" . '=>' . "$k" . '<br/>';
        }
    } else {
        var_dump($a);
    }
}