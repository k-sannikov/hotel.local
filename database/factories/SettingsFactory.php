<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Settings;
use Faker\Generator as Faker;

$factory->define(Settings::class, function (Faker $faker) {
    return [
        'group_name' => 1,
        'element_name' => 'Номер на 4-х человек',
        'value' => 450,
    ];
});

/**
 * Состояние для 4-x местного номера
 */
$factory->state(Settings::class, 'room_4', [
    'group_name' => 'rooms',
    'element_name' => 'Номер на 4-x человек',
    'value' => 450,
]);

/**
 * Состояние для 2-x местного номера
 */
$factory->state(Settings::class, 'room_2', [
    'group_name' => 'rooms',
    'element_name' => 'Номер на 2-x человек',
    'value' => 900,
]);

/**
 * Состояние для vip номера
 */
$factory->state(Settings::class, 'room_vip', [
    'group_name' => 'rooms',
    'element_name' => 'VIP-номер на 1 человека',
    'value' => 1400,
]);

/**
 * Состояние для завтрака
 */
$factory->state(Settings::class, 'breakfast', [
    'group_name' => 'amenities',
    'element_name' => 'Завтрак',
    'value' => 150,
]);

/**
 * Состояние для химчиски
 */
$factory->state(Settings::class, 'dry_cleaning', [
    'group_name' => 'amenities',
    'element_name' => 'Химчистка',
    'value' => 300,
]);

/**
 * Состояние для Отеля Йошкин Еж
 */
$factory->state(Settings::class, 'yoshkin_Hedgehog', [
    'group_name' => 'hotels',
    'element_name' => 'Отель',
    'value' => 'Йошкин Еж',
]);

/**
 * Состояние для Отеля Волжский Кот
 */
$factory->state(Settings::class, 'volga_cat', [
    'group_name' => 'hotels',
    'element_name' => 'Отель',
    'value' => 'Волжский Кот',
]);

/**
 * Состояние для максимальной скидки
 */
$factory->state(Settings::class, 'max_discount', [
    'group_name' => 'discount',
    'element_name' => 'max',
    'value' => '15',
]);

/**
 * Состояние для минимальной скидки
 */
$factory->state(Settings::class, 'min_discount', [
    'group_name' => 'discount',
    'element_name' => 'min',
    'value' => '5',
]);

