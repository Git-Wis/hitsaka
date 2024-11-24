<?php

namespace App\Http\Controllers;

use App\Models\capital;
use Illuminate\Http\Request;

class CapitalController extends Controller
{

/**
 * Display the capital page view.
 *
 * @return \Illuminate\View\View
 */
    //
    public function index()
    {
        $revenus = capital::where('type', 'Revenu')->sum('montant'); // Total des revenus
        $depenses = capital::where('type', 'Dépense')->sum('montant'); // Total des dépenses
        $alltransaction = capital::all();

        return view('page.capital',compact('revenus', 'depenses', 'alltransaction'));
    }

    public function show()
    {
        // pour recupere tout les transaction 

    
    }

}
