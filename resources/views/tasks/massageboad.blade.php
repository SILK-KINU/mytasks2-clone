@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>お知らせ</h2>
                <form action="{{ action('Admin\TasksController@create') }}" method="post" enctype="multipart/form-data">
　　　　　　</div>
        </div>
    </div>
@endsection