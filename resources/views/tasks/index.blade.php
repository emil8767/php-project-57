@extends('layouts.maket')

@section('content')
<section class="bg-white dark:bg-gray-900">
<div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
@include('flash-message')
<div class="grid col-span-full">
<h1 class="mb-5">Задачи</h1>
<div class="w-full flex items-center">
                <div>
                    {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}}
                        <div class="flex">
                            <div>
                            {{ Form::select('status_id', $statuses, null, ['placeholder' => 'Статус', 'class' => 'rounded border-gray-300']) }}<br>
                            </div>
                            <div>
                            {{ Form::select('created_by_id', $users, null, ['placeholder' => 'Автор', 'class' => 'ml-2 rounded border-gray-300']) }}<br>
                            </div>
                            <div>
                            {{ Form::select('assigned_to_id', $users, null, ['placeholder' => 'Исполнитель', 'class' => 'ml-2 rounded border-gray-300']) }}<br>
                            </div>
                            <div>
                                {{ Form::submit('Применить', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2']) }}
                            </div>                
                        </div>
                    {{Form::close()}}
                </div>
</div>
@if(Auth::check())
<div class="flex">
    <a href="{{route('tasks.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Создать задачу            </a>
            </div>
@endif


    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>Статус</th>
                <th>Имя</th>
                <th>Автор</th>
                <th>Исполнитель</th>
                <th>Дата создания</th>
                @if(Auth::check())
                <th>Действия</th>
                @endif

                            </tr>
        </thead>
        @foreach ($tasks as $task)
        <tr class="border-b border-dashed text-left">
                <td>{{$task->id}}</td>
                <td>{{$task->status->name}}</td>
                <td>
                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                    {{$task->name}}
                    </a>
                </td>
                <td>{{$task->created_by->name}}</td>
                <td>{{$task->assigned_to->name}}</td>
                <td>{{$task->created_at}}</td>
                @can('update', $task)
<td>@can('delete', $task)
    <a  data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" rel="nofollow" href="{{route('tasks.destroy', $task)}}">
                Удалить</a>
                @endcan
                <a class="text-blue-600 hover:text-blue-900" href="{{route('tasks.edit', $task)}}">
                Изменить</a></td>
                @endcan
            </tr>
        @endforeach
            </table>
    
</div>
            </div>
        </section>
@endsection