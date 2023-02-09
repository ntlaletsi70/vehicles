<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //to generate code comments for documentation
    use HasFactory;
    protected $fillable = [
        'make', 'model','year_of_manufacture', 'price','transmission','fuel_type','body_type'
    ];
}
