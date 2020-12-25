@extends('layouts.app')

@section('pagetitle', 'Homepage')
@section('content')
    <div class="bg-light p-5 rounded-lg jumbotron text-center">
        <div class="display-5 mb-5 mt-5">
            <img src="{{ asset('img/upnvj-logo.png') }}" alt="UPNVJ" width="150px" height="150px">
        </div>
        <div class="h4 fw-bold text-uppercase">
            Tingkat kepuasan pelayanan
        </div>
        <div class="h1 fw-bold" style="color:yellow">
            UPN VETERAN JAKARTA
        </div>
        <div class="caption offset-2 col-8">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, et ipsum. Sit neque dignissimos
            nostrum laborum aperiam repellendus omnis tempora corporis, velit molestias ad accusantium reprehenderit
            soluta eius culpa. Corrupti quaerat sint cumque exercitationem illum voluptatum quas delectus totam.
            Nihil maiores, dolorum quibusdam delectus ipsa ex recusandae exercitationem sunt omnis!
        </div>
    </div>
@endsection
