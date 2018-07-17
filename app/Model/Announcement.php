<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    public $timestamps = false;//时间戳

    public $primaryKey='id';//主键

    protected $table = 'announcement';//表名

    protected $guarded = [];//黑名单
}
