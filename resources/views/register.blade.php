@extends('master')

@section('content')
<h1>register</h1>

<form action="{{ route('auth.register') }}" method="POST">
    @csrf
    <label for="title">Name:</label>
    <input type="text" name="name" required>


    <label for="title">Email:</label>
    <input type="text" name="email" required>

    <label for="description">Password:</label>
    <input type="password" name="password" required/>

    <button type="submit">create</button>
</form>
@endsection