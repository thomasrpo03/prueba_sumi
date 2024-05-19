<x-app-layout :title=$title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="flex justify-between items-center">
            <div class="float-left">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100">
                    {{ __('Editar Producto') }}
                </h2>
            </div>
            <x-secondary-link href="{{ route('products.index') }}"
                class="float-right inline-flex gap-2 items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>Volver</x-secondary-link>
        </div>
        <form method="post" action="{{ route('products.update', $product) }}"
            class="mt-6 space-y-6 border border-cyan-500 dark:border-gray-800 p-6 dark:bg-slate-800">
            @csrf
            @method('PATCH')
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Descripción')" />
                <x-textarea-input id="description" name="description"
                    class="mt-1 block w-full">{{ old('description', $product->description) }}</x-textarea-input>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="category_id" :value="__('Categoría')" />
                <select id="category_id" name="category_id" class="mt-1 block w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
            </div>

            <div>
                <x-input-label for="price" :value="__('Precio')" />
                <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" :value="old('price', $product->price)"
                    required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('price')" />
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
