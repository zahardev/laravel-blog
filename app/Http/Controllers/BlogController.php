<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
	protected $limit = 3;

    public function index(){
    	//\DB::enableQueryLog();
    	$posts = Post::with('author')
	                 ->latestFirst()
		             ->published()
	                 ->simplePaginate($this->limit);
    	return view('blog.index', compact('posts'));
    	//dd(\DB::getQueryLog());
    }

	public function show($slug) {
		$post = Post::published()->where('slug', $slug)->first();
    	return view('blog.show', compact('post'));
    }
}
