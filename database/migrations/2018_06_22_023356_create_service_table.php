<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration
{
    public $set_schema_table = 'service';
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
            $table->string('name', 50)->default('')->comment('名称');
            $table->integer('level')->default('0')->comment('等级');
            $table->integer('gid')->default('0')->comment('父级id');
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
