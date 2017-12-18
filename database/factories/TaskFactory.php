<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'project_id' => function() {
            return factory('App\Project')->create()->id;
        },
        'created_by' => function() { 
            return factory('App\User')->create()->id;
        }
    ];
});
