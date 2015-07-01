@extends('app')
@section('content')
<h2>Crear nueva post</h2>

{!! Form::open(['url'=>'posts']) !!}
{!! Form::label('name','Contenido:') !!}
{!! Form::text('content') !!}
{!! Form::label('name','Pais:') !!}
{!! Form::select('country_id',array(1=>'Bolivia',2=>'Colombia')) !!}

<br>
<div class="form-group">
{!! Form::hidden('type',1) !!}


<br><br>
{!! Form::submit('Guardar') !!}
{!! Form::close() !!}
@if ($errors->any())
	@foreach($errors -> all() as $error)
		{{$error}}
	@endforeach
@endif
@stop