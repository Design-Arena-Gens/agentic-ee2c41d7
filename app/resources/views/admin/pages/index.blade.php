@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pages</h2>
            <a href="{{ route('admin.pages.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">New page</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Title</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Brand</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Slug</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-2 text-right font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($pages as $page)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 font-semibold">{{ $page->title }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $page->brand->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $page->slug }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $page->is_active ? 'Active' : 'Hidden' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
