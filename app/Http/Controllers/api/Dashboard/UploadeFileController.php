<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\RealEstateEvaluation;
use App\Models\RealEstateOffer;
use Illuminate\Http\Request;

class UploadeFileController extends Controller
{
    public function UploadEvaluationFile(Request $request , $id)
    {
        try {
            $RealEstateEvaluation = RealEstateEvaluation::findorFail($id);
            $names = $request->get('name');
            $types = $request->get('type');
            $extensions = $request->get('extension');
            $files = $request->file('file');
            foreach ($files as $i=>$file) {
                $imagePath = null;
                if ($file != null) {
                    $imagePath = $file->store('uploads', 'public');
                }
                $RealEstateEvaluation->Attachment()->create([
                    'name' => $names[$i],
                    'type' => $types[$i],
                    'extension' => $extensions[$i],
                    'path' => $imagePath,
                ]);
            }
            return response()->json("OfferAttachment created successfully" , 200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }



    public function UploadOfferFile(Request $request , $id)
    {
        try {
            $RealEstateOffer = RealEstateOffer::findorFail($id);
            $names = $request->get('name');
            $types = $request->get('type');
            $extensions = $request->get('extension');
            $files = $request->file('file');
            foreach ($files as $i=>$file) {
                $imagePath = null;
                if ($file != null) {
                    $imagePath = $file->store('uploads', 'public');
                }
                $RealEstateOffer->Attachment()->create([
                    'name' => $names[$i],
                    'type' => $types[$i],
                    'extension' => $extensions[$i],
                    'path' => $imagePath,
                ]);
            }
            return response()->json('OfferAttachment created successfully' , 200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
