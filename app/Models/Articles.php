<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    private $table = "articles";
    private $fillable = [
        'name',
        'text',
        'is_public',
        'category_id'
    ];
    public $timestamps = false;
    public function category(){
        return $this->belongsTo(Categorys::class, 'category_id', 'id');
    }

    public function user() {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(Users::class, 'users_articles', 'article_id', 'user_id' );
    }
    
}
