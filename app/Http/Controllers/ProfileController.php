<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index() {
        $users = User::all();
        return view('profile.index', compact('users'));
    }

    public function edit(User $user){
        $this->authorize('update', $user);
        return view('profile.edit', compact('user'));
    }

    public function update(User $user, Request $request){
        $this->authorize('update', $user);

        // バリデーション
        $inputs=request()->validate([
            'name'=>'required|max:255',
            'email'=>['required','email','max:255', Rule::unique('users')->ignore($user->id)],
            'avatar'=>'image|max:1024',
            'password'=>'required|confirmed|max:255|min:8',
            'password_confirmation'=>'required|same:password'
        ]);

        // アバターの保存
        if(request('avatar')){
                $path = Storage::disk('s3')->putFile('/test', $request->file('avatar'), 'public');
                
                $inputs['avatar'] = Storage::disk('s3')->url($path);
                
            
        }

        // データベースに保存    
        $inputs['password'] = Hash::make($inputs['password']);
        $user->update($inputs);

        return back()->with('message', '情報を更新しました');
    }

    public function delete(User $user, Request $request) { 
        if($user->avatar !== 'user_default.jpg') {
        Storage::delete('public/avatar/'.$user->avatar);
        }
        $user->delete();
        return back()->with('message', 'ユーザーを削除しました');

    }
}
