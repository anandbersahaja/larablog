@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">My Categories</h1>
</div>

<div class="d-flex justify-content-end col-lg-6">
  <a href="/dashboard/categories/create" class="btn btn-primary btn-sm">Add new category</a>
</div>

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show col-lg-8 mt-1" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if ($categories->count())
<div class="table-responsive col-lg-6">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $category->name }}</td>
        <td>
          <a href="/dashboard/categories/{{ $category->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
          <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
          <form action="/dashboard/categories/{{ $category->slug }}" method="POST" class=" d-inline">
            @method('delete')
            @csrf
            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
<div class="row">
  <div class="d-flex align-items-center justify-content-center" style="height: 400px">
    <p class="fs-4 text-secondary">No categories yet</p>
  </div>
</div>
@endif
@endsection
