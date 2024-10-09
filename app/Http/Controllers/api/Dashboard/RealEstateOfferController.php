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
    public function index($Category_id = null )
    {
        try {
            $RealEstateOffer=RealEstateOffer::with('attachment')->get();

//            if($OfferType_id != null){
//                $RealEstateOffer = OfferType::findorFail($OfferType_id)->Categories->RealEstateOffer;
//            }

            if($Category_id != null){
                $RealEstateOffer = Category::findorFail($Category_id)->RealEstateOffer;
            }



            return response()->json($RealEstateOffer);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'price' => 'string|between:2,100',
                'space' => 'string|between:2,100',
                'region' => 'string|between:2,100',
                'piece' => 'string|between:2,100',
                'coupon' => 'string|between:2,100',
                'street' => 'string|between:2,100',
                'home' => 'string|between:2,100',
                'description' => 'string|between:2,255',
                'location' => 'string|between:2,100',
                'phone' => 'string|between:6,16',
                'phone2' => 'string|between:6,16',
                'whatsapp' => 'string|between:6,16',
                'licenseNo'=>'string|between:2,100',
                'state' => 'integer|between:0,3',
                'inKuwait'=>'boolean',
                'notes' => 'string|between:2,255',
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
                'price' => 'string|between:2,100',
                'space' => 'string|between:2,100',
                'region' => 'string|between:2,100',
                'piece' => 'string|between:2,100',
                'coupon' => 'string|between:2,100',
                'street' => 'string|between:2,100',
                'home' => 'string|between:2,100',
                'description' => 'string|between:2,255',
                'location' => 'string|between:2,100',
                'phone' => 'string|between:6,16',
                'phone2' => 'string|between:6,16',
                'whatsapp' => 'string|between:6,16',
                'licenseNo'=>'string|between:2,100',
                'state' => 'integer|between:0,3',
                'inKuwait'=>'boolean',
                'notes' => 'string|between:2,255',
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
