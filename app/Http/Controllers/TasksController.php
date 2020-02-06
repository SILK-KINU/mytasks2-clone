<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use \App\Tweet;

// 追記
use App\Tasks;

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
        return view('tasks.tweet');
    }
    
    public function postTweet(Request $request)
    {
        
    }
    
}