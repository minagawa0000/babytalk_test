<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prefecture extends Model
{
    use HasFactory;

    // リレーションの設定
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
}
