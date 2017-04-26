<?php

/**
 * Dump the passed variables and end the script.
 *
 * @return void
 */
function d()
{
    array_map(function ($x) {
        (new \Illuminate\Support\Debug\Dumper)->dump($x);
    }, func_get_args());
}

/**
 * Format the response
 *
 * @param $data
 * @param bool $error
 *
 * @return array
 */
function api_response($data, $error = false)
{
    if ($error)
        return ['error' => $data];
    else
        return ['success' => $data];
}
