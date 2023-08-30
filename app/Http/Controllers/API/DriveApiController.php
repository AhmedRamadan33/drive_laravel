<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drive;

class DriveApiController extends Controller
{
        public function index()
        {
            $driveData = Drive::all();
            $message = [
                'message'=> 'get all data done',
                'data'=> $driveData ,
                'status'=> 200 ,

            ];
            return response($message ,200) ;
        }
        public function store(Request $request)
    {
        // validation code
        $request->validate([
            'title' => "required|min:2|max:20|string",
            'description' => "required|min:3|max:100|string",
            'file' => "required|mimes:png,jpg,pdf|max:2048"
        ]);
        
        // upload file : name ,location
        if ($request->hasFile('file')){
            $fileData = $request->file('file');
            $fileName = time() . $fileData->getClientOriginalName();
            $location = public_path('./drives/');
            $fileData->move($location, $fileName);
        }

        $drive = Drive::create([
            'title' => $request->title ,
            'description' => $request->description,
            'file' => $fileName,
            'userId' => 2,
            'status' => 'private',
        ]);
        $message = [
            'message'=> 'store data done',
            'data'=> $drive ,
            'status'=> 201 ,
        ];
        return response($message ,201) ;
    }

    public function update(Request $request, $id)
    {
              // validation code
              $request->validate([
                'title' => "required|min:2|max:20|string",
                'description' => "required|min:3|max:100|string",
                'file' => "required|mimes:png,jpg,pdf|max:2048"
            ]);
            
            $drive = Drive::find($id);
        // upload file : name,location
        $fileData = $request->file('file');
        if ($fileData != null) {
            $fileName = time() . $fileData->getClientOriginalName();
            $location = public_path('./drives/');
            $fileData->move($location, $fileName);
            $path = public_path() . "/drives/" . $drive->file;
            unlink($path);
        } else {
            $fileName = $drive->file;
        }

            $drive->update([
                'title' => $request->title ,
                'description' => $request->description,
                'file' => $fileName,
                'userId' => 2,
                'status' => 'private',
            ]);
            $message = [
                'message'=> 'updated data done',
                'data'=> $drive ,
                'status'=> 201 ,
            ];
            return response($message ,201) ;
    }
    public function destroy($id)
    {
        $drive = Drive::find($id);
        $path = public_path() . "/drives/" . $drive->file;
        unlink($path);
        $drive->delete();
        $message = [
            'message'=> 'delete done',
            'data'=> $drive ,
            'status'=> 200 ,
        ];
        return response($message ,200) ;

    }
}
