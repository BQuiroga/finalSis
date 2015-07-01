@extends('app')
@section('content')
@section('title', 'Notificaciones')

 @foreach ($posts as $post)

 	<h3>Post: {{$post->content}}</h3>
 	@if($post->cantReposts()>0)
 		<h4>Reposteados</h4>	
	 	@foreach (App\Repost::where('post_id',$post->id)->get() as $a ) 
	 		<p>Usuario:{{$a->user->name}}</p>
	 		<p>Nombre:{{$a->user->uname}}</p>
	 		<hr>
	 	@endforeach	
 	@endif
	@if($post->cantReposts()>0)
	 	<h4>Likes de los usuarios</h4>
	 	@foreach (App\Like::where('post_id',$post->id)->get() as $like)
	 		<p>Usuario:{{$like->user->uname}}</p>
	 	@endforeach
	 	<br>
 	@endif
 	@if($post->cantReplies()>0)
	 	<h4>Replies de los usuarios</h4>
	 	@foreach (App\Reply::where('post_id',$post->id)->get() as $reply)
	 		<p>Usuario:{{$reply->user->uname}}</p>
	 	@endforeach
 	@endif
 @endforeach
@stop