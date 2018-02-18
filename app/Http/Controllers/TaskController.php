<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index()
    {
        // Handles Redirect if user is not logged in
        if(!Auth::check()){
            return redirect('/login');
        } else {

            $taskCategories = [];

            $categories = Task::select('taskCategory')->where('taskCreator', Auth::id())->get();

            foreach($categories as $category) {
                if(!in_array($category->taskCategory, $taskCategories)){
                    $taskCategories[] = $category->taskCategory;
                }
            }

            $tasks = Task::select()->where('taskCreator', Auth::id())->get();

            return view('index', compact('tasks', 'taskCategories'));
        }
    }

    public function create()
    {
        $taskCategories = [];

        $categories = Task::select('taskCategory')->where('taskCreator', Auth::id())->get();

        foreach($categories as $category) {
            if(!in_array($category->taskCategory, $taskCategories)){
                $taskCategories[] = $category->taskCategory;
            }
        }

        return view('logbook.create')->with('taskCategories', $taskCategories);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'taskBody' => 'required',
            'taskCategory' => 'required',
            'taskStartTime' => 'required',
            'taskEndTime' => 'required',
            'taskCreationDate' => 'required'
        ]);

        $task = new Task;
        $task->taskBody = $request->input('taskBody');
        $task->taskCategory = $request->input('taskCategory');
        $task->taskStartTime = $request->input('taskStartTime');
        $task->taskEndTime = $request->input('taskEndTime');
        $task->taskCreationDate = $request->input('taskCreationDate');
        $task->taskCreator = Auth::id();
        $task->save();

        return redirect('/index')->with('success', 'Post Created!');
    }

    public function show($id)
    {
        $task = Task::select()->where('id', $id)->get();

        return $task;
    }

    public function edit($id)
    {
        $task = Task::select('*')->where('taskId', $id)->get();

        return view('logbook.edit')->with('task', $task);
    }

    public function update($id, Request $request)
    {
        $task = Task::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();

        $task->fill($input)->save();

        Session::flash('flash_message', 'Task successfully added!');

        return redirect()->back();
    }

    public function destroy($id)
    {
        Task::select('*')->where('taskId', $id)->delete();

        return redirect('/index');
    }
}
