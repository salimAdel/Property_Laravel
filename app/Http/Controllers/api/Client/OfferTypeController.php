<?php

namespace App\Http\Controllers\api\Client;

use App\Http\Controllers\Controller;
use App\Models\OfferType;
use Illuminate\Http\Request;

class OfferTypeController extends Controller
{
    public function index()
    {
        try {
            $OfferType=OfferType::with('Categories')->get();

            return response()->json($OfferType);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $OfferType = OfferType::with('Categories')->findorFail($id);
            return response()->json($OfferType);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
