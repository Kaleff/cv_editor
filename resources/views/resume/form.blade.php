@extends('layout')

@section('content')
<div class="container">
  <form method="POST" action='{{ $edit ? "/resume/$resume->id" : '/resume' }}' enctype="multipart/form-data">
    @csrf
    @if($edit)
      @method('PUT')
    @endif
    <div class="form-group row">
      <label for="name" class="col-sm-3 col-form-label">CV filename:</label>
      <input type="text" name="name" value="{{ $resume ? $resume['name'] : old('name') }}" />
    </div>
    @error('name')
    <p class="errorMessage">{{ $message }}</p>
    @enderror
    <div class="form-group row">
      <label for="phone" class="col-sm-3 col-form-label">Phone (optional):</label>
      <span class="plusie">+</span>
      <input type="tel" name="phone" value="{{ $resume ? $resume['phone'] : old('phone') }}" pattern="[0-9]{11}"
        placeholder="99912345678" />
      <p>(999)1234-5678 format</p>
    </div>
    @error('phone')
    <p class="errorMessage">{{ $message }}</p>
    @enderror
    <div class="form-group row">
      <label for="address" class="col-sm-3 col-form-label">Address (optional):</label>
      <input type="text" name="address" value="{{ $resume ? $resume['address'] : old('address') }}" />
    </div>
    @error('address')
    <p class="errorMessage">{{ $message }}</p>
    @enderror
    <button type="submit" class="btn btn-light">
      Submit
    </button>
  </form>
</div>
@endsection