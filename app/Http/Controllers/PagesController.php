<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function index(){
        $title = 'Brianstein!';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Projects',
            'services' => ['Web Design', 'Programming', 'PHP', 'android']
        );
        return view('pages.services')->with($data);
    }
    public function guestAdmin(){

        return view('pages.guestAdmin');
    }
}
