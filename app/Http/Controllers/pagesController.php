<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 


use Carbon\Carbon;
use Str;
use ZipArchive;


class pagesController extends Controller
{
    public function returnForm () {
        return view('pages.form');
    }

    // public function backUploadDropZone (Request $request) {
    //    
        // $now = Carbon::now();
        // $d = $now->format('Y-m-d');
        // $folder = 'SCE_'.$d; // SCE_orderId_2023-02-23_5_images

        // $dir = 'public/orders/'.$folder.'/';
        // $file = $request->file('file');

        // // Save the file to a folder with the current date
        // // $path = Storage::putFile($dir, $file);
        // $path = Storage::putFileAs($dir, $file, $file->getClientOriginalName());

        // // Return a response indicating success
        // return response()->json([
        //     'success' => true,
        //     'message' => 'File uploaded successfully!',
        //     'path' => $path // Return the path to the uploaded file
        // ]);
    // }

    // public function backupRemoveFile () {
    //     // $fileName = $request->filename;

    //     // if ($fileName) {
    //     //     File::delete(storage_path('app/public/orders/'.Carbon::now()->format('Y-m-d').'/'. $fileName));
    //     // }
    // }

    public function upload (Request $request) {
        $folder = 'SCE_'.Carbon::now()->format('Y-m-d');
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

    
    //remove file
    public function removeFile (Request $request) {

        $fileName = $request->filename;

        if ($fileName) {
            File::delete(storage_path('app/public/orders/SCE_'.Carbon::now()->format('Y-m-d').'/'. $fileName));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'File has been successfulkly removed.'
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

    public function demo_zip () {
        $folderPath = storage_path('app/public/folderToZip');
        $zipFilePath = storage_path('app/public/output/zipFiles.zip');
        $result = $this->createZipFile($folderPath, $zipFilePath);
        if ($result) {
            return "OK";
        } else {
            // An error occurred
            return "Not OK";
        }
    }

    public function make_zip () {
        $folderPath = storage_path('app/public/orders/SCE_'.Carbon::now()->format('Y-m-d'));
        $zipFilePath = storage_path('app/public/approved_orders/zipFiles.zip');

        $result = $this->createZipFile($folderPath, $zipFilePath);
        if ($result) {
            return "OK";
        } else {
            // An error occurred
            return "Not OK";
        }
    }

    private function createZipFile ($folderPath, $zipFilePath) {
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($folderPath)
            );
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            return true;
        } else {
            return false;
        }
    }
}
