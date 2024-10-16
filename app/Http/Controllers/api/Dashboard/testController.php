<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function test(Request $request): \Illuminate\Http\JsonResponse
    {

    }
}
