<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendors';
    protected $primaryKey = 'id_vendor';
    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'company_name',
        'requestor_name',
        'location_of_work',
        'building_level_room',
        'work_description',
        'email',
        'phone_number',
        'permit_number',
        'start_date',
        'end_date',
        'number_plate',
        'vehicle_types',
        'worker1_name',
        'worker1_id_nopermit',
        'worker2_name',
        'worker2_id_nopermit',
        'worker3_name',
        'worker3_id_nopermit',
        'worker4_name',
        'worker4_id_nopermit',
        'worker5_name',
        'worker5_id_nopermit',
        'generate_dust',
        'protection_system',
        'file_mos',
        'status_approval_DHI',
        'status_approval_FH',
        'mode',
        'status'
    ];
}
