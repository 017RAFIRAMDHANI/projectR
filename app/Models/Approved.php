<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approved extends Model
{
    use HasFactory;

    protected $table = 'approveds';

    protected $primaryKey = 'id_approved';

      protected $fillable = [
         'id_vendor',
         'id_visitor',
         'type',
         'status',
      ];
      // Model Approved
public function visitor()
{
    return $this->belongsTo(Visitor::class, 'id_visitor', 'id_visitor');
}

}
