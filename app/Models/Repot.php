<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repot extends Model
{
    use HasFactory;
    protected $table = 'repots';

    protected $primaryKey = 'id_repot';

    protected $fillable = [
        'id_akun',
        'type',
        'name_akun_download',
        'schedule',
        'name_file_pdf',
        'name',
      ];
}
