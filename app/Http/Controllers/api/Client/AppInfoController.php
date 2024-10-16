<?php

namespace App\Http\Controllers\api\Client;

use App\Http\Controllers\Controller;
use App\Models\AppInfo;
use Illuminate\Http\Request;

class AppInfoController extends Controller
{
    //
    public function index()
    {
        try {
            $AppInfo=AppInfo::findorFail(1);
            return response()->json($AppInfo);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
