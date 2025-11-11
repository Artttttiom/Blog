<?php

namespace App\Http\Controllers\Article;

use App\Models\Articles;
use App\Models\CountryModel;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class ArticleController
{
    const DEFAULT_PER_PAGE = 15;

    public function index(Request $request){

        $data = $request->validate([
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable','integer','min:1', 'max:100'],
        ]);
        
        $perPage = $data['per_page'] ?? self::DEFAULT_PER_PAGE;
        return response()->json(Articles::query()->paginate($perPage));
    }

    public function show($id) {
        $article = Articles::query()->findOrFail($id) ;


    return response()->json([
        'data' => $article,
        'status' => 'success'
    ],200);
    }

    public function store(Request $request) {
        $article = Articles::query()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $article,
            'message' => 'Article created successfuly'
        ],201);
    }

    public function update(Request $request, $id) {
        $article = Articles::query()->find($id);
        $article->query()->update($request->all());
        $article->save();

        if(!$article) {
            return response()->json([
                'message' => 'Article not faund'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfuly'
        ],200);
    }


    public function destroy($id){
        $article = Articles::query()->find($id);
        if(!$article) {
            return response()->json([
                'status' => 404,
                'message' => 'Article not faund'
            ],404);
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfuly'
        ], 200);
    }
}
