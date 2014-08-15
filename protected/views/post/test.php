<?php

function myStrRev($s) {
    $len = strlen($s);
    for ($i = 0; $i < ($len >> 1); $i++) {
        $s[$i] = $s[$i] ^ $s[$len - $i - 1];
        $s[$len - $i - 1] = $s[$len - $i - 1] ^ $s[$i];
        $s[$i] = $s[$i] ^ $s[$len - $i - 1];
    }

    echo "$s\n";
}
myStrRev('Hello!');