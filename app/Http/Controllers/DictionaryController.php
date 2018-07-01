<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use TCG\Voyager\Voyager;

class DictionaryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::orderBy('title','desc')->take(1)->get();
        //$posts = Post::orderBy('title','desc')->get();
        //$posts = Post::orderBy('created_at','desc')->paginate(10);

	    $sortby = Input::get('sortby');
	    $order = Input::get('order');

	    if ($sortby && $order) {
            $dictionary = Word::orderBy($sortby, $order)->paginate(20);
	    } else {
            $dictionary = Word::orderBy('created_at','desc')->paginate(20);
	    }

	    //return View::make('posts.index', compact('posts', 'sortby', 'order'));
        return view('dictionary.index')->with('dictionary', $dictionary) ->with('sortby', $sortby)->with( 'order', $order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dictionary.create');
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
            'english' => 'required',
            'cantonese' => 'required',
            'jyutping' => 'required'
        ]);

        // Create WordResource
        $word = new Word;
        $word->english = $request->input('english');
        $word->cantonese = $request->input('cantonese');
        $word->jyutping = $request->input('jyutping');
        $word->soundAddress = 'no-soundaddress';
        $word->user_id = auth()->user()->id;
        $word->save();

        return redirect('/vue-dictionary')->with('success', 'WordResource Created');
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
        $word = Word::find($id);

        $voyager = new Voyager();
        try {
            $canEditCantonese = $voyager->can('edit_cantonese');
        } catch (\Exception $e) {
            Log::error('Error with files controller: ' . $e);
            return redirect('/vue-dictionary')->with('error', 'You can only edit or delete your own words');
        }

        $user_owns_post = auth()->user()->id ===$word->user_id;


        // Check for correct user
        if(!$user_owns_post||!$canEditCantonese) {
            return view('dictionary.edit')->with('word', $word);

        }
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
        $this->validate($request, [
            'english' => 'required',
            'cantonese' => 'required',
            'jyutping' => 'required'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Create WordResource
        $word = Word::find($id);
        $word->english = $request->input('english');
        $word->cantonese = $request->input('cantonese');
        $word->jyutping = $request->input('jyutping');
        $word->user_id = auth()->user()->id;
        $word->save();

        return redirect('/vue-dictionary')->with('success', 'WordResource Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $word = Word::find($id);

        $voyager = new Voyager();
        try {
            $canEditCantonese = $voyager->can('delete_cantonese');
        } catch (\Exception $e) {
            Log::error('Error with files controller: ' . $e);
            return redirect('/vue-dictionary')->with('error', 'You can only edit or delete your own words');
        }

        $user_owns_post = auth()->user()->id ===$word->user_id;


        // Check for correct user
        if(!$user_owns_post||!$canEditCantonese) {
            $word = Word::find($id);

            $word->delete();
            return redirect('/vue-dictionary')->with('success', 'WordResource Removed');
       // }
    }
        }

    public function vue(){
            $dictionary = Word::orderBy('created_at','desc')->paginate(20);
            return view('vue.dictionary')->with('dictionary', $dictionary);

    }
}