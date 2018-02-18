@include('layouts.app')

<div class="container">
    @if(empty($taskCategories))
        <h1>You haven't added any Tasks yet!</h1>
        <p>Click on Create Task to add one!</p>
    @endif
    @foreach($taskCategories as $taskCategory)
        <div class="card" style="margin-bottom: 40px;">
            <div class="card-header">
                <h2>{{$taskCategory}}</h2>
            </div>
            <div class="list-group list-group-flush">
                <table class="table table-responsive-md">
                    <thead>
                    <tr>
                        <th scope="col">Taak</th>
                        <th scope="col">Start Tijd</th>
                        <th scope="col">Eind Tijd</th>
                        <th scope="col">Datum</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        @if($taskCategory == $task->taskCategory)
                            <tr>
                                <td>{{$task->taskBody}}</td>
                                <td>{{$task->taskStartTime}}</td>
                                <td>{{$task->taskEndTime}}</td>
                                <td>{{$task->taskCreationDate}}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->taskId) }}" style="color: #555;"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['tasks.destroy', $task->taskId]
                                    ]) !!}
                                    <button type="submit" id="submitBtn">
                                        <i class="fas fa-times" aria-hidden="true"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

