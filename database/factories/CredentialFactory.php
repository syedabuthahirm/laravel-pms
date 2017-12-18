<?php

use Faker\Generator as Faker;

$factory->define(App\Credential::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'url' => $faker->url,
        'username' => $faker->userName,
        'password' => $faker->password,
        'others' => $faker->paragraph,
        'project_id' => function() {
            return factory('App\Project')->create()->id;
        }
    ];
});
