<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    public $timestamps = false;//ʱ���

    public $primaryKey='id';//����

    protected $table = 'announcement';//����

    protected $guarded = [];//������
}
