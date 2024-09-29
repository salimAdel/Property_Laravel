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
        $ar = [ 1 ,1,1,1,1,];

        try {
            return response()->json(auth()->id(), 201);
            foreach ($ar)
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
