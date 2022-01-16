{{-- @dd($post->category->name) --}}

@extends('layouts.main')

@section('content')
      <div class="row justify-content-center">
        <div class="col-md-8">
          {{-- header --}}
          <h1>{{ $post->title }}</h1>

          {{-- penulis dan kategori --}}
          <p class="mb-0">
            By 
            <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">
              {{ $post->author->name }}
            </a>
            in 
            <a href="/blog?category={{ $post->category->slug }}" class="text-decoration-none">
              {{ $post->category->name }}
            </a>
          </p>

          <div class="my-3" style="max-height:350px; overflow:hidden;">
            @if ($post->image)
                <img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">  
              @else
                <img src="https://source.unsplash.com/800x400?"{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid">
              @endif
            </div>

          {{-- <img src="https://source.unsplash.com/800x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid py-3"> --}}
          {{-- content --}}
          {!! $post->body !!}
          
          <a href="/blog" >Back to Blog</a>
        </div>
      </div>
        

@endsection


