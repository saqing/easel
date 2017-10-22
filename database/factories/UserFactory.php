<?php

$factory->define(Canvas\Models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name'    => $first = $faker->firstName,
        'last_name'     => $last = $faker->lastName,
        'display_name'  => $first.' '.$last,
        'role'          => 1,
        'job'           => $faker->jobTitle,
        'birthday'      => $faker->date('Y-m-d'),
        'email'         => $faker->safeEmail,
        'twitter'       => $faker->userName,
        'facebook'      => $faker->userName,
        'github'        => $faker->userName,
        'linkedin'      => $faker->userName,
        'resume_cv'     => $faker->url,
        'address'       => $faker->streetAddress,
        'city'          => $faker->city,
        'country'       => $faker->countryCode,
        'url'           => $faker->url,
        'phone'         => $faker->phoneNumber,
        'bio'           => $faker->sentence,
        'gender'        => 'Male',
        'relationship'  => 'Single',
        'password'      => bcrypt('password'),
    ];
});
