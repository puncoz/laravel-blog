<?php

namespace App\Http\Controllers;

use App\Posts;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
    	// fetch 5 posts from database which are active and latest
    	$posts = Posts::where('active', 1)->orderBy('created_at', 'desc')->paginate(5);

    	// page heading
    	$title = 'Latest Posts';

    	// return home.blade.php template from resources/views folder
    	return view('home')->withPosts($posts)->withTitle($title);
    }

    public function create(Request $request) {
    	// if user can post i.e. user is admin or author
    	if($request->user()->can_post()) {
    		return view('posts.create');
    	}
    	return redirect('/')->withErrors('You have not sufficient permissions for writing post');
    }

    public function store(PostFormRequest $request) {
    	$post = new Posts();
    	$post->title = $request->get('title');
    	$post->body = $request->get('body');
    	$post->slug = str_slug($post->title);
    	$post->author_id = $request->user()->id;

    	if($request->has('save')) {
    		$post->active = 0;
    		$message = 'Post saved successfully';
    	} else {
    		$post->active = 1;
    		$message = 'Post published successfully';
    	}

    	$post->save();

    	return redirect('edit/'.$post->slug)->withMessage($message);
    }

    public function show($slug) {
    	$post = Posts::where('slug', $slug)->first();
    	if(!$post) {
    		return redirect('/')->withErrors('requested page not found');
    	}
    	$comments = $post->comments;
    	return view('posts.show')->withPost($post)->withComments($comments);
    }

}
