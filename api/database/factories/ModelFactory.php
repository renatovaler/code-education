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

$factory->define(CodeProject\Entities\User::class, function (Faker\Generator $faker) {
    /*
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
    */
    return [
        'name' => 'Renato',
        'email' => 'renato.valer@hotmail.com',
        'password' => bcrypt(12345),
        'remember_token' => str_random(10),
    ];
});
$factory->define(CodeProject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence(),
    ];
});
$factory->define(CodeProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => \CodeProject\Entities\User::orderByRaw("RAND()")->first()->getKey(),
        'client_id' => \CodeProject\Entities\Client::orderByRaw("RAND()")->first()->getKey(),
        'name' => $faker->name,
        'description' => $faker->sentence(),
        'progress' => $faker->randomDigitNotNull,
        'status' => $faker->randomDigitNotNull,
        'due_date' => $faker->dateTime,
    ];
});

$factory->define(CodeProject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => \CodeProject\Entities\Project::orderByRaw("RAND()")->first()->getKey(),
        'title' => $faker->word,
        'note' => $faker->paragraph
    ];
});

$factory->define(CodeProject\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => \CodeProject\Entities\Project::orderByRaw("RAND()")->first()->getKey(),
        'name' => $faker->name,
        'status' => $faker->randomDigitNotNull,
        'start_date' => $faker->dateTime,
        'due_date' => $faker->dateTime
    ];
});

$factory->define(CodeProject\Entities\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        'project_id' => \CodeProject\Entities\Project::orderByRaw("RAND()")->first()->getKey(),
        'user_id' => \CodeProject\Entities\User::orderByRaw("RAND()")->first()->getKey()
    ];
});
$factory->define(CodeProject\Entities\OAuth2::class, function (Faker\Generator $faker) {
    return [
        'id' => md5(rand(10000, 999999)),
        'name' => md5(rand(10000, 999999)),
        'secret' => md5(rand(10000, 999999))
    ];
});
