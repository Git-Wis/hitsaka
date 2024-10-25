<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passage;
use App\Models\voyage;
use App\Models\Reservation;

class BilanController extends Controller
{
    //

    public function show_bilan()
    {
        return(view('page.bilan'));
    }

    public function index(Request $request)
    {

    }

}
