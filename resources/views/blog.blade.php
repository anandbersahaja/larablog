{{-- @dd($posts) --}}

@extends('layouts.main')

@section('content')

  @if ($posts->count())

    <div class="row justify-content-center mb-3">
      <div class="col">
        <h1 class="mb-4">{{ $title }}</h1>
      </div>

      <div class="col-7 align-self-center">
        <form action="/blog" >
          @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
          @elseif (request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
          @endif
          <div class="input-group mb-2">
            <input class="form-control" type="search" placeholder="Search" name="search" autocomplete="off" value="{{ request('search') }}">
            {{-- <input class="form-control" type="text" placeholder="Search" name="search" autocomplete="off" value={{ request('search') }}> --}}
            <button class="btn btn-dark" type="submit">Search</button>
          </div>
        </form>
      </div>
    </div>

    <div class="container">

    <div class="row" style="">
      <div class="col-12">
        <div class="card mb-5 shadow rounded">
          
          {{-- IMG TOP --}}
          <div style="max-height:400px; overflow:hidden;">
          @if ($posts[0]->image)
              <img src="{{ asset('storage/'. $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="card-img-top">  
            @else
              <img src="https://source.unsplash.com/1200x400?"{{ $posts[0]->category->name }}" alt="{{ $posts[0]->category->name }}" class="card-img-top">
            @endif
          </div>
          {{-- <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}"> --}}
          
          <div class="card-body">
            <h5 class="card-title mb-1"><a href="/blog/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>
            <p class="card-text mb-1">
              <small>
              By 
                <a href="/blog?author={{ $posts[0]->author->username }}" class="text-decoration-none">
                  {{ $posts[0]->author->name }}</a> in <a href="/blog?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}
                </a> 
                <span class="text-secondary">{{ $posts[0]->created_at->diffForHumans() }}</span>
              </small>
            </p>
            <p class="card-text">{{ $posts[0]->excerpt }}</p>
            
            <a href="/blog/{{ $posts[0]->slug }}" class="btn btn-primary">Read more</a>
          </div>
        </div>
      </div>

      @foreach ($posts->skip(1) as $post)
        <div class="col-md-4 mb-5">
          <div class="card shadow rounded h-100">
          <a href="/blog?category={{ $post->category->slug }}" class="text-decoration-none text-light px-2 " style="position:absolute; background:rgba(0,0,0,.5);">
            {{ $post->category->name }}
          </a>

            @if ($post->image)
              <img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->category->name }}" class="card-img-top">  
            @else
              <img src="https://source.unsplash.com/800x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="card-img-top">
            @endif
          
            <div class="card-body">
              <h5 class="card-title"><a href="/blog/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
              <small>
                By 
                <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">
                  {{ $post->author->name }}
                </a>
                <span class="text-secondary">{{ $post->created_at->diffForHumans() }}</span>
              </small>
              <p class="card-text">{{ $post->excerpt }}</p>
              
            </div>
            {{-- <div class="card-footer"> --}}
            <span class="card-footer bg-white mt-0 bt-none d-flex justify-content-end">
              <a href="/blog/{{ $post->slug }}" class="btn btn-primary bg-primary py-0 px-2">
                Read more
              </a>
            </span>

              {{-- <small class="text-muted">Last updated 3 mins ago</small> --}}
            {{-- </div> --}}
          </div>
        </div>
      @endforeach

    </div>
    
  </div>
  <div class="pagination justify-content-center align-self-center mb-3">
    {{ $posts->links() }}
  </div>
  
  
  @else
    <p class="text-center fs-4">Post Not Found</p>
  @endif
    
@endsection

