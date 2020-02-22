@extends('layouts.tweetbody')

@section('title', 'オススメレシピ投稿サイト')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>オススメレシピ投稿サイト</h2>
                <form action="{{ action('TasksController@tweet') }}" method="post" enctype="multipart/form-data">
　　　　　　
　　　　　        　{{ csrf_field() }}
　　　　　　        <div class="button">
　　　　　　           <input type="text" name="tweet" style="margin: 1rem; padding: 0 1rem; width: 70%; border-radius: 6px; border: 1px solid #ccc; height: 2.3rem;" placeholder="みんなのオススメレシピ教えて？？">
                        <button type="submit"class="btn btn-primary">ツイート</button>
                
                            @if($errors->first('tweet')) 
                            <p style>{{$errors->first('tweet')}}</p>
                            @endif
                    </div>

                    <div class="list-group">
                        <ul>
                            @foreach($tweets as $tweet)
                                <div style="padding:2rem; border-top: solid 1px #E6ECF0; border-bottom: solid 1px #E6ECF0;">
                                <div>{{ $tweet->tweet }}</div>
                                <hr color="#a9a9a9">
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
