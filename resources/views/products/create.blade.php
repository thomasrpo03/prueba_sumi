<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 p-4 flex flex-col gap-6">
        <div class="flex justify-between items-center">
            <div class="float-left">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100">
                    {{ __('Nuevo Producto') }}
                </h2>
            </div>
            <x-secondary-link href="{{ route('products.index') }}"
                class="float-right inline-flex gap-2 items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>Volver</x-secondary-link>
        </div>
        <form method="POST" action="{{ route('products.store') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="description" :value="__('Descripción')" />
                <x-textarea-input id="description" class="block mt-1 w-full" name="description"
                    required>{{ old('description') }}</x-textarea-input>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="category_id" :value="__('Categoría')" />
                <select id="category_id" name="category_id" class="block mt-1 w-full" required>
                    <option value="">{{ __('Seleccionar Categoría') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="price" :value="__('Precio')" />
                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')"
                    required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="is_active" :value="__('Disponible')" />
                <input id="is_active" name="is_active" type="checkbox" class="mt-1"
                    {{ old('is_active') ? 'checked' : '' }} />
                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Crear Producto') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
