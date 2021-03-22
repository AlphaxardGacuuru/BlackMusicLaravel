<?php

namespace App\Http\Controllers;

use App\PostCommentLikes;
use Illuminate\Http\Request;

class PostCommentLikesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postCommentLikeCount = PostCommentLikes::where('post_comment_id', $request->input('post-comment-id'))->where('username', auth()->user()->username)->count();
        if ($postCommentLikeCount > 0) {
            PostCommentLikes::where('post_comment_id', $request->input('post-comment-id'))->where('username', auth()->user()->username)->delete();
            $message = 'Like deleted';
        } else {
            $postCommentLikes = new PostCommentLikes;
            $postCommentLikes->post_comment_id = $request->input('post-comment-id');
            $postCommentLikes->username = auth()->user()->username;
            $postCommentLikes->save();
            $message = 'Comment liked';
        }

        return redirect('posts/' . $request->input('post-id'))->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function show(PostCommentLikes $postCommentLikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCommentLikes $postCommentLikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCommentLikes $postCommentLikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostCommentLikes  $postCommentLikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCommentLikes $postCommentLikes)
    {
        //
    }
}
