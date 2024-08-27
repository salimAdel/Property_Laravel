<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index(): \Illuminate\Http\JsonResponse
    {
        $Advertisement = Advertisement::all();
        return response()->json($Advertisement);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'toUrl' => 'string|url',
            'image' => 'file|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $imagePath = null;
        if (request('image') != null) {
            $imagePath = request('image')->store('uploads', 'public');
        }

        Advertisement::create(array_merge(
            $validator->validated(),
            [
                'image' => $imagePath
            ]
        ));
        return response()->json('Advertisement created successfully', 201);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $Advertisement = Advertisement::findorFail($id);
        return response()->json($Advertisement);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $Advertisement = Advertisement::findorFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'string|between:2,100',
            'toUrl' => 'string|url',
            'image' => 'file|mimes:jpeg,jpg,png|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $imagePath = null;
        if (request('image') != null) {
            $imagePath = request('image')->store('uploads', 'public');
        }
        $Advertisement->update(array_merge(
            $validator->validated(),
            [
                'image' => $imagePath
            ]
        ));
        $Advertisement->save();
        return response()->json('Advertisement updated successfully');
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $Advertisement = Advertisement::findorFail($id);
        $Advertisement->delete();
        return response()->json('Advertisement deleted successfully');
    }
}
