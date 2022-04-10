@extends('layouts.app')
@section('content')

{{-- メッセージ表示 --}}
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

{{$user->name}}さん

<form method="get" action="" enctype="multipart/form-data">
    <label for="title">住んでいる地域：</label>
        <select name="pref[]" class="form-select form-select-sm" aria-label=".form-select-sm example"　size="4" multiple>
            <option value="" selected>全て選択</option>
            <!-- ＄prefをforeachで回す -->
            @foreach($prefs as $pref)
            <option value="{{$pref['id']}}">{{$pref['name']}}</option>
            @endforeach
        </select>

    <label for="title">お子様の年齢：</label>
        <select name="babyage[]" class="form-select form-select-sm" aria-label=".form-select-sm example" size="4" multiple>
            <option value="" selected>全て選択</option>
            @foreach($ages as $age)
            <!-- 表示は０際０ヶ月だけどDB(postsテーブル)には$age['id']でid（文字を入れたくないから）をいれる -->
            <option value="{{$age['id']}}">{{$age['age']}}</option>
            @endforeach
        </select>

    <label for="title">いつの話：</label>
        <select name="year[]" id="multiple" class="multiple" multiple="multiple">
            <option value="" selected>全て選択</option>
            @foreach($years as $year)
            <option value="{{$year}}">{{$year}}</option>
            @endforeach
        </select>

        <select name="month[]"　size="4" multiple>
        <option value="" selected>全て選択</option>
            @foreach($months as $month)
            <option value="{{$month}}">{{(int)$month}}月</option>
            @endforeach
        </select>

    <button type="submit" class="btn btn-success">検索</button>
</form>


@foreach ($posts as $post)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        @if($post->user)
                            @if($post->user->avatar === "user_default.jpg")
                                <img src="{{asset('/img/user_default.jpg')}}"class="rounded-circle" style="width:40px;height:40px;">
                            @else                            
                                <img src="{{$post->user->avatar}}"class="rounded-circle" style="width:40px;height:40px;">
                            @endif 
                        @else
                        <img src="{{asset('/img/user_default.jpg')}}"class="rounded-circle" style="width:40px;height:40px;">
                        @endif     
                        <div class="media-body ml-3">
                       {{$post->user->name??'削除されたユーザ'}}
                            <div class="text-muted small"> 
                            地域： {{$post->prefecture->name}}
                            子供の年齢： {{$post->babyage_scope->age}}
                            いつの話：{{$post->year}}年
                            {{$post->month}}月
                            </div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <div><strong>{{$post->created_at->diffForHumans()}}</strong> </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- 地域など表示したい -->
                    <a href="{{route('post.show', $post)}}">
                    {{ Str::limit ("起床時間:".substr((string)$post->getup_time,0,5)."  "."朝食内容:".$post->breakfast."  "."午前の過ごし方:".$post->morning_time."  "."昼食内容:".$post->lunch."  "."午後の過ごし方:".$post->after_time."夕食内容:".$post->dinner."就寝時間:".substr((string)$post->sleep_time,0,5).$post->body, 100, ' ...詳細はこちら') }}
                    </a>
                    @if($post->image)
                    <!-- imageカラムにアマゾンのリンクが入っていたら、リンクを参照して表示する -->
                    <img src="{{$post->image}}" class="img-fluid mx-auto d-block" style="width:200px;">
                    @endif
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3">
                        @if ($post->comments->count())
                        <span class="badge badge-success">
                            コメント{{$post->comments->count()}}件
                        </span>
                    @else
                        <span>コメントはまだありません。</span>
                    @endif
                    </div>
                    <div class="px-4 pt-3"> 
                       <button type="button" class="btn btn-primary">
                          <a href="{{route('post.show', $post)}}" style="color:white;">コメントする</a>
                      </button> </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection