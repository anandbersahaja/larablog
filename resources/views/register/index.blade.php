@extends('layouts.main')

@section('content')
<div class="row justify-content-center mt-5">
  <div class="col col-lg-5">

    

    <main class="form-register">
      <form action="/register" method="POST">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please Register</h1>

        <div class="form-floating">
          <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="name" name="name" value="{{ old('name') }}" autofocus required>
          <label for="name">Name</label>
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        
        <div class="form-floating">
          <input type="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username.example" name="username" value="{{ old('username') }}" required>
          <label for="username">Username</label>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        
        <div class="form-floating">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required>
          <label for="email">Email address</label>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        
        <div class="form-floating">
          <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required>
          <label for="password">Password</label>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        
        <button class="w-100 btn btn-lg btn-primary mt-2 mb-2" type="submit">Register</button>
        <small class="d-block text-center">Registered? <a href="/login">Login Now!</a></small>
      </form>
    </main>

  </div>
</div>
@endsection
