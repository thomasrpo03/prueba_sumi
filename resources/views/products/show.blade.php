<x-app-layout :title=$title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 p-4 ">
        <x-secondary-link href="{{ route('products.index') }}" class="mb-4">{{ __('Volver') }}</x-secondary-link>
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">
            <div class="p-6 flex flex-col gap-3">
                <h2 class="text-2xl font-extrabold uppercase text-gray-800 dark:text-white">{{ $product->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $product->description }}</p>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $product->category->name }}</p>
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ '$' . number_format($product->price, 2) }}</p>
            </div>
            <div class="flex justify-end p-4 bg-gray-100 dark:bg-gray-700 gap-2">
                <x-primary-link href="{{ route('products.edit', $product) }}">{{ __('Editar') }}</x-primary-link>
                <form method="POST" action="{{ route('products.destroy', $product) }}">
                    @csrf
                    @method('DELETE')
                    <x-danger-button
                        onclick="return confirm('{{ __('¿Seguro que quieres eliminar este producto?') }}')">{{ __('Eliminar') }}</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
