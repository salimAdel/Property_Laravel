<?php

namespace App\Http\Controllers\api\Client;

use App\Http\Controllers\Controller;
use App\Models\RealEstateOffer;
use Illuminate\Http\Request;

class RealEstateOfferController extends Controller
{
    //

    public function index(Request $request){
        try {
            $query = RealEstateOffer::query();

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

    public function show($id)
    {
        try {
            $RealEstateOffer = RealEstateOffer::findorFail($id) ;
            $Attachment = $RealEstateOffer->Attachment;
            return response()->json([$RealEstateOffer]);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
