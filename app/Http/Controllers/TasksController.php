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

    public function search(Request $request)
    {
        $master = Master::all()->sortByDesc('type.sort_no');

        $category = $request->input('category') ?: null;
        // 選択されたもの
        $selected = [
            'category' => $category,
        ];
        // 返却値の初期化
        $master_arr = [];
        
        // 検索結果の初期化
        $result = [];
        
        foreach($master as $value) {

            if ($category) {
                // 絞り込みの場合
                if ($value->type === 'material_' . $category || $value->type === 'category') {
                    // 一致したものだけとカテゴリーをセットする
                    $master_arr[$value->type][$value->code] = $value->value;
                
                    if ($request->input($value->type) === $value->code) {
                        $result = json_decode(json_encode($value), true);
                    }
                }
            } else {
                // 絞り込みではない場合は全て
                $master_arr[$value->type][$value->code] = $value->value;
            }

            // 選択された材料をセットする
            // セットされてないときにセットする
            if (!isset($selected[$value->type])) {
                $selected[$value->type] = $request->input($value->type) ?: null;
            }
            
        }

        // セットした内容の確認
        // \Log::debug(print_r($result, true));

        $arr = [
            'master' => $master_arr,
            'selected' => $selected,
            'result' => $result,
        ];
        return view('tasks.search', $arr);
      
    }
    
    public function recommend()
    {
        return view('tasks.recommend');
    }
    
    
    
}