<?php

/*
|--------------------------------------------------------------------------
| Entities Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Entities factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Codeproject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Codeproject\Entities\Client::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('pt_BR');
    return [
        'name' => $faker->firstName,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence(100),
    ];
});

$factory->define(Codeproject\Entities\Project::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('pt_BR');
    return [
        'owner_id' => Codeproject\Entities\User::all()->random()->id,
        'client_id' => Codeproject\Entities\Client::all()->random()->id,
        'name' => $faker->name,
        'description' => $faker->sentence(100),
        'progress' => rand(1,100),
        'status' => rand(1,3),
        'due_date' => $faker->dateTime('now'),
    ];
});


$factory->define(Codeproject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('pt_BR');
    return [
        'project_id' => Codeproject\Entities\Project::all()->random()->id,
        'title' => $faker->title,
        'note' => $faker->paragraph,
    ];
});

$factory->define(Codeproject\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('pt_BR');
    return [
        'project_id' => Codeproject\Entities\Project::all()->random()->id,
        'name' => $faker->word,
        'start_date' => $faker->dateTime('now'),
        'due_date' => $faker->dateTime('now'),
        'status' => rand(1,3),
    ];
});

$factory->define(Codeproject\Entities\ProjectMembers::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('pt_BR');
    return [
        'project_id' => Codeproject\Entities\Project::all()->random()->id,
        'user_id' => Codeproject\Entities\User::all()->random()->id,
    ];
});