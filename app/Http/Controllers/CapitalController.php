<?php

namespace App\Http\Controllers;

use App\Models\capital;
use App\Models\depense_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $totalrevenus = capital::where('type', 'Revenu')->sum('montant'); // Total des revenus
        $totaldepenses = capital::where('type', 'Dépense')->sum('montant'); // Total des dépenses
        $alltransaction = capital::all();

        //pour le chart
        $revenus = DB::table('capitals')
        ->selectRaw('MONTH(date_transaction) as mois, SUM(montant) as total')
        ->where('type', 'Revenu')
        ->groupBy('mois')
        ->pluck('total', 'mois');

        $depenses = DB::table('capitals')
            ->selectRaw('MONTH(date_transaction) as mois, SUM(montant) as total')
            ->where('type', 'Dépense')
            ->groupBy('mois')
            ->pluck('total', 'mois');


            // recupere les categorie de depense 

        $categoriesDepense = depense_type::all();

            return view('page.capital',compact('totalrevenus', 
            'totaldepenses', 
            'alltransaction',
             'revenus',
              'depenses',
               'categoriesDepense'));
        }

    public function show()
    {
        // pour recupere tout les transaction 

        

    
    }


    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'montant' => 'required|numeric',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);
    
        Capital::create([
            'montant'=>$request->montant,
            'type'=>$request->type,
            'montant'=>$request->montant,
            'description'=>$request->description,
            'date_transaction'=>Carbon::now()],
        );
    
        return redirect()->back()->with('success', 'Transaction enregistrée avec succès.');
    }

}
