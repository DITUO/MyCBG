<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Service;
use JonnyW\PhantomJs\Client;
use QL\QueryList;
use App\Model\Announcement;
use Session;

class ServiceController extends Controller
{
    //
	public function serviceList(Request $request){
        $res = Service::select('id','name')->where('gid',0)->where('level',1)->orderBy('id')->get();
		$data = $res->toArray();
		$i = 0;
		foreach($data as &$v){
			$num = intval(intval($v['id'] - 1) % 7);
			if($num < 7){
				$data1[$i][] = $v;
			}
			if($num == 6){
				$i++;
			}
		}
		$res1 = Service::select('id','name')->where('gid',1)->get();
		$res1 = $res1->toArray();
		$num = 14 - count($res1);
		$res2 = Service::select('id','name')->where('gid',0)->limit($num)->get();
		$data3 = $res2->toArray();
		foreach($data3 as &$vv){
			$vv['name'] = '';
		}
		$res1 = array_merge($res1,$data3);
		$i = $j = 0;
		foreach($res1 as &$v){
			if($i < 7){
				$data2[$j][] = $v;
			}
			if($i == 6){
				$i = -1;
				$j++;
			}
			$i++;
		}
		$res2 = Announcement::where('status',1)->limit(7)->orderBy('id','desc')->get();
		$data3 = $res2->toArray();
		return view('service.service',compact('data1','data2','data3'));
	}

	public function services(Request $request){
		$id = $request->filled('service_id') ? $request->input('service_id') : 1;
		$res = Service::select('id','name')->where('gid',$id)->get();
		$data = $res->toArray();
		$num = 14 - count($data);
		$res1 = Service::select('id','name')->where('gid',0)->limit($num)->get();
		$data1 = $res1->toArray();
		foreach($data1 as &$vv){
			$vv['name'] = '';
		}
		$data = array_merge($data,$data1);
		$i = $j = 0;
		foreach($data as &$v){
			if($i < 7){
				$data2[$j][] = $v;
			}
			if($i == 6){
				$i = -1;
				$j++;
			}
			$i++;
		}
		return $data2;
	}

	public function serviceAdd(Request $request){
		$res = Service::select('id','name')->where('gid',0)->where('level',2)->get();
		$data = $res->toArray();
		return view('service.add',compact('data'));
	}

	public function serviceStore(Request $request){
		$data = [
			'id' => $request->input('id'),
			'name' => $request->filled('name') ? $request->input('name') : '',
			'level' => $request->input('level'),
			'gid' => $request->input('gid'),
			'create_time' => $request->filled('create_time') ? strtotime($request->input('create_time')) : 0,
		];
		$res = Service::create($data);
	}

	public function serviceDetail(Request $request){
		$id = $request->input('service_id');
	}

	public function test(Request $request){
		return view('service.test');
	} 

	public function test1(Request $request){
        $client = Client::getInstance();
        $client->getEngine()->setPath(env('PHANTOM_JS_PATH'));
        /** 
         * @see JonnyW\PhantomJs\Http\Request
         **/
        $request = $client->getMessageFactory()->createRequest('http://xyq.163.com/news/cbg_news.html', 'GET');
    
        /** 
         * @see JonnyW\PhantomJs\Http\Response 
         **/
        $response = $client->getMessageFactory()->createResponse();
    
        // Send the request
        $client->send($request, $response);
    
        if($response->getStatus() === 200) {
            $html = '<html>'.$response->getContent().'</html>';
            $rules = [
                //采集a标签的href属性
                'link' => ['a','href'],
                'content' => ['a','text'],
            ];
			$content = QueryList::html($html)->removeHead()->rules($rules)->range("#main > div,p")->query()->getData();
			$data = array_reverse($content->all());
			foreach($data as $v){
				$data = array();
				$data = [
					'title' => $v['content'],
					'url' => $v['link'],
					'create_time' => time()
				];
				$res = Announcement::create($data);
			}
        }
	}
	
	public function test2(){  //所有的大区
        $file_path = '../public/'."aaa.txt";
        if(file_exists($file_path)){
            $str = file_get_contents($file_path);//将整个文件内容读入到一个字符串中
            $strs = explode("\t", $str);
        }
        $tmp = array();
        foreach($strs as &$v){
            $v = substr($v,0,-2);
            if(strlen($v)>10){
                $aaa = explode(",", $v);
                if(strlen($aaa[0]) > 7){
					$bbb = substr(substr($aaa[0],2),0,-1);
					$ccc = explode('_',substr(substr($aaa[1],2),0,-1));
					$id = intval($ccc[0])+(intval($ccc[1])-1)*7;
                    $tmp[] = [
						'id' => $id,
						'name' => $bbb
					];
                }
            }
		}
		foreach($tmp as $vv){
			$data = [
				'id' => $vv['id'],
				'name' => $vv['name'],
				'level' => 1,
				'gid' => 0,			
				'create_time' => time(),
			];
			$res = Service::create($data);
		}
	}
	
	public function test3(){//所有区  
        $file_path = '../public/'."aaa.txt";
        if(file_exists($file_path)){
            $str = file_get_contents($file_path);//将整个文件内容读入到一个字符串中
            $strs = explode("\t", $str);
        }
        $tmp = array();
        foreach($strs as &$v){
            $v = substr($v,0,-2);
            if(strlen($v)>10){
                $aaa = explode(",", $v);
                if(strlen($aaa[1]) > 7){
					$bbb = substr(substr($aaa[1],2),0,-1);
                    $tmp[] = $bbb;
                }
            }
		}
		foreach($tmp as $vv){
			$data = [
				'name' => $vv,
				'level' => 2,
				'gid' => 0,			
				'create_time' => time(),
			];
			$res = Service::create($data);
		}
    }

	public function app(){
		return redirect()->route('topics.index');
	}

	public function choose(Request $request){
		$id = $request->input('id');
		Session::put('id',$id);
		return redirect()->route('login');
	}
}
