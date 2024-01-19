@extends('master')

@section('content')

<h1>Edit Task</h1>

@if (session()->has('message'))
{{ session()->get('message')}}
@endif

<form action="{{route('task.update',['task' => $task->id])}}" method="post">
    @csrf
    <input type="hidden" name="_method" value="put">
    <input type="text"  name="title" value="{{ $task->title}}">
    <input type="text"  name="description" value="{{$task->description}}">
    <button type="submit">Editar</button>
</form>

@endsection 