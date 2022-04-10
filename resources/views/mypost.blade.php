@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

<div class="ml-2 mb-3">
   あなたの投稿
</div>

@if (count($posts) == 0)
<p>
あなたはまだ投稿していません。
</p>
@else
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
                        <div class="media-body ml-3"><a href="{{route('post.show', $post)}}">{{$post->title}}</a> 
                            <div class="text-muted small"> 
                                {{$post->user->name??'削除されたユーザ'}}
                                <div class="text-muted small"> 
                                    地域： {{$post->prefecture->name}}
                                    子供の年齢： {{$post->babyage_scope->age}}
                                    いつの話：{{$post->year}}年
                                    {{$post->month}}月
                                </div>
                            </div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>投稿日</div>
                            <div><strong>{{$post->created_at->diffForHumans()}}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <a href="{{route('post.show', $post)}}">
                        {{ Str::limit ("起床時間:".substr((string)$post->getup_time,0,5)."  "."朝食内容:".$post->breakfast."  "."午前の過ごし方:".$post->morning_time."  "."昼食内容:".$post->lunch."  "."午後の過ごし方:".$post->after_time."夕食内容:".$post->dinner."就寝時間:".substr((string)$post->sleep_time,0,5).$post->body, 100, ' ...詳細はこちら') }}
                </a>
                    @if($post->image)
                    <img src="{{$post->image}}" class="img-fluid mx-auto d-block" style="width:200px;">
                    @endif
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3">
                        @if ($post->comments->count())
                        <span class="badge badge-success">
                            コメント {{$post->comments->count()}}件
                        </span>
                    @else
                        <span>コメントはありません。</span>
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
@endif
@endsection