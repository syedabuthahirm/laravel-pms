<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'client_id' => function() {
            $u = factory('App\User')->create();
            $u->assignRole('client');
            return $u->id;
        },
        'created_by' => 1
    ];
});
