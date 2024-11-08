<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_colis',
        'updated_bye',
        'id_expe',
        'id_dest',
        'direction',
        'poids',
        'type',
        'date_envoi',
        'statut',
    ];

    /**
     * Get the user that owns the 2024_10_21_023858_create_reservations_table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expeditaires()
    {
        return $this->belongsTo(expeditaire::class, 'id_expe');
    }

    public function destinataires()
    {
        return $this->belongsTo(destinataire::class, 'id_dest');
    }
}
