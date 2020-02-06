@extends('layouts.front')

@section('title', 'オススメレシピ掲示板')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>オススメレシピ掲示板</h2>
                <form action="{{ action('TasksController@messageboard') }}" method="post" enctype="multipart/form-data">
　　　　　　</div>
        </div>
    </div>
@endsection