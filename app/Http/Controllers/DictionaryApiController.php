<?php

namespace App\Http\Controllers;

use App\Http\Resources\WordCollection;
use Illuminate\Http\Request;
use App\Word as word;
use App\Http\Resources\WordResource as WordResource;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;


class DictionaryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return WordCollection
     */
    public function index()
    {

/*
        $sortby = Input::get('sortby');
        $order = Input::get('order');

        if ($sortby && $order) {
            $dictionary = WordResource::orderBy($sortby, $order)->paginate(20);
        } else {
            $dictionary = WordResource::orderBy('created_at','desc')->paginate(20);
        }
        //return View::make('posts.index', compact('posts', 'sortby', 'order'));
        return view('dictionary.index')->with('dictionary', $dictionary)
            ->with('sortby', $sortby)->with( 'order', $order);*/

        $sortby = Input::get('sortby');
        $order = Input::get('order');

        Log::debug('sortby: '.$sortby.'order'. $order);

        if ($sortby && $order) {
            $dictionary = Word::with('user')->orderBy($sortby, $order)->paginate(10);
        } else {
            $dictionary = Word::with('user')->orderBy('created_at','desc')->paginate(10);
        }

        return new WordCollection($dictionary);
        }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return WordResource
     */
    public function store(Request $request)
    {
        Log::debug('post to store '. $request);

        $word = $request->isMethod('put') ? Word::findOrFail($request->id) : new Word;

        // Handle File Upload
        if($request->hasFile('file')){

            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('file')->storeAs('public/appFiles', $fileNameToStore);

            if ($path){        Log::debug('upload successful' );
            }
        } else {
            $fileNameToStore = 'nosound.3gp';

            $word->id = $request->input('id');
            $word->english = $request->input('english');
            $word->cantonese = $request->input('cantonese');
            $word->jyutping = $request->input('jyutping');

        }
        $word->soundAddress = $fileNameToStore;


        if ($word->save()) {
            Log::debug('post to store '. $word);

            return new WordResource($word);
        }
        //announce that a message has been posted
        //broadcast(new messagePosted($message, $user))->toOthers();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return WordResource
     */
    public function show($id)
    {
        //get word
        $word = Word::findOrFail($id);

        //return single word as resource
        return new WordResource($word);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return WordResource
     */
    public function destroy($id)
    {
        Log::debug('post to destroy '. $id);

        if(
        //get word
        $word = Word::findOrFail($id)){

        //delete the word
        if ($word->delete()){
            //return single word as resource
            return new WordResource($word);
        }
        else return 'error word not found';
        }
    }
}
