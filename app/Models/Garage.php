<?php

namespace App\Models;

use App\Models\GarageImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garage extends Model
{
    use HasFactory;

    protected $table = 'garages';

    protected $fillable = [
        'gambar',
        'title',
        'categories',
        'description',
        'user_id',
    ];

    /**
     * Get the images associated with the garage.
     */
    public function garageImages()
    {
        return $this->hasMany(GarageImage::class);
    }
}
