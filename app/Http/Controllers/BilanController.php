<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passage;
use App\Models\voyage;
use App\Models\Reservation;
use Carbon\Carbon;

class BilanController extends Controller
{
    //
    public function CountResa($Mois)
    {
        $StartOfMonth = Carbon::now()->subMonth($Mois)->startOfMonth();
        $EndOfMonth = Carbon::now()->subMonth($Mois)->endOfMonth();
        $Month = Carbon::now()->subMonth($Mois)->monthName;

        // Filtrer les réservations du mois précédent
        $Resamois = Reservation::whereBetween('date', [$StartOfMonth, $EndOfMonth]);

        // Compter le nombre total de réservations pour le mois précédent
        $CountResaMois = $Resamois->count();

        // Nombre de réservations confirmées pour le mois précédent
        $CountConfmois = $Resamois->where('payer',true)->count();

        // Nombre de réservations non confirmées pour le mois précédent
        $CountNotConfmois = $Resamois->where('payer',false)->count(); // mbola ts mipa 
        
        // Créer un tableau contenant les résultats
        return $mois = [
            'count' => $CountResaMois,
            'count_Conf' => $CountConfmois,
            'Count_Conf_Not' => $CountNotConfmois,
            'Month_Name' => $Month
        ];
    }


    public function show_bilan()
    {

        
        $totalResa = Reservation::count();
        $totalConfirm = Reservation::Where('payer',1)->count();
        $totalNotConfirm = Reservation::Where('payer',0)->count();

        //recupéré les reservation des trois dernier mois 

        // 1er mois 
        $mois1 = $this->CountResa(1);
        // 2-eme mois 
        $mois2 = $this->CountResa(2);
        // 3-eme mois 
        $mois3 = $this->CountResa(3);
        

        //dd($totalResa);


        return view('page.bilan', 
        compact(
            'totalResa',
            'totalConfirm',
            'totalNotConfirm',
            'mois1',
            'mois2',
            'mois3'
        ));
    }

    public function index(Request $request)
    {
       
    }

}
