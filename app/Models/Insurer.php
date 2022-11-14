<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'customer_id'];

    /**
     * Establish relationship to Customer model
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
