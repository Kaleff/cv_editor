@extends('layout')

@section('content')
<div class="container">
  <h2 class="text-center">{{ $user['name'] }}</h2>
  <h4 class="text-center">Email: {{ $user['email'] }}</h4>
  @if($resume['phone'])
    <h4 class="text-center">Phone: +{{ $resume['phone'] }}</h4>
  @endif
  @if($resume['address'])
    <h4 class="text-center">Address: {{ $resume['address'] }}</h4>
  @endif

  @if (count($experiences) > 0)
    <h3 class="text-center">Work experience</h3>
    @foreach ($experiences as $experience)
      <h4>{{ $experience['company'] }} | @if($experience['location'])
        {{ $experience['location'] }}        
      @endif</h4>
      <h4>{{ $experience['role'] }} - {{ $experience['type'] }}| {{ $experience['start_date'] }} @if($experience['end_date'])
        -- {{ $experience['end_date'] }}  
      @endif</h4>
      <p>{{ $experience['description'] }}</p>
      <a href="{{ route('experience_edit_form', ['experience' => $experience['id']]) }}"><button class="btn btn-light">Edit Entry</button></a>
      <button onclick="document.getElementById('{{ 'delete_entry_'.$experience['id'] }}').submit();" class="btn btn-danger">Delete Entry</button>
      <form id="{{ 'delete_entry_'.$experience['id'] }}" action="{{ route('experience_delete', ['experience' => $experience['id']]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
      </form>
    @endforeach
  @endif

  @if (count($educations) > 0)
    <h3 class="text-center">Education</h3>
    @foreach ($educations as $education)
      <h4>{{ $education['company'] }} | @if($education['location'])
        {{ $education['location'] }}        
      @endif</h4>
      <h4>{{ $education['role'] }} | {{ $education['start_date'] }} @if($education['end_date'])
        -- {{ $education['end_date'] }}  
      @endif</h4>
      <p>{{ $education['description'] }}</p>
      <a href="{{ route('experience_edit_form', ['experience' => $education['id']]) }}"><button class="btn btn-light">Edit Entry</button></a>
      <button onclick="document.getElementById('{{ 'delete_entry_'.$education['id'] }}').submit();" class="btn btn-danger">Delete Entry</button>
      <form id="{{ 'delete_entry_'.$education['id'] }}" action="{{ route('experience_delete', ['experience' => $education['id']]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
      </form>
    @endforeach
  @endif
  <br />
  <div class="cv_buttons"><a href="{{ route('experience_create_form', ['id' => $resume['id']]) }}"><button class="btn btn-light">Add an experience/education</button></a>
    <a href="{{ route('resume_list') }}"><button class="btn btn-info">Back to resume list</button></a></div>
    
</div>

@endsection