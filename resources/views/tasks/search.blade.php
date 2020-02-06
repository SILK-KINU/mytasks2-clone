@extends('layouts.front')

@section('title', 'お知らせ')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>お知らせ</h2>
            </div>
　　　　　　<div class="form-group row">
             　　<div class="col-md-8 mx-auto">           
                   <ul>
                    $personal_name = $_post['personal_name'];
                    $contents = $_post["contents'];
                    $contents = n12br($contents);
                    
                    print('<p>投稿者:'.$personal_name.'</p>');
                    print('<p>内容:</p>');
                    print('<p>'.$contents.'</p>');
                   </ul>
      　　　　　　　　</div>
            </div>　　　　
        </div>
    </div>
@endsection