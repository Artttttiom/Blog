<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserArticles extends Model
{
     private $table = "user_articles";
    private $guarded = false;

    public function user() {
        return $this->belongsTo(Users::class, 'user_id', 'id');

    }

    public function article() {
        return $this->belongsTo(Articles::class, 'article_id', 'id');
    }
}