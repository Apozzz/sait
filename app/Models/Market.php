<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'address',
    ];

    public function sectors(): HasMany
    {
        return $this->hasMany(Sector::class);
    }

    public function marketSectors(string $market_id)
    {
        return $this->sectors()->where('market_id', '=', $market_id)->get();
    }
}
