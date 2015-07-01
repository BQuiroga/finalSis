@extends('app')
@section('content')

<p>Usuarios relacionados con: {{$input}}</p>
 @foreach ($users as $user)
 					
                	 <strong>-----------------------------------------------------</strong>
                    <p>Nombre del usuario:<a href="/users/{{$user->name}}">{{ $user->name }}</a></p>
                    <p>Nombre: {{ $user->uname }}</p>                   
                    <p>Email: {{ $user->email }}</p>           
@endforeach
@stop