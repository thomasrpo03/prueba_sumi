<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $title = 'Mis Tareas ';
        // Traer todas las tareas propias del usuario
        $tasks = Task::whereUserId(auth()->id())->latest()->paginate(5);
        return view('tasks.index', compact('tasks', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Nueva Tarea ';
        $statuses = TaskStatus::all();
        return view('tasks.create', compact('title', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validaciones para la creación de una tarea
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:5|max:255',
            'task_status_id' => 'required|exists:task_statuses,id',
        ]);

        $request->user()->tasks()->create($validated);

        return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito');
        // dd('Tarea creada', $validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $title = 'Ver Tarea ';
        return view('tasks.show', compact('task', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $title = 'Editar Tarea ';
        $statuses = TaskStatus::all();
        return view('tasks.edit', compact('task', 'title', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);


        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'body' => ['required', 'string', 'min:5', 'max:255'],
            'task_status_id' => ['required', 'exists:task_statuses,id'],
        ]);

        $task->update($validated);
        return redirect(route('tasks.index'))->with('success','Tarea actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this-> authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Tarea eliminada con éxito');
    }
}
