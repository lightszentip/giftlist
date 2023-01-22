<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Lightszentip\LaravelReleaseChangelogGenerator\Logic\Version;

class FileController extends Controller
{
    public function uploadFile(Request $request){

        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');// Error response

        }else{
            try {
                if($request->file('file')) {

                    $file = $request->file('file');
                    $filename = time().'_'.$file->getClientOriginalName();
                    $filename = hash('sha256', $filename).'.'.$request->file('file')->getClientOriginalExtension();
                    // File upload location
                    $location = 'files';

                    // Upload file
                    $file->move($location,$filename);

                    // Response
                    $data['success'] = 1;
                    $data['message'] = 'Uploaded Successfully!';
                    $data['link'] = $filename;

                }else{
                    // Response
                    $data['success'] = 0;
                    $data['message'] = 'File not uploaded.';
                }
            } catch (\Exception $e) {
                Log::warning('File upload ',$e);
                $data['success'] = 0;
                $data['message'] = 'File not uploaded.';
            }

        }

        return response()->json($data);
    }
}
