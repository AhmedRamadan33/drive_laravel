<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DriveController extends Controller
{
    // Display all Filles for one User only (multi auzirization)
     public function allDrives()
     {
         $driveData = Drive::all() ;
         return view('drives.allDrives', compact('driveData'));
     }

    // Display a listing of the Private resource.
    public function index()
    {
        $userId = auth()->user()->id;
        $driveData = Drive::where('userId', '=', $userId)->get();
        return view('drives.index', compact('driveData'));
    }


    // Show the form for creating a new resource.
    public function create()
    {
        return view('drives.create');
    }


    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Start validation code
        $request->validate([
            'title' => "required|min:2|max:20|string",
            'description' => "required|min:3|max:50|string",
            'file' => "required|mimes:png,jpg,pdf|max:2048"
        ]);
        // End validation code
        $drive = new Drive;
        $drive->title = $request->title;
        $drive->description = $request->description;
        // upload file : name,location
        $fileData = $request->file('file');
        $fileName = time() . $fileData->getClientOriginalName();
        $location = public_path('./drives/');
        $fileData->move($location, $fileName);
        $drive->file = $fileName;

        $drive->userId = auth()->user()->id;
        $drive->save();
        return redirect()->back()->with('done', 'uploaded file done');
    }


    // Display the specified resource.
    public function show($id)
    {
        $showFile = Drive::find($id);
        return view('drives.show', compact('showFile'));
    }

    // show and display More details about public Files only 
    public function showPublicFiles($id){
        $drive = DB::table('joindriveswithusers')->get()->first();
        return view('drives.showPublicFiles',compact('drive'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $editFile = Drive::find($id);
        return view('drives.edit', compact('editFile'));
    }


    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // Start validation code
        $request->validate([
            'title' => "required|min:2|max:20|string",
            'description' => "required|min:3|max:50|string",
            'file' => "mimes:png,jpg,pdf|max:2048"
        ]);
        // End validation code
        $editFile = Drive::find($id);
        $editFile->title = $request->title;
        $editFile->description = $request->description;
        // upload file : name,location
        $fileData = $request->file('file');

        if ($fileData != null) {
            $fileName = time() . $fileData->getClientOriginalName();
            $location = public_path('./drives/');
            $fileData->move($location, $fileName);
            $path = public_path() . "/drives/" . $editFile->file;
            unlink($path);
        } else {
            $fileName = $editFile->file;
        }

        $editFile->file = $fileName;
        $editFile->save();
        return redirect()->route('drives.index');
    }


    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $deleteFile = Drive::find($id);
        $path = public_path() . "/drives/" . $deleteFile->file;
        unlink($path);
        $deleteFile->delete();
        return redirect()->back()->with('done', 'deleted file done');
    }
    // download Files
    public function download($id)
    {
        $drive = Drive::find($id);
        $driveName = $drive->file;
        $path = public_path() . "/drives/" . $driveName;
        return response()->download($path);
    }
    // Display a listing of the public resource.
    public function publicFiles(){
        $publicFiles = Drive::where('status', '=', 'public')->get();
        return view('drives.public', compact('publicFiles'));
    }
    // switch between status files 
    public function changStatus($id){
        $drive = Drive::find($id);
        if($drive->status == 'private'){
            $drive->status = 'public' ;
        }else{
            $drive->status = 'private' ;
        }
        $drive->save();
        return redirect()->route('drives.allDrives');

    }
}
