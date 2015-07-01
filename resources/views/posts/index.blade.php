@extends('app')
@section('content')
<h3><a href="/posts/create">Nuevo</a></h3>

<h1>Posts</h1>
@foreach ($posts as $post)
	<p>Contenido:<a href="/posts/{{$post->id}}">{{$post->content}}</a></p>
	<p>By: {{$post->user->name}}</p>
	@if ($post->country)

		<p>On: {{$post->country->name}} </p>
	@endif
	@if ($post->user->id==Auth::user()->getId())
		<a href="/posts/{{$post->id}}/edit"><button type="button" class="btn btn-info">Editar</button></a>
	
	{!! Form::open(array('route' => array('posts.destroy', $post->id), 'method' => 'delete')) !!}
			<button type="submit" class="btn btn-danger btn-mini">Borrar</button>
	{!! Form::close() !!}
	@endif
<div>


<hr style="width: 100%; color: black; height: 1px; background-color:black; align: right" />
</div>
@endforeach

@stop

