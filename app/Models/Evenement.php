<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Evenement extends Model
{
    protected $fillable = [
        'titre', 'description', 'date', 'end_date', 'prix', 'status', 'images'
    ];

    protected $casts = [
        'date' => 'datetime',
        'end_date' => 'datetime',
        'images' => 'array',
    ];

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    /**
     * Get the event date with proper formatting
     */
    public function getFormattedDateAttribute()
    {
        return $this->date->format('M d, Y');
    }

    /**
     * Get the event time with proper formatting
     */
    public function getFormattedTimeAttribute()
    {
        return $this->date->format('h:i A');
    }

    /**
     * Check if event is upcoming
     */
    public function getIsUpcomingAttribute()
    {
        return $this->date->gt(now());
    }
}