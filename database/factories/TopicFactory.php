<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Topic::class, function (Faker $faker) {

    $sentence = $faker->sentence();

    // ���ȡһ�������ڵ�ʱ��
    $updated_at = $faker->dateTimeThisMonth();
    // ����Ϊ�������ʱ�䲻����������ʱ����Զ�ȸ���ʱ��Ҫ��
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
        'service_id' => 204
    ];
});