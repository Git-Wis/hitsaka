<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'idClient',
        'idVoyage',
        'date',
        'direction',
        'payer',
    ];

    /**
     * Get the user that owns the 2024_10_21_023858_create_reservations_table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function passage()
    {
        return $this->belongsTo(Passage::class, 'idClient');
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'idVoyage');
    }
}
