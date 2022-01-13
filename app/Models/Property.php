<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * Get location
     */
    public function location()
    {
        return $this->hasMany(Location::class, '__pk', '_fk_location');
    }

    /**
     * Get booking
     */
    public function booking()
    {
        return $this->hasMany(Booking::class, '_fk_property', '__pk');
    }
}
