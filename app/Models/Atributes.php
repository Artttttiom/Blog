<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atributes extends Model
{
    private $table = "atributes";
    private $fillable = [
        "gender" 
    ]; 
    public function user(){
        return $this->belongsToMany(Users::class, 'users_articles', 'id');
    }
    

}