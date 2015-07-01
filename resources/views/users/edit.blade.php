@extends('app')
@section('content')


{!! Form::model($user, ['method'=>'PATCH', 'action' => ['UsersController@update', $user->id]]) !!}
{!! Form::label('name','Nombre:') !!}
{!! Form::text('name') !!}
<br>
{!! Form::label('name','Nombre Usuario:') !!}
{!! Form::text('uname') !!}
<br>
{!! Form::label('name','email:') !!}
{!! Form::text('email') !!}
<br>
<br><br>
{!! Form::label('name','Pais:') !!}
{!! Form::select('country_id',array(1=>'Bolivia',2=>'Colombia')) !!}

{!! Form::submit('Guardar') !!}
{!! Form::close() !!}

@stop