<!-- 新規投稿画面 -->

@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">新規投稿</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @if(empty($errors->first('image')))
                    <li>画像ファイルがあれば、再度、選択してください。</li>
                    @endif
                </ul>
            </div>
            @endif
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="title">住んでいる地域</label>
                    <select name="prefecture_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <!-- ＄prefをforeachで回す -->
                        <!-- <option selected>/option> -->
                             <!-- 表示は北海道だけどDB(postsテーブル)には$pref['id']でid（文字を入れたくないから数字）をいれる -->
                        @foreach($prefs as $pref)
                        <option value="{{$pref['id']}}">{{$pref['name']}}</option>
                        @endforeach
                       
                     </select>
                     <label for="title">お子様の年齢</label>
                     <select name="babyage_scope_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                     @foreach($ages as $age)
                     <!-- 表示は０際０ヶ月だけどDB(postsテーブル)には$age['id']でid（文字を入れたくないから）をいれる -->
                        <option value="{{$age['id']}}">{{$age['age']}}</option>
                    @endforeach
                     </select>
                     <label for="title">いつの話</label>
                     <input type="month" name="yearmonth" min="1990-04" max="{{date('Y')}}-{{date('m')}}">
                     
                     <!-- <input type="text" name="year" class="form-control" id="title" value="" placeholder="西暦"> -->
                    
                    
                </div>
                <div>
                <label for="time">起床時間</label>
                <input type="time" name="getup_time">
                </div>

                <label for="title">朝食内容</label>
                <input type="text" name="breakfast" class="form-control" placeholder="ヨーグルト・シリアル・バナナ1本・ミルク">

                <label for="title">午前中の過ごし方</label>
                <input type="text" name="morning_time" class="form-control" placeholder="公園にいく">

                <label for="title">昼食内容</label>
                <input type="text" name="lunch" class="form-control" placeholder="カレーライス・オレンジ・ミルク">

                <label for="title">午後の過ごし方</label>
                <input type="text" name="after_time" class="form-control" placeholder="家でプール・買い物">

                <label for="title">夕食内容</label>
                <input type="text" name="dinner" class="form-control" placeholder="うどん・温野菜・ヨーグルト">

                <label for="time">就寝時間</label>
                <input type="time" name="sleep_time">
                </div>

                <!-- <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data"> -->
                <div class="form-group">
                    <label for="body">自由記入</label>
                    <textarea name="body" class="form-control" id="body" cols="10" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">画像（1MBまで）</label>
                    <div class="col-md-6">
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">送信する </button>
            </form>
        </div>
    </div>
</div>

@endsection