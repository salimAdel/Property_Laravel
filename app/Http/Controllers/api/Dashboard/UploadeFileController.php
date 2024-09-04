<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\EvaluationAttachment;
use App\Models\OfferAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadeFileController extends Controller
{
    public function UploadEvaluationFile(Request $request)
    {
        try {
            $evaluation_id = $request->get('evaluation_id');
            $names = $request->get('name');
            $types = $request->get('type');
            $extensions = $request->get('extension');
            $files = $request->file('file');
            foreach ($files as $i=>$file) {
                $imagePath = null;
                if ($file != null) {
                    $imagePath = $file->store('uploads', 'public');
                }
                EvaluationAttachment::create([
                    'name' => $names[$i],
                    'type' => $types[$i],
                    'extension' => $extensions[$i],
                    'path' => $imagePath,
                    'evaluation_id'=>$evaluation_id,
                ]);
            }
            $a = asset('uploads');
            return response()->json("OfferAttachment created successfully" , 200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }



    public function UploadOfferFile(Request $request)
    {
        try {
            $evaluation_id = $request->get('offer_id');
            $names = $request->get('name');
            $types = $request->get('type');
            $extensions = $request->get('extension');
            $files = $request->file('file');
            foreach ($files as $i=>$file) {
                $imagePath = null;
                if ($file != null) {
                    $imagePath = $file->store('uploads', 'public');
                }
                OfferAttachment::create([
                    'name' => $names[$i],
                    'type' => $types[$i],
                    'extension' => $extensions[$i],
                    'path' => $imagePath,
                    'Offer_id'=>$evaluation_id,
                ]);
            }
            return response()->json('OfferAttachment created successfully' , 200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
