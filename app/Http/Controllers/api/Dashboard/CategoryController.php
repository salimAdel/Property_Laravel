<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OfferType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        try {
            $Category = Category::all();
            return response()->json($Category);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'offer_type_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $OfferType = OfferType::findorFail($validator->validated()['offer_type_id']); ;
            $OfferType->categories()->create(["name" => $request->get('name')]);
            return response()->json('Category created successfully', 201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $Category = Category::findorFail($id);
            return response()->json($Category);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $Category = Category::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $Category->update($validator->validated());
            $Category->save();
            return response()->json('Category updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $Category = Category::findorFail($id);
            $Category->delete();
            return response()->json('Category deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
