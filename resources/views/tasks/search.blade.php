@extends('layouts.body')

@section('title', '糖質量check!')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>糖質量chech!</h2>
                <div>食品を入力してください (糖質量は100g中)</div>
                
            </div>
        </div>

        <form action="{{ action('TasksController@search') }}" method="get" name="form2">
            @if (isset($master['category']))
                <div class="row">
                    {!! 
                        Form::select(
                            'category', 
                            $master['category'], 
                            $selected['category'], 
                            [
                                'class' => 'form-control col-md-4', 
                                'placeholder' => '==分類==',
                                'onchange' => 'submit(this.form)',
                            ]) 
                    !!}
                </div>
            @endif
            <div class="row">
                @foreach ($master as $type => $value)
                    @if ($type !== 'category')
                            {!! Form::select($type, $value, $selected[$type], ['class' => 'form-control col-md-4', 'placeholder' => '===選択してね===']) !!}
                    @endif
                @endforeach
            </div>
            <div class="row">
                @if (isset($master['category']))
                {!! Form::submit('絞り込んで見る', ['class' => 'form-control col-md-4']) !!}
                @else
                {!! Form::submit('表示', ['class' => 'form-control']) !!}
                @endif
                {{ Form::reset('リセット', ['class' => 'btn btn-outline-success btn-lg']) }}
            </div>
        </form>
        <div class="row result">
            @if (isset($result['amount']))
                <div class="col-md-2 mt-2">
                    結果
                </div>
                <div class="col-md-4 mt-2">
                    {{ $result['amount'] }}
                </div>
            @endif
            
        </div>

    </div>
@endsection

