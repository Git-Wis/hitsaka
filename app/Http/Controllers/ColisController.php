<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colis;
use Illuminate\Support\Facades\DB;
use App\Models\expeditaire;
use App\Models\destinataire;
use Carbon\Carbon;
use App\Notifications\ColisDeposeNotification;

class ColisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // Récupérer les filtres si fournis
        $filters = $request->only(['filter_date', 'filter_destination']);
        
        // Récupérer les colis avec les filtres
        $colis = colis::query();

        if(!$colis){
            return response()->json(['error' => 'pas de reservation trouvé'], 500);
        }

        if ($request->filled('filter_date')) {
            $colis->where('date_envoi', $filters['filter_date']);

        }

        if ($request->filled('filter_destination')) {
            $colis->where('direction', $filters['filter_destination']);

        }


        $colis = $colis->paginate(10); // Pagination


        return view('page.addcolis', compact('colis'));
    }

    public function suivi()
    {
        return view('colis');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('page.addcolis');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

 
        // Validation des données
        $request->validate([
            'trajet' => 'required|string|max:10',
            'expediteur' => 'required|string|max:255',
            'expediteur_mail' => 'required|email',
            'destinataire' => 'required|string|max:255',
            'destinataire_mail' => 'required|email',
            'destinataire_tel' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'poids' => 'required|numeric',
            'type' => 'required|string|max:50',
        ]);

        //dd($request);

        DB::beginTransaction();

        try {
            // Vérification de l'existence de l'expéditeur
            $expe = Expeditaire::firstOrCreate(
                ['email' => $request->expediteur_mail],
                ['name' => $request->expediteur]
            );

            // Vérification de l'existence du destinataire
            $dest = Destinataire::firstOrCreate(
                ['email' => $request->destinataire_mail],
                [
                    'name' => $request->destinataire,
                    'tel' => $request->destinataire_tel,
                    'adresse' => $request->adresse,
                ]
            );

            // Création de l'envoi du colis
            do {
                $num_colis = random_int(10000, 99999); // Génère un numéro entre 1000 et 9999
            } while (Colis::where('num_colis', $num_colis)->exists());

            $colis = Colis::create([
                'num_colis' => $num_colis,
                'id_expe' => $expe->id,
                'id_dest' => $dest->id,
                'direction' => $request->trajet,
                'poids' => $request->poids,
                'type' => $request->type,
                'date_envoi' => Carbon::today(),
            ]);

            DB::commit();

            // Envoyer la notification
            $expe->notify(new ColisDeposeNotification($expe, $dest, $colis));
            $dest->notify(new ColisDeposeNotification($expe, $dest, $colis));

            return redirect()->route('colis.index')->with('success', 'Colis créé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transaction échouée : ' . $e->getMessage()], 500);
        }
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
        //
    }
}
