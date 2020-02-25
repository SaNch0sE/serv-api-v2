<?php
    $filename = json_encode($uid).'.json';
    if (file_exists($filename)) {
        $tasks = json_decode(file_get_contents($filename), true);
    } else {
        file_put_contents($filename, "");
        $tasks = json_decode(file_get_contents($filename), true);
    }