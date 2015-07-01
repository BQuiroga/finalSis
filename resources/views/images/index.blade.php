@extends('app')
@section('content')

<h1>Images</h1>
@foreach ($images as $image)

	<img width="50px" height="50px" src="{{ ($image->image == null) ? '/uploads/nophoto.jpg' : $image->image}}" alt="">

@endforeach

@stop

