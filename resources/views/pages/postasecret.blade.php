@extends('templates.template')
@section('title','post a secret')

@section('body')
@include('templates.navbar')
<div class="container">
    <br> <br>
    <p class="font-weight-bold">post a confession:</p>
    <form method="POST" action='/postsecret' enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <textarea name="confession" id="confess" cols="30" rows="7" class="form-control"></textarea>
        <button type="submit" class="btn btn-block btn-success mt-3">post</button>
    </form>
</div>
@endsection