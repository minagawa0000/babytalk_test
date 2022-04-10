@extends('layouts.app')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        @if($post->user)
            @if($post->user->avatar === "user_default.jpg")
                <img src="{{asset('/img/user_default.jpg')}}"class="rounded-circle" style="width:40px;height:40px;">
            @else                            
                    <img src="{{$post->user->avatar}}"class="rounded-circle" style="width:40px;height:40px;">
            @endif
        @else
            <img src="{{asset('/img/user_default.jpg')}}"class="rounded-circle" style="width:40px;height:40px;">
        @endif
        <div class="text-muted small mr-3"> 
            {{$post->user->name??'削除されたユーザ'}}
            <div class="text-muted small"> 
                    地域： {{$post->prefecture->name}}
                    子供の年齢： {{$post->babyage_scope->age}}
                    いつの話：{{$post->year}}年
                    {{$post->month}}月
                </div>
        </div>
        <h4>{{$post->title}}</h4>
        @can('update', $post)
        <span class="ml-auto">
        <a href="{{route('post.edit', $post)}}"><button class="btn btn-primary">編集</button></a>
        </span>
        @endcan
        @can('delete', $post)
        <span class="ml-2">
          <form method="post" action="{{route('post.destroy', $post)}}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
          </form>
        </span>
        @endcan
    </div>
    <div class="card-body">
        <p class="card-text">
            <h5>{{"起床時間：".substr((string)$post->getup_time,0,5)}}</h5>
            <h5>{{"朝食内容：".$post->breakfast}}</h5>
            <h5>{{"午前の過ごし方：".$post->morning_time}}</h5>
            <h5>{{"昼食内容：".$post->lunch}}</h5>
            <h5>{{"午後の過ごし方：".$post->after_time}}</h5>
            <h5>{{"夕食内容：".$post->dinner}}</h5>
            <h5>{{"就寝時間：".substr((string)$post->sleep_time,0,5)}}</h5>
            </br>
            <h5>{{"一言：".$post->body}}</h5>
        </p>
        @if ($post->image)
        <img src="{{$post->image}}" class="img-fluid mx-auto d-block" style="width:300px;">    
        @endif
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$post->created_at->format('Y/m/d H:i:s')}}
        </span>
    </div>
</div>

<hr>
@if ($post->comments)
@foreach ($post->comments as $comment)
<div class="card mb-4">
    
    <div class="card-header">
    @if($comment->user->avatar === "user_default.jpg")
            <img src="{{asset('/img/user_default.jpg')}}"class="rounded-circle" style="width:40px;height:40px;">
        @else                            
                <img src="{{$comment->user->avatar}}"class="rounded-circle" style="width:40px;height:40px;">
        @endif
        <div class="text-muted small mr-3"> 
            {{$comment->user->name??'削除されたユーザ'}} 
        </div>
    </div>
    <div class="card-body">
        {{$comment->body}}
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$comment->created_at->diffForHumans()}}
        </span>
    </div>
</div>
@endforeach
@endif

<!-- {-- バリデーションエラー表示 --}} -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- {{-- コメント投稿用フォーム --}} -->
<div class="card mb-4">
    <form method="post" action="{{route('comment.store')}}">
        @csrf
        <input type="hidden" name='post_id' value="{{$post->id}}">
        <div class="form-group">
            <textarea name="body" class="form-control" id="body" cols="30" rows="5" 
            placeholder="コメントを入力する">{{old('body')}}</textarea>
        </div>
        <div class="form-group">
        <button class="btn btn-success float-right mb-3 mr-3">コメントする</button>
        </div>
    </form>
</div>  

@endsection