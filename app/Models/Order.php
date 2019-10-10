<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guest_name',
        'series_passport',
        'number_passport',
        'phone_number',
        'hotel_name',
        'date_of_arrival',
        'date_of_departure',
        'room_type',
        'room_cost',
        'amenities',
        'percent_discounts',
        'amount_discounts',
        'total_cost',
        'admin_name',
    ];

    protected $casts = [
        'amenities' => 'array'
    ];
}
