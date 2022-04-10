@extends('layouts.app')
@section('content')

<h1 class="mt4">ユーザー一覧</h1>

<table class="table" style="background-color:white;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">ニックネーム</th>
            <th scope="col">メールアドレス</th>
            <th scope="col">avatar</th>
            <th scope="col">編集</th>
            <th scope="col">削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user) 
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <!-- {{-- アバター表示 --}} -->
        <td>
        @if($user->avatar === "user_default.jpg")
            <img src="{{asset('/img/user_default.jpg')}}"class="rounded-circle" style="width:40px;height:40px;">
        @else                            
            <img src="{{$user->avatar}}"class="rounded-circle" style="width:40px;height:40px;">
        @endif
            <!-- class="rounded-circle" style="width:40px;height:40px;"> -->
        </td>
        <!-- {{-- 編集ボタン --}} -->
        <td>
            <a href="{{route('profile.edit', $user->id)}}">
                <button class="btn btn-primary">
                    編集
                </button>
            </a>
        </td>
        <!-- {{-- 削除ボタン --}} -->
        <td>
            <form method="post" action="{{route('profile.delete', $user)}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">
                    削除
                </button>
            </form>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection