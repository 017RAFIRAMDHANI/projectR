<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safeti extends Model
{
    use HasFactory;

      protected $table = 'safetis';

      protected $primaryKey = 'id_safeti';

      protected $fillable = [
           'id_visitor',
           'id_vendor',
           'id_employe',
           'id_history_safeti',
           'start_date',
           'expired_date',
           'status_safeti',
           'type',
           'lampu_hijau',
           'lampu_kuning',
           'lampu_merah',
           'catatan_lampu_hijau',
           'catatan_lampu_kuning',
           'catatan_lampu_merah',
           'file_gambar',
      ];

}
