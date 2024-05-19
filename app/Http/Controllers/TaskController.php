<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $title = 'Mis Tareas ';
            $tasks = Task::whereUserId(auth()->id())
                ->where('is_active', true)
                ->latest()
                ->paginate(5);
            return view('tasks.index', compact('tasks', 'title'));
        } catch (\Exception $e) {
            Log::error('Error al obtener las tareas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener las tareas.');
        }
    }

    public function create()
    {
        try {
            $title = 'Nueva Tarea ';
            $statuses = TaskStatus::all();
            return view('tasks.create', compact('title', 'statuses'));
        } catch (\Exception $e) {
            Log::error('Error al cargar el formulario de creación de tareas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario.');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|min:3|max:255',
                'body' => 'required|string|min:5|max:255',
                'task_status_id' => 'required|exists:task_statuses,id',
            ]);

            $request->user()->tasks()->create($validated);

            return redirect()->route('tasks.index')->with('success', 'Tarea creada con éxito');
        } catch (\Exception $e) {
            Log::error('Error al crear tarea: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear la tarea.');
        }
    }

    public function show(Task $task)
    {
        try {
            $title = 'Ver Tarea ';
            return view('tasks.show', compact('task', 'title'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar la tarea: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al mostrar la tarea.');
        }
    }

    public function edit(Task $task)
    {
        try {
            $this->authorize('update', $task);
            $title = 'Editar Tarea ';
            $statuses = TaskStatus::all();
            return view('tasks.edit', compact('task', 'title', 'statuses'));
        } catch (\Exception $e) {
            Log::error('Error al cargar el formulario de edición de tareas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario.');
        }
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        try {
            $this->authorize('update', $task);

            $validated = $request->validate([
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'body' => ['required', 'string', 'min:5', 'max:255'],
                'task_status_id' => ['required', 'exists:task_statuses,id'],
            ]);

            $task->update($validated);
            return redirect(route('tasks.index'))->with('success', 'Tarea actualizada con éxito');
        } catch (\Exception $e) {
            Log::error('Error al actualizar tarea: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la tarea.');
        }
    }

    public function destroy(Task $task)
    {
        try {
            $this->authorize('delete', $task);

            if (auth()->user()->id === $task->user_id) {
                $task->is_active = false;
                $task->save();

                return redirect(route('tasks.index'))->with('success', 'Tarea eliminada con éxito');
            } else {
                return redirect(route('tasks.index'))->with('error', 'No tienes permisos para eliminar esta tarea');
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar tarea: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar la tarea.');
        }
    }
}
