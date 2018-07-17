<?php

use Illuminate\Database\Seeder;
use App\Model\Reply;
use App\Model\User;
use App\Model\Topic;

class ReplysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	$user_ids = User::all()->pluck('id')->toArray();

	$topic_ids = Topic::all()->pluck('id')->toArray();

	$faker = app(Faker\Generator::class);

	$replys = factory(Reply::class)
			->times(100)
			->make()
			->each(function ($reply,$index)use($user_ids,$topic_ids,$faker){
            // 从用户 ID 数组中随机取出一个并赋值
            $reply->user_id = $faker->randomElement($user_ids);

            // 话题 ID，同上
            $reply->topic_id = $faker->randomElement($topic_ids);
			});
	        // 将数据集合转换为数组，并插入到数据库中
        Reply::insert($replys->toArray());
    }
}
