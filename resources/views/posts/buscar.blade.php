@extends('app')
@section('content')
@section('title', 'Buscar')
<h2>Posts relacionados con: {{$input}}</h2>
<br>
 @foreach ($posts as $post)
          
         <strong>----------------------------------------------------------------</strong>
         <p>-{{$post->content}}</p>
         <p>Fecha: {{$post->created_at}}</p>
         <p>Usuario: {{$post->user->name}}</p>
         <b>Likes:</b> {{$post->likes()->count()}}
          
         @if ($post->type==2)
            <h3><i>Es un re post</i></h3>
            <p>dasda:{{$user->id}}</p>
         @endif
        @if (Auth::guest())
           @else
                    @if ($post->liked(Auth::user()))
                        {!! Form::open(array('route' => array('likes.destroy', $post->userLike(Auth::user())->id), 'method' => 'delete')) !!}
                        <button type="submit" class="btn btn-danger btn-mini">Unlike</button>
                        {!! Form::close() !!}
                    @else
                    {!! Form::open(['url'=>'likes']) !!}
                    {!! Form::hidden('post_id',$post->id) !!}
                    {!! Form::submit('Like') !!}
                    {!! Form::close() !!}
                    @endif

        @endif    
         <br>
@endforeach
@stop

