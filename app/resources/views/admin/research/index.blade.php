@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Research projects</h2>
            <a href="{{ route('admin.research-projects.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">New project</a>
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
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Updated</th>
                            <th class="px-4 py-2 text-right font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($projects as $project)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 font-semibold">{{ $project->title }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $project->brand->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ Str::headline($project->status) }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $project->updated_at->diffForHumans() }}</td>
                                <td class="px-4 py-3 text-right"><a href="{{ route('admin.research-projects.edit', $project) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
