<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function store(Request $request) {

        $inputs=request()->validate([
            'body'=>'required|max:255',
        ]);

        $comment=Comment::create([
            'body'=>$inputs['body'],
            'user_id'=>auth()->user()->id,
            'post_id'=>$request->post_id
        ]);

        return back();
    }






}
