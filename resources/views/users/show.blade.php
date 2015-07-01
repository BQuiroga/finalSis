@extends('app')
@section('content')
@section('title', 'Usuario')
<div class="col-lg-10 col-lg-offset-1">
 
    <h1><i class="fa fa-users"></i> User  </h1>
 
    <div class="table-responsive">
        
                    <p>Nombre:{{ $user->uname }}</p>
                    <img src="{{ ($user->image == null) ? '/uploads/nophoto.jpg' : $user->image}}" alt="" weight="150px" height="150">
                    <p>User Name:{{ $user->name }}</p>
                    <p>Correo: {{ $user->email }}</p>
                    @if ($user->country)

                      <p>Pais: {{$user->country->name}} </p>
                     @endif
                    <p>Contador de post:{{$user->posts->count()}}</p>
                    <p><a href="/users/seguidores/{{$user->id}}">Contador de Seguidores:  {{$user->follows->count()}}</a></p>
                    <p><a href="/users/sigoa/{{$user->id}}">Contador de a los q sigo:  {{$follows->count()}}</a></p>
                   
                    @if (Auth::guest())
                    @else
                    @if (Auth::user()->getId()==$user->id)   
                    {!! Form::open(['url'=>'images', 'files'=>true ]) !!}
                    {!! Form::label('name','Imagen:') !!}
                    {!! Form::file('image') !!}
                    {!! Form::hidden('user_id',Auth::user()->id) !!}
                    {!! Form::submit('Submit') !!}
                    {!! Form::close() !!}
                    @endif
                    @endif


                    @if (Auth::guest())
                    @else
                        @if (Auth::user()->getId()!=$user->id)   
                            @if($user->seguidores(Auth::user(),$user->id)==0)                           
                                {!! Form::open(['url'=>'follows']) !!}
                                {!! Form::hidden('user_id',$user->id) !!}
                                {!! Form::hidden('userfolow_id', $user->id)!!}
                                {!! Form::submit('Seguir') !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(array('route' => array('follows.destroy', $user->seguidor(Auth::user(),$user->id)), 'method' => 'delete')) !!}
                                <button type="submit" class="btn btn-danger btn-mini">Ya no seguir</button>
                                {!! Form::close() !!}
                            @endif
                        @endif
                    @endif
    </div>
<!-- <div class="container-fluid">Mis Post</div> -->
<div >
    <strong>Palabras mas populares</strong>
    <br>
    @foreach ($arrays as $array=> $val)
            <strong>-----------------------------------------------------</strong>
            <p>Palabra: {{$array}} </p>
            <p>Cantidad de veces usada: {{$val}}</p>  
    @endforeach
    <h2><i class="fa fa-users">Mis Posts</i></h2>

<div class="table-responsive">
    @if (Auth::guest())
           @else
        @if (Auth::user()->getId()==$user->id)

        {!! Form::open(['url'=>'posts','class' => 'postForm' ]) !!}
        {!! Form::label('name','Contenido:') !!}
        {!! Form::textarea('content', '' , ['id' => 'contenido']) !!}
        <input disabled  maxlength="3" size="3" value="140" id="counter">
        {!! Form::hidden('type',1) !!}
        {!! Form::hidden('user_id',$user->id) !!}
        {!! Form::hidden('country_id',$user->country_id) !!}
        <br>    
        {!! Form::submit('Publicar') !!}
        {!! Form::close() !!}
        @if ($errors->any())
            @foreach($errors -> all() as $error)
                {{$error}}
            @endforeach
        @endif
 
        @endif
    @endif
</div>

