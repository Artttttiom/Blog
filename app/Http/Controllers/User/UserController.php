<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
class UserController extends Controller
{
    public function user() {
        return response()->json(Users::get(), 200);
    }
}
