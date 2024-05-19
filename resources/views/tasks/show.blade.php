<x-app-layout :title=$title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tareas') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 p-4 ">
        <x-secondary-link href="{{ route('tasks.index') }}" class="mb-4">{{ __('Volver') }}</x-secondary-link>
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-extrabold uppercase text-gray-800 dark:text-white">{{ $task->title }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $task->body }}</p>
            </div>
            @if ($task->user->is(auth()->user()))
                <div class="flex justify-end p-4 bg-gray-100 dark:bg-gray-700 gap-2">
                    <x-primary-link href="{{ route('tasks.edit', $task) }}">{{ __('Editar') }}</x-primary-link>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')
                        <x-danger-button
                            onclick="return confirm('{{ __('¿Seguro que quieres eliminar esta tarea?') }}')">{{ __('Eliminar') }}</x-danger-button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
