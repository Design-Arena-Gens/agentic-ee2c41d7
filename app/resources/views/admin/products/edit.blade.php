<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit product</h2>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                @csrf
                @method('DELETE')
                <button class="rounded-md border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Delete</button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-6">
                    @method('PUT')
                    @include('admin.products._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
