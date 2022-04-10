@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">編集</h1>
            <!-- <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
                @csrf
                @method('put') -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @if(empty($errors->first('image')))
                    <li>画像ファイルがあれば、再度選択してください。</li>
                    @endif
                </ul>
            </div>
            @endif

            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif

            <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                 <!-- ここから -->
                 <div class="form-group">
                <label for="title">住んでいる地域</label>
                    <select name="prefecture_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <!-- ＄prefをforeachで回す -->
                        <!-- <option selected>/option> -->
                             <!-- 表示は北海道だけどDB(postsテーブル)には$pref['id']でid（文字を入れたくないから数字）をいれる -->
                        @foreach($prefs as $pref)
                    　　    @if(old('prefecture_id', $post->prefecture_id) === $pref['id'])
                                <option value="{{$pref['id']}}" selected>{{$pref['name']}}</option>
                            @else
                                <option value="{{$pref['id']}}">{{$pref['name']}}</option>
                            @endif
                        @endforeach
                       
                     </select>
                     <label for="title">お子様の年齢</label>
                     <select name="babyage_scope_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                     
                     @foreach($ages as $age)
                     <!-- 表示は０際０ヶ月だけどDB(postsテーブル)には$age['id']でid（文字を入れたくないから）をいれる -->
                        @if(old('babyage_scope_id', $post->babyage_scope_id) === $age['id'])
                            <option value="{{$age['id']}}" selected>{{$age['age']}}</option>
                        @else
                            <option value="{{$age['id']}}">{{$age['age']}}</option>
                        @endif
                       
                    @endforeach
                     </select>
                     <label for="title">いつの話</label>
                     <input type="month" name="yearmonth" min="1990-04" max="{{date('Y')}}-{{date('m')}}" value="{{old('year',$post->year)."-".old('month',$post->month)}}">
                     
                     <!-- <input type="text" name="year" class="form-control" id="title" value="" placeholder="西暦"> -->
                    
                    
                </div>
                <div>
                <label for="time">起床時間</label>
                <input type="time" name="getup_time" value="{{old('getup_time', $post->getup_time)}}">
                </div>

                <label for="title">朝食内容</label>
                <input type="text" name="breakfast" class="form-control" value="{{old('breakfast', $post->breakfast)}}">

                <label for="title">午前中の過ごし方</label>
                <input type="text" name="morning_time" class="form-control" value="{{old('morning_time', $post->morning_time)}}">

                <label for="title">昼食内容</label>
                <input type="text" name="lunch" class="form-control" value="{{old('luncht', $post->lunch)}}">

                <label for="title">午後の過ごし方</label>
                <input type="text" name="after_time" class="form-control" value="{{old('after_time', $post->after_time)}}">

                <label for="title">夕食内容</label>
                <input type="text" name="dinner" class="form-control" value="{{old('dinner', $post->dinner)}}">

                <label for="time">就寝時間</label>
                <input type="time" name="sleep_time" value="{{old('sleep_time', $post->sleep_time)}}">
                </div>

                <!-- <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data"> -->
                <div class="form-group">
                    <label for="body">自由記入</label>
                    <textarea name="body" class="form-control" id="body" cols="10" rows="3">{{old('body', $post->body)}}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">画像（1MBまで）</label>
                    <div class="col-md-6">
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <!-- ここまで -->
                <button type="submit" class="btn btn-success">送信</button>
            </form>
            
        </div>
    </div>
</div>
    
@endsection