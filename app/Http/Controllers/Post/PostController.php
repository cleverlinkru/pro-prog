<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\Message\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show(Request $request, Post $post)
    {
        return Inertia::render('Post/Show', [
            'post' => $post,
        ]);
    }

    public function create(Request $request)
    {
        $postCategoryId = $request->input('post-category');
        $postCategory = $postCategoryId ? PostCategory::findOrFail($postCategoryId) : null;
        return Inertia::render('Post/Create', [
            'postCategoryId' => $postCategory,
            'postCategories' => PostCategory::orderBy('title')->get(),
        ]);
    }

    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => $post,
            'postCategories' => PostCategory::orderBy('title')->get(),
        ]);
    }

    public function store(PostRequest $request)
    {
        Post::create(array_merge($request->validated(), [
            'text' => $request->text ?? '',
        ]));

        Message::show('Материал создан');

        if ($request->category_id) {
            return redirect()->route('postCategory.show', $request->category_id);
        } else {
            return redirect()->route('postCategory.index');
        }
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update(array_merge($request->validated(), [
            'text' => $request->text ?? '',
        ]));

        Message::success('Материал изменён');

        if ($request->category_id) {
            return redirect()->route('postCategory.show', $request->category_id);
        } else {
            return redirect()->route('postCategory.index');
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();

        Message::show('Материал удалён');

        return redirect()->route('postCategory.index');
    }
}
