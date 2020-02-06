@extends('layouts.front')

@section('title', 'オススメレシピ投稿サイト')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>オススメレシピ投稿サイト</h2>
                <form action="{{ action('TasksController@tweet') }}" method="post" enctype="multipart/form-data">
　　　　　　        
　　　　　　     {{ csrf_field() }}
                <div style="background-color: #E8F4FA; text-align: center;">
                    <input type="text" name="tweet" style="margin: 1rem; padding: 0 1rem; width: 70%; border-radius: 6px; border: 1px solid #ccc; height: 2.3rem;" placeholder="今どうしてる？">
                    <button type="submit" style="background-color: #2695E0; color: white; border-radius: 10px; padding: 0.5rem;">ツイート</button>
                </div>
                @if($errors->first('tweet')) <!-- 追加 -->
                    <p style="font-size: 0.7rem; color: red; padding: 0 2rem;">※{{$errors->first('tweet')}}</p>
                @endif
            </form>

            <div class="tweet-wrapper"> <!-- この辺追加 -->
                @foreach($tweets as $tweet)
                <div style="padding:2rem; border-top: solid 1px #E6ECF0; border-bottom: solid 1px #E6ECF0;">
                    <div>{{ $tweet->tweet }}</div>
                </div>
                @endforeach   
　　　　　　</div>
        </div>
    </div>
@endsection