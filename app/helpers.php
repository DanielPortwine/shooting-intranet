<?php

if (! function_exists('decimalise')) {
    function decimalise($time) {
        $timeLength = strlen($time);
        if ($timeLength > 2) {
            $time = substr($time, 0, $timeLength - 2) . '.' . substr($time, $timeLength - 2);
        }

        return $time;
    }
}
