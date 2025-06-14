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
        'email',
        'validity_date_from',
        'validity_date_to',
        'validity_time_from',
        'validity_time_to',
        'company_name',
        'requestor_name',
        'company_contact',
        'phone_number',
        'location_of_work',
        'building_level_room',
        'purpose',
        'purpose_details',
        'total_worker',
        'worker1_name',
        'worker1_id_card',
        'worker1_birthdate',
        'worker2_name',
        'worker2_id_card',
        'worker2_birthdate',
        'worker3_name',
        'worker3_id_card',
        'worker3_birthdate',
        'worker4_name',
        'worker4_id_card',
        'worker4_birthdate',
        'worker5_name',
        'worker5_id_card',
        'worker5_birthdate',
        'worker6_name',
        'worker6_id_card',
        'worker6_birthdate',
        'worker7_name',
        'worker7_id_card',
        'worker7_birthdate',
        'worker8_name',
        'worker8_id_card',
        'worker8_birthdate',
        'worker9_name',
        'worker9_id_card',
        'worker9_birthdate',
        'worker10_name',
        'worker10_id_card',
        'worker10_birthdate',
        'generate_dust',
        'state_cause',
        'method',
        'any_fire',
        'isolation_of',
        'isolation_name',
        'check_one_approve',
        'isolation_date',
        'file_mos',
        'number_plate',
        'vehicle_types',
        'primary_number',
        'permit_number',
        'status',
        'mode'
    ];

      public function Vendor_Visitor()
    {
        return $this->hasMany(Vendor_Visitor::class, 'id_vendor');
    }
}
