<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ownership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OwnershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        try {
            $Ownership=Ownership::all();
            return response()->json($Ownership);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'region' => 'string|between:2,100',
                'piece' => 'string|between:2,100',
                'coupon' => 'string|between:2,100',
                'street' => 'string|between:2,100',
                'home' => 'string|between:2,100',
                'phone' => 'string|between:6,16',
                'phone2' => 'string|between:6,16',
                'state' => 'digits_between:0,3',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            Ownership::create($validator->validated());
            return response()->json('Ownership created successfully',201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $Ownership = Ownership::findorFail($id) ;
            return response()->json($Ownership);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function update(Request $request, $id){
        try {
            $Ownership = Ownership::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'region' => 'string|between:2,100',
                'piece' => 'string|between:2,100',
                'coupon' => 'string|between:2,100',
                'street' => 'string|between:2,100',
                'home' => 'string|between:2,100',
                'phone' => 'string|between:6,16',
                'phone2' => 'string|between:6,16',
                'state' => 'digits_between:0,3',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $Ownership->update($validator->validated());
            $Ownership->save();
            return response()->json('Ownership updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function destroy($id){
        try {
            $Ownership = Ownership::findorFail($id);
            $Ownership->delete();
            return response()->json('Ownership deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
