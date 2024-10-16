<?php

namespace App\Http\Controllers\api\Client;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    //
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // تحديد عدد العناصر في الصفحة مع قيمة افتراضية
            $perPage = $request->input('per_page', 10); // القيمة الافتراضية هي 10

            // استرجاع الإعلانات مع التصفح
            $Advertisement = Advertisement::paginate($perPage);
            return response()->json($Advertisement);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
