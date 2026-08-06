<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
class ArticleController extends Controller
{
    // Get all articles
    public function index()
    {
        $articles = Article::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Articles fetched successfully',
            'data' => $articles
        ], 200);
    }


    // Create article
    public function store(Request $request)
{
    $request->validate([
        'title'   => 'required|max:255',
        'content' => 'required',
        'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);


    $article = new Article();

    $article->title = $request->title;
    $article->content = $request->input('content');

    // Automatically get logged-in user
    $article->user_id = $request->user()->id;

    $article->slug = Str::slug($request->title);


    if ($request->hasFile('image')) {

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(
            public_path('images'),
            $imageName
        );

        $article->image = $imageName;
    }


    $article->save();


    return response()->json([
        'success' => true,
        'message' => 'Article created successfully',
        'data' => $article
    ], 201);
}


    // Get single article
    public function show(int $id)
    {
        $article = Article::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Article fetched successfully',
            'data' => $article
        ], 200);
    }


    // Update article
    public function update(Request $request, int $id)
    {
        $article = Article::findOrFail($id);

        Gate::authorize('update', $article);
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $article->title = $request->title;
        $article->content = $request->input('content');
        
        $article->slug = Str::slug($request->title);


        if ($request->hasFile('image')) {


            if ($article->image && file_exists(public_path('images/'.$article->image))) {

                unlink(public_path('images/'.$article->image));

            }


            $imageName = time() . '.' . $request->image->extension();


            $request->image->move(
                public_path('images'),
                $imageName
            );


            $article->image = $imageName;
        }


        $article->save();


        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => $article
        ], 200);
    }


    // Delete article
    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);
        Gate::authorize('delete', $article);

        if ($article->image && file_exists(public_path('images/'.$article->image))) {

            unlink(public_path('images/'.$article->image));

        }


        $article->delete();


        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully'
        ], 200);
    }
}