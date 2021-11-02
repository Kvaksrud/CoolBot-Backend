<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\LaborReply;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class LaborController extends Controller
{
    public function doLabor()
    {
        $laborReply = LaborReply::where('status','=','approved')->inRandomOrder()->first();
        if(!$laborReply)
            return ResponseBuilder::error(ApiCodes::NO_LABOR_REPLY);


    }
}
