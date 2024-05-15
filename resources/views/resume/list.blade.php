@extends('layout')

@section('content')
<div class="container">
  @foreach ($resumes as $resume)
  <div class="resumeBlock">
    {{ $resume['name'] }}
  </div>
  <button>View</button>
  <a href="{{ route('resume_edit_form', ['resume' => $resume['id']]) }}"><button type="button" class="btn btn-light">Edit</button></a>
  
  <a href="javascript:void" onclick="document.getElementById('{{ 'delete_resume_'.$resume['id'] }}').submit();">
    <button class="btn btn-danger">Delete</button>
  </a>
  <form id="{{ 'delete_resume_'.$resume['id'] }}" action="{{ route('resume_delete', ['resume' => $resume['id']]) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
  </form>
  @endforeach
  <div class="createBlock">
    <a href="{{ route('resume_create_form') }}" class="">
      Create new CV
    </a>
  </div>
</div>
@endsection