<?php

namespace App\Http\Controllers;

use App\Models\babyage_scope;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\prefecture;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ここでprefectureテーブルから全データを持ってくる　＄pref=全データを入れる
        // compactでpost.createに送る
        $prefs = prefecture::all();
        $ages = babyage_scope::all();
        return view('post.create', compact('prefs','ages'));
        // return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($_POST['yearmonth'],$request->yearmonth);
    //    dd($request->time);
        // dd($request->pref);
        // dd($request->pref,$request->babyage,$request->month,$request->year);

        $post=new Post();
        $inputs=request()->validate([
            // 'title'=>'required|max:255',
            // 'body'=>'required|max:255',
            'getup_time'=>'required',
            'breakfast'=>'required|max:255',
            'morning_time'=>'required|max:255',
            'lunch'=>'required|max:255',
            'after_time'=>'required|max:255',
            'dinner'=>'required|max:255',
            'sleep_time'=>'required',
            'image'=>'image|max:1024'

        ]);

        // $post->title=$request->title;
        //テーブルのカラム名にフォームタグで送信された値をいれる
        $post->body=$request->body;
        $post->user_id=auth()->user()->id;
        $post->getup_time=$request->getup_time;
        $post->breakfast=$request->breakfast;
        $post->morning_time=$request->morning_time;
        $post->lunch=$request->lunch;
        $post->after_time=$request->after_time;
        $post->dinner=$request->dinner;
        $post->sleep_time=$request->sleep_time;
        $post->prefecture_id=$request->prefecture_id;
        $post->babyage_scope_id=$request->babyage_scope_id;
        //2021-08の2021だけ返してくれた値を$post->yearにいれる
        $post->year=substr($request->yearmonth, 0, 4);
         //2021-08の08だけ返してくれた値を$post->yearにいれる
        $post->month=substr($request->yearmonth, 5, 2);
    
        
        if(request('image')){
            $path = Storage::disk('s3')->putFile('/test', $request->file('image'), 'public');
            // dd($path);
            $post->image = Storage::disk('s3')->url($path);
            // $original=request()->file('image')->getClientOriginalName();
            // $name=date('Ymd_His').'.'.$original;
            // request()->file('image')->move('storage/images', $name);
            // $post->image=$name;
        }

        $post->save();
        return redirect()->route('home')->with('message','投稿を作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user=auth()->user();
        $prefs=prefecture::all();
        $ages=babyage_scope::all();
        // dd($posts[0]->babyage_scope);
        return view('post.edit', compact('post','prefs','ages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {    
        $this->authorize('update', $post);

        $inputs=request()->validate([
            // 'body'=>'required|max:255',
            'getup_time'=>'required',
            'breakfast'=>'required|max:255',
            'morning_time'=>'required|max:255',
            'lunch'=>'required|max:255',
            'after_time'=>'required|max:255',
            'dinner'=>'required|max:255',
            'sleep_time'=>'required',
            'image'=>'image|max:1024'
        ]);

        
        if(request('image')){
            $path = Storage::disk('s3')->putFile('/test', $request->file('image'), 'public');
            // dd($path);
            $post->image = Storage::disk('s3')->url($path);
            // $name=request()->file('image')->getClientOriginalName();
            // request()->file('image')->move('storage/images', $name);
            // $post->image=$name;
        }
        
        $post->body=$request->body;
        $post->user_id=auth()->user()->id;
        $post->getup_time=$request->getup_time;
        $post->breakfast=$request->breakfast;
        $post->morning_time=$request->morning_time;
        $post->lunch=$request->lunch;
        $post->after_time=$request->after_time;
        $post->dinner=$request->dinner;
        $post->sleep_time=$request->sleep_time;
        $post->prefecture_id=$request->prefecture_id;
        $post->babyage_scope_id=$request->babyage_scope_id;
        //2021-08の2021だけ返してくれた値を$post->yearにいれる
        $post->year=substr($request->yearmonth, 0, 4);
         //2021-08の08だけ返してくれた値を$post->yearにいれる
        $post->month=substr($request->yearmonth, 5, 2);

        // $post->body=$inputs['body'];
        $post->save();
        return redirect()->route('home')->with('message', '投稿を編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('home')->with('message', '投稿を削除しました');
    }
}
