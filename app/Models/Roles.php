<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
class Roles extends Model
{
    private $table = "roles";

    private $fillable = [
        'name'
    ];

    public function users() {
        return $this->hasMany(Users::class, 'role_id','id');
    }
}
