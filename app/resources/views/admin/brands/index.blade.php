<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Brands</h2>
            <a href="{{ route('admin.brands.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">New brand</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Name</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Slug</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Primary color</th>
                            <th class="px-4 py-2 text-right font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($brands as $brand)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 font-semibold">{{ $brand->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $brand->slug }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $brand->primary_color }}</td>
                                <td class="px-4 py-3 text-right"><a href="{{ route('admin.brands.edit', $brand) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
