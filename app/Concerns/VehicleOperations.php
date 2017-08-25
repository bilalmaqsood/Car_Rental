<?php

namespace Qwikkar\Concerns;

trait VehicleOperations
{
    public function dcoumentsExists()
    {
        $error = array();
        foreach (request()->documents as $key => $doc){
            if(isset($doc['doc']) && filter_var($doc['path'], FILTER_VALIDATE_URL) ===false){
            array_push($error, str_replace("_"," ",$doc['doc']). " is missing");
            }
        }
        return $error;
    }

}