</div>
     {!! Form::open(array('action' => 'PostsController@buscar', 'method' => 'post')) !!}
             {!! Form::label('name','Post:') !!}
             {!! Form::text('find'), Input::old('find') !!}
            <button type="submit" class="btn btn-danger btn-mini">Buscar</button>
    {!! Form::close() !!}

    @foreach ($user->posts as $post)
         <strong>----------------------------------------------------------------</strong>
         <p>-{{$post->content}}</p>
         <p>Fecha: {{$post->created_at}}</p>
         <p>Usuario: {{$post->user->name}}</p>
         <b>Likes:</b> {{$post->likes()->count()}}
         @if (Auth::guest())
           @else
        {!! Form::open(['url'=>'reposts']) !!}
        {!! Form::hidden('post_id',$post->id) !!}
        {!! Form::hidden('user_id',Auth::user()->getId()) !!}
        <button type="submit" class="btn btn-default">Repost</button>
        {!! Form::close() !!}
        @endif
         @if ($post->type==2)
            <h3><i>Es un re post</i></h3>
            <strong>dasda:{{$user->id}}</strong>
         @endif
         @if ($post->reply==1)
            <strong><i>Es un re reply</i></strong>
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
        {!! Form::open(['url'=>'replies']) !!}
        {!! Form::label('name','Reply:') !!}
        {!! Form::text('content', '' , ['id' => 'contenido']) !!}
        {!! Form::hidden('user_id',$user->id) !!}
        {!! Form::hidden('post_id',$post->id) !!}
        <br>    
        {!! Form::submit('Publicar') !!}
        {!! Form::close() !!}
        @if ($errors->any())
            @foreach($errors -> all() as $error)
                {{$error}}
            @endforeach
        @endif  
         <br>
    @endforeach
    <h3>Reposts</h3>
    @foreach ($reposts as $repost)
         <p>Creado por: {{$repost->post->user->name}}</p>
         <p>Contenido:{{$repost->post->content}}</p>
         <p>Fecha: {{$repost->post->created_at}}</p>
         <b>Likes:</b> {{$repost->post->likes()->count()}}
        @if ($repost->post->type==2)
            <h3><i>Es un re repost->post</i></h3>
            <p>dasda:{{$user->id}}</p>
         @endif
        @if (Auth::guest())
           @else
                    @if ($repost->post->liked(Auth::user()))
                        {!! Form::open(array('route' => array('likes.destroy', $repost->post->userLike(Auth::user())->id), 'method' => 'delete')) !!}
                        <button type="submit" class="btn btn-danger btn-mini">Unlike</button>
                        {!! Form::close() !!}
                    @else
                    {!! Form::open(['url'=>'likes']) !!}
                    {!! Form::hidden('repost->post_id',$repost->post->id) !!}
                    {!! Form::submit('Like') !!}
                    {!! Form::close() !!}
                    @endif


        @endif      
    @endforeach
    <h2><i>Seguidores</i></h2>
    @foreach ($follows as $follow)
        <p></p>
        @foreach($follow->user->posts as $post)
            <strong>----------------------------------------------------------------</strong>
         <p>-{{$post->content}}</p>
         <p>Fecha: {{$post->created_at}}</p>
         <p>Usuario:<a href="/users/{{$post->user->id}}">{{$post->user->name}}</a> </p>
         <b>Likes:</b> {{$post->likes()->count()}}
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
             {!! Form::open(['url'=>'replies']) !!}
            {!! Form::label('name','Reply:') !!}
            {!! Form::text('content', '' , ['id' => 'contenido']) !!}
            {!! Form::hidden('user_id',$user->id) !!}
            {!! Form::hidden('post_id',$post->id) !!}
            <br>    
            {!! Form::submit('Publicar') !!}
            {!! Form::close() !!}
            @if ($errors->any())
                @foreach($errors -> all() as $error)
                    {{$error}}
                @endforeach
            @endif  
        @endif     
        @endforeach
    @endforeach
    <br>
    {!! Form::open(array('action' => 'UsersController@usuarios', 'method' => 'post')) !!}
             {!! Form::label('name','Usuario:') !!}
             {!! Form::text('find'), Input::old('find') !!}
            <button type="submit" class="btn btn-danger btn-mini">Buscar</button>
    {!! Form::close() !!}
    <h3>Otras cuentas</h3>
    <table border =1> 
            <thead>
                <tr>
                    <th>Otros usuarios</th>
                </tr>
            </thead>
 
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><a href="/users/{{$user->name}}">{{ $user->name }}</a></td>              
                </tr>
                @endforeach
            </tbody>
 
        </table>



   
</div>

<script>

$(document).ready( function(){
    $( 'postForm' ).on( 'submit', function(e){
        e.preventDefault();

        var content = $(this).find('input[name=content]').val();
        var user_id = $(this).find('input[name=user_id]').val();

        $.ajax({
            type: "POST",
            url: '/users/.$user->id'
            data: {content: content},
            success: function( post ) {
                $('#posts').append(post);
            }
        })
    })
})

</script>

<script>
function cuenta(){
       document.forms[0].caracteres.value=document.forms[0].texto.value.length
}

document.getElementById("contenido").onkeyup = function() {myFunction()};
function myFunction() {
    if (document.getElementById("contenido").value.length > 140)
    {
        document.getElementById("contenido").value = document.getElementById("contenido").value.substring( 0, 140);
        return false;
    }
    else{
        document.getElementById("counter").value = 140-document.getElementById("contenido").value.length;
    }
    
}
</script> 
 
@stop