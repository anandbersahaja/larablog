@extends('dashboard.layouts.main')

@section('content')

<div class="container my-4">
  <div class="row">
    <div class="col-lg-8">
      {{-- header --}}
      <h1>{{ $post->title }}</h1>

      <div class="justify-content-end d-flex gap-2">
        <a href="/dashboard/posts" class="btn btn-sm btn-info"><span data-feather="arrow-left"></span> Back to all posts</a>
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-warning"><span data-feather="edit"></span> Edit</a>
        <form action="/dashboard/posts/{{ $post->slug }}" method="POST">
          @method('delete')
          @csrf
          <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="trash"></span> Delete</button>
        </form>

      </div>
      
      <div class="my-3" style="max-height:300px; overflow:hidden;">
        @if ($post->image)
          <img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid
          ">  
        @else
          <img src="https://source.unsplash.com/800x400?"{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid">
        @endif
      </div>

        {{-- content --}}
        {!! $post->body !!}
    </div>
  </div>
</div>
        

@endsection