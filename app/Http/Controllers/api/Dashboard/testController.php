<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
        $this->middleware('check.role.privilege:edit,GET')->only('test');

    }
    public function test(Request $request): \Illuminate\Http\JsonResponse
    {


             return response()->json(auth()->user()->role);
    }
}
