<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capital extends Model
{
    use HasFactory;

    protected $fillable = [
        'idResa',
        'type', 
        'montant',
        'description',
        'date_transaction'

    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class,'idResa');
    }
}
