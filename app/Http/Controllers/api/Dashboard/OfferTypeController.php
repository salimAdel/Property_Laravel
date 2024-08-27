<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\OfferType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        try {
            $OfferType=OfferType::all();
            return response()->json($OfferType);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            OfferType::create($validator->validated());
            return response()->json('OfferType created successfully',201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $OfferType = OfferType::findorFail($id) ;
            return response()->json($OfferType);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function update(Request $request, $id){
        try {
            $OfferType = OfferType::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'string|between:2,100',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $OfferType->update($validator->validated());
            $OfferType->save();
            return response()->json('OfferType updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function destroy($id){
        try {
            $OfferType = OfferType::findorFail($id);
            $OfferType->delete();
            return response()->json('OfferType deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
