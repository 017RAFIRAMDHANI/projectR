<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'company',
        'email',
        'password',

        'file_card',
        'role',
        'item1',
        'item2',
        'item3',
        'item4',
        'item5',
        'item6',
        'remember_token',
    'access_newspecial_create',
        'access_employe_create',
        'access_employe_edit',
        'access_employe_delete',
        'access_employe_view',
        'access_approvals_view',
        'access_approvals_edit',
        'access_visvin_view',
        'access_visvin_delete',
        'access_vehicle_view',
        'access_vehicle_create',
        'access_vehicle_edit',
        'access_vehicle_delete',
        'access_safety_view',
        'access_safety_edit',
        'access_report_view',
        'access_report_create',
        'access_report_edit',
        'access_report_delete',
        'access_role_view',
        'access_role_create',
        'access_role_edit',
        'access_role_delete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
