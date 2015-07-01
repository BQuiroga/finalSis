@extends('app')
@section('content')
@section('title', 'Usuario')
 	<h1>Seguidores a:</h1>
 	@foreach ($follows as $follow)
		
 				<li><h3>{{App\User::where('id',$follow->userfolow_id)->first()->name}}/{{App\User::where('id',$follow->userfolow_id)->first()->name}}</h3></li> 			
 	@endforeach
@stop