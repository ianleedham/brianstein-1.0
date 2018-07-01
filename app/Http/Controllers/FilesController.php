<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use DB;
use TCG\Voyager\Voyager;


class filesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'GuestPMS']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todo add checks


            $files = file::orderBy('created_at','desc')->paginate(10);
            return view('media.index')->with('files', $files);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //upload files page needed?
        return view('media.create-file');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'file' => 'file|required|max:199900',
            'description'=>'nullable',
            'name'=>'required'
        ]);


        // Handle File Upload
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extmedia
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time();

            // Upload Image
            $path = $request->file('file')->storeAs('public/files', $fileNameToStore);


            // Create FileDetails in database
            $file = new File();
            $file->name = $fileNameToStore;
            $file->displayname = $request->input('name');
            $file->description = '';//$request->input('description');
            $file->user_id = auth()->user()->id;
            $file->type = $extension;
            $file->save();

            return redirect('/media')->with('success', 'File Uploaded');
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);


        $voyager = new Voyager();
        try {
            $canDeleteFile = $voyager->can('delete_files');
        } catch (\Exception $e) {
            Log::error('Error with files controller: ' . $e);
            return redirect('/media')->with('error', 'You don not have permission to do that');
        }

        $ownsFile = function ($file){
            if(auth()->user()== $file->owner){return true;}else return false;
        };

        if ($canDeleteFile||$ownsFile) {
            Log::error('should be success ');

            // Delete file
            Storage::delete('public/files/' . $file->name);

            $file->delete();
            return redirect('/media')->with('success', 'File Removed');


        }else{
            return redirect('/media')->with('error', 'You do not have permission to do that');
        }
    }

    public function download($id)
    {
        $file = File::find($id);


        $voyager = new Voyager();
        try {
            $canDeleteFile = $voyager->can('delete_files');
        } catch (\Exception $e) {
            Log::error('Error with files controller: ' . $e);
            return redirect('/media')->with('error', 'You don not have permission to do that');
        }

        $ownsFile = function ($file){
            if(auth()->user()== $file->owner){return true;}else return false;
        };

        if ($canDeleteFile||$ownsFile) {
            $headers = array('Content-Type: application/octet-stream');
            return response()->download('storage/files/' . $file->name, $file->name);

        }else{
            return redirect('/media')->with('error', 'You don not have permission to do that');
        }
    }


    public function GuestPMS()
    {
        return view('media.guestPMS');
    }
}
