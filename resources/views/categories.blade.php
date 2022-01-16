{{-- @dd($posts) --}}

@extends('layouts.main')

@section('content')
    <h1 class="mb-5">Post Categories</h1>

    <div class="row">
      @foreach ($categories as $category)
        <div class="col-md-4">
          <a href="/blog?category={{ $category->slug }}">

            <div class="card shadow-lg bg-secondary">
              <img src="https://source.unsplash.com/500x300?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
              <div class="card-img-overlay d-flex align-items-center p-0">
                <h5 class="card-title flex-fill text-center fs-3 text-primary" style="background: rgba(0,0,0,.75);">
                  {{-- <a href="/categories/{{ $category->slug }}" class=" text-decoration-none text-white"> --}}
                    {{ $category->name }}
                  {{-- </a> --}}
                </h5>
              </div>
            </div>

          </a>
        </div>
      @endforeach

    </div>

@endsection