<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
   protected $table = 'employes';

    protected $primaryKey = 'id_employe';

      protected $fillable = [
         'name',
         'company_name',
         'position',
         'type',
         'file_card',
         'status',
      ];
      
   public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'id_employe', 'id_employe');
    }
}
