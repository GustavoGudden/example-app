@extends('master')

@section('content')
<h1>Create New Task</h1>

<form action="{{ route('task.store') }}" method="POST">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <button type="submit">Create Task</button>
</form>

<a href="{{ route('tasks.index') }}">Back to Task List</a>

@endsection