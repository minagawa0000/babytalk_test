<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\prefecture;
use App\Models\babyage_scope;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

          
        if(isset($_GET['pref'],$_GET['babyage'],$_GET['year'],$_GET['month'])){
            //   dd($_GET['pref']);
            //都道府県・子供の年齢・年を選択・月を選択が全部選択されていない場合
            if(empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && empty($_GET['month'][0])){
                $posts=Post::orderBy('created_at','desc')->get();
            }

            //都道府県（都道府県を選ぶは含まない）・子供の年齢（子供の年齢を選ぶは含まない）・年を選択・月を選択が全部選択されている
            if(!empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->whereIn('babyage_scope_id',$_GET['babyage'])->whereIn('year',$_GET['year'])->whereIn('month',$_GET['month'])->get();
            }

            //都道府県（都道府県を選ぶは含まない）のみ選択されている
            if(!empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && empty($_GET['month'][0])){
                // dd($_GET['pref']);
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->get();
            }

            //子供の年齢（子供の年齢を選ぶは含まない）のみ選択されている
            if(empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && empty($_GET['month'][0])){
                $posts=Post::whereIn('babyage_scope_id',$_GET['babyage'])->get();
            }

            //年を選択のみ選択されている
              if(empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && empty($_GET['month'][0])){
                $posts=Post::whereIn('year',$_GET['year'])->get();
            }

            //月を選択のみ選択されている
              if(empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('month',$_GET['month'])->get();
            }

            //都道府県以外選択されている
            if(empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('babyage_scope_id',$_GET['babyage'])->whereIn('year',$_GET['year'])->whereIn('month',$_GET['month'])->get();
            }

            //子供の年齢以外選択されている
            if(!empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->whereIn('year',$_GET['year'])->whereIn('month',$_GET['month'])->get();
            }

            //年の選択以外選択されている
            if(!empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->whereIn('babyage_scope_id',$_GET['babyage'])->whereIn('month',$_GET['month'])->get();
            }

             //月の選択以外選択されている
             if(!empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && empty($_GET['month'][0])){
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->whereIn('babyage_scope_id',$_GET['babyage'])->where('year',$_GET['year'])->get();
            }

             //都道府県・子供の年齢のみ選択されている
             if(!empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && empty($_GET['month'][0])){
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->whereIn('babyage_scope_id',$_GET['babyage'])->get();
            }

              //都道府県・年の選択のみ選択されている
              if(!empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && empty($_GET['month'][0])){
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->whereIn('year',$_GET['year'])->get();
            }

              //都道府県・月の選択のみ選択されている
              if(!empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('prefecture_id',$_GET['pref'])->whereIn('month',$_GET['month'])->get();
            }

            //年・月を選択のみ選択されている
            if(empty($_GET['pref'][0]) && empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('year',$_GET['year'])->whereIn('month',$_GET['month'])->get();
            }

             //子供の年齢・年を選択のみ選択されている
             if(empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && !empty($_GET['year'][0]) && empty($_GET['month'][0])){
                $posts=Post::whereIn('babyage_scope_id',$_GET['babyage'])->whereIn('year',$_GET['year'])->get();
            }

             //子供の年齢・月を選択のみ選択されている
             if(empty($_GET['pref'][0]) && !empty($_GET['babyage'][0]) && empty($_GET['year'][0]) && !empty($_GET['month'][0])){
                $posts=Post::whereIn('babyage_scope_id',$_GET['babyage'])->whereIn('month',$_GET['month'])->get();
            }

        }else{
            // ログイン後できた分岐$_GETには何も入ってない
            $posts=Post::orderBy('created_at','desc')->get();
        }
    
        
        // if(isset($_GET['pref'],$_GET['babyage'])){
        //     $posts=Post::where('prefecture_id',$_GET['pref'])->where('babyage',$_GET['babyage'])->get();
        // }else{
        //     // ログイン後できた分岐$_GETには何も入ってない
        //     $posts=Post::orderBy('created_at','desc')->get();
        // }



        $user=auth()->user();
        // $test=array_column(Post::groupBy('prefecture_id')->get('prefecture_id')->toArray(),'prefecture_id');   
        //  $nihon = [['player' => 'honda','height' => 180],['player' => 'kagawa','height' => 170]];   
        //  $temp = [];
        //  foreach ($nihon as $value){
        //   array_push($temp,$value['height']);
        //  }
        // dd(array_column($nihon,'player'));
        
        // $testtest = array(1,2);
        
        // dd(Post::groupBy('prefecture_id')->get('prefecture_id')->toArray());
    //   dd($test);
         $test = Post::groupBy('prefecture_id')->get('prefecture_id')->toArray();        
         $temparray = [];
       foreach ($test as $value){
          array_push($temparray,$value['prefecture_id']);
      }
    //   array_column(Post::groupBy('prefecture_id')->get('prefecture_id')->toArray(),'prefecture_id')と$temparrayは同じ
      
         $prefs=prefecture::whereIn('id',$temparray)->get();

        // $prefs = prefecture::all();
        //  dd($prefs);
        $babyid=Post::groupBy('babyage_scope_id')->get('babyage_scope_id')->toArray();
        $temparray = [];
        foreach ($babyid as $value){
            array_push($temparray,$value['babyage_scope_id']);
        }
        $ages=babyage_scope::whereIn('id',$temparray)->get();
        
        $postedyear=Post::groupBy('year')->get('year')->toArray();
        $temparray = [];
        foreach ($postedyear as $value){
            array_push($temparray,$value['year']);
        }
        $years=$temparray;

        $postedmonth=Post::groupBy('month')->get('month')->toArray();
        $temparray = [];
        foreach ($postedmonth as $value){
            array_push($temparray,$value['month']);
        }
        $months=$temparray;



        return view('home', compact('posts', 'user','prefs','ages','years','months'));
        
    }

    public function mypost() {
        $user=auth()->user()->id;
        $posts=Post::where('user_id', $user)->get();
        return view('mypost', compact('posts'));
    }

    public function mycomment() {
        $user=auth()->user()->id;
        $comments=Comment::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('mycomment', compact('comments'));
    }

}
