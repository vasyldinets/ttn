<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Profile::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->unique()->numberBetween(2,21),
        'name' => $faker->firstName,
        'middlename' => "Ivanovych",
        'lastname' => $faker->lastName,
        'phone' => $faker->tollFreePhoneNumber,
        'passport_id' => 'KO'.$faker->numberBetween(100000,999999),
    ];
});


$factory->define(App\Ttn::class, function (Faker\Generator $faker) {

    return [
            'user_id' => 1,
            'recipient_id' => $faker->numberBetween(2,21),
            'from_department_id' => $faker->numberBetween(1,20),
            'to_department_id' => $faker->numberBetween(1,20),
            'weight' => ''.$faker->numberBetween(1,20),
            'width' => ''.$faker->numberBetween(1,20),
            'height' => ''.$faker->numberBetween(1,20),
            'depth' => ''.$faker->numberBetween(1,20),
            'price' => ''.$faker->numberBetween(1,20),
            'track_id'=> $faker->numberBetween(1,20),
            'status' => $faker->randomElement(['new','in_progress']),
    ];
});
$factory->define(App\Track::class, function (Faker\Generator $faker) {

    return [
        'from_location_id' => $faker->numberBetween(1,20),
        'to_location_id' => $faker->numberBetween(1,20),
        'current_location_id' => $faker->numberBetween(1,20),
        'car_id' => $faker->numberBetween(1,20),
        'status' => 'active',
    ];
});
$factory->define(App\Car::class, function (Faker\Generator $faker) {

    return [
        'car_number' => 'BI'.$faker->numberBetween(100000,999999),
        'car_model' => $faker->randomElement(['GAZ','ZIL', 'Mersedes', 'Volvo', 'Scania']),
        'carrying_capacity' => $faker->numberBetween(1,3),
    ];
});

$factory->define(App\Region::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->state,
    ];
});
$factory->define(App\Location::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->city,
        'region_id' => $faker->numberBetween(1,24),
    ];
});
$factory->define(App\Department::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->secondaryAddress,
        'location_id' => $faker->numberBetween(1,60),
    ];
});