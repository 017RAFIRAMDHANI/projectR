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
         'name',
         'number_plate',
         'type',
         'company',
         'date_from',
         'date_to',
         'status',
         'id_vendor',
         'id_visitor',
         'id_employe',
   ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'id_visitor', 'id_visitor');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe', 'id_employe');
    }


}
