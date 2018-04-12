<?php

use Faker\Generator as Faker;

$factory->define(App\Resume::class, function (Faker $faker) {
    return [
        'data'     => [
            'title'    => '',
            'sections' => [
                'section1' => [],
                'section2' => [],
                'section3' => [],
                'section4' => [],
                'section5' => [],
            ]
        ],
        'template' => ''
    ];
});
