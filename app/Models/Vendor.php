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
        'company_name',
        'company_contact',
        'requestor_name',
        'phone_number',
        'validity_date_from',
        'validity_date_to',
        'work_description',
        'building',
        'level',
        'specific_location',
        'vehicle_types',
        'number_plate',
        'worker1_name',
        'worker1_id_card',
        'worker2_name',
        'worker2_id_card',
        'worker3_name',
        'worker3_id_card',
        'worker4_name',
        'worker4_id_card',
        'worker5_name',
        'worker5_id_card',
        'worker6_name',
        'worker6_id_card',
        'worker7_name',
        'worker7_id_card',
        'worker8_name',
        'worker8_id_card',
        'worker9_name',
        'worker9_id_card',
        'worker10_name',
        'worker10_id_card',
        'worker11_name',
        'worker11_id_card',
        'worker12_name',
        'worker12_id_card',
        'worker13_name',
        'worker13_id_card',
        'worker14_name',
        'worker14_id_card',
        'worker15_name',
        'worker15_id_card',
        'worker16_name',
        'worker16_id_card',
        'worker17_name',
        'worker17_id_card',
        'worker18_name',
        'worker18_id_card',
        'worker19_name',
        'worker19_id_card',
        'worker20_name',
        'worker20_id_card',
        'worker21_name',
        'worker21_id_card',
        'worker22_name',
        'worker22_id_card',
        'worker23_name',
        'worker23_id_card',
        'worker24_name',
        'worker24_id_card',
        'worker25_name',
        'worker25_id_card',
        'worker26_name',
        'worker26_id_card',
        'worker27_name',
        'worker27_id_card',
        'worker28_name',
        'worker28_id_card',
        'worker29_name',
        'worker29_id_card',
        'worker30_name',
        'worker30_id_card',
        'generate_dust',
        'fire_system',
        'isolation_of',
        'isolation_name',
        'isolation_date',
        'up_id_card_foto',
        'file_mos',
        'primary_number',
        'check_one_approve',
        'permit_number',
        'status',
        'mode',
    ];

      public function Vendor_Visitor()
    {
        return $this->hasMany(Vendor_Visitor::class, 'id_vendor');
    }
}
