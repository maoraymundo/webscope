@extends('layouts.app')

@section('content')
<div class="container" id="tasks">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add task</div>
                <div class="panel-body">
                    <form action="/task" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control" name="task" rows="3"></textarea>
                        </div>
                        <!-- todo pin task, date due -->
                        <button class="btn btn-primary" type="submit">Add</button>
                    </form>
                </div>
            </div>

            @if (count($tasks)) 
            <div class="panel panel-default">
                <div class="panel-heading">Task Summary</div>
                <div class="panel-body">
                    <div class="col-sm-4">Total: <span class="text-default">{{ count($tasks) }}</span></div>
                    @foreach($stats as $stat)
                        @if ($stat->status == 1)
                            <div class="col-sm-4">Open: <span class="text-warning">{{ $stat->total}}</span></div>
                        @else
                            <div class="col-sm-4">Closed: <span class="text-warning">{{ $stat->total}}</span></div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">My Tasks ({{ count($tasks) }})</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><code>TID</code></th>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <!-- todo: pagination -->
                            <tr>
                                <td><code>{{ $task->id }}</code></td>
                                <td class="table-text">
                                    <div>{{ $task->body }}</div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($task->status == 1)
                                        <a href="/task/{{ $task->id }}">Done</a>
                                    @else 
                                        Closed
                                    @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
