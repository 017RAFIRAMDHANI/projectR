<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $primaryKey = 'id_vehicle';

      protected $fillable = [
         'number_plate',
         'type',
         'company',
         'date_from',
         'date_to',
         'status',
   ];
}
