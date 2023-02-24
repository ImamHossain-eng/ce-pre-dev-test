<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use Carbon\Carbon;
use Str;


class BackPagesController extends Controller
{
    public function returnForm () {
        return view('pages.form');
    }

    // public function backUploadDropZone (Request $request) {
    //     $folder = date('Y-m-d'); // Generate folder name using current date
    //     $dir = 'public/orders/'.$folder.'/';
    //     $file = $request->file('file');

    //     // Save the file to a folder with the current date
    //     // $path = Storage::putFile($dir, $file);
    //     $path = Storage::putFileAs($dir, $file, $file->getClientOriginalName());

    //     // Return a response indicating success
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'File uploaded successfully!',
    //         'path' => $path // Return the path to the uploaded file
    //     ]);

    // }

    public function upload (Request $request) {

        $now = Carbon::now();
        $d = $now->format('Y-m-d');
        $folder = 'SCE_'.$d; // SCE_orderId_2023-02-23_5_images

        $dir = 'public/orders/'.$folder.'/';
        $file = $request->file('file');

        // Save the file to a folder with the current date
        // $path = Storage::putFile($dir, $file);
        $path = Storage::putFileAs($dir, $file, $file->getClientOriginalName());

        // Return a response indicating success
        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully!',
            'path' => $path // Return the path to the uploaded file
        ]);
    }
    public function getForm() {
        return view('pages.test_form');
    }
    public function testUpload(Request $request) {
        $file = $request->file('image');

        $filename = $file->getClientOriginalName();
        $file->move('public/img', $filename);
        return "OK";
    }

    public function demo_folder_name () {
        $now = Carbon::now();
        $d = $now->format('Y-m-d');
        $r = Str::random(32);
        $result = 'SCE_'.$d.'_'.$r;
        return $result;
    }
}
