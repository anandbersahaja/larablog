@extends('layouts.main')

@section('content')
    
    <h1>About Page</h1>
    
    <h5>{{ $name }}</h5>
    <p class="mb-0"><b>Contact me:</b></p>
    <ul>
        <li>Send me your mail to{{ $email }}</li>
        <li>Or call me at {{ $phone }}</li>
    </ul>
    <img src="img/{{ $img }}" alt="{{ $name }}" width="200">

@endsection