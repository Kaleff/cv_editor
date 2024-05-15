@extends('layout')

@section('content')
<div class="container">
  <form method="POST" action="/login" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
      <label for="email" class="col-sm-3 col-form-label">Email</label>
      <input type="text" class="" name="email"
        value="{{old('email')}}" />
    </div>
    @error('email')
      <p class="errorMessage">{{$message}}</p>
      @enderror
    <div class="form-group row">
      <label for="password" class="col-sm-3 col-form-label">Password</label>
      <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
    </div>

    <div class="form-group row row button-row">
      <button type="submit" class="btn btn-light">
        Login
      </button>

      <a href="{{ route('homepage') }}"><button type="button" class="btn btn-info">Back</button></a>
    </div>
  </form>
</div>
@endsection