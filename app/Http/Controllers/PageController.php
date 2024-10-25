<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class PageController extends Controller
{
    //


    public function userspace( ){
        $user = Auth::user();

        if( $user && $user->profil == 'client'){
            return view('user_space.client');
        }
        else if( $user && $user->profil == 'chauffeur'){
            return view('user_space.chauffeur');
        }
        else{
            return view('/dashboard');
        }


    }
}
