@extends('layout')

@section('content')
<div class="container">
  <form method="POST" action='{{ $edit ? "/experience/$experience->id" : route('store_experience') }}' enctype="multipart/form-data">
    @csrf
    @if($edit)
      @method('PUT')
    @endif
    <div class="form-group row">
      <label for="company" class="col-sm-3 col-form-label">Company/Educational institution:</label>
      <input type="text" name="company" value="{{ $experience ? $experience['company'] : old('company') }}" />
    </div>
    @error('company')
    <p class="errorMessage">{{ $message }}</p>
    @enderror

    <div class="form-group row">
      <label for="role" class="col-sm-3 col-form-label">Role:</label>
      <input type="text" name="role" value="{{ $experience ? $experience['role'] : old('role') }}" />
    </div>
    @error('role')
    <p class="errorMessage">{{ $message }}</p>
    @enderror

    <div class="form-group row">
      <label for="type" class="col-sm-3 col-form-label">Experience Type:</label>
      <select name="type">
        <option value="Full-time">Full-time</option>
        <option value="Part-time">Part-time</option>
        <option value="Internship">Internship</option>
        <option value="Education">Education</option>
      </select>
    </div>
    @error('type')
    <p class="errorMessage">{{ $message }}</p>
    @enderror

    <div class="form-group row">
      <label for="location" class="col-sm-3 col-form-label">Location (optional):</label>
      <input type="text" name="location" value="{{ $experience ? $experience['location'] : old('location') }}" />
    </div>
    @error('location')
    <p class="errorMessage">{{ $message }}</p>
    @enderror

    <div class="form-group row">
      <label for="start_date" class="col-sm-3 col-form-label">Start date:</label>
      <input type="date" id="start_date" name="start_date" value="{{ $experience ? $experience['start_date'] : old('start_date') }}" />
    </div>
    @error('start_date')
    <p class="errorMessage">{{ $message }}</p>
    @enderror

    <div class="form-group row">
      <label for="end_date" class="col-sm-3 col-form-label">End date (optional):</label>
      <input type="date" id="end_date" name="end_date" value="{{ $experience ? $experience['end_date'] : old('end_date') }}" />
    </div>
    @error('end_date')
    <p class="errorMessage">{{ $message }}</p>
    @enderror

    <div class="form-group row">
      <label for="description" class="col-sm-3 col-form-label">Description:</label>
      <input type="text" name="description" value="{{ $experience ? $experience['description'] : old('description') }}" />
    </div>
    @error('description')
    <p class="errorMessage">{{ $message }}</p>
    @enderror

    <button type="submit" class="btn btn-light">
      Submit
    </button>
  </form>
</div>
@endsection