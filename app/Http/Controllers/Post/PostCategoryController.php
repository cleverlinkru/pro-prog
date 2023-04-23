<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCategoryRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\Message\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostCategoryController extends Controller
{
    public function index(Request $request)
    {
        $postCategories = PostCategory
            ::whereNull('category_id')
            ->orderBy('title')
            ->get();

        $posts = Post
            ::whereNull('category_id')
            ->orderBy('title')
            ->get();

        return Inertia::render('PostCategory/Index', [
            'postCategories' => $postCategories,
            'postCategory' => null,
            'posts' => $posts,
        ]);
    }

    public function show(Request $request, PostCategory $postCategory)
    {
        $postCategories = PostCategory
            ::where('category_id', $postCategory->id)
            ->orderBy('title')
            ->get();

        $posts = Post
            ::where('category_id', $postCategory->id)
            ->orderBy('title')
            ->get();

        return Inertia::render('PostCategory/Index', [
            'postCategories' => $postCategories,
            'postCategory' => $postCategory,
            'posts' => $posts,
        ]);
    }

    public function create(Request $request)
    {
        $parentPostCategoryId = $request->input('parent-post-category');
        $parentPostCategory = $parentPostCategoryId ? PostCategory::findOrFail($parentPostCategoryId) : null;
        return Inertia::render('PostCategory/Create', [
            'parentPostCategory' => $parentPostCategory,
            'postCategories' => PostCategory::orderBy('title')->get(),
        ]);
    }

    public function edit(PostCategory $postCategory)
    {
        return Inertia::render('PostCategory/Edit', [
            'postCategory' => $postCategory,
            'postCategories' => PostCategory::whereNot('id', $postCategory->id)->orderBy('title')->get(),
        ]);
    }

    public function store(PostCategoryRequest $request)
    {
        PostCategory::create($request->validated());

        Message::show('Категория материала создана');

        if ($request->category_id) {
            return redirect()->route('postCategory.show', $request->category_id);
        } else {
            return redirect()->route('postCategory.index');
        }
    }

    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        if ($request->category_id == $postCategory->id) {
            Message::error('Неверные данные!');
            return redirect()->route('postCategory.edit', $postCategory->id);
        }

        $postCategory->update($request->validated());

        Message::success('Категория материала изменена');

        if ($request->category_id) {
            return redirect()->route('postCategory.show', $request->category_id);
        } else {
            return redirect()->route('postCategory.index');
        }
    }

    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();

        Message::show('Категория материала удалена');

        return redirect()->route('postCategory.index');
    }
}
