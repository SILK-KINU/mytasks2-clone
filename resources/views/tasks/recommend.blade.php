@extends('layouts.front')

@section('title', '低糖質食品一覧')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>低糖質食品一覧</h2>
                <form action="{{ action('TasksController@recommend') }}" method="post" enctype="multipart/form-data">
　　　　　　</div>
        </div>
    </div>
    <ul>もやし</ul>
    <ul></ul>
    <ul></ul>
@endsection

