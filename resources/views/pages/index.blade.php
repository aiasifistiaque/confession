@extends('templates.template')
@section('title','home')

@section('head')
    
@endsection


@section('body')
<br><br><br>
<div class="container">
    <div class="" style="">
        <div class="offset-md-4">

            <h2 class="mt-5 ml-3"> Make a <br> confession </h2>
        </div>
        <hr>
        <br>
        
        <blockquote class="blockquote mt-3 offset-md-3">
            <p>To confess a fault freely is the next thing to being innocent <br> of it.</p>
            <footer class="blockquote-footer">Publilius Syrus</footer>
        </blockquote>
        <br>
        <div class="offset-md-4" style="">
            <div class="">

                <a href="/post" class="btn btn-success">Post a Confession</a>
                <a href="/read" class="btn btn-danger" >Read a Confession</a>
            </div>
        </div>
    </div>
		
</div>

@endsection