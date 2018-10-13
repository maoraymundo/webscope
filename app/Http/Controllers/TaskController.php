<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Validator;
use Auth;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskService $taskService)
    {
        $this->middleware('auth');
        $this->taskService = $taskService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $stats = $this->taskService->getStats($userId);
        $tasks = $this->taskService->getUserTasks($userId);

        return view('home', [
            'tasks' => $tasks,
            'stats' => $stats
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task();
        $task->body = $request->task;
        $task->status = 1;
        $task->user()->associate(Auth::user());
        $task->save();

        return redirect('/home');
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status = '2';
        $task->save();

        return redirect('/home');
    }
}
