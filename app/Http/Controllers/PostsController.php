<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests;
use App\Post;
use App\Category;

class PostsController extends Controller
{

	private function stripAccents($stripAccents){

		$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ');
		$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
		return str_replace($a,$b, $stripAccents);
	}

	private function create_slug($title){
		$slug = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), $this->stripAccents($title)));
		$numHits = Post::where('slug', $slug)->count();

		return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
	}
	public function index()
	{
			$posts = Post::where('type', 'post')->get();
			return view('index', ['posts' => $posts]);
	}
	public function archive($year, $month)
	{
		$posts = Post::whereRaw("YEAR(created_at) = ".$year." AND MONTH(created_at) = ".$month." AND `type`='post'")->get();
		return view('archive', ['posts' => $posts]);
	}
    public function details(Post $post)
    {
    	return view('single', ['post' => $post]);
    }
	public function admin_index()
	{
		if (Auth::user()->cant('view_posts', Post::class)) abort(403);

		$posts = Post::where('type', 'post')->get();
		return view('admin.posts.index', ['posts' => $posts, 'type' => 'post']);
	}
	public function admin_create(Request $request)
	{
		if (Auth::user()->cant('create_posts', Post::class)) abort(403);

		if (!empty($request['_token'])) {
			$post = new Post(['title' => $request->title, 'content' => $request->content, 'comments' => $request->comments, 'type' => 'post']);
			$post->slug = $this->create_slug($request->title);
			$post->save();
			if (empty($request->category)) $request->category = 1;
			$post->categories()->attach($request->category);
			return redirect()->action('PostsController@admin_index');
		}
		return view('admin.posts.create', ['categories' => Category::all(), 'type' => 'post']);
	}
	public function admin_edit($id, Request $request)
	{
		$post = Post::where('id', $id)->first();
		if ($post->type == 'post') $categories = Category::all();
		else $categories = '';

		if (!empty($request['_token'])) {
			if(($post->type == 'post' && (Auth::user()->can('edit_posts', $post) || Auth::user()->can('edit_others_posts', $post)) || ($post->type == 'page' && Auth::user()->can('edit_pages', $post)))){
				$post->title = $request->title;
				$post->content = $request->content;
				$post->updated_at = date('Y-m-d H:i:s');
				if ($post->type == 'post') {
					$post->comments = $request->comments;
					$post->categories()->detach();
					$post->categories()->attach($request->category);
				}
				$post->save();
				return view('admin.posts.edit', ['message' => array('type' => 'success', 'content'=>'Changes where successfully saved'), 'categories' => $categories, 'type' => $post->type, 'post' => $post]);
			}
			else return view('admin.posts.edit', ['message' => array('type' => 'danger', 'content'=>'You are not authorized to edit this '.$post->type), 'categories' => $categories, 'type' => $post->type, 'post' => $post]);
		}
		return view('admin.posts.edit', ['categories' => $categories, 'type' => $post->type, 'post' => $post]);
	}

	public function admin_delete($id){
		if (Auth::user()->can('delete_posts', Post::class) || Auth::user()->can('delete_others_posts', Post::class)) {
			Post::where('id', $id)->delete();
			return redirect()->action('PostsController@admin_index');
		}
	}
	public function admin_pages_index(){
		if (Auth::user()->cant('view_pages', Post::class)) abort(403);

		$posts = Post::where('type', 'page')->get();
		return view('admin.posts.index', ['posts' => $posts, 'type' => 'page']);
	}
	public function admin_page_create(Request $request)
	{
		if (Auth::user()->cant('create_pages', Post::class)) abort(403, 'Unauthorized action.');

		if(!empty($request['_token']))
		{
			$post = new Post(['title' => $request->title, 'content' => $request->content, 'comments' => 0, 'type' => 'page', 'slug' => $this->create_slug($request->title)]);
			$post->save();
			return redirect()->action('PostsController@admin_pages_index');
		}
		return view('admin.posts.create', ['type' => 'page']);
	}
}
