<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Slug;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Slug::class, function (Faker $faker) {
    return [
        'slug' => '1a',
        'redirect' => 'www.google.com'
    ];
});
