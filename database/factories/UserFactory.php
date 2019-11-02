<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'role' => 'user',
        'remember_token' => Str::random(10),
    ];
});

/**
 * Состояние для учетной записи Администратора
 */
$factory->state(User::class, 'admin', [
    'email' => 'admin@test.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);

/**
 * Состояние для учетной записи Пользователя1
 */
$factory->state(User::class, 'user1', [
    'email' => 'user1@test.com',
    'password' => bcrypt('password'),
    'role' => 'user'
]);

/**
 * Состояние для учетной записи Пользователя2
 */
$factory->state(User::class, 'user2', [
    'email' => 'user2@test.com',
    'password' => bcrypt('password'),
    'role' => 'user'
]);
