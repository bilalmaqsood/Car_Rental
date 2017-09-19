<?php

namespace Qwikkar\Concerns;

trait VehicleOperations
{
    public function dcoumentsExists()
    {
        $year = Date("Y");
        $year -= 2;
        $documents = [
            'pco_certificate',
            'car_log_book',
            'mot_certificate',
            'permission_letter',
        ];
        if(request()->year <= $year)
            array_push($documents,"mot_certificate");

        $error = array();
        foreach (request()->documents as $key => $doc){
            if( isset($doc['doc']) && in_array($doc['doc'],$documents) && filter_var($doc['path'], FILTER_VALIDATE_URL) ===false){
            array_push($error, str_replace("_"," ",$doc['doc']). " is missing");
            }
        }
        return $error;
    }

}