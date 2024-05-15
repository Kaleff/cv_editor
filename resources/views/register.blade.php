@extends('layout')

@section('content')
    <div class="container">
        <form method="POST" action="/register" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" />
            </div>
            @error('email')
                <p class="errorMessage">{{ $message }}</p>
            @enderror

            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" />
            </div>
            @error('name')
                <p class="errorMessage">{{ $message }}</p>
            @enderror
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
            </div>
            @error('password')
                <p class="errorMessage">{{ $message }}</p>
            @enderror
            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm password</label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />
            </div>

            <div class="form-group row button-row">
                <button type="su" class="btn btn-default">
                    Register
                </button>

                <a href="{{ route('homepage') }}" class="text-black ml-4"><button type="button"
                        class="btn btn-info">Back</button></a>
            </div>
        </form>
    </div>
@endsection
