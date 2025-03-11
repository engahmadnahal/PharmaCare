<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,CustomTrait;

    public function __construct()
    {
        ini_set('max_execution_time', 380); //3 minutes
    }
}
