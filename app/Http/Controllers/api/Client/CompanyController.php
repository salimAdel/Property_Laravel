<?php

namespace App\Http\Controllers\api\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            // تحديد عدد العناصر في الصفحة مع قيمة افتراضية
            $perPage = $request->input('per_page', 10); // القيمة الافتراضية هي 10

            $Company = Company::paginate($perPage);
            return response()->json($Company);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
