<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index()
    {
        try {
            $User=User::all();
            return response()->json($User);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|confirmed|min:6',
                'birthday' => 'date|before:today',
                'image' => 'file|mimes:jpeg,jpg,png|max:2048',
                'phone' => 'string|min:6|unique:users|max:16',
                'role_id'=> 'required|integer|exists:roles,id'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $imagePath = null;
            if (request('image') != null) {
                $imagePath = request('image')->store('uploads', 'public');
            }
            User::create(array_merge(
                $validator->validated(),
                [
                    'password' => bcrypt($request->password),
                    'image' => $imagePath
                ]
            ));
            return response()->json('User created successfully',201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $User = User::findorFail($id);
            $Role = $User->role;
            return response()->json([$User]);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function update(Request $request, $id){
        try {
            $User = User::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'birthday' => 'date|before:today',
                'image' => 'file|mimes:jpeg,jpg,png|max:2048',
                'phone' => 'string|min:6|max:16',
                'role_id'=> 'required|integer|exists:roles,id'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $imagePath = $User->image;
            if (request('image') != null) {
                $imagePath = request('image')->store('uploads', 'public');
            }
            $User->update(array_merge(
                $validator->validated(),
                [
                    'image' => $imagePath
                ]
            ));
            $User->save();
            return response()->json('User updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function destroy($id){
        try {
            $User = User::findorFail($id);
            $User->delete();
            return response()->json('User deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
