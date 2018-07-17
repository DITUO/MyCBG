<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'name'        => '梦幻币',
                'description' => '充钱就对了！',
            ],
            [
                'name'        => '召唤兽',
                'description' => '还是充钱！！！',
            ],
            [
                'name'        => '装备',
                'description' => '不充钱能行？',
            ],
            [
                'name'        => '其他',
                'description' => '还用解释？',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
	DB::table('categories')->truncate();
    }
}
