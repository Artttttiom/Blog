<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    private $table = "users";
    private $fillable = [
        "id",
        "email", 
        "password",
        "is_active",
        "name",
        "patronymic"
    ]; 

    public function article(){
        return $this->hasOne(Articles::class, "category_id", "id");
    }
    public function articles() {
        return $this->belongsToMany(Articles::class, 'user_articles', 'user_id', 'article_id');
    }
}
