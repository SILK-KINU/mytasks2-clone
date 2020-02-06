<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

// 追記
use App\Tasks;
use App\Tweet;

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
    
    public function messageboard()
    {
        return view('tasks.messageboard');
    }
    
    public function tweet(Request $request)
    {
    $validator = $request->validate([ // これだけでバリデーションできるLaravelすごい！
            'tweet' => ['required', 'string', 'max:280'], // 必須・文字であること・280文字まで（ツイッターに合わせた）というバリデーションをします（ビューでも軽く説明します。）
        ]);
        Tweet::create([ // tweetテーブルに入れるよーっていう合図
            'user_id' => Auth::user()->id, // Auth::user()は、現在ログインしている人（つまりツイートしたユーザー）
            'tweet' => $request->tweet, // ツイート内容
        ]);
        return back(); // リクエスト送ったページに戻る（つまり、/timelineにリダイレクトする）    
    }
    
}