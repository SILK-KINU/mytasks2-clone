<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tasks;
use App\History;

use Storage;
use Carbon\Carbon;

class TasksController extends Controller
{
  public function add()
  {
      return view('admin.tasks.create');
  }
  public function create(Request $request)
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

      return redirect('admin/tasks/create');
  }  
  
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Tasks::where('recipename', 'LIKE','%'. $cond_title.'%')
            ->orWhere('mainmaterial', 'LIKE','%'. $cond_title.'%')
            ->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Tasks::all();
      }
      return view('admin.tasks.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request)
  {
      // Tasks Modelからデータを取得する
      $tasks = Tasks::find($request->id);
      if (empty($tasks)) {
        abort(404);    
      }
      return view('admin.tasks.edit', ['tasks_form' => $tasks]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Tasks::$rules);
      // Tasks Modelからデータを取得する
      $tasks = Tasks::find($request->id);
      // 送信されてきたフォームデータを格納する
      $tasks_form = $request->all();
      
      if ($request->remove == 'true') {
            $tasks_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = Storage::disk('s3')->putFile('/',$tasks_form['image'],'public');
            $tasks->image_path = Storage::disk('s3')->url($path);
        } else {
            $tasks_form['image_path'] = $tasks->image_path;
        }
        
        unset($tasks_form['_token']);
        unset($tasks_form['image']);
        unset($tasks_form['remove']);
        $tasks->fill($tasks_form)->save();
      
        $history = new History;
        $history->tasks_id = $tasks->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/tasks/');
  }
  
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $tasks = Tasks::find($request->id);
      // 削除する
      $tasks->delete();
      return redirect('admin/tasks/');
  }  
    
}
