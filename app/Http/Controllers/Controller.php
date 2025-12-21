<?php

namespace App\Http\Controllers;

abstract class Controller
{

    
    protected function smartView($fullView, $fragmentView = null, $data = [])
    {
        $fragmentView = $fragmentView ?? $fullView . '-fragment';

        if (request()->ajax()) {
            return view($fragmentView, $data);
        }

        return view($fullView, $data);
    }
}
