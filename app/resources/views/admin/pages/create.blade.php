<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create page</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6">
                <form action="{{ route('admin.pages.store') }}" method="POST" class="space-y-6">
                    @include('admin.pages._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
