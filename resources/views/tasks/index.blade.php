@extends('master')

@section('content')

@if(session()->has('success'))
{{session()->get('success')}}
@endif


@if(auth()->check())

<h1>Bem vindo de volta {{auth()->user()->name}}</h1>

<form action="{{route('logout')}}" method="POST">
@csrf
<button type="submit">Sair</button>
</form>

<h1>To do List</h1>

<h2><a href="{{route('task.create')}}">Criar nova Task</a><h2>

<ul>
    @foreach ($tasks as $task)
    <li>{{$task->title}}|
        <a href="{{route('task.edit',['task' => $task->id])}}">ver mais</a> |
        <form action="{{ route('task.destroy', ['task' => $task->id]) }}" method="post" style="display:inline">
            @csrf
            @method('delete')
            <button type="submit">deletar</button>
        </form>
    </li>
        @endforeach
</ul>
@endif



@endsection