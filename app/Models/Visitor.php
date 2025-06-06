<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
      protected $table = 'visitors';
    protected $primaryKey = 'id_visitor';

       public function Vendor_Visitor()
    {
        return $this->hasMany(Vendor_Visitor::class, 'id_visitor');
    }
}
