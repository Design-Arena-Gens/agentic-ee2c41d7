<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">FAQs</h2>
            <a href="{{ route('admin.faqs.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">New FAQ</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Brand</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Question</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-2 text-right font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($faqs as $faq)
                            <tr>
                                <td class="px-4 py-3 text-gray-600">{{ $faq->brand->name }}</td>
                                <td class="px-4 py-3 text-gray-900 font-semibold">{{ $faq->question }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $faq->is_active ? 'Active' : 'Hidden' }}</td>
                                <td class="px-4 py-3 text-right"><a href="{{ route('admin.faqs.edit', $faq) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
