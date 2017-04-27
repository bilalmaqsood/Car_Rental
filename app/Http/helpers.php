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
 * @param bool|int $error
 *
 * @return array|\Illuminate\Http\JsonResponse
 */
function api_response($data, $error = false)
{
    if ($error)
        return response()->json(['error' => $data], $error);
    else
        return response()->json(['success' => $data], 200);
}
