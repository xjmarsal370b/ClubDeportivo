<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPostCategoryRequest;
use App\Http\Requests\StorePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Models\PostCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postCategories = PostCategory::all();

        return view('frontend.postCategories.index', compact('postCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.postCategories.create');
    }

    public function store(StorePostCategoryRequest $request)
    {
        $postCategory = PostCategory::create($request->all());

        return redirect()->route('frontend.post-categories.index');
    }

    public function edit(PostCategory $postCategory)
    {
        abort_if(Gate::denies('post_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.postCategories.edit', compact('postCategory'));
    }

    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        $postCategory->update($request->all());

        return redirect()->route('frontend.post-categories.index');
    }

    public function show(PostCategory $postCategory)
    {
        abort_if(Gate::denies('post_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postCategory->load('categoryPosts');

        return view('frontend.postCategories.show', compact('postCategory'));
    }

    public function destroy(PostCategory $postCategory)
    {
        abort_if(Gate::denies('post_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostCategoryRequest $request)
    {
        PostCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
