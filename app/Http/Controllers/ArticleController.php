<?php

namespace App\Http\Controllers;

class ArticleController extends Controller {
    public function index(){
        $articles = Article::query()->with(["category"])->get();

        return $articles;
    }
}