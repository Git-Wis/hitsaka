<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Passage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'tel',
        'adresse1',
        'adresse2',
    ];

    /**
     * Get all of the comments for the 2024_10_21_022150_create_clients_table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations():HasMany
    {
        return $this->hasMany(Reservation::class,'idClient');
    }
}


