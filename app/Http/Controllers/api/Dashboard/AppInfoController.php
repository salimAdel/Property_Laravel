<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AppInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppInfoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        try {
            $AppInfo=AppInfo::findorFail(1);
            return response()->json($AppInfo);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function update(Request $request){
        try {
            $AppInfo = AppInfo::findorFail(1);
            $validator = Validator::make($request->all(), [
                'about_us' => 'string',
                'policy' => 'string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $AppInfo->update($validator->validated());
            $AppInfo->save();
            return response()->json('AppInfo updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
