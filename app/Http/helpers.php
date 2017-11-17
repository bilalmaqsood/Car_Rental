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
    $discount = [];
    $vehicle = $booking->vehicle;
     $total_weeks = (int) floor(($booking->start_date->diffInDays($booking->end_date)+1)/7);
    $total_discounts = count($booking->vehicle->discounts);
    if($total_discounts > 0){
        foreach ($booking->vehicle->discounts as $d) {
            $discount[$d['week']]=$d['percent'];
        }
    }
    ksort($discount);
    if(is_array($discount)){
        if(array_key_exists($total_weeks,$discount))
            return (int) $discount[$total_weeks];
        else{
            end($discount);
            $key = key($discount);
           if($total_weeks > $key)
               return end($discount);
            else{
                $amount = 0;
                foreach ($discount as $key => $value){
                    if($key <= $total_weeks)
                        $amount = $value;
                }
                return $amount;
            }

        }
    }
    return 0;
}