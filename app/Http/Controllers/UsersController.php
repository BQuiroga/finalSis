<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Follow;
use App\Repost;
use Auth;
use Request;

class UsersController extends Controller {

	/**public function __construct(){
		$this->middleware('auth',['only'=>'show']);
	}
	*/
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function usuarios(Request $request)
	{
		$input = $request::get('find');	
		$users = User::where('name', 'LIKE', "%$input%")->get();		
		return view('users.usuarios',compact('input','users'));
	}
	public function sigoa($id)
	{
		$ids=$id;
		$follows=Follow::where('userfolow_id',$id)->get();
		return view('users.sigoa',compact('follows','ids'));
	}
	public function seguidores($id)
	{
		$follows=Follow::where('user_id',$id)->get();
		$users=User::All();
		return view('users.seguidores',compact('follows','users'));
	}

	function cant($var)
	{
	    return (strlen($var)>5);
	}



	public function index()
	{	
		if (Auth::guest())
		{
			$users = User::all();
			$a = Post::all()->lists('content');		 //array de contenidos
			$b=implode(" ",$a); // String completo
			$c=explode(" ",$b); // array de palabras
			$e=array_filter($c, function($var){return (strlen($var)>=4);});			
						//funcion de filter
			$d=array_count_values($e);// array con su contador	
			arsort($d);
			$arrays = array_slice($d, 0, 5);
			return view('users.index', compact('users','arrays','hola'));
		}
		else
		{
			$a = Post::all()->lists('content');		 //array de contenidos
			$b=implode(" ",$a); // String completo
			$c=explode(" ",$b); // array de palabras
			$hola=5;			
						
			$e=array_filter($c, function($var){return (strlen($var)>=4);});			
						//funcion de filter
			$d=array_count_values($e);// array con su contador	
			arsort($d);
			$arrays = array_slice($d, 0, 5);
			$reposts= Repost::where('user_id',Auth::user()->getId())->get();
			$users = User::all();
			$user = User::find(Auth::user()->getId());
			$follows=Follow::where('userfolow_id',Auth::user()->getId())->get();
			return view('users.show', compact('user','follows','users','reposts','arrays'));
		}
	}

	

	public function notificacion($id)
	{
		$posts=Post::where('user_id',$id)->get();
		return view('users.notificacion',compact('posts'));	
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$a = Post::all()->lists('content');		 //array de contenidos
		$b=implode(" ",$a); // String completo
		$c=explode(" ",$b); // array de palabras
		$hola=5;			
						//funcion de filter
		$e=array_filter($c, function($var){return (strlen($var)>=4);});			
						//funcion de filter
			$d=array_count_values($e);// array con su contador	
		arsort($d);
		$arrays = array_slice($d, 0, 5);	
		$user = User::where('name',$id)->first();
		$users = User::all();
		$reposts= Repost::where('user_id',$id)->get();
		$follows=Follow::where('userfolow_id',$id)->get();
		return view('users.show', compact('user','follows','users','reposts','arrays'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$user =User::find($id);
		$input = $request->all();
		$user->update($input);
		return redirect('users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
/*if (Input::has('search'))
	    {
	        $posts = Post::whereHas('breed', function($q)     
	        {
	            $queryString = $q;
	            $q->where('content', 'LIKE', "%$queryString%");

	        })->orderBy('content')->paginate(5);

	    }
	    else
	    {
	    	$posts = Post::all();
	    }*/