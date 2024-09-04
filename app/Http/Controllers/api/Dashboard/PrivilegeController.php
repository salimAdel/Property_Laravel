<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivilegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        try {
            $Privilege=Privilege::all();
            return response()->json($Privilege);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
