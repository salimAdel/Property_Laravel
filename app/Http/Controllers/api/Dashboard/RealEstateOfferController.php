<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RealEstateOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RealEstateOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function index(Request $request)
    {
        try {
            $query = RealEstateOffer::with(['attachment', 'user' , 'user.company']);

            // فلترة حسب المستخدم
            $query->when($request->filled('user_id'), function ($q) use ($request) {
                return $q->where('user_id', $request->user_id);
            });

            // فلترة حسب الشركة
            $query->when($request->filled('company_id'), function ($q) use ($request) {
                return $q->whereHas('user.company', function ($q) use ($request) {
                    return $q->where('id', $request->company_id);
                });
            });

            // فلترة حسب المحافظة
            $query->when($request->filled('governorate'), function ($q) use ($request) {
                return $q->where('governorate', $request->governorate);
            });
            // فلترة حسب السعر بين عددين
            $query->when($request->filled('min_price') && $request->filled('max_price'), function ($q) use ($request) {
                return $q->whereBetween('price', [$request->min_price, $request->max_price]);
            });


            // فلترة حسب offer_type_id
            $query->when($request->filled('offer_type_id'), function ($q) use ($request) {
                return $q->whereHas('category.offerType', function ($q) use ($request) {
                    return $q->where('id', $request->offer_type_id);
                });
            });

            // فلترة حسب category_id
            $query->when($request->filled('category_id'), function ($q) use ($request) {
                return $q->where('category_id', $request->category_id);
            });

            // فلترة حسب country_id
            $query->when($request->filled('country_id'), function ($q) use ($request) {
                return $q->where('country_id', $request->country_id);
            });

            // فلترة حسب inKuwait
            $query->when($request->filled('inKuwait'), function ($q) use ($request) {
                return $q->where('inKuwait', $request->inKuwait);
            });

            // فلترة حسب space
            $query->when($request->filled('min_space') && $request->filled('max_space'), function ($q) use ($request) {
                return $q->whereBetween('space', [$request->min_space, $request->max_space]);
            });

            // تحديد عدد العناصر في الصفحة
            $perPage = $request->input('per_page', 10); // القيمة الافتراضية هي 10

            // تنفيذ الاستعلام مع التصفح
            $offers = $query->paginate($perPage);

            return response()->json($offers);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'string',
                'price' => 'string',
                'space' => 'string',
                'region' => 'string',
                'piece' => 'string',
                'coupon' => 'string',
                'street' => 'string',
                'home' => 'string',
                'description' => 'string',
                'location' => 'string',
                'phone' => 'string',
                'phone2' => 'string',
                'whatsapp' => 'string',
                'licenseNo'=>'string',
                'state' => 'integer|between:0,3',
                'governorate' => 'string',
                'inKuwait'=>'boolean',
                'notes' => 'string',
                'category_id'=>'required|integer|exists:categories,id',
                'country_id'=>'integer|exists:countries,id',

            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $Category = Category::find($request->get('category_id'));
            $RealEstateOffer =RealEstateOffer::create(array_merge($validator->validated(),['user_id'=>auth()->id()]));
            return response()->json($RealEstateOffer,201);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $RealEstateOffer = RealEstateOffer::findorFail($id) ;
            $Attachment = $RealEstateOffer->Attachment;
            $user = $RealEstateOffer->user;
            $Company = $RealEstateOffer->user->company;
            $Country = $RealEstateOffer->user->country;
            return response()->json([$RealEstateOffer]);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function update(Request $request, $id){
        try {
            $RealEstateOffer = RealEstateOffer::findorFail($id);
            $validator = Validator::make($request->all(), [
                'title' => 'string',
                'price' => 'string',
                'space' => 'string',
                'region' => 'string',
                'piece' => 'string',
                'coupon' => 'string',
                'street' => 'string',
                'home' => 'string',
                'description' => 'string',
                'location' => 'string',
                'phone' => 'string',
                'phone2' => 'string',
                'whatsapp' => 'string',
                'licenseNo'=>'string',
                'state' => 'integer|between:0,3',
                'governorate' => 'string',
                'inKuwait'=>'boolean',
                'notes' => 'string',
                'category_id'=>'integer|exists:categories,id',
                'country_id'=>'integer|exists:countries,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $RealEstateOffer->update($validator->validated());
            $RealEstateOffer->save();
            return response()->json('RealEstateOffer updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function destroy($id){
        try {
            $RealEstateOffer = RealEstateOffer::findorFail($id);
            $RealEstateOffer->delete();
            return response()->json('RealEstateOffer deleted successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
