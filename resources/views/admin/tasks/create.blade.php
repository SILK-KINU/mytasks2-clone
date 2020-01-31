{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'糖質制限中オススメレシピ'を埋め込む --}}
@section('title', '糖質制限中オススメレシピ新規作成')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>糖質制限中オススメレシピ</h2>
                <form action="{{ action('Admin\TasksController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">レシピ名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="recipename" value="{{ old('recipename') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">糖質量</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">主な材料</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="mainmaterial" value="{{ old('mainmaterial') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">作り方</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="howtocook" rows="10">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
