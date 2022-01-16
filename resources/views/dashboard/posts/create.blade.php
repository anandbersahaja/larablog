@extends('dashboard.layouts.main')

@section('content')
<div class="col-lg-8 mt-3 mb-5">
  <form action="/dashboard/posts" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label" >Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" autofocus value="{{ old('title') }}" required>
      @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') }}" required>
      @error('slug')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="category_id" class="form-label">Category</label>
      <select type="form-select" class="form-select" name="category_id" id="category_id">
        @foreach ($categories as $category)
          @if ($category->id == old('category_id'))
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
          @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endif
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Post Image</label>
      <img class="img-preview img-fluid mb-3 col-sm-5">
      <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" onchange=imgPrev()>
      @error('image')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="body" class="form-label">Body</label>
      <input id="body" type="hidden" name="body" required value="{{ old('body') }}" class="@error('body') is-invalid @enderror" >
      <trix-editor input="body"></trix-editor>
      @error('body')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
  </form>
</div>

<script>
  const title = document.querySelector('#title')
  const slug = document.querySelector('#slug')

  title.addEventListener('change', function() {
    fetch('/dashboard/posts/checkSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
  })

  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  })

  function imgPrev() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    // const file = new FileReader();
    imgPreview.style.display= 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
      imgPreview.src = oFREvent.target.result;
    }

  }

</script>
@endsection
