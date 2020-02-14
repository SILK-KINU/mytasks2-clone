<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Tasks;

use App\Tweet;

use Auth;

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
        
        return view('tasks.tweet', ["tweets" => $tweets]);
    }
    
    public function postTweet(Request $request) //　Requestはpostリクエストを取得するためのもの
    {
        $validator = $request->validate([ 
            'tweet' => ['required', 'string', 'max:280'], // 必須・文字であること・280文字まで（ツイッターに合わせた）というバリデーションをする。
        ]);
        Tweet::create([ // tweetテーブルに入れる合図
            'user_id' => Auth::user()->id, // Auth::user()は、現在ログインしている人(ツイートしたユーザー）
            'tweet' => $request->tweet, // ツイートの内容
        ]);
        
        return back();
    }
    
    public function search()
    {
        return view('tasks.search');
    }
    
    public function recommend()
    {
        return view('tasks.recommend');
    }
    
}