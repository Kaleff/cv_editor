@extends('layout')

@section('content')
<div class="container">
  <h4>{{ $user['name'] }}</h4>
  <h5>Email: {{ $user['email'] }}</h5>
  @if($resume['phone'])
    <h5>Phone: +{{ $resume['phone'] }}</h5>
  @endif
  @if($resume['address'])
    <h5>Address: {{ $resume['address'] }}</h5>
  @endif


  <a href="{{ route('experience_create_form', ['id' => $resume['id']]) }}"><button class="btn btn-light">Add an experience/education</button></a>
</div>
@endsection