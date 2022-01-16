@extends('layouts.main')

@section('content')
<div class="row justify-content-center mt-5">
  <div class="col col-lg-5">

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  
    @elseif(session()->has('failure'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" id="failure-alert">
        {{ session('failure') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    
    @endif


    <main class="form-login">
      <form action='/login' method="POST">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please Login</h1>

        <div class="form-floating">
          <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
          <label for="email">Email address</label>
        </div>
        <div class="invalid-feedback">
          @error('email')
            {{ $messages }}
          @enderror
        </div>
        
        <div class="form-floating">
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          <label for="password">Password</label>
          <div class="invalid-feedback">
            @error('password')
              {{ $messages }}
            @enderror
          </div>
        </div>
        
        <button class="w-100 btn btn-lg btn-primary mt-2 mb-2" type="submit">Login</button>
        <small class="d-block text-center">Not registered? <a href="/register">Register now!</a></small>
      </form>
    </main>
  </div>
</div>
@endsection