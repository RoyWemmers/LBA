@include('layouts.app')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Create Task</h2>
        </div>
        <div class="card-body">
            {!! Form::open(['action' => 'TaskController@store', 'method' => 'POST' , 'id' => 'createTaskForm']) !!}
                <div>
                    {!! Form::label('taskBody', 'Task') !!}
                    {!! Form::textarea('taskBody', '', ['class' => 'form-control', 'placeholder' => 'Task description...']) !!}
                </div>
                <div>
                    <div>
                        {!! Form::label('taskCategory', 'Category') !!}
                        <input type="text" name="taskCategory" list="categorySelect" class="form-control">
                        <datalist id="categorySelect">
                            @foreach($taskCategories as $category)
                                <option value="{{$category}}">
                            @endforeach
                        </datalist>
                    </div>
                    <div>
                        {!! Form::label('taskStartTime', 'Start Time') !!}
                        {!! Form::time('taskStartTime', '', ['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::label('taskEndTime', 'End Time') !!}
                        {!! Form::time('taskEndTime', '', ['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::label('datepicker', 'Date') !!}
                        {!! Form::text('taskCreationDate', '' , ['class' => 'form-control', 'id' => 'datepicker']) !!}
                    </div>
                </div>
                {!! Form::submit('Add Task', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>