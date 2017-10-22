<?php

namespace Canvas\Http\Controllers\Backend;

use Session;
use Canvas\Models\Post;
use Canvas\Jobs\PostFormFields;
use Canvas\Http\Controllers\Controller;
use Canvas\Http\Requests\PostCreateRequest;
use Canvas\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = Post::all();

        return view('canvas::backend.post.index', compact('data'));
    }

    /**
     * Show the new post form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = $this->dispatch(new PostFormFields());

        return view('canvas::backend.post.create', $data);
    }

    /**
     * Store a newly created Post.
     *
     * @param PostCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
        $post->syncTags($request->get('tags', []));

        Session::set('_new-post', trans('canvas::messages.create_success', ['entity' => 'post']));

        return redirect()->route('canvas.admin.post.edit', $post->id);
    }

    /**
     * Show the post edit form.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->dispatch(new PostFormFields($id));

        return view('canvas::backend.post.edit', $data);
    }

    /**
     * Update the Post.
     *
     * @param PostUpdateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
        $post->syncTags($request->get('tags', []));

        Session::set('_update-post', trans('canvas::messages.update_success', ['entity' => 'Post']));

        return redirect()->route('canvas.admin.post.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();

        Session::set('_delete-post', trans('canvas::messages.delete_success', ['entity' => 'Post']));

        return redirect()->route('canvas.admin.post.index');
    }
}
