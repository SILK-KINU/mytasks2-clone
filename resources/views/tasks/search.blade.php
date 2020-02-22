@extends('layouts.body')

@section('title', '糖質量check!')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>糖質量chech!</h2>
                <li>食品を入力してください (糖質量は100g中)</li>
                <form action="{{ action('TasksController@search') }}" method="get" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-md-4　col-form-label text-md-right">種類</label>
                            <div class="col-md-6">
                                <select class= "form-control" name="categories">
                                    <option value="" selected>選択してください</option>
                                    <option value="meat">肉</option>
                                    <option value="seafood">魚</option>
                                    <option value="vegitable">野菜</option>
                                    <option value="dairy-product">卵&乳製品</option>
                                    <option value="bean">豆製品</option>
                                </select>
                                {{Form::select('categories', $master['category'])}}
                            </div> 
                        </label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4　col-form-label text-md-right">食品名</label>
                            <div class="col-md-6">
                                <select class= "form-control" name="meat">
                                    <option value="pork_loin">豚ロース</option>
                                    <option value="pork_ibs">豚バラ</option>
                                    <option value="beef_round">牛もも（赤身）</option>
                                    <option value="beef_minched">牛挽肉</option>
                                　　<option value="ram">ラムチョップ</option>
                                    <option value="chicken_leg">鶏もも</option>
                                    <option value="chicken_breast">鶏ムネ</option>
                                    <option value="becon">ベーコン</option>
                                </select>
                                <select class= "form-control" name="seafood">
                                    <option value="chub_mackerel">鯖</option>
                                    <option value="brevoort">秋刀魚</option>
                                    <option value="tuna">鮪</option>
                                    <option value="cod">鱈</option>
                                　　<option value="horse_mackerel">鯵</option>
                                    <option value="prawn">海老</option>
                                    <option value="squid">イカ</option>
                                    <option value="clam">アサリ</option>
                                </select>
                                <select class= "form-control" name=vegitable>
                                    <option value="soybean_sprout" selected>大豆もやし</option>
                                    <option value="bean_sprout" selected>緑豆もやし</option>
                                    <option value="broccoli" selected>ブロッコリー</option>
                                    <option value="spinach" selected>ホウレン草</option>
                                    <option value="komatsuna" selected>小松菜</option>
                                    <option value="lettuce" selected>レタス</option>
                                　　<option value="okura" selected>オクラ</option>
                                    <option value="shiitake" selected>しいたけ</option>
                                    <option value="eringi" selected>エリンギ</option>
                                    <option value="shimeji" selected>しめじ</option>
                                    <option value="naitake" selected>舞茸</option>
                                    <option value="avocado" selected>アボカド</option>
                                </select>
                                <select class= "form-control" name="dairy-product">
                                    <option value="egg">卵</option>
                                    <option value="cheese">カマンベールチース</option>
                                    <option value="cheese2">ピザ用チース</option>
                                    <option value="creame">生クリーム</option>
                                    <option value="butter">バター</option>
                                </select>
                                <select class="form-control" name="bean">
                                    <option value="toufu">木綿豆腐</option>
                                　　<option value="toufu2">絹ごし豆腐</option>
                                    <option value="natto">納豆</option>
                                    <option value="atsuage">厚揚げ</option>
                                    <option value="okara">おから</option>
                                    <option value="tounyu">豆乳</option>
                                </select>
                            </div>
                        </label>
                    <div class="form-check">
                        <label class="form-check-label">           
                            <input type="submit" value="検索">
                        </label>
                    </div>
                    @foreach($master as $value)
                        {{ $value->type }}
                    @endforeach
                </form>
            </div>
        </div>
    <hr color="#202f55">
    
    <hr color="#202f55">
    <u><a href="{{url('tasks/recommend')}}">低糖質の食品一覧</a></u>
    </div>
@endsection

