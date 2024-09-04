<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $files = $request->file('q');
            $x = 0;
//            foreach ($files as $file) {
//                 $file->store('files', 'public');
//                 $x = $x + 1;
//            }
            return response()->json($request, 201);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
