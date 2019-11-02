<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
        'passport_series',
        'passport_number',
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

    /**
     * Дата прибытия в формате "4 окт 2019 г."
     */
    public function getArrivalAttribute()
    {
        $date = new Carbon;
        $date->locale('ru');
        $dateArrival = $date->parse($this->date_of_arrival)->isoFormat('D MMM Y г.');

        return $dateArrival;
    }

    /**
     * Дата выселения в формате "4 окт 2019 г."
     */
    public function getDepartureAttribute()
    {
        $date = new Carbon;
        $date->locale('ru');
        $dateDeparture = $date->parse($this->date_of_departure)->isoFormat('D MMM Y г.');

        return $dateDeparture;
    }
}
