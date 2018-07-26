<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    private $array = [
        [
            'title' => 'test1',
            'user' => 'user1',
            'time' => 'time1',
            'id' => 1
        ],[
            'title' => 'test2',
            'user' => 'user2',
            'time' => 'time2',
            'id' => 2
        ]
    ];
    public function getData(){
        $array = $this->array;
        return $array;
    }

    public function getData1(Request $request){
        $id = $request->input('id');
        $array = $this->array;
        foreach($array as &$v){
            if($v['id'] == $id){
                array_splice($array,$id,1);
            }
        }
        return $array;
    }
}
