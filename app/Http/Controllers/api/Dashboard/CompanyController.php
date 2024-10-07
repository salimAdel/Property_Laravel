<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $Company = Company::all();
        return response()->json($Company);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|between:2,100',
            'licenseNo' => 'string|between:2,100',
            'email' => 'unique|string|email|max:100',
            'image' => 'file|mimes:jpeg,jpg,png|max:2048',
            'phone'=>'string|between:1,20',
            'phone2'=>'string|between:1,20',
            'active' => 'boolean',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $imagePath = null;
        if (request('image') != null) {
            $imagePath = request('image')->store('uploads', 'public');
        }

        Company::create(array_merge(
            $validator->validated(),
            [
                'image' => $imagePath
            ]
        ));
        return response()->json('Company created successfully', 201);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $Company = Company::findorFail($id);
        return response()->json($Company);
    }


    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $Company = Company::findorFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'string|between:2,100',
            'licenseNo' => 'string|between:2,100',
            'email' => 'required|unique|string|email|max:100',
            'image' => 'file|mimes:jpeg,jpg,png|max:2048',
            'phone'=>'string|between:1,20',
            'phone2'=>'string|between:1,20',
            'active' => 'boolean'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $imagePath = $Company->image;
        if (request('image') != null) {
            $imagePath = request('image')->store('uploads', 'public');
        }
        $Company->update(array_merge(
            $validator->validated(),
            [
                'image' => $imagePath
            ]
        ));
        $Company->save();
        return response()->json('Company updated successfully');
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->json = response()->json('Company deleted successfully');
            try {
                $Company = Company::findorFail($id);
                $Company->delete();
                return $this->json;
            } catch (\Exception $exception) {
                return response()->json($exception->getMessage(), 500);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }
}
