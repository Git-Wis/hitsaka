<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;


class destinataire extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'adresse',
        'tel',
    ];

    /**
     * Get all of the comments for the 2024_10_21_022150_create_clients_table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinataires():HasMany
    {
        return $this->hasMany(Colis::class,'id_dest');
    }
}
