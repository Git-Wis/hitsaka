<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passage;
use App\Models\voyage;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;


class ResaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Récupérer les filtres si fournis
        $filters = $request->only(['date', 'direction', 'payer']);
        
        // Récupérer les réservations avec les filtres
        $reservations = Reservation::query();

        if(!$reservations){
            return response()->json(['error' => 'pas de reservation trouvé'], 500);
        }

        if ($request->filled('date')) {
            $reservations->where('date', $filters['date']);
            //dd($reservations);

        }

        if ($request->filled('direction')) {
            $reservations->where('direction', $filters['direction']);
            //dd($reservations);

        }

        if ($request->filled('payer')) {
            $reservations->where('payer', $filters['payer']);
            //dd($reservations);
        }

        $reservations = $reservations->paginate(10); // Pagination


        return view('page.reservation', compact('reservations', 'filters'));
    }

    // Méthode pour confirmer une réservation
    public function confirm($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->payer = true; // Marquer comme payé
            $reservation->save();
        }
        return redirect()->back()->with('success', 'Réservation confirmée.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    *public function create()
    *{

    *}*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([

            'name' => 'required|string',
            'traget'=> 'required|string',
            'mail'=> 'required|email',
            'tel'=> 'required',
            'adresse1'=> 'required',
            'date'=> 'required|date',
            
  
        ]);


        //sauvegardé les donner dans deux table,reservations et clients
        DB::beginTransaction();


            try {
                //creation un client

                $passage = Passage::create([
                    'name'=>$request->name,
                    'email'=> $request->mail,
                    'tel'=> $request->tel,
                    'adresse1'=> $request->adresse1,
                    'adresse2'=> $request->adresse2 ?? null,

                ]);

                // Vérifiez s'il existe déjà un voyage à la date donnée
                $voyage = Voyage::where('date', $request->date)->first();

                // Si aucun voyage n'existe à cette date, en créer un nouveau
                if (!$voyage) {
                    $voyage = Voyage::create([
                        'Nom' => $request->traget,
                        'date' => $request->date,
                        
                    ]);
                }

                // Vérifiez que le voyage a bien été créé
                if (!$voyage || !$voyage->id) {
                    // Gérer le cas où le voyage n'a pas été créé
                    return response()->json(['error' => 'Le voyage n\'a pas pu être créé.'], 500);
                }

                //creation d'une reservation 

                Reservation::create([
                    'idClient'=>$passage->id,
                    'idVoyage'=>$voyage->id,
                    'direction'=> $voyage->Nom,
                    'date'=> $request->date,
                ]);

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error'=>'Transaction échouée :' . $e->getMessage()],500);
            }

            return redirect()->back()->with('success', 'Votre reservation á été prise en charge.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('page.show', compact('cours'));
        return view('page.reservation');
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
    public function destroy(Passage $passages)
    {
        //
        $passages->delete();
        return redirect()->route('/');
    }
}
