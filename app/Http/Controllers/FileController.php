<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * 	All Entries for list
     */
    public function showFileList()
    {
        $files = File::with('uploader', 'reference')->get()->sortBy('title');
        return view('pages.file.list')->with('files', $files);
    }

    /**
     * 	Show Media
     */
    public function showFile($locale, $id) {
        $file = File::where('id', $id)->first();
        return view('pages.file.show')->with([
            'file' => $file
        ]);
    }

    public function showFileForEdit($locale, $id) {
        $file = File::where('id', $id)->first();
        return view('pages.file.add-edit-file')->with([
            'file' => $file
        ]);
    }

    public function editFile(Request $request, $locale, $id)
    {
    	$file = File::find($id);
        $request['user_id'] = auth()->user()->id;
        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'type' => 'required',
            'file_name' => '',
            'file_path' => 'required',
            'file_extension'=> 'required'
        ]);

        $file->update($validatedData);
        return redirect()->back();
    }

    public function showFileForAdd($locale) {
        return view('pages.file.add-edit-file')->with([
            'file' => null
        ]);
    }

	public function addFile(Request $request, $locale)
    {
    	$request['user_id'] = auth()->user()->id;
        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'type' => 'required',
            'file_name' => '',
            'file_path' => 'required',
            'file_extension'=> 'required'
        ]);

        $file = File::create($validatedData);

        return view('pages.file.add-edit-file')->with([
            'file' => $file
        ]);
    }


    public function storeUserImages(Request $request)
    {
        $profileImage = $request->profile_image;
        $passportImage = $request->passport_image;

        function saveNewFile($requestFile, $fileName)
        {
            if ($requestFile) {
                $oldFile = File::where('user_id', auth()->user()->id)->where('type', $fileName)->first();
                if ($oldFile) {
                    // deleting the old file
                    Storage::delete($oldFile->path);
                    // deleting the db entry for the old file
                    $oldFile->delete();
                    // creating the db entry for the new file
                    // saving the new file
                }
                File::create([
                    'user_id' => auth()->user()->id,
                    'type' => $fileName,
                    'path' => $fileName . 's/' . auth()->user()->id . '-' . $fileName . '.' . $requestFile->getClientOriginalExtension(),
                    'file_extension' => $requestFile->getClientOriginalExtension()
                ]);
                $requestFile->storeAs('public/' . $fileName . 's', auth()->user()->id . '-' . $fileName . '.' . $requestFile->getClientOriginalExtension());
            }
        }

        saveNewFile($profileImage, 'profile-image');
        saveNewFile($passportImage, 'passport-image');

        return redirect(route('iframe-user-account-basic', app()->getLocale()));
    }
}
