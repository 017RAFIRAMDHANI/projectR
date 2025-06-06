<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor_Visitor extends Model
{
    use HasFactory;
      protected $table = 'vendor__visitors'; 
    protected $primaryKey = 'id_vendor_visitor';

    // Relasi dengan tabel Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor');
    }

    // Relasi dengan tabel Visitor
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'id_visitor');
    }
}
