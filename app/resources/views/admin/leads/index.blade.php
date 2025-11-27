<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Leads</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Name</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Brand</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Interest</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Received</th>
                            <th class="px-4 py-2 text-right font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($leads as $lead)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 font-semibold">{{ $lead->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $lead->brand->name ?? 'Any' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ ucfirst($lead->interest) }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $lead->created_at->diffForHumans() }}</td>
                                <td class="px-4 py-3 text-right space-x-3">
                                    <a href="{{ route('admin.leads.show', $lead) }}" class="text-indigo-600 hover:text-indigo-500">View</a>
                                    <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" class="inline" onsubmit="return confirm('Archive this lead?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-400">Archive</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $leads->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
