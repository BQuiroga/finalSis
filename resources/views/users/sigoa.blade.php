@extends('app')
@section('content')
@section('title', 'Usuario')
 	<h2>Esta es la 4.b</h2>
 	<h1>Sigo a:</h1>
 	@foreach ($follows as $follow)
 		<li>{{$follow->user->name}}/{{$follow->user->uname}}</li>
 		
 		@if(Auth::user()->getId()==$ids)
			{!! Form::open(array('route' => array('follows.destroy', $follow->user->seguidor(Auth::user(),$follow->user->id)), 'method' => 'delete')) !!}
             <button type="submit" class="btn btn-danger btn-mini">Ya no seguir</button>
            {!! Form::close() !!}	
         @endif

 		<br>
    @endforeach
@stop