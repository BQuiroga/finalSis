<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;
use Auth;
use Request;
class PostsController extends Controller {


	public function __construct(){
		$this->middleware('auth',['only'=>'create','only'=>'show']);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::orderBy('id', 'DESC')->get();
		return view('posts.index', compact('posts'));
	}
	public function buscar(Request $request)
	{


		/*$post = new Post;
		$post->content="Buscador aqui";
		$post->type=1;
		Auth::user()->posts()->save($post);*/
		$input = $request::get('find');	
		$posts = Post::where('content', 'LIKE', "%$input%")->get();	
		return view('posts.buscar',compact('input','posts'));
	}

	public function buscarP(Request $request)
	{
		$input = $request::get('find');	
		$posts = Post::where('country_id', 'LIKE', "%$input%")->get();	
		return view('posts.buscar',compact('input','posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PostRequest $request)
	{
		$input = $request->all();
		$post = new Post($input);
		Auth::user()->posts()->save($post);
		return redirect('users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);
		return view('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);
		return view('posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,PostRequest $request)
	{
		$post = Post::find($id);
		$input = $request->all();
		$post->update($input);
		return redirect('posts');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::destroy($id);
		return redirect('posts');
	}

}
