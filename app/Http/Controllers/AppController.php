<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{



    public function getAdminPage()
    {
        // Check if user is admin
        if(!(Auth::user()->hasRole("Admin"))) {

            return redirect('/')->with('error', 'Unauthorized Page');
        }else {
            $users = User::all();
            return view('pages/admin')->with('users', $users);
        }
    }


    public function postAdminAssignRoles(Request $request)
    {
        Log::debug('assign role: '. $request);
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();
    }
}