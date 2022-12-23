<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'market_id',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function sectorRooms(string $sector_id)
    {
        return $this->rooms()->where('sector_id', '=', $sector_id)->get();
    }
}
