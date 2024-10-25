<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('app.categories.index', [
            'categories' => Category::withCount('tracks')->get(),
        ]);
    }

    public function show(Category $category): View
    {
        $category->loadCount('tracks');

        return view('app.categories.show', [
            'category' => $category,
            'tracks' => $category->tracks()->withCount('likes')->latest('likes_count')->simplePaginate(),
        ]);
    }
}
