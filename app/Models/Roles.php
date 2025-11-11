<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
class Roles extends Model
{
    private $table = "roles";

    private $fillable = [
        'name'
    ];

    public function user() {
        return $this->hasMany(Users::class, 'role_id');
    }
}
