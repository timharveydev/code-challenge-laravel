<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'premium'];

    /**
     * Get the Policy associated with the Customer
     */
    public function policy()
    {
        return $this->hasOne(Policy::class);
    }

    /**
     * Get the Insurer associated with the Customer
     */
    public function insurer()
    {
        return $this->hasOne(Insurer::class);
    }
}
