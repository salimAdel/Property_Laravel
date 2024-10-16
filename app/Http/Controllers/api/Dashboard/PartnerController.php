<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $Partner = Partner::all();
            return response()->json($Partner);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string|between:2,100',
                'location' => 'string',
                'image' => 'file|mimes:jpeg,jpg,png|max:2048',
                'active' => 'boolean',
                'phone' => 'string|between:1,20',
                'routeType' => 'integer|between:0,2',

            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $imagePath = null;
            if (request('image') != null) {
                $imagePath = request('image')->store('uploads', 'public');
            }

            Partner::create(array_merge(
                $validator->validated(),
                [
                    'image' => $imagePath
                ]
            ));
            return response()->json('Partner created successfully', 201);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        try {
            $Partner = Partner::findorFail($id);
            return response()->json($Partner);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $Partner = Partner::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'string|between:2,100',
                'location' => 'string',
                'image' => 'file|mimes:jpeg,jpg,png|max:2048',
                'active' => 'boolean',
                'phone' => 'string|between:1,20',
                'routeType' => 'integer|between:0,2'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $imagePath = $Partner->image;
            if (request('image') != null) {
                $imagePath = request('image')->store('uploads', 'public');
            }
            $Partner->update(array_merge(
                $validator->validated(),
                [
                    'image' => $imagePath
                ]
            ));
            $Partner->save();
            return response()->json('Partner updated successfully');
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->json = response()->json('Partner deleted successfully');
            try {
                $Partner = Partner::findorFail($id);
                $Partner->delete();
                return $this->json;
            } catch (\Exception $exception) {
                return response()->json($exception->getMessage(), 500);
            }
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }
}
