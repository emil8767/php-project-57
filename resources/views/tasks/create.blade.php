@extends('layouts.maket')

@section('content')
<section class="bg-white dark:bg-gray-900">
            <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            <div class="grid col-span-full">
    <h1 class="mb-5">Создать задачу</h1>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    
{{ Form::model($task, ['route' => 'tasks.store']) }}
    {{ Form::label('name', 'Имя') }}
    {{ Form::text('name') }}<br>
    {{ Form::label('description', 'Описание') }}
    {{ Form::textarea('description') }}<br>
    {{ Form::label('status_id', 'Статус') }}
    {{ Form::select('status_id', $statuses, null, ['placeholder' => '----------']) }}<br>
    {{ Form::label('assigned_to_id', 'Исполнитель') }}
    {{ Form::select('assigned_to_id', $users, null, ['placeholder' => '----------']) }}<br>
    {{ Form::label('label_id', 'Метки') }}
    {{ Form::select('label_id', $labels, null, ['placeholder' => '', 'multiple']) }}<br>
    {{ Form::submit('Создать') }}
{{ Form::close() }}

</div>
            </div>
        </section>
        @endsection