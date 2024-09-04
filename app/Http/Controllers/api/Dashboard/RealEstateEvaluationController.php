<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RealEstateEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RealEstateEvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        try {
            $RealEstateEvaluation=RealEstateEvaluation::all();
            return response()->json($RealEstateEvaluation);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'offer_type'=>'digits_between:0,3',
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

            return response()->json('RealEstateEvaluation created successfully',201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $RealEstateEvaluation = RealEstateEvaluation::findorFail($id) ;
            return response()->json($RealEstateEvaluation);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function update(Request $request, $id){
        try {
            $RealEstateEvaluation = RealEstateEvaluation::findorFail($id);
            $validator = Validator::make($request->all(), [
                'offer_type'=>'digits_between:0,3',
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
            $RealEstateEvaluation->update($validator->validated());
            $RealEstateEvaluation->save();
            return response()->json('RealEstateEvaluation updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function destroy($id){
        try {
            $RealEstateEvaluation = RealEstateEvaluation::findorFail($id);
            $RealEstateEvaluation->delete();
            return response()->json('RealEstateEvaluation deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
