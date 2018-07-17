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
            $table->increments('id')->comment('���');
            $table->string('title', 100)->default('')->comment('����');
	   $table->string('url', 100)->default('')->comment('����');
            $table->tinyInteger('status')->default('1')->comment('״̬��0 Ϊ���� , 1 ������');
            $table->integer('create_time')->default('0')->comment('����ʱ��');
            $table->text('remark')->nullable()->default(null)->comment('��ע');
    
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
