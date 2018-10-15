@extends('templates.template')

@section('title','all confessions')
@section('body')
@section('head')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<style>
    a{
       color:#007bff;
       font-size:1.1rem; 
    }
    body{

    }
    #navbar-brand{
        font-size:1.4rem;
    }
</style>
@include('templates.navbar')
<div class="container mt-5">
    <div id="app">
        <all-confessions></all-confessions>
    </div>
</div>
@endsection