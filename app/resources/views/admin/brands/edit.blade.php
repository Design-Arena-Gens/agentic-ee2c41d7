<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit brand</h2>
            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Delete this brand?');">
                @csrf
                @method('DELETE')
                <button class="rounded-md border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Delete</button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6">
                <form action="{{ route('admin.brands.update', $brand) }}" method="POST" class="space-y-6">
                    @method('PUT')
                    @include('admin.brands._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
