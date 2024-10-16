<?php

namespace App\Http\Controllers\api\Client;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            // تحديد عدد العناصر في الصفحة مع قيمة افتراضية
            $perPage = $request->input('per_page', 10); // القيمة الافتراضية هي 10

            $Partner = Partner::paginate($perPage);
            return response()->json($Partner);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
