@extends('templates.template')
@section('title','read a secret')

@section('body')
@include('templates.navbar')
<div class="container">
    <br> <br>
    <div class="offset-md-1 mt-4 col-lg-10 col-md-12">
        <div class="card">

            <div class="card-body">
                <div class="">
                    <h4 class="card-text mt-3 ml-3">"{{$confession}}"</h4>
                    <div class="text-muted text-uppercase text-left ml-5 mt-4">
                        <small>Posted On: {{$posted_on}}</small>
                        <br>
                        <small>Total Views: {{$views}} </small> <br>
                        <small>id: {{$confession_id}} </small>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-block btn-danger mt-3" href="/read">Read a random confession</a>
        {{-- <p class="mt-5"> Comments:</p> --}}
        <div id="app" class="container">

            <confession-comments :confessionid={{ $confession_id }}></confession-comments>
        </div>
        <hr>
    </div>
</div>
@endsection