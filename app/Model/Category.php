<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $primaryKey='id';//主键

    protected $table = 'categories';//表名

    protected $guarded = [];//黑名单
}
