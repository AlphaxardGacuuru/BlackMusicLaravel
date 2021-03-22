<?php

namespace App\Http\Controllers;

use App\BoughtVideos;
use App\CartVideos;
use App\Follow;
use App\Polls;
use App\Post;
use App\PostCommentLikes;
use App\PostComments;
use App\PostLikes;
use App\User;
use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('post_id', 'desc')->get();
        $users = User::orderBy('user_id', 'desc')->get();
        $follows = Follow::get();
        $videos = Videos::orderBy('id', 'desc')->get();
        $boughtVideos = BoughtVideos::get();
        $cartVideos = CartVideos::get();
        $polls = Polls::get();

        return view('/pages/index')->with(['posts' => $posts, 'users' => $users, 'follows' => $follows, 'videos' => $videos, 'boughtVideos' => $boughtVideos, 'cartVideos' => $cartVideos, 'polls' => $polls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/post-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post-text' => 'required',
            'post-media' => 'image|nullable|max:9999',
        ]);

/* Handle file upload */
        if ($request->hasFile('post-media')) {
            //$path = $request->file('post-media')->store('public/post-media');
            $path = 'public/post-media/' . $request->file('post-media')->hashName();
            $compressedImg = Image::make($request->file('post-media'))->encode('jpg', 50);
            Storage::put($path, $compressedImg);
        } else {
            $path = "";
        }

        /* Create new post */
        $post = new Post;
        $post->username = auth()->user()->username;
        $post->text = $request->input('post-text');
        $post->media = substr($path, 7);
        $post->parameter_1 = $request->input('poll_1') ? $request->input('poll_1') : "";
        $post->parameter_2 = $request->input('poll_2') ? $request->input('poll_2') : "";
        $post->parameter_3 = $request->input('poll_3') ? $request->input('poll_3') : "";
        $post->parameter_4 = $request->input('poll_4') ? $request->input('poll_4') : "";
        $post->parameter_5 = $request->input('poll_5') ? $request->input('poll_5') : "";
        $post->save();

        return redirect('posts')->with('success', 'Post Sent');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('post_id', $id)->first();
        $comments = PostComments::where('post_id', $id)->orderby('post_comment_id', 'DESC')->get();
        return view('pages/post-show')->with(['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('post_id', $id)->first();
        Storage::delete('public/' . $post->media);
        Polls::where('post_id', $post->post_id)->delete();
        $postComment = PostComments::where('post_id', $id)->get();
        foreach ($postComment as $postComment) {
            PostCommentLikes::where('post_comment_id', $postComment->post_comment_id)->delete();
        }
        PostComments::where('post_id', $id)->delete();
        PostLikes::where('post_id', $id)->delete();
        Post::find($id)->delete();

        return redirect('posts')->with('success', 'Post Deleted');

    }
}
