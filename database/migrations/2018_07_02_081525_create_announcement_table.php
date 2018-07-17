<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    public $set_schema_table = 'announcement';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('编号');
            $table->string('title', 100)->default('')->comment('标题');
	   $table->string('url', 100)->default('')->comment('链接');
            $table->tinyInteger('status')->default('1')->comment('状态（0 为禁用 , 1 正常）');
            $table->integer('create_time')->default('0')->comment('创建时间');
            $table->text('remark')->nullable()->default(null)->comment('备注');
    
            $table->index(["status"], 'status');
            $table->softDeletes();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
