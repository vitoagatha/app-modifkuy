<?php

namespace App\Models;

use App\Models\Garage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GarageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'garage_id',
        'image_path',
    ];

    // Relasi dengan model Garage
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
}
