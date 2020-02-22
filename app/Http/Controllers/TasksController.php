<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Tasks;

use App\Tweet;

use Auth;

use App\Master;

class TasksController extends Controller
{
  
    public function index(Request $request)
    {
        $posts = Tasks::all()->sortByDesc('updated_at');
        

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // tasks/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('tasks.index', ['headline' => $headline, 'posts' => $posts]);
    }
    
    public function tweet()
    {
        $tweets = Tweet::all();
        
        return view('tasks.tweet', ['tweets' => $tweets,]);
    }
    
    public function postTweet(Request $request) //　Requestはpostリクエストを取得するためのもの
    {
        $validator = $request->validate([ 
            'tweet' => ['required', 'string', 'max:280'], // 必須・文字であること・280文字まで（ツイッターに合わせた）というバリデーションをする。
        ]);
        Tweet::create([ // tweetテーブルに入れる合図
            'user_id' => Auth::user()->id, // Auth::user()は、現在ログインしている人(ツイートしたユーザー）
            //'nickname' => $request->nickname,
            'tweet' => $request->tweet, // ツイートの内容
        ]);
        
        return back();
    }
    
    public function search()
    {
        $master = Master::all()->sortByDesc('sort_no');
        
        // 返却値の初期化
        $master_arr = [];
        foreach($master as $value) {
            if (isset($master[$value->type])) {
	            $master[$value->type][] = '';
            }
            $master_arr[$value->type][$value->code] = $value->value;
            
        }
        \Log::debug(__LINE__.' '.__FILE__.' '.print_r($master_arr, true));
        $arr=[
            'master' => $master_arr,
            ];
        
        return view('tasks.search', $arr);
      
    }
    
    public function recommend()
    {
        return view('tasks.recommend');
    }
    
    
    
}