<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;
  protected $table = 'historis';

    protected $primaryKey = 'id_histori';

      protected $fillable = [
          'id_data',
           'type',
           'read',
           'judul',
           'id_akun',
           'text'
      ];
}
