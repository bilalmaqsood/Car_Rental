<?php

namespace Qwikkar\Concerns;

trait VehicleOperations
{
    public function dcoumentsExists()
    {
        $error = array();
        foreach (request()->documents as $key => $doc){
            if(isset($doc['doc']) && isset($doc['title']) && $doc['path']==null){
            array_push($error, $doc["title"]. " is missing");
            }
        }
        return $error;
    }

}