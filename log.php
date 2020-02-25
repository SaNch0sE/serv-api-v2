<?php 
    function mlog($var)
    {
        $new = json_encode($var);
        $old = file_get_contents('l.log');
        $new = $old."\n".$new;
        file_put_contents('l.log', json_encode($new));
    }