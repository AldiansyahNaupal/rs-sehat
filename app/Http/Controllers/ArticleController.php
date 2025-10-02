<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()->latest()->paginate(9);
        $featuredArticles = Article::published()->latest()->take(3)->get();
        
        return view('articles.index', compact('articles', 'featuredArticles'));
    }

    public function show(Article $article)
    {
        // Hanya tampilkan artikel yang sudah dipublish
        if (!$article->is_published || $article->published_at > now()) {
            abort(404);
        }
        
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
