<?php

namespace App\Http\Controllers\api\Client;

use App\Http\Controllers\Controller;
use App\Models\RealEstateEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RealEstateEvaluationController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'property_type'=>'string|between:2,100',
                'purpose' => 'string|between:2,100',
                'region' => 'string|between:2,100',
                'piece' => 'string|between:2,100',
                'coupon' => 'string|between:2,100',
                'street' => 'string|between:2,100',
                'home' => 'string|between:2,100',
                'phone' => 'string|between:6,16',
                'phone2' => 'string|between:6,16',
                'state' => 'digits_between:0,3',
                'is_company'=>'boolean',
                'notes' => 'string|between:2,255',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }


            $RealEstateEvaluation = RealEstateEvaluation::create($validator->validated());

            return response()->json($RealEstateEvaluation,201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
