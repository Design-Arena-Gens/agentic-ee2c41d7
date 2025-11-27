<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit page</h2>
            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Delete this page?');">
                @csrf
                @method('DELETE')
                <button class="rounded-md border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Delete</button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6">
                <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-6">
                    @method('PUT')
                    @include('admin.pages._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
