<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'telephone', 'adresse', 'date_naissance', 'ville', 'profession'
    ];

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    public function inscriptionsActives()
    {
        return $this->paiements()->whereHas('evenement', function ($query) {
            $query->where('end_date', '>=', now());
        });
    }

    public function inscriptionsPassees()
    {
        return $this->paiements()->whereHas('evenement', function ($query) {
            $query->where('end_date', '<', now());
        });
    }
}
