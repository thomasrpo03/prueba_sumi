<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 p-4">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="description" :value="__('Descripción')" />
                <x-textarea-input id="description" class="block mt-1 w-full" name="description" required>{{ old('description', $product->description) }}</x-textarea-input>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="category_id" :value="__('Categoría')" />
                <select id="category_id" name="category_id" class="block mt-1 w-full" required>
                    <option value="">{{ __('Seleccionar Categoría') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="price" :value="__('Precio')" />
                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price', $product->price)" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="is_active" :value="__('Activo')" />
                <input id="is_active" name="is_active" type="checkbox" class="mt-1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} />
                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Actualizar Producto') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
