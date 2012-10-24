<?php

function test($I_got, $u_thought, $options)
{
    if (isset($options['name'])) {
        $name = $options['name'];
    } else if (isset($GLOBALS['name'])) {
        $name = $GLOBALS['name'];
    } else {
        $name = 'test';
    }
    if ($I_got === $u_thought) {
        $success = 1;
        $fail = 0;
    } else {
        $success = 0;
        $fail = 1;
    }
    include 'static/entry.html';
}
