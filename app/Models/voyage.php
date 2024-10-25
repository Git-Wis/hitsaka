<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = [

        'Nom',
        'capacite',
        'date',
        'statut',
    ];

    /**
     * Get all of the comments for the 2024_10_21_022150_create_clients_table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations():HasMany
    {
        return $this->hasMany(Reservation::class,'idVoyage');
    }


}
