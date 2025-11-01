<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    private $table = "categories";
    private $fillable = [
        "name", 
        "description",
        "status"
    ]; 

    public function article(){
        return $this->hasOne(Articles::class, "category_id", "id");
    }
}
