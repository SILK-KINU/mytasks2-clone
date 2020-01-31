@extends('layouts.admin')
@section('title', '糖質制限中オススメメニューの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>糖質制限中オススメレシピの編集</h2>
                <form action="{{ action('Admin\TasksController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="recipename">レシピ名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="recipename" value="{{ $tasks_form->recipename }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="amount">糖質量</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="amount" value="{{ $tasks_form->amount }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="mainmaterial">主な材料</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="mainmaterial" value="{{ $tasks_form->mainmaterial }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="howtocook">作り方</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="howtocook" rows="10">{{ $tasks_form->howtocook }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $tasks_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $tasks_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($tasks_form->histories!= NULL)
                                @foreach ($tasks_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection