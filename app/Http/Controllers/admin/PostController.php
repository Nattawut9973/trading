<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $post = Post::where('title', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('title_image', 'LIKE', "%$keyword%")
                ->orWhere('content_image', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $post = Post::latest()->paginate($perPage);
        }
        $page = (int)\request('page') ?: 1;
        return view('admin.post.index', compact('post', 'page', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $request_title = $request->input('title');
        $request_content = $request->input('content');
        $request_description = $request->input('description');
        $title_img = $request->file('title_image')->store('public/uploads/posts/title');
        $content_img = $request->file('content_image')->store('public/uploads/posts/content');

//        if ($title_img == null || $content_img == null) {
//            if ($title_img == null) {
//                Post::create([
//                    'title' => $request_title,
//                    'content' => $request_content,
//                    'title_image' => null,
//                    'content_image' => $content_img,
//                    'description' => $request_description
//                ]);
//                return redirect('admin/post')->with('success', 'create success');
//            }
//            if ($content_img == null) {
//                Post::create([
//                    'title' => $request_title,
//                    'content' => $request_content,
//                    'title_image' => $title_img,
//                    'content_image' => null,
//                    'description' => $request_description
//                ]);
//                return redirect('admin/post')->with('success', 'create success');
//            }
//            if ($title_img == null && $content_img == null){
//                Post::create([
//                    'title' => $request_title,
//                    'content' => $request_content,
//                    'title_image' => null,
//                    'content_image' => null,
//                    'description' => $request_description
//                ]);
//                return redirect('admin/post')->with('success', 'create success');
//            }
//        }
        Post::create([
            'title' => $request_title,
            'content' => $request_content,
            'title_image' => $title_img,
            'content_image' => $content_img,
            'description' => $request_description
        ]);
        return redirect('admin/post')->with('success', 'create success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $post = Post::findOrFail($id);
        $post->update($requestData);

        return redirect('admin/post')->with('flash_message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect('admin/post')->with('flash_message', 'Post deleted!');
    }

    public function post()
    {
        $posts = Post::all();

        return view('frontend.posts.index', compact('posts'));
    }

    public function content(Post $post)
    {
        return view('frontend.posts.content', compact('post'));
    }
}
