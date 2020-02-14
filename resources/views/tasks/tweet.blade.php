@extends('layouts.tweetbody')

@section('title', 'オススメレシピ投稿サイト')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>オススメレシピ投稿サイト</h2>
                <h3>投稿してください</h3>
                <form action="{{ action('TasksController@tweet') }}" method="post" enctype="multipart/form-data">
　　　　　　        
　　　　　　     {{ csrf_field() }}
                <input type="text" name="tweet" placeholder="みんなのオススメレシピ教えて？？">
                <button type="submit">ツイート</button>
                
                @if($errors->first('tweet')) 
                    {{$errors->first('tweet')}}
                @endif
            </div>

            <div class="list-group">
                <ul>
                    @foreach($tweets as $tweet)
                        <li>{{ $tweet->tweet }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
