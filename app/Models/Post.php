<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // DBに保存を許可する
    use HasFactory;
    protected $fillable = [
        // 'title',
        'body',
        'user_id',
        'image',

    ];


    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
    public function prefecture() {
        return $this->belongsTo('App\Models\prefecture');
    }

    public function babyage_scope() {
        return $this->belongsTo('App\Models\babyage_scope');
    }


}
