<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
      protected $table = 'visitors';
    protected $primaryKey = 'id_visitor';

       public function Vendor_Visitor()
    {
        return $this->hasMany(Vendor_Visitor::class, 'id_visitor');
    }

      protected $fillable = [
        'email',
        'request_date_from',
        'request_date_to',
        'purpose',
        'purpose_detail',
        'area',
        'name_1',
        'id_card_1',
        'name_2',
        'id_card_2',
        'name_3',
        'id_card_3',
        'name_4',
        'id_card_4',
        'name_5',
        'id_card_5',
        'name_6',
        'id_card_6',
        'name_7',
        'id_card_7',
        'name_8',
        'id_card_8',
        'name_9',
        'id_card_9',
        'name_10',
        'id_card_10',
        'qty_1',
        'material_1',
        'qty_2',
        'material_2',
        'qty_3',
        'material_3',
        'qty_4',
        'material_4',
        'qty_5',
        'material_5',
        'qty_6',
        'material_6',
        'qty_7',
        'material_7',
        'qty_8',
        'material_8',
        'qty_9',
        'material_9',
        'qty_10',
        'material_10',
        'pic_name',
        'contact_number',
        'car_plate_no',
        'vehicle_type',
        'primary_number',
        'permit_number',
        'status',
        'mode'
    ];
}
