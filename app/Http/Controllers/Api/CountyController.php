<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\County;

class CountyController extends Controller
{
    public function towns(Request $request, County $county)
    {
        return $county->towns;
    }
}
