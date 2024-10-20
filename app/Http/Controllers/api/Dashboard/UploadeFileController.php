<?php

namespace App\Http\Controllers\api\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\EvaluationAttachment;
use App\Models\OfferAttachment;
use App\Models\RealEstateEvaluation;
use App\Models\RealEstateOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            return response()->json($request , 200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function UpdateEvaluationFile(Request $request , $id)
    {
        try {
            $EvaluationAttachment = EvaluationAttachment::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'type' => 'string',
                'file' => 'file',
                'extension'=>'string'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $filePath = $EvaluationAttachment->path;
            if (request('file') != null) {
                $filePath = request('file')->store('uploads', 'public');
            }
            $EvaluationAttachment->update(array_merge(
                [
                    'name' => $request->get('name'),
                    'type' => $request->get('type'),
                    'path' => $filePath,
                    'extension' => $request->get('extension')
                ]
            ));
            $EvaluationAttachment->save();
            return response()->json('EvaluationAttachment updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function DeleteEvaluationFile($id)
    {
        try {
            $EvaluationAttachment = EvaluationAttachment::findorFail($id);
            $EvaluationAttachment->delete();
            return response()->json('EvaluationAttachment deleted successfully');
        } catch (\Exception $exception) {
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
            return response()->json($request , 200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function UpdateOfferFile(Request $request , $id)
    {
        try {
            $OfferAttachment = OfferAttachment::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'type' => 'string',
                'file' => 'file',
                'extension'=>'string'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $filePath = $OfferAttachment->path;
            if (request('file') != null) {
                $filePath = request('file')->store('uploads', 'public');
            }
            $OfferAttachment->update(array_merge(

                [
                    'name' => $request->get('name'),
                    'type' => $request->get('type'),
                    'path' => $filePath,
                    'extension' => $request->get('extension')
                ]

            ));
            $OfferAttachment->save();
            return response()->json('OfferAttachment updated successfully');
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
    public function DeleteOfferFile($id)
    {
        try {
            $OfferAttachment = OfferAttachment::findorFail($id);
            $OfferAttachment->delete();
            return response()->json('OfferAttachment deleted successfully');
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }
}
