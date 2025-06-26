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
           'lampu_green',
           'lampu_yellow',
           'lampu_red',
           'catatan_lampu_green',
           'catatan_lampu_yellow',
           'catatan_lampu_red',
           'date_lampu_green',
           'date_lampu_yellow',
           'date_lampu_red',
           'file_gambar',
           'name',
           'company_name',
      ];
public function vendor()
{
    return $this->belongsTo(Vendor::class, 'id_vendor');
}

public function visitor()
{
    return $this->belongsTo(Visitor::class, 'id_visitor');
}

public function employe()
{
    return $this->belongsTo(Employe::class, 'id_employe');
}

}
