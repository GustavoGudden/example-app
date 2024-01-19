@extends('master')

@section('content')
<h1>login</h1>

@error('error')
<span>{{message}}</span>
@enderror


<form action="{{ route('auth.login') }}" method="POST">
    @csrf
    <label for="title">Email:</label>
    <input type="text" name="email" required>
    @error('email')
    <span>{{$message}}</span>
    @enderror
    <label for="description">Password:</label>
    <input type="password" name="password" required></input>
    @error('password')
    <span>{{$message}}</span>
    @enderror
    <button type="submit">login</button>
</form>
@endsection