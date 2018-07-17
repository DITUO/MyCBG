<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 生成数据集合
        $users = factory(User::class)
                        ->times(3)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker)
        {
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Mr_White_DT';
        $user->email = '337361454@qq.com';
        $user->save();
        /*$user->assignRole('Founder');

        $user = User::find(2);
        $user->assignRole('Maintainer')*/;
    }
}
