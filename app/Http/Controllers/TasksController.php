<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

// 追記
use App\Tasks;

class TasksController extends Controller
{
   // public function add()
   //{
     // return view('tasks.bbs');
   //}
  
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
    
    public function edit(Request $request)
   {
      // Varidationを行う
      $this->validate($request, Tasks::$rules);
      $tasks = new Tasks;
      $form = $request->all();
      
      // formに画像があれば、保存する
      if(isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $tasks->image_path = Storage::disk('s3')->url($path);
      } else {
          $tasks->image_path = null;
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      // データベースに保存する
      $tasks->fill($form);
      $tasks->save();

      return redirect('tasks/bbs');
  }  
}