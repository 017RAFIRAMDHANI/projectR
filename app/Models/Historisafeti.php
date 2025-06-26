<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historisafeti extends Model
{
    use HasFactory;
    protected $table = 'historisafetis';

      protected $primaryKey = 'id_histori_safeti';
      protected $fillable = [
           'type',
           'id_safeti',
           'jenis_lampu',
           'note',
           'date_terbit',
           'name',
           'position',
           'company',
      ];

}
