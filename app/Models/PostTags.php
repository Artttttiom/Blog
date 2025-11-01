<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTags extends Model

{
    private $table = "articles_tag";
    private $fillable = [
        "name"
    ]; 

    public function article(){
        return $this->hasOne(Articles::class, "tag_id", "id");
    }
}