<x-app-layout :title=$title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tareas') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="flex justify-between items-center">
            <div class="float-left">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100">
                    {{ __('Editar Tarea') }}
                </h2>
            </div>
            <x-secondary-link href="{{ route('tasks.index') }}"
                class="float-right inline-flex gap-2 items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>Volver</x-secondary-link>
        </div>
        <form method="post" action="{{ route('tasks.update', $task) }}"
            class="mt-6 space-y-6 border border-cyan-500 dark:border-gray-800 p-6 dark:bg-slate-800">
            @csrf
            @method('PATCH')
            <div>
                <x-input-label for="title" :value="__('Título')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $task->title)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="body" :value="__('Descripción')" />
                <x-textarea-input id="body" name="body"
                    class="mt-1 block w-full">{{ old('body', $task->body) }}</x-textarea-input>
                <x-input-error class="mt-2" :messages="$errors->get('body')" />
            </div>

            <div>
                <x-input-label for="task_status_id" :value="__('Estado')" />
                <select id="task_status_id" name="task_status_id" class="mt-1 block w-full">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}"
                            {{ old('task_status_id', $task->task_status_id) == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('task_status_id')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>

                    {{ __('Guardar') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
