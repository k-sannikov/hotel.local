<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;
use App\Models\User;
use Carbon\Carbon;

$factory->define(Order::class, function (Faker $faker) {

    $user = User::select(['name'])
        ->toBase()
        ->get()
        ->random();

    //тип номера
    $room = $faker->randomElement(
        [
            'Номер на 4-x человек',
            'Номер на 2-x человек',
            'VIP-номер на 1 человека',
        ]
    );

    request()->room_type = $room;

    //стоимость номера
    switch ($room) {
        case 'Номер на 4-x человек':
            $roomCost = 450;
        break;
        case 'Номер на 2-x человек':
            $roomCost = 900;
        break;
        case 'VIP-номер на 1 человека':
            $roomCost = 1400;
        break;
    }

    //тип услуги
    $amenitiesName = $faker->randomElement(
        [
            'Завтрак',
            'Химчистка',
        ]
    );

    //стоимость номера
    switch ($amenitiesName) {
        case 'Завтрак':
            $costAmenities = 150;
        break;
        case 'Химчистка':
            $costAmenities = 300;
        break;
    }

    $amenities = $faker->randomElement(
        [
            [],
            ["$amenitiesName" => "$costAmenities"],
        ]
    );

    //дата прибытия
    $dateOfArrival = Carbon::parse($faker->dateTimeBetween('-2 months', '-1 days'))->toDateString();
    //дата отбытия
    $dateOfDeparture = Carbon::parse($faker->dateTimeBetween('+1 days', '+2 months'))->toDateString();

    // скидка в процентах
    $percentDiscounts = mt_rand(5, 15);

    //кол-во дней пребывания
    $daysOfStay = Carbon::parse($dateOfArrival)->DiffInDays($dateOfDeparture);
    //кол-во дней пребывания (если меньше суток)
    if ($daysOfStay < 1) {
        $daysOfStay = 1;
    }


    // сумма скидки
    $amountDiscounts = round($roomCost * $daysOfStay * ($percentDiscounts / 100), 2);
    //финальная стоимость
    $totalCost = $roomCost * $daysOfStay - $amountDiscounts + $costAmenities * $daysOfStay;

    return [
        'guest_name'        => $faker->name(),
        'passport_series'   => mt_rand(1111, 9999),
        'passport_number'   => mt_rand(111111, 999999),
        'phone_number'      => '+7' . mt_rand(900, 999) . mt_rand(1000000, 9000000),
        'hotel_name'        => $faker->randomElement(['Йошкин Еж', 'Волжский Кот',]),
        'date_of_arrival'   => $dateOfArrival,
        'date_of_departure' => $dateOfDeparture,
        'room_type'         => $room,
        'room_cost'         => $roomCost,
        'amenities'         => $amenities,
        'percent_discounts' => $percentDiscounts,
        'amount_discounts'  => $amountDiscounts,
        'total_cost'        => $totalCost,
        'admin_name'        => $user->name,
    ];
});
