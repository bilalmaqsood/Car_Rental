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

/**
 * Render blade string rather than blade view
 *
 * @param $__php
 * @param $__data
 * @return string
 */
function render($__php, $__data)
{
    $obLevel = ob_get_level();

    ob_start();
    extract($__data, EXTR_SKIP);

    try {
        eval('?' . '>' . $__php);
    }

    catch (Exception $e) {
//        while (ob_get_level() > $obLevel) ob_end_clean();
//        throw $e;
    }

    catch (Throwable $e) {
//        while (ob_get_level() > $obLevel) ob_end_clean();
//        throw new \Symfony\Component\Debug\Exception\FatalThrowableError($e);
    }

    return ob_get_clean();
}


function format_date($date){
    
    if( is_object($date) && get_class($date)==\Carbon\Carbon::class){
        return $date->format(DATE_FORMAT);
    } else{
       return \Carbon\Carbon::parse($date)->format(DATE_FORMAT);
    }
}

function Discount($booking){
    $discount=0;

    $vehicle = $booking->vehicle;

    $total_weeks = $booking->start_date->diffInWeeks($booking->end_date);

    $total_discounts = count($booking->vehicle->discounts);

    if($total_discounts > $total_weeks)
        foreach ($booking->vehicle->discounts as $discount) {
                if($discount['week']==$total_weeks);
                    $discount = $discount['percent'];
        }
    else
    {
        $discount = collect($booking->vehicle->discounts)->last();
        $discount = isset($discount["percent"])?$discount["percent"]:0;
    }
    return $discount;
}