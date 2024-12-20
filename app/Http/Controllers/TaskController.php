<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('task.index', [
            'tasks' => Task::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        //-- method 01: --//
        // $task = new Task();
        // $task->title = $request->title;
        // $task->description = $request->description;
        // $task->due_date = $request->due_date;
        // $task->save();

        //-- method 02: --//
        // dd($request->due_date);
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        return view('task.edit', [
            'task' => Task::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        // dd($request->all());

        //-- method 01: --//
        // $task = Task::find($id);
        // $task->title = $request->title;
        // $task->description = $request->description;
        // $task->due_date = $request->due_date;
        // $task->save();

        //-- method 02: --//
        $task = Task::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('alert', ['type' => 'warning', 'message' => 'Task Deleted Successfully!']);
    }

    public function getTaskData()
    {
        return Task::take(7)->get();
    }
}
