<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        try {
            $Role=Role::all();
            return response()->json($Role);

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

            Role::create($validator->validated());
            return response()->json('Role created successfully',201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $Role = Role::findorFail($id) ;
            return response()->json($Role);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function update(Request $request, $id){
        try {
            $Role = Role::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'string|between:2,100',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $Role->update($validator->validated());
            $Role->save();
            return response()->json('Role updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function destroy($id){
        try {
            $Role = Role::findorFail($id);
            $Role->delete();
            return response()->json('Role deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